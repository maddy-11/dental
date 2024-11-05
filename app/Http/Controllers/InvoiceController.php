<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Payment;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        $payments = \Auth::user()->status === "Patient"
        ? Invoice::whereHas('appointment', fn($query) => $query->where('patient_id', \Auth::id()))->get()
        : Invoice::all();

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

    public function invoice($id)
    {
        $invoice = Invoice::where('id',$id)->withSum('payments', 'amount')->first();
        $payments = Payment::where('invoice_id', $invoice->id)->get();
        $patient = $invoice->appointment->patient;
        return view('content.invoice.invoice', compact('patient', 'payments', 'invoice'));
    }

    public function downloadPDF($id)
    {
        $invoice = Invoice::where('id',$id)->withSum('payments', 'amount')->first();
        $payments = Payment::where('invoice_id', $invoice->id)->get();
        $patient = $invoice->appointment->patient;
        $pdf = PDF::loadView('content.invoice.invoicePDF', compact('invoice', 'payments', 'patient'));
        return $pdf->download('invoice.pdf');
    }

    public function destroy($id){
        $invoice = Invoice::findOrFail($id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        return back()->with('success', 'Payment Deleted Successfully');
    }
}
