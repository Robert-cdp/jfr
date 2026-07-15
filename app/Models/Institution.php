<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
     use SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function schoolYears(): HasMany
    {
        return $this->hasMany(SchoolYear::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function paymentConcepts(): HasMany
    {
        return $this->hasMany(PaymentConcept::class);
    }

    public function receiptSequences(): HasMany
    {
        return $this->hasMany(ReceiptSequence::class);
    }
}
