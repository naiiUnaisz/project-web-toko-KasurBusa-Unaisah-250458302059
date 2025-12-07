<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    protected $table ='payment_confirmations';

    protected $fillable = [
        'order_id',
        'proof_image_url',
        'payment_method',
        'bank_name',
        'account_name',
        'status',

    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
