<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Review;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        $reviews = Review::with('user')->approved()->latest()->limit(6)->get();
        $reviews = Review::with(['user', 'product'])->latest()->limit(5)->get();

        return view('dashboard', compact('products', 'categories', 'reviews'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        // Incrémenter le compteur de vues
        $product->increment('views');

        return view('products.show', compact('product'));
    }
    public function recordStockMovement($type, $quantity, $reason = null)
    {
        $before = $this->stock;
        $after = $this->stock + ($type === 'in' ? $quantity : -$quantity);

        $this->stockMovements()->create([
            'type' => $type,
            'quantity' => $quantity,
            'stock_before' => $before,
            'stock_after' => $after,
            'reason' => $reason,
        ]);

        $this->stock = $after;
        $this->save();

        // Alerte stock bas
        if ($after <= 5) {
            Notification::create([
                'user_id' => 1, // admin ID
                'type' => 'stock_alert',
                'message' => 'Le produit "' . $this->name . '" a un stock critique (' . $after . ' unités).',
                'link' => route('admin.products.edit', $this),
                'is_read' => false,
            ]);
        }
    }
}