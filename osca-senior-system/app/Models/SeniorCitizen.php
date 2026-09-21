<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeniorCitizen extends Model
{
    protected $fillable = [
        'senior_id','first_name','middle_name','last_name','birth_date',
        'sex','address','barangay','pension_status','philhealth_status',
        'qr_code','status'
    ];

    protected $casts = ['birth_date' => 'date'];

    public function benefits(): HasMany
    {
        return $this->hasMany(Benefit::class);
    }

    public function verificationLogs(): HasMany
    {
        return $this->hasMany(VerificationLog::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name.' '.($this->middle_name ? $this->middle_name.' ' : '').$this->last_name);
    }

    public function getAgeAttribute(): int
    {
        return $this->birth_date?->age ?? 0;
    }
}
