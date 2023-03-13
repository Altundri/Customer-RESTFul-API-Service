<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id_address';

    protected $fillable = [
        'customer_id',
        'address',
        'district',
        'city',
        'province',
        'postal_code'
    ];
}
