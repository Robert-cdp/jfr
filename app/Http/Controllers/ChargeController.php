<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChargeController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('search'));

        $charges = Charge::with([
                'enrollment.student',
                'paymentConcept',
            ])
            ->when($search, function ($query) use ($search) {

                $query->whereHas('enrollment.student', function ($query) use ($search) {

                    $query->where('code', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");

                });

            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('charges.index', compact(
            'charges',
            'search'
        ));
    }

    public function show(Charge $charge): View
    {
        $charge->load([
            'paymentConcept',
            'enrollment.student',
            'payments.user',
        ]);

        return view('charges.show', compact('charge'));
    }

    public function edit(Charge $charge): View
    {
        return view('charges.edit', compact('charge'));
    }

    public function update(Request $request, Charge $charge): RedirectResponse
    {
        $validated = $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'due_date' => ['nullable', 'date'],
        ]);

        $charge->update($validated);

        return redirect()
            ->route('charges.index')
            ->with('success', 'Cargo actualizado correctamente.');
    }
}
