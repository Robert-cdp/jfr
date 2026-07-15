<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Charge extends Model
{
    protected $fillable = [
        'enrollment_id',
        'payment_concept_id',
        'description',
        'amount',
        'due_date',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'due_date' => 'date',
        ];
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function paymentConcept(): BelongsTo
    {
        return $this->belongsTo(PaymentConcept::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function getPaidAttribute(): float
    {
        return (float) $this->payments()->sum('amount');
    }

    public function getBalanceAttribute(): float
    {
        return (float) $this->amount - $this->paid;
    }

    public function getStatusAttribute(): string
    {
        if ($this->paid <= 0) {
            return 'Pendiente';
        }

        if ($this->paid < $this->amount) {
            return 'Parcial';
        }

        return 'Pagado';
    }
}
