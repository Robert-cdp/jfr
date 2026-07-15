<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'charge_id',
        'user_id',
        'receipt_number',
        'amount',
        'payment_date',
        'payment_method',
        'reference',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'payment_date' => 'datetime',
        ];
    }

    public function charge(): BelongsTo
    {
        return $this->belongsTo(Charge::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
