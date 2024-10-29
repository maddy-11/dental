<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Display a listing of the services
    public function index()
    {
        $services = Service::all();
        return view('content.services.index', compact('services'));
    }

    // Show the form for creating a new service
    public function create()
    {
        return view('content.services.create');
    }

    // Store a newly created service in storage
    public function store(Request $request)
    {
        if(!(\Auth::user()->is_admin)){
          return back()->with('error', 'Not Admin');
      }
      $request->validate([
        'name' => 'required|string',
    ]);

      Service::create($request->all());
      return redirect()->route('all_services')->with('success', 'Service created successfully.');
  }

    // Show the form for editing the specified service
  public function edit($id)
  {
    $service = Service::findOrFail($id);
    return view('content.services.edit', compact('service'));
}

    // Update the specified service in storage
public function update(Request $request, $id)
{
    if(!(\Auth::user()->is_admin)){
      return back()->with('error', 'Not Admin');
  }
  $request->validate([
    'name' => 'required|string|max:255',
            // Add other validation rules as needed
]);

  $service = Service::findOrFail($id);
  $service->update($request->all());
  return redirect()->route('all_services')->with('success', 'Service updated successfully.');
}

public function destroy($id)
{
    $service = Service::findOrFail($id);
    $service->delete();
    return redirect()->route('all_services')->with('success', 'Service deleted successfully.');
}
}
