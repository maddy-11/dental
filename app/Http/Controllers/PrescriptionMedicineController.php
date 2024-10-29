<?php

namespace App\Http\Controllers;
use App\Models\PrescriptionMedicine;
use Illuminate\Http\Request;

class PrescriptionMedicineController extends Controller
{
     public function prescription_medicine()
    {
        $medicine = PrescriptionMedicine::all();
        return view('content.medicine.index', compact('medicine'));
    }

    public function prescription_medicine_create()
    {
        return view('content.medicine.create');
    }

    public function prescription_medicine_store(Request $request)
    {
        
      PrescriptionMedicine::create($request->all());
      return redirect()->route('prescription.medicine.index')->with('success', 'Medicine added successfully.');
    }

    public function prescription_medicine_edit($id)
    {
        dd('here');
    }

    public function prescription_medicine_update()
    {
        dd('here');
    }

    public function destroy($id)
    {
        PrescriptionMedicine::findOrFail($id)->delete();
        return redirect()->route('prescription.medicine.index')->with('success', 'Medicine deleted successfully.');
    }
}
