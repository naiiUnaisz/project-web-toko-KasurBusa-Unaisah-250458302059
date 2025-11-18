<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    


    // public function variants()
    // {
    //     return $this->hasMany(ProductVariant::class);
    // }

    // public function images()
    // {
    //     return $this->hasMany(ProductImage::class);
    // }
}
