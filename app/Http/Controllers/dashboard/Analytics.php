<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\User;

class Analytics extends Controller
{
  public function index()
  {
    $doctors = User::where('status', 'Doctor')->get();
    if (\Auth::user()->is_admin){
    $patients = User::where('status','Patient')->get();
    $appointments = Appointment::where('status',true)->orderBy('created_at', 'desc')->get();
    $services = Service::all();
    $users = User::where('status', '!=','Patient')->get();
  }
  else if(\Auth::user()->status =='Patient'){
    $appointments = Appointment::where('status',true)->where('patient_id', \Auth::user()->id)->orderBy('created_at', 'desc')->get();
    return view('content.dashboard.dashboards-analytics', compact('appointments'));
  }
  else if(\Auth::user()->status =='Doctor'){
    $users = User::all();
    $services = Service::all();
    $appointments = Appointment::where('status',true)->where('user_id', \Auth::user()->id)->orderBy('created_at', 'desc')->get();
    $patients = User::where('doctor', \Auth::user()->name)->get();
  }
    $total_patients = User::where('status','Patient')->count();
    $total_doctors = User::where('status', 'Doctor')->count();
    $total_appointments = Appointment::count();
    $total_payments = Payment::sum('amount');
    return view('content.dashboard.dashboards-analytics', compact('services','appointments', 'users', 'doctors', 'patients', 'total_patients', 'total_doctors', 'total_appointments', 'total_payments'));
  }

}
