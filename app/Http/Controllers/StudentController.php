<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('search'));

        $students = Student::query()
            ->when($search, function ($query) use ($search) {
                $query->where('code', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('guardian_name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('students.index', compact(
            'students',
            'search'
        ));
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        Student::create($request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'Alumno registrado correctamente.');
    }

    public function show(Student $student): View
    {
        $student->load([
            'enrollments.grade',
            'enrollments.schoolYear',
        ]);

        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        $student->update($request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'Alumno actualizado correctamente.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Alumno eliminado correctamente.');
    }
}
