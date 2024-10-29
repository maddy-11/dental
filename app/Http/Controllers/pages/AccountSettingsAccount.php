<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Designation;
use Illuminate\Support\Facades\Auth;
use App\Models\Examination;

class AccountSettingsAccount extends Controller
{
  public function index($id)
  {
    $user = User::findOrFail($id);
    $designations = Designation::all();
    return view('content.pages.pages-account-settings-account', compact('user','designations'));
  }

  public function index_()
  {
    $user = Auth::user();
    $designations = Designation::all();
    if($user->status == 'Patient'){
      $patient = Auth::user();
      $doctors = User::where('status', 'Doctor')->get();
      return view('content.pages.patient-edit', compact('patient', 'doctors'));
    }
    return view('content.pages.pages-account-settings-account', compact('user','designations'));
  }

  public function destroy($id)
  {
    $appointment = User::findOrFail($id);
    $appointment->delete();
    return redirect()->route('dashboard-analytics')->with('success', 'Account deleted successfully.');
  }

  public function edit(Request $request, $id)
  {
    $request->validate([
      'name' => 'sometimes|required|string',
      'username' => 'sometimes|required|string',
      'email' => 'sometimes|required|email',
    ]);

    $user = User::findOrFail($id);
    $data = $request->except('password');
    if(!Auth::user()->is_admin){
      $data = \Arr::except($data, ['salary']);
    }
    $user->fill($data);
    $user->save();

    return redirect()->route('dashboard-analytics')->with('success', 'User updated successfully.');
  }
  public function patient_index()
  {
    $patients = User::where('status','Patient')->get();
    return view('content.pages.patients', compact('patients'));
  }

  public function patient_history()
  {
    $examinations = Examination::where('patient_id',\Auth::user()->id)->get();
    return view('content.pages.patient-history', compact('examinations'));
  }

  public function patient_edit($id)
  {
    $doctors = User::where('status', 'Doctor')->get();
    $patient = User::where('id',$id)->first();
    return view('content.pages.patient-edit', compact('patient', 'doctors'));
  }

  public function patient_update(Request $request, $id)
  {
    $request->validate([
      'name' => 'sometimes|required|string',
      'username' => 'sometimes|required|string',
    ]);

    $user = User::findOrFail($id);
    $data = $request->except('password');
    $user->fill($data);
    $user->save();

    return redirect()->route('patient.index')->with('success', 'User updated successfully.');
  }
}
