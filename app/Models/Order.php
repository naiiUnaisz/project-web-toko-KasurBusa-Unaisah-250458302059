<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table ='orders';

    protected $fillable = [
        'user_id',
        'user_address_id',
        'order_number',
        'total_amount',
        'status',
        'courier_name',
        'tracking_number',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(AlamatUser::class, 'user_address_id');
    }
}
