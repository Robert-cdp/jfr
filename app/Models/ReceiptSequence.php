<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceiptSequence extends Model
{
    protected $fillable = [
        'institution_id',
        'prefix',
        'current_number',
        'padding',
    ];

    protected function casts(): array
    {
        return [
            'current_number' => 'integer',
            'padding' => 'integer',
        ];
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function getNextReceiptAttribute(): string
    {
        return sprintf(
            '%s-%0' . $this->padding . 'd',
            $this->prefix,
            $this->current_number + 1
        );
    }
}
