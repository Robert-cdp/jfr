<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentConcept extends Model
{
    protected $fillable = [
        'institution_id',
        'name',
        'description',
        'default_amount',
        'is_monthly',
        'allow_partial_payments',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'default_amount' => 'decimal:2',
            'is_monthly' => 'boolean',
            'allow_partial_payments' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function chargeTemplates(): HasMany
    {
        return $this->hasMany(ChargeTemplate::class);
    }

    public function charges(): HasMany
    {
        return $this->hasMany(Charge::class);
    }
}
