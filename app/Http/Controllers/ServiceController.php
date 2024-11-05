<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('content.services.index', compact('services'));
    }

    public function create()
    {
        return view('content.services.create');
    }

    public function store(Request $request)
    {
      if (!\Auth::user()->is_admin) {
        if ($request->ajax()) {
            return response()->json(['message' => 'Not Admin'], 403);
        }
        return back()->with('error', 'Not Admin');
    }
    $request->validate([
        'name' => 'required|string',
    ]);
    if(!$request['description']){
        $request['description']= 'Description';
    }
    $service = Service::create($request->all());
    if ($request->ajax()) {
        return response()->json([
            'id' => $service->id,
            'name' => $service->name,
            'message' => 'Service added successfully.'
        ]);
    }
    return redirect()->route('all_services')->with('success', 'Service created successfully.');
}

public function edit($id)
{
    $service = Service::findOrFail($id);
    return view('content.services.edit', compact('service'));
}


public function update(Request $request, $id)
{
    if(!(\Auth::user()->is_admin)){
      return back()->with('error', 'Not Admin');
  }
  $request->validate([
    'name' => 'required|string|max:255',    
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
