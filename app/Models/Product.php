<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;
use App\Models\User;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
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

        // Alerte stock bas (email + notification)
        if ($after <= 5) {
            // Notification admin
            $admin = User::where('is_admin', true)->first();
            if ($admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'type' => 'low_stock',
                    'message' => 'Le stock du produit "' . $this->name . '" est bas : ' . $after . ' unités restantes.',
                    'link' => route('admin.products.edit', $this->id),
                    'is_read' => false,
                ]);
            }
            // Email
            \App\Mail\LowStockAlert::sendAlert($this);
        }
    }
}