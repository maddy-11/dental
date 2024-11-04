<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Examination;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Service;
use App\Models\Payment;
use App\Models\PendingPayment;
use App\Models\Invoice;

class ExaminationController extends Controller
{
    public function index()
    {
        $examinations = Examination::with(['patient', 'doctor', 'appointment', 'service'])->get();
        return view('content.examination.examinations', compact('examinations'));
    }

    public function ajax_index(Request $request)
    {
        $patient_id = $request->patient_id;
        $examinations = Examination::with(['patient', 'doctor', 'appointment', 'service'])->where('patient_id',$patient_id)->get();
        return response()->json($examinations);
    }

    public function create($id)
    {
        $services = Service::all();
        $doctors = User::where('status','Doctor')->get();
        $appointment = Appointment::findOrFail($id);
        $examinations = Examination::where('appointment_id', $id)->get();
        return view('content.examination.index', compact('services', 'appointment', 'doctors', 'examinations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|int',
            'doctor_id' => 'required|int',
            'service_id' => 'required|int',
        ]);
        $invoice = Invoice::where('appointment_id', $request->appointment_id)->first();
        if(!$invoice){
            $invoice = Invoice::create(['appointment_id'=>$request->appointment_id]);
        }
        $appointment = Appointment::findOrFail($request->appointment_id);
        $e = Examination::create($request->all());
        
        $payment['amount'] = $request->price;
        $payment['examination_id'] = $e->id;
        $payment['invoice_id'] = $invoice->id;
        Payment::create($payment);
        if($e->doctor->salaryType == 'percentage'){
            $amount = $e->doctor->salary/100 * $request->price;
            $Ppayment['doctor_id'] = $request->doctor_id;
            $Ppayment['pending_salary'] = $amount;
            $Ppayment['examination_id'] = $e->id;
            $Ppayment['paid'] = false;
            $Ppayment['salaryType'] = 'percentage';
            $Ppayment['salaryPercentage'] = $e->doctor->salary;
            $Ppayment['paid_salary'] = 0;
            PendingPayment::create($Ppayment);
        }

        return back()->with('success', 'Prodcedure Added Successfully.');
    }

    public function complete($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = false;
        $appointment->save();
        return redirect()->route('dashboard-analytics');
    }

    public function edit($id)
    {
        $services = Service::all();
        $examination = Examination::with(['patient', 'doctor', 'appointment', 'service'])->where('id', $id)->first();
        $doctors = User::where('status','Doctor')->get();
        $examinations = Examination::where('appointment_id', $examination->appointment_id)->get();
        return view('content.examination.examination-edit', compact('examination', 'doctors', 'services', 'examinations'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_id' => 'required|int',
            'patient_id' => 'required|int',
            'doctor_id' => 'required|int',
            'service_id' => 'required|int',
        ]);

        $examination = Examination::findOrFail($id);
        $examination->fill($request->all());
        $examination->save();

        return redirect()->route('examination.index')->with('success', 'Procedure Updated Successfully.');
    }

    public function destroy($id)
    {
        $e = Examination::findOrFail($id);
        $e->delete();
        return back()->with('success', 'Procedure deleted successfully.');
    }

}
