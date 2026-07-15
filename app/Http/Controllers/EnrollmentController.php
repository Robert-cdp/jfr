<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('search'));

        $enrollments = Enrollment::with([
            'student',
            'grade',
            'schoolYear',
        ])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('student', function ($query) use ($search) {
                    $query->where('code', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('enrollments.index', compact(
            'enrollments',
            'search'
        ));
    }

    public function create(): View
    {
        $students = Student::orderBy('last_name')->get();

        $grades = Grade::where('is_active', true)
            ->orderBy('order')
            ->get();

        $schoolYears = SchoolYear::where('is_active', true)
            ->orderByDesc('start_date')
            ->get();

        return view('enrollments.create', compact(
            'students',
            'grades',
            'schoolYears'
        ));
    }

    public function store(StoreEnrollmentRequest $request): RedirectResponse
    {
        Enrollment::create($request->validated());

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Alumno inscrito correctamente.');
    }

    public function show(Enrollment $enrollment): View
    {
        $enrollment->load([
            'student',
            'grade',
            'schoolYear',
            'charges',
        ]);

        return view('enrollments.show', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment): View
    {
        $students = Student::orderBy('last_name')->get();

        $grades = Grade::where('is_active', true)
            ->orderBy('order')
            ->get();

        $schoolYears = SchoolYear::orderByDesc('start_date')->get();

        return view('enrollments.edit', compact(
            'enrollment',
            'students',
            'grades',
            'schoolYears'
        ));
    }

    public function update(
        UpdateEnrollmentRequest $request,
        Enrollment $enrollment
    ): RedirectResponse {

        $enrollment->update(
            $request->validated()
        );

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Inscripción actualizada correctamente.');
    }

    public function destroy(
        Enrollment $enrollment
    ): RedirectResponse {

        $enrollment->delete();

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Inscripción eliminada correctamente.');
    }
}
