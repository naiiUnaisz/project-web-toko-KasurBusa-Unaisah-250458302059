<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlamatUser extends Model
{
    protected $table ='user_addresses';

    protected $fillable = [
        'user_id',
        'address_label',
        'recipient_name',
        'phone_number',
        'address_line',
        'city',
        'province',
        'postal_code',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

        public function orders()
    {
        return $this->hasMany(Order::class, 'address_id');
    }

}
