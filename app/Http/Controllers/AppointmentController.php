<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Service;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    // Display all appointments
    public function index()
    {
        $appointments = Appointment::orderBy('created_at', 'desc')->get();
        return view('content.appointments.index', compact('appointments'));
    }

    public function patient_appointments($id)
    {
        $appointments = Appointment::where('patient_id', $id)->orderBy('created_at', 'desc')->get();
        return view('content.appointments.index', compact('appointments'));
    }
    public function doc_patient($status, $id)
    {
        $appointments = Appointment::where($status, $id)
        ->orderBy('created_at', 'desc')
        ->get();
        return view('content.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $services = Service::all();
        $doctors = User::where('status','Doctor')->get();
        $patients = User::where('status','Patient')->get();
        return view('content.appointments.create', compact('services', 'doctors','patients'));
    }

    // Store a new appointment
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $formattedDate = Carbon::createFromFormat('F j, Y', $request->date)->format('Y-m-d');
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $formattedDate . ' ' . $request->time);

        $data = $request->all();
        $data['start_date_time'] = $startDateTime;

        unset($data['date'], $data['time']);
        $user = User::findOrFail($data['patient_id']);
        $data['name'] = $user->name;
        $data['status'] = true;
        Appointment::create($data);

        return redirect()->route('all_appointments')->with('success', 'Appointment created successfully.');
    }

    public function edit($id)
    {
        $timings = ClinicTiming::first();
        $services = Service::all();
        $doctors = User::where('status','Doctor')->get();
        $patients = User::where('status','Patient')->get();
        $appointment = Appointment::findOrFail($id);
        return view('content.appointments.edit', compact('services', 'doctors','patients', 'appointment', 'timings'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $formattedDate = Carbon::createFromFormat('F j, Y', $request->date)->format('Y-m-d');
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $formattedDate . ' ' . $request->time);

        $data = $request->all();
        $data['start_date_time'] = $startDateTime;

        unset($data['date'], $data['time']);
        if(!isset($data['name']))
        {
        $user = User::findOrFail($data['patient_id']);
        $data['name'] = $user->name;
        }
        $appointment = Appointment::findOrFail($id);
        $appointment->fill($data);
        $appointment->save();


        return redirect()->route('all_appointments')->with('success', 'Appointment created successfully.');
    }

    public function store_front(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $formattedDate = Carbon::createFromFormat('F j, Y', $request->date)->format('Y-m-d');
        $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $formattedDate . ' ' . $request->time);

        $data = $request->all();
        $data['start_date_time'] = $startDateTime;

        unset($data['date'], $data['time']);
        Appointment::create($data);

        return response('OK', 200);
    }

    // Delete an appointment
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return back()->with('success', 'Appointment deleted successfully.');
    }
}
