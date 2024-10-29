<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    // Display a listing of the designations
    public function index()
    {
        $designations = Designation::all();
        return view('content.designations.index', compact('designations'));
    }

    // Show the form for creating a new designation
    public function create()
    {
        return view('content.designations.create');
    }

    // Store a newly created designation in the database
    public function store(Request $request)
    {
        if(!(\Auth::user()->is_admin)){
          return back()->with('error', 'Not Admin');
      }
      $request->validate([
        'name' => 'required|string|max:255'
    ]);

      Designation::create($request->all());

      return redirect()->route('designations.index')->with('success', 'Designation created successfully.');
  }

    // Show the form for editing a specific designation
  public function edit(Designation $designation)
  {
    return view('content.designations.edit', compact('designation'));
}

    // Update a specific designation in the database
public function update(Request $request, Designation $designation)
{
    if(!(\Auth::user()->is_admin)){
      return back()->with('error', 'Not Admin');
  }
  $request->validate([
    'name' => 'required|string|max:255'
]);

  $designation->update($request->all());

  return redirect()->route('designations.index')->with('success', 'Designation updated successfully.');
}

    // Remove a specific designation from the database
public function destroy(Designation $designation)
{
    if(!\Auth::user()->is_admin){
      return back()->with('error', 'Not Admin');
  }
  $designation->delete();

  return redirect()->route('designations.index')->with('success', 'Designation deleted successfully.');
}
}
