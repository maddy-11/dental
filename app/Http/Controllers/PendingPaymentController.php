<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendingPayment;
use App\Models\PaidSalary;
use App\Models\User;
use Carbon\Carbon;

class PendingPaymentController extends Controller
{

public function index(Request $request)
{
    $this->checkMonthlySalary();
    if(\Auth::user()->is_admin != true){
        return redirect()->route('pending_payments.pending.get', ['id'=>\Auth::user()->id]);
    }
    [$startDate, $endDate] = $this->parseDateRange($request->input('start_date'), $request->input('end_date'));

    // Subquery for summing paid salaries per doctor to avoid duplication
    $paidSalariesSubquery = \DB::table('paid_salaries')
        ->select('doctor_id', \DB::raw('SUM(paid_salary) as total_paid_salary'))
        ->groupBy('doctor_id');

    // Define base query for pending payments
    $basePaymentsQuery = PendingPayment::select(
            'pending_payments.doctor_id',
            'pending_payments.salaryType',
            \DB::raw('MAX(paid_salaries_summary.total_paid_salary) as total_paid_salary'), // Use MAX to comply with ONLY_FULL_GROUP_BY
            \DB::raw('SUM(pending_payments.pending_salary) as total_pending_salary')
        )
        ->leftJoinSub($paidSalariesSubquery, 'paid_salaries_summary', function ($join) {
            $join->on('pending_payments.doctor_id', '=', 'paid_salaries_summary.doctor_id');
        })
        ->groupBy('pending_payments.doctor_id', 'pending_payments.salaryType')
        ->with(['doctor', 'examination']);

    // Clone and modify for fixed and percentage payments
    $fixedPaymentsQuery = (clone $basePaymentsQuery)->where('pending_payments.salaryType', 'fixed');
    $percentagePaymentsQuery = (clone $basePaymentsQuery)->where('pending_payments.salaryType', 'percentage');

    // Apply date filtering if provided
    if ($startDate && $endDate) {
        $fixedPaymentsQuery->whereBetween('pending_payments.created_at', [$startDate, $endDate]);
        $percentagePaymentsQuery->whereBetween('pending_payments.created_at', [$startDate, $endDate]);
    }

    $fixedPayments = $fixedPaymentsQuery->get();
    $percentagePayments = $percentagePaymentsQuery->get();

    if ($request->ajax()) {
        return response()->json([
            'fixedPayments' => $fixedPayments,
            'percentagePayments' => $percentagePayments,
        ]);
    }

    return view('content.pending_payments.index', compact('fixedPayments', 'percentagePayments'));
}


private function parseDateRange($startDate, $endDate)
{
    $startDate = $startDate ? Carbon::createFromFormat('m/d/Y', $startDate)->startOfDay() : null;
    $endDate = $endDate ? Carbon::createFromFormat('m/d/Y', $endDate)->endOfDay() : null;

    return [$startDate, $endDate];
}



    public function checkMonthlySalary(){
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $currentMonthName = date('F');
        $currentYearName = date('Y');
        $currentMonthName = $currentMonthName . '-' .  $currentYearName;
        $fixedSalaryDoctors = User::where('status', 'doctor')->where('salaryType', 'fix')->get();
        foreach ($fixedSalaryDoctors as $doctor) {
            $existingPayment = PendingPayment::where('doctor_id', $doctor->id)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->first();

            if (!$existingPayment) {
                PendingPayment::create([
                    'doctor_id' => $doctor->id,
                    'salaryType' => 'fixed',
                    'pending_salary' => $doctor->salary,
                    'paid_salary' => 0,
                    'month' => $currentMonthName,
                ]);
            }
        }
    }
    public function single_pending_payment($id)
    {
        $this->checkMonthlySalary();
        $payments = PendingPayment::where('doctor_id', $id)->where(function ($query) {$query->where('paid', false)->orWhereNull('paid');})->get();

        $paid = PaidSalary::where('doctor_id', $id)->get();

        $payment_payments = $payments->sum('pending_salary');
        $total_paid = $paid->sum('paid_salary');
        $totalPendingSalary = $payments->sum('pending_salary') - $total_paid;
        $user = User::findOrFail($id);
        
        return view('content.pending_payments.pending_index', compact('user', 'payment_payments', 'totalPendingSalary', 'total_paid'));
    }   

    public function filter_payments(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if ($startDate && $endDate) {
        $startDate = Carbon::createFromFormat('m/d/Y', $startDate)->startOfDay();
        $endDate = Carbon::createFromFormat('m/d/Y', $endDate)->endOfDay();
        }

        $pendingQuery = PendingPayment::where('doctor_id', $id)
        ->where(function ($query) {
            $query->where('paid', false)
            ->orWhereNull('paid');
        });
        $paidQuery = PaidSalary::where('doctor_id', $id);

        if ($startDate && $endDate) {
            $pendingQuery->whereBetween('created_at', [$startDate, $endDate]);
            $paidQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $payments = $pendingQuery->get();
        $paid = $paidQuery->get();

        $pending_html = view('content.pending_payments.partials.pending_salaries', compact('payments', 'user'))->render();
        $paid_html = view('content.pending_payments.partials.paid_salaries', compact('paid', 'user'))->render();
        return response()->json([
            'pending_html' => $pending_html,
            'paid_html' => $paid_html
        ]);
    }



    public function pending_pay(Request $request, $id)
    {
        $doctor = User::findOrFail($id);
        $amount = $request->amount ? $request->amount : 0;
        if($doctor){
            $payment = new PaidSalary();
            $payment->paid_salary = $amount;
            $payment->doctor_id = $doctor->id;
            $payment->save();
        }

        return back()->with('success', 'Doctor Paid Successfully');
    }

    public function destroy($id){
        PendingPayment::findOrFail($id)->delete();
        return back()->with('success', 'Payment Deleted Successfully');
    }
}
