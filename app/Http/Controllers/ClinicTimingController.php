<?php

namespace App\Http\Controllers;
use App\Models\ClinicTiming;
use Illuminate\Http\Request;

class ClinicTimingController extends Controller
{
    public function edit()
    {
        $timings = ClinicTiming::first();
        return view('content.clinicTimings.edit', compact('timings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
        $timings = ClinicTiming::firstOrNew();
        $timings->start_time = $request->start_time;
        $timings->end_time = $request->end_time + 12;
        $timings->save();

        return redirect()->route('timing.edit');
    }

}
