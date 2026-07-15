<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'school_year_id',
        'grade_id',
        'enrollment_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'enrollment_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function schoolYear(): BelongsTo
    {
        return $this->belongsTo(SchoolYear::class);
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function charges(): HasMany
    {
        return $this->hasMany(Charge::class);
    }
}
