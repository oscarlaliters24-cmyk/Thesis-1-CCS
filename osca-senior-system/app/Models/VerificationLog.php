<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationLog extends Model
{
    protected $fillable = ['senior_citizen_id','verified_by','verification_date','status'];

    protected $casts = ['verification_date' => 'datetime'];

    public function senior(): BelongsTo
    {
        return $this->belongsTo(SeniorCitizen::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
