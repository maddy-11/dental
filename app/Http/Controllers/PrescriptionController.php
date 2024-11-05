<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\PrescriptionMedicine;
use Barryvdh\DomPDF\Facade\Pdf;

class PrescriptionController extends Controller
{
    public function index()
    {
        if (\Auth::user()->is_admin) {
            $prescriptions = Prescription::all();
        } 
        else if (\Auth::user()->status == 'Doctor') {
            $prescriptions = Prescription::whereHas('appointment', function($query) {
                $query->where('user_id', \Auth::id());
            })->get();
        } 
        else if (\Auth::user()->status == 'Patient') {
            $prescriptions = Prescription::whereHas('appointment', function($query) {
                $query->where('patient_id', \Auth::id());
            })->get();
        }
        return view('content.prescriptions.index', compact('prescriptions'));
    }

    public function patientPrescriptions($id)
    {
        $prescriptions = Prescription::whereHas('appointment', function($query) use ($id) {
            $query->where('patient_id', $id);
        })->get();

        return view('content.prescriptions.index', compact('prescriptions'));
    }


    public function downloadPDF($id)
    {
        $appointment = Appointment::findOrFail($id);
        $prescriptions = Prescription::where('appointment_id', $id)->get();
        $pdf = PDF::loadView('content.prescriptions.prescriptionPdf', compact('prescriptions', 'appointment'));
        return $pdf->download('prescription.pdf');
    }

    public function create($id)
    {
        $appointment = Appointment::findOrFail($id);
        $medicine = PrescriptionMedicine::all();
        $prescriptions = Prescription::where('appointment_id', $id)->count();
        if ($prescriptions > 0) return redirect()->route('prescription.edit', ['id'=> $appointment->id]);
        return view('content.prescriptions.create', compact('appointment', 'medicine'));
    }

    public function store(Request $request)
    {
        $appointmentId = $request->input('appointment_id');
        foreach ($request->medicine as $index => $medicineId) {
            $details = [
                'duration' => $request->duration[$index],
                'time_unit' => $request->time_unit[$index],
                'daily_dosage' => $request->daily_dosage[$index],
            ];

            $p = Prescription::create([
                'appointment_id' => $appointmentId,
                'medicine_id' => $medicineId,
                'details' => json_encode($details),
            ]);
        }

        // return redirect()->route('prescriptions.index')->with('success', 'Prescription created successfully.');
        return redirect()->route('prescription.edit', ['id'=>$p->appointment->id,'status'=>true])->with('success', 'Prescription created successfully.');
    }

    public function edit(Request $request, $id)
    {
        $medicine = PrescriptionMedicine::all();
        $appointment = Appointment::findOrFail($id);
        $prescriptions = Prescription::where('appointment_id', $id)->get();
        $status = $request->status ? true : false;
        return view('content.prescriptions.edit', compact('medicine', 'prescriptions', 'appointment', 'status'));
    }

    public function update(Request $request)
    {
        $appointmentId = $request->input('appointment_id');
        Prescription::where('appointment_id', $appointmentId)->delete();
        foreach ($request->medicine as $index => $medicineId) {
            $details = [
                'duration' => $request->duration[$index],
                'time_unit' => $request->time_unit[$index],
                'daily_dosage' => $request->daily_dosage[$index] ?? '',
            ];
            Prescription::create([
                'appointment_id' => $appointmentId,
                'medicine_id' => $medicineId,
                'details' => json_encode($details),
            ]);
        }

        // return redirect()->route('prescriptions.index')->with('success', 'Prescription created successfully.');
        return back()->with('success', 'Prescription Updated successfully.');
    }

    public function destroy()
    {
        dd('here');
    }
    public function get_prescription($id)
    {
        $appointment = Appointment::findOrFail($id);
        $prescriptions = Prescription::where('appointment_id', $id)->get();
        return view('content.prescriptions.prescription', compact('prescriptions', 'appointment'));

    }

    public function get_latest_prescription()
    {
        $appointment = Appointment::where('patient_id', \Auth::id())->orderBy('created_at', 'desc')->first();
        $prescriptions = Prescription::where('appointment_id', $appointment->id)->get();
        // $prescription = Prescription::whereHas('appointment', function($query) {
        //     $query->where('patient_id', \Auth::id());
        // })->orderBy('created_at', 'desc')->first();


        return view('content.prescriptions.prescription', compact('prescriptions', 'appointment'));
    }

}
