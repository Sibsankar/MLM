<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    protected $table = 'user_details';
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'password',
    ];
}
