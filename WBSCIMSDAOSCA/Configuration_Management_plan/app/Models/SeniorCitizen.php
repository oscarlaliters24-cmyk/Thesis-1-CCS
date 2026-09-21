<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeniorCitizen extends Model
{
    protected $fillable = [
        'osca_id','first_name','middle_name','last_name','suffix',
        'birth_date','sex','civil_status','barangay','address',
        'contact_number','email','philhealth_number','pension_type',
        'pension_enrolled','qr_token','is_active'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'pension_enrolled' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function benefits(): HasMany
    {
        return $this->hasMany(Benefit::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->first_name, $this->middle_name, $this->last_name, $this->suffix
        ])));
    }

    public function getAgeAttribute(): ?int
    {
        return $this->birth_date?->age;
    }
}