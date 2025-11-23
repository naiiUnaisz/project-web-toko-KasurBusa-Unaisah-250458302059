<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table ='cart_items';

    protected $fillable = [
        'user_id',
        'produk_id',
        'quantity',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }
}
