<?php

namespace App\Services;

use App\Models\SchoolYear;
use Illuminate\Support\Facades\DB;

class SchoolYearService
{
    public static function store(array $data): SchoolYear
    {
        return DB::transaction(function () use ($data) {

            if ($data['is_active']) {
                SchoolYear::where('institution_id', $data['institution_id'])
                    ->update([
                        'is_active' => false
                    ]);
            }

            return SchoolYear::create($data);
        });
    }

    public static function update(SchoolYear $schoolYear, array $data): SchoolYear
    {
        return DB::transaction(function () use ($schoolYear, $data) {

            if ($data['is_active']) {
                SchoolYear::where('institution_id', $data['institution_id'])
                    ->whereKeyNot($schoolYear->id)
                    ->update([
                        'is_active' => false
                    ]);
            }

            $schoolYear->update($data);

            return $schoolYear;
        });
    }
}