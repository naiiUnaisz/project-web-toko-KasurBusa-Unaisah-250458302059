<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table ='product_reviews';

    protected $fillable = [
        'user_id',
        'product_id',
        'order_item_id',
        'rating',
        'comment',
        'is_approved',
        'approved_byadmin_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }
}
