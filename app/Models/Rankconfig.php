<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rankconfig extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'rank_id',
        'performance_target',
        'commission_cat',
        'commission_type',
        'guaranteed_prize',
        'conveyance',
        'percentage',
        'multiple_by',
        'amount'
    ];
}
