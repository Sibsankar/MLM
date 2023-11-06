<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'aadhar',
        'segment',
        'amount',
        'txnid',
        'payment_details',
        'payment_image',
        'is_approved',
        'user_id'
    ];
}
