<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use App\Models\Institution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InstitutionController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('search'));

        $institutions = Institution::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('institutions.index', compact(
            'institutions',
            'search'
        ));
    }

    public function create(): View
    {
        return view('institutions.create');
    }

    public function store(StoreInstitutionRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            Institution::create($request->validated());
        });

        return redirect()
            ->route('institutions.index')
            ->with('success', 'Institución creada correctamente.');
    }

    public function show(Institution $institution): View
    {
        return view('institutions.show', compact('institution'));
    }

    public function edit(Institution $institution): View
    {
        return view('institutions.edit', compact('institution'));
    }

    public function update(UpdateInstitutionRequest $request, Institution $institution): RedirectResponse
    {
        DB::transaction(function () use ($request, $institution) {
            $institution->update($request->validated());
        });

        return redirect()
            ->route('institutions.index')
            ->with('success', 'Institución actualizada correctamente.');
    }

    public function destroy(Institution $institution): RedirectResponse
    {
        DB::transaction(function () use ($institution) {
            $institution->delete();
        });

        return redirect()
            ->route('institutions.index')
            ->with('success', 'Institución eliminada correctamente.');
    }
}
