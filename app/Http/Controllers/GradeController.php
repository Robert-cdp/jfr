<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\Grade;
use App\Models\Institution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GradeController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('search'));

        $grades = Grade::with('institution')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('institution', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('order')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('grades.index', compact(
            'grades',
            'search'
        ));
    }

    public function create(): View
    {
        $institutions = Institution::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('grades.create', compact('institutions'));
    }

    public function store(StoreGradeRequest $request): RedirectResponse
    {
        Grade::create($request->validated());

        return redirect()
            ->route('grades.index')
            ->with('success', 'Grado creado correctamente.');
    }

    public function show(Grade $grade): View
    {
        $grade->load('institution');

        return view('grades.show', compact('grade'));
    }

    public function edit(Grade $grade): View
    {
        $institutions = Institution::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('grades.edit', compact(
            'grade',
            'institutions'
        ));
    }

    public function update(UpdateGradeRequest $request, Grade $grade): RedirectResponse
    {
        $grade->update($request->validated());

        return redirect()
            ->route('grades.index')
            ->with('success', 'Grado actualizado correctamente.');
    }

    public function destroy(Grade $grade): RedirectResponse
    {
        $grade->delete();

        return redirect()
            ->route('grades.index')
            ->with('success', 'Grado eliminado correctamente.');
    }
}
