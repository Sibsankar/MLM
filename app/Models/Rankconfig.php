<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;
use App\Models\RankConfigCommission;

class Rankconfig extends Model
{
    use HasFactory;
    use Compoships;
    
    protected $fillable = [
        'rank_id',
        'phase_id',
        'performance_target',
        'guaranteed_prize',
        'conveyance',
        'multiple_by',
        'amount'
    ];

    public function commissions() {
        return $this->hasMany(RankConfigCommission::class, ['rank_id', 'phase_id'], ['rank_id', 'phase_id']);
    }
}
