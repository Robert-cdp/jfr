<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentConceptRequest;
use App\Http\Requests\UpdatePaymentConceptRequest;
use App\Models\Institution;
use App\Models\PaymentConcept;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentConceptController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('search'));

        $paymentConcepts = PaymentConcept::with('institution')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('institution', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('payment-concepts.index', compact(
            'paymentConcepts',
            'search'
        ));
    }

    public function create(): View
    {
        $institutions = Institution::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('payment-concepts.create', compact('institutions'));
    }

    public function store(StorePaymentConceptRequest $request): RedirectResponse
    {
        PaymentConcept::create($request->validated());

        return redirect()
            ->route('payment-concepts.index')
            ->with('success', 'Concepto creado correctamente.');
    }

    public function show(PaymentConcept $paymentConcept): View
    {
        $paymentConcept->load('institution');

        return view('payment-concepts.show', compact('paymentConcept'));
    }

    public function edit(PaymentConcept $paymentConcept): View
    {
        $institutions = Institution::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('payment-concepts.edit', compact(
            'paymentConcept',
            'institutions'
        ));
    }

    public function update(
        UpdatePaymentConceptRequest $request,
        PaymentConcept $paymentConcept
    ): RedirectResponse {

        $paymentConcept->update(
            $request->validated()
        );

        return redirect()
            ->route('payment-concepts.index')
            ->with('success', 'Concepto actualizado correctamente.');
    }

    public function destroy(
        PaymentConcept $paymentConcept
    ): RedirectResponse {

        $paymentConcept->delete();

        return redirect()
            ->route('payment-concepts.index')
            ->with('success', 'Concepto eliminado correctamente.');
    }
}
