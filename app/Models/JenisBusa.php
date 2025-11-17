<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisBusa extends Model
{
    use HasFactory;

    protected $table = 'foam_types';
    
    protected $fillable = ['name', 'slug'];
}
