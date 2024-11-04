<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Invoice;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index($id)
    {
        $payments = Payment::where('invoice_id', $id)->get();
        $patient = $payments[0]->examination->patient->name;
        $date = $payments[0]->examination->appointment->start_date_time;
        $total = $payments->sum('amount');
        return view('content.payments.index', compact('payments', 'patient', 'date', 'total'));
    }

}
