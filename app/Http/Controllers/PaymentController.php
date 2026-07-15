<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Charge;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->get('search'));
        $payments = Payment::with(['charge.enrollment.student', 'charge.paymentConcept', 'user',])->when($search, function ($query) use ($search) {
            $query->where('receipt_number', 'like', "%{$search}%")->orWhereHas('charge.enrollment.student', function ($query) use ($search) {
                $query->where('code', 'like', "%{$search}%")->orWhere('first_name', 'like', "%{$search}%")->orWhere('last_name', 'like', "%{$search}%");
            });
        })->latest('payment_date')->paginate(15)->withQueryString();
        return view('payments.index', compact('payments', 'search'));
    }

    public function create(): View
    {
        $charges = Charge::with(['enrollment.student', 'paymentConcept',])->orderByDesc('id')->get();
        return view('payments.create', compact('charges'));
    }

    public function store(StorePaymentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        Payment::create($data);
        return redirect()->route('payments.index')->with('success', 'Pago registrado correctamente.');
    }

    public function show(Payment $payment): View
    {
        $payment->load(['charge.paymentConcept', 'charge.enrollment.student', 'user',]);
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment): View
    {
        $charges = Charge::with(['enrollment.student', 'paymentConcept',])->orderByDesc('id')->get();
        return view('payments.edit', compact('payment', 'charges'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment): RedirectResponse
    {
        $payment->update($request->validated());
        return redirect()->route('payments.index')->with('success', 'Pago actualizado correctamente.');
    }
    
    public function destroy(Payment $payment): RedirectResponse
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Pago eliminado correctamente.');
    }
}
