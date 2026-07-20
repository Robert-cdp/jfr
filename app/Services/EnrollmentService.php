<?php

namespace App\Services;

use App\Models\Charge;
use App\Models\ChargeTemplate;
use App\Models\Enrollment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EnrollmentService
{
    public static function store(array $data): Enrollment
    {
        return DB::transaction(function () use ($data) {

            // Crear la inscripción
            $enrollment = Enrollment::create($data);

            // Obtener las plantillas del grado y ciclo
            $templates = ChargeTemplate::with('paymentConcept')
                ->where('school_year_id', $enrollment->school_year_id)
                ->where('grade_id', $enrollment->grade_id)
                ->where('is_active', true)
                ->get();

            foreach ($templates as $template) {

                switch ($template->frequency) {

                    case 'monthly':
                        self::generateMonthlyCharges($enrollment, $template);
                        break;

                    case 'one_time':
                        self::generateOneTimeCharge($enrollment, $template);
                        break;
                }
            }

            return $enrollment;
        });
    }

    /**
     * Genera colegiaturas o pagos mensuales.
     */
    private static function generateMonthlyCharges(
        Enrollment $enrollment,
        ChargeTemplate $template
    ): void {

        $amount = round(
            $template->amount / $template->installments,
            2
        );

        $year = $enrollment->schoolYear->start_date->year;

        for ($month = 0; $month < $template->months; $month++) {

            $currentMonth = $template->start_month + $month;

            $dueDate = Carbon::create(
                $year,
                $currentMonth,
                $template->payment_day
            );

            for ($i = 1; $i <= $template->installments; $i++) {

                Charge::create([
                    'enrollment_id'      => $enrollment->id,
                    'payment_concept_id' => $template->payment_concept_id,
                    'description'        => sprintf(
                        '%s %s%s',
                        $template->paymentConcept->name,
                        $dueDate->translatedFormat('F'),
                        $template->installments > 1
                            ? " ({$i}/{$template->installments})"
                            : ''
                    ),
                    'amount'             => $amount,
                    'due_date'           => $dueDate,
                ]);

            }

        }
    }

    /**
     * Genera un único cargo.
     */
    private static function generateOneTimeCharge(
        Enrollment $enrollment,
        ChargeTemplate $template
    ): void {

        $amount = round(
            $template->amount / $template->installments,
            2
        );

        $year = $enrollment->schoolYear->start_date->year;

        $dueDate = Carbon::create(
            $year,
            $template->event_month,
            $template->payment_day
        );

        for ($i = 1; $i <= $template->installments; $i++) {

            Charge::create([
                'enrollment_id'      => $enrollment->id,
                'payment_concept_id' => $template->payment_concept_id,
                'description'        => sprintf(
                    '%s%s',
                    $template->paymentConcept->name,
                    $template->installments > 1
                        ? " ({$i}/{$template->installments})"
                        : ''
                ),
                'amount'             => $amount,
                'due_date'           => $dueDate,
            ]);

        }
    }
}