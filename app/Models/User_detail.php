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
        'gender',
        'pan_no',
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
        'image',
        'guardians_name',
        'district',
        'nominee_Name',
        'relation_with_nominee',
        'account_holder_name',
        'bank_name',
        'branch_name',
        'account_number',
        'ifc_code',
        'city_name',
        'pin',
        'country_name',
        'state_name',
        'address_line1',
        'address_line2'
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
