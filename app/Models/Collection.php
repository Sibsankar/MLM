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

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        if ($this->payment_image) {
            return asset('images/' . $this->payment_image);
        } else {
            return asset('images/no-image.png');
        }
    }
}
