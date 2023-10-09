<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;

class RankConfigCommission extends Model
{
    use HasFactory;
    use Compoships;
    
    protected $fillable = [
        'rank_id',
        'phase_id',
        'commission_cat',
        'commission_type',
        'percentage',
        'amount'
    ];
}
