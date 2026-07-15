<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChargeRequest;
use App\Http\Requests\UpdateChargeRequest;
use App\Models\ChargeTemplate;
use App\Models\Grade;
use App\Models\PaymentConcept;
use App\Models\SchoolYear;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChargeTemplateController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('search'));

        $chargeTemplates = ChargeTemplate::with([
            'schoolYear',
            'grade',
            'paymentConcept',
        ])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('paymentConcept', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('grade', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('schoolYear', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('charge-templates.index', compact(
            'chargeTemplates',
            'search'
        ));
    }

    public function create(): View
    {
        $schoolYears = SchoolYear::where('is_active', true)
            ->orderByDesc('start_date')
            ->get();

        $grades = Grade::where('is_active', true)
            ->orderBy('order')
            ->get();

        $paymentConcepts = PaymentConcept::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('charge-templates.create', compact(
            'schoolYears',
            'grades',
            'paymentConcepts'
        ));
    }

    public function store(StoreChargeRequest $request): RedirectResponse
    {
        ChargeTemplate::create($request->validated());

        return redirect()
            ->route('charge-templates.index')
            ->with('success', 'Plantilla creada correctamente.');
    }

    public function show(ChargeTemplate $chargeTemplate): View
    {
        $chargeTemplate->load([
            'schoolYear',
            'grade',
            'paymentConcept',
        ]);

        return view('charge-templates.show', compact('chargeTemplate'));
    }

    public function edit(ChargeTemplate $chargeTemplate): View
    {
        $schoolYears = SchoolYear::where('is_active', true)
            ->orderByDesc('start_date')
            ->get();

        $grades = Grade::where('is_active', true)
            ->orderBy('order')
            ->get();

        $paymentConcepts = PaymentConcept::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('charge-templates.edit', compact(
            'chargeTemplate',
            'schoolYears',
            'grades',
            'paymentConcepts'
        ));
    }

    public function update(
        UpdateChargeRequest $request,
        ChargeTemplate $chargeTemplate
    ): RedirectResponse {

        $chargeTemplate->update(
            $request->validated()
        );

        return redirect()
            ->route('charge-templates.index')
            ->with('success', 'Plantilla actualizada correctamente.');
    }

    public function destroy(
        ChargeTemplate $chargeTemplate
    ): RedirectResponse {

        $chargeTemplate->delete();

        return redirect()
            ->route('charge-templates.index')
            ->with('success', 'Plantilla eliminada correctamente.');
    }
}
