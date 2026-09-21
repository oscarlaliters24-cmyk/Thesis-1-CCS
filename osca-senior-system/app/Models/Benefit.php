<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Benefit extends Model
{
    protected $fillable = [
        'senior_citizen_id','benefit_type','amount','distribution_date','status','notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'distribution_date' => 'date',
    ];

    public function senior(): BelongsTo
    {
        return $this->belongsTo(SeniorCitizen::class, 'senior_citizen_id');
    }
}
