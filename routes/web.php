<?php

use App\Http\Controllers\ChargeController;
use App\Http\Controllers\ChargeTemplateController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\PaymentConceptController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::resources([
        'institutions'      => InstitutionController::class,
        'school-years'      => SchoolYearController::class,
        'grades'            => GradeController::class,
        'students'          => StudentController::class,
        'enrollments'       => EnrollmentController::class,
        'payment-concepts'  => PaymentConceptController::class,
        'charge-templates'  => ChargeTemplateController::class,
        'payments'          => PaymentController::class,
    ]);

    Route::resource('charges', ChargeController::class)
        ->except(['create', 'store']);
});