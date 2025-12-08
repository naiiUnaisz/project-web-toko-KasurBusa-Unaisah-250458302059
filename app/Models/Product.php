<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    protected $fillable = [
        'kategori_id',
        'brand_id',
        'foam_type_id',
        'name',
        'slug',
        'size_id',
        'price', 
        'stock_quantity',
        'sku',
        'deskripsi',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function foamType()
    {
        return $this->belongsTo(JenisBusa::class, 'foam_type_id');
    }


   // Relasi ke Ukuran (Size)
   public function size()
   {
       return $this->belongsTo(Size::class, 'size_id');
   }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'produk_id'); 
    }

    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class, 'produk_id')
                    ->where('is_primary', true);
    }

        public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    
        public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'produk_id');
    }

}
