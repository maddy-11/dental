<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

// class SettingsController extends Controller
// {
//     public function edit()
//     {
//         $timings = ClinicTiming::first();
//         return view('content.clinicTimings.edit', compact('timings'));
//     }

//     public function update(Request $request)
//     {
//         $request->validate([
//             'start_time' => 'required',
//             'end_time' => 'required',
//         ]);
//         $timings = ClinicTiming::firstOrNew();
//         $timings->start_time = $request->start_time;
//         $timings->end_time = $request->end_time + 12;
//         $timings->save();

//         return redirect()->route('timing.edit');
//     }

// }

class SettingsController extends Controller
{
    public function edit()
    {
        return view('content.settings.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'clinic_phone' => 'required|string|max:20',
            'address' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $envPath = app()->environmentFilePath();
        $envContent = file_get_contents($envPath);
        $address = trim(preg_replace('/\s+/', ' ', $request->address));
        $updatedContent = str_replace(
            [
                'BRAND_NAME="' . config('settings.brand_name') . '"',
                'CLINIC_PHONE="' . config('settings.clinic_phone') . '"',
                'ADDRESS="' . str_replace("\n", '\\n', config('settings.address')) . '"',
                'START_TIME="' . config('settings.start_time') . '"',
                'END_TIME="' . config('settings.end_time') . '"'
            ],
            [
                'BRAND_NAME="' . $request->brand_name . '"',
                'CLINIC_PHONE="' . $request->clinic_phone . '"',
                'ADDRESS="' . $address . '"',
                'START_TIME="' . $request->start_time . '"',
                'END_TIME="' . ($request->end_time + 12). '"',
            ],
            $envContent
        );
        file_put_contents($envPath, $updatedContent);
        \Artisan::call('config:clear');

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }


}
