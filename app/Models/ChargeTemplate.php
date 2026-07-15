<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChargeTemplate extends Model
{
    protected $fillable = [
        'school_year_id',
        'grade_id',
        'payment_concept_id',
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

    public function schoolYear(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function paymentConcept(): BelongsTo
    {
        return $this->belongsTo(PaymentConcept::class);
    }
}
