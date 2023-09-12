<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commision_type extends Model
{
    use HasFactory;
    protected $table = 'commision_type';
    protected $fillable = [
        'category_id',
        'type_name',
        'status'
    ];
    
    // protected $appends = ['commission_categories'];

    // public function getDetailsAttribute()
    // {
    //     return $this->commisionTypes()->get();
    // }

    // public function commisionTypes() {
    //     return $this->hasOne(Commission_categories::class, 'id');
    // }
}
