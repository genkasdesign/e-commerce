<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use App\Mail\NewOrderNotification;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_method' => 'carte_bancaire',
            'shipping_address' => $request->input('shipping_address'),
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            $product = Product::find($productId);
            if ($product) {
                $product->recordStockMovement('out', $item['quantity'], 'Commande #' . $order->id);
            }
        }

        session()->forget('cart');

        // Emails (avec gestion d'erreur)
        try {
            Mail::to($order->user->email)->send(new OrderConfirmation($order));
            Mail::to(config('mail.admin_email', 'admin@monshop.com'))->send(new NewOrderNotification($order));
        } catch (\Exception $e) {
            // On log l'erreur mais on continue pour ne pas bloquer la commande
            \Log::error('Erreur envoi email : ' . $e->getMessage());
        }
        // Notifications
        Notification::create([
            'user_id' => $order->user_id,
            'type' => 'order_status',
            'message' => 'Votre commande #' . $order->id . ' a été enregistrée et est en attente de paiement.',
            'link' => route('orders.show', $order),
            'is_read' => false,
        ]);

        $admin = User::where('is_admin', true)->first();
        if ($admin) {
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'new_order',
                'message' => 'Nouvelle commande #' . $order->id . ' passée par ' . $order->user->email,
                'link' => route('admin.orders.index'),
                'is_read' => false,
            ]);
        }

        dd('Redirection vers payment.show', $order->id);

        return redirect()->route('payment.show', $order)->with('success', 'Commande validée ! Veuillez procéder au paiement.');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if (Auth::id() !== $order->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }
        return view('orders.show', compact('order'));
    }

    public function adminIndex(Request $request)
    {
        $query = Order::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }
        if ($request->filled('client')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->client . '%');
            });
        }

        $orders = $query->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        if ($oldStatus !== $order->status) {
            $statusLabels = [
                'pending' => 'en attente',
                'processing' => 'en traitement',
                'completed' => 'terminée',
                'cancelled' => 'annulée',
            ];
            Notification::create([
                'user_id' => $order->user_id,
                'type' => 'order_status',
                'message' => 'Le statut de votre commande #' . $order->id . ' est maintenant : ' . $statusLabels[$order->status],
                'link' => route('orders.show', $order),
                'is_read' => false,
            ]);
        }

        $statusColors = [
            'pending' => 'bg-yellow-900/30 text-yellow-300',
            'processing' => 'bg-blue-900/30 text-blue-300',
            'completed' => 'bg-green-900/30 text-green-300',
            'cancelled' => 'bg-red-900/30 text-red-300',
        ];

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour.',
            'statusLabel' => __('status.' . $order->status),
            'statusColor' => $statusColors[$order->status],
        ]);
    }
}