<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSchoolYearRequest;
use App\Http\Requests\UpdateSchoolYearRequest;
use App\Models\Institution;
use App\Models\SchoolYear;
use App\Services\SchoolYearService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SchoolYearController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('search'));

        $schoolYears = SchoolYear::with('institution')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('institution', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('school-years.index', compact(
            'schoolYears',
            'search'
        ));
    }

    public function create(): View
    {
        $institutions = Institution::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('school-years.create', compact('institutions'));
    }

    public function store(StoreSchoolYearRequest $request)
    {
        SchoolYearService::store($request->validated());

        return to_route('school-years.index')
            ->with('success', 'Ciclo escolar creado correctamente.');
    }

    public function show(SchoolYear $schoolYear): View
    {
        $schoolYear->load('institution');

        return view('school-years.show', compact('schoolYear'));
    }

    public function edit(SchoolYear $schoolYear): View
    {
        $institutions = Institution::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('school-years.edit', compact(
            'schoolYear',
            'institutions'
        ));
    }

    public function update(
        UpdateSchoolYearRequest $request,
        SchoolYear $schoolYear
    ): RedirectResponse {

        SchoolYearService::update(
            $schoolYear,
            $request->validated()
        );

        return to_route('school-years.index')
            ->with('success', 'Ciclo escolar actualizado correctamente.');
    }

    public function destroy(SchoolYear $schoolYear): RedirectResponse
    {
        $schoolYear->delete();

        return redirect()
            ->route('school-years.index')
            ->with('success', 'Ciclo escolar eliminado correctamente.');
    }
}
