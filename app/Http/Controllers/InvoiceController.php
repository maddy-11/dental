<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index()
    {
        $payments = Invoice::all();
        return view('content.invoice.index', compact('payments'));
    }

    public function fetch(Request $request)
{
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    if ($startDate && $endDate) {
            $startDate = Carbon::createFromFormat('m/d/Y', $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', $endDate)->endOfDay();
        }

    $invoices = Invoice::with('appointment', 'appointment.service', 'appointment.user')
    ->whereBetween('created_at', [$startDate, $endDate])
    ->withSum('payments', 'amount')
    ->get();

    return response()->json($invoices);
}
}
