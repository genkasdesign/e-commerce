<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        // Vérifier que la commande appartient à l'utilisateur connecté
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Ne permettre le paiement que si le statut est 'pending' et le paiement 'pending'
        if ($order->payment_status !== 'pending') {
            return redirect()->route('orders.show', $order)->with('error', 'Cette commande a déjà été payée ou est annulée.');
        }

        return view('payment.index', compact('order'));
    }

    public function process(Request $request, Order $order)
    {
        // Vérifier que la commande appartient à l'utilisateur connecté
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Simuler un paiement (succès dans 80% des cas)
        $success = rand(1, 100) <= 80;

        if ($success) {
            $order->payment_status = 'paid';
            $order->status = 'processing'; // Optionnel : changer le statut de la commande
            $message = 'Paiement accepté ! Merci pour votre commande.';
        } else {
            $order->payment_status = 'failed';
            $message = 'Le paiement a échoué. Veuillez réessayer.';
        }

        // Enregistrer la méthode de paiement choisie
        $order->payment_method = $request->input('payment_method', 'carte_bancaire');
        $order->save();

        return redirect()->route('orders.show', $order)->with('status', $message);
    }
}