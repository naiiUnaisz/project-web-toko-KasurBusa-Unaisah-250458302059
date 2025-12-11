<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table ='order_items';

    protected $fillable = [
        'order_id',
        'produk_id',
        'quantity',
        'price',
        'product_name_snapshot',

    ];


    public function product(){
        return $this->belongsTo(Product::class, 'produk_id');
    }
    
}
