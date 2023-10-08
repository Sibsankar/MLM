<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rankconfig extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'rank_id',
        'phase_id',
        'performance_target',
        'guaranteed_prize',
        'conveyance',
        'multiple_by',
        'amount'
    ];
}
