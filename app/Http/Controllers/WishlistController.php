<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Auth::user()->wishlists()->with('product')->get();
        return view('wishlist.index', compact('wishlists'));
    }

    public function store(Request $request, Product $product)
    {
        $exists = Wishlist::where('user_id', Auth::id())
                          ->where('product_id', $product->id)
                          ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);
            return response()->json(['success' => true, 'message' => 'Produit ajoute aux favoris.', 'inWishlist' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Deja dans vos favoris.', 'inWishlist' => true]);
    }

    public function destroy(Product $product)
    {
        Wishlist::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->delete();

        return response()->json(['success' => true, 'message' => 'Produit retire des favoris.', 'inWishlist' => false]);
    }
}