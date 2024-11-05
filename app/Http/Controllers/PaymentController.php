<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Invoice;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index($id, $startDate, $endDate)
    {   
        $startDate = $startDate ? Carbon::createFromFormat('m-d-Y', $startDate)->startOfDay() : null;
        $endDate = $endDate ? Carbon::createFromFormat('m-d-Y', $endDate)->endOfDay() : null;

        $payments = Payment::with('examination.patient', 'examination.appointment')
        ->where('invoice_id', $id)
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

        $patient = $payments->isNotEmpty() ? $payments[0]->examination->patient->name : null;
        $date = $payments->isNotEmpty() ? $payments[0]->examination->appointment->start_date_time : null;
        $total = $payments->sum('amount');

        return view('content.payments.index', compact('payments', 'patient', 'date', 'total'));
    }

    public function destroy($id)
    {
        $invoice = Payment::findOrFail($id)->delete();
        return back()->with('success', 'Payment Deleted Successfully');
    }


}
