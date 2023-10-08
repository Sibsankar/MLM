<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankConfigCommission extends Model
{
    use HasFactory;
    protected $fillable = [
        'rank_id',
        'phase_id',
        'commission_cat',
        'commission_type',
        'percentage',
        'amount'
    ];
}
