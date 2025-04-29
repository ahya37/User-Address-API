<?php

namespace App\Address\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = ['user_id', 'label', 'recipient_name', 'phone_number', 'address_line', 'postal_code', 'city', 'province', 'country', 'is_default'];
}
