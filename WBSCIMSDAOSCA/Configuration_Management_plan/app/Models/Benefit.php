<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Benefit extends Model
{
    protected $fillable = [
        'senior_citizen_id','benefit_type','amount','claimed_at','status','remarks','verified_by'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'claimed_at' => 'datetime',
    ];

    public function seniorCitizen(): BelongsTo
    {
        return $this->belongsTo(SeniorCitizen::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}