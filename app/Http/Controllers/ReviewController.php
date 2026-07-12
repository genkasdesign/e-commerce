<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        // Récupère les produits commandés par le client
        $productIds = $user->orders()
                        ->with('items')
                        ->get()
                        ->pluck('items')
                        ->flatten()
                        ->pluck('product_id')
                        ->unique()
                        ->values();

        $products = Product::whereIn('id', $productIds)->get();

        return view('reviews.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);

        // Vérifier que le client a bien acheté ce produit
        $hasPurchased = Auth::user()->orders()->whereHas('items', function ($query) use ($request) {
            $query->where('product_id', $request->product_id);
        })->exists();

        if (!$hasPurchased) {
            return redirect()->back()->with('error', 'Vous ne pouvez laisser un avis que sur un produit que vous avez acheté.');
        }

        // Vérifier si un avis existe déjà pour ce produit par cet utilisateur
        $exists = Review::where('user_id', Auth::id())
                        ->where('product_id', $request->product_id)
                        ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Vous avez déjà laissé un avis pour ce produit.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Merci pour votre avis ! Il sera visible après validation.');
    }
}