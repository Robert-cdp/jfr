<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'phone',
        'email',
        'address',
        'father_name',
        'mother_name',
        'guardian_name',
        'guardian_phone',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
