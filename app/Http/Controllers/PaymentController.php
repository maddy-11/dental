<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('content.payments.index', compact('payments'));
    }

    public function fetch(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    if ($startDate && $endDate) {
            $startDate = Carbon::createFromFormat('m/d/Y', $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', $endDate)->endOfDay();
        }

    $payments = Payment::with('examination.appointment', 'examination.doctor', 'examination.service')->whereBetween('created_at', [$startDate, $endDate])
    ->get();

    return response()->json($payments);
}
}
