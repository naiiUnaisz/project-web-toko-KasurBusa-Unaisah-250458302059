<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariant extends Model
{
    use HasFactory;

    
    // protected $table = 'product_variants'; 

    // protected $fillable = [
    //     'produk_id', 
    //     'size_id',
    //     'price', 
    //     'stock_quantity'
    // ];
    
    // // Relasi ke Produk
    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'produk_id'); 
    // }
    
    // // Relasi ke Ukuran (Size)
    // public function size()
    // {
    //     return $this->belongsTo(Size::class, 'size_id');
    // }
}
