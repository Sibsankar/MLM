<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    protected $table = 'user_details';
    use HasFactory;

    protected $fillable = [
        'associate_name',
        'first_name',
        'last_name',
        'user_id',
        'sponsor_code',
        'rank',
        'dob',
        'aadhar_no',
        'email',
        'phone_no',
        'percentage_cat',
        'is_active',
        'address_line1',
        'address_line2',
        'state',
        'country',
        'city',
        'pin',
        'referred_by',
        'image'
    ];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        } else {
            return asset('images/no-image.png');
        }
    }
}
