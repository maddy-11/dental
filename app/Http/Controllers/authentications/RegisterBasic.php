<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Designation;

class RegisterBasic extends Controller
{
  public function index()
  {
    $designations = Designation::get();
    return view('content.authentications.auth-register-basic', compact('designations'));
  }

  public function patient_index()
  {
    $doctors = User::where('status','Doctor')->get();
    return view('content.authentications.patient-register', compact('doctors'));
  }

  public function register(Request $request)
  {
    if(!(\Auth::user()->is_admin)){
      return back()->with('error', 'Not Admin');
    }
    $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    $user = User::create($request->all());
    return redirect()->route('dashboard-analytics')->with('success', 'Account created successfully.');
  }

  public function patient_register(Request $request)
  {
    if(!(\Auth::user()->is_admin)){
      return back()->with('error', 'Not Admin');
    }
    $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
        ]);
    $request['status'] = "Patient";
    $user = User::create($request->all());
    return redirect()->route('dashboard-analytics')->with('success', 'Patient added successfully.');
  }

}
