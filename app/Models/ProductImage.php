<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'products_images';

    protected $fillable = [
        'produk_id',
        'image_url', 
        'alt_text',
        'is_primary'
    ];

    
    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }
}
