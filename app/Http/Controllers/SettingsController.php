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
    public function editBasic()
    {
        return view('content.settings.edit');
    }

    public function editLogos()
    {
        return view('content.settings.logos-edit');
    }

    public function editTimings()
    {
        return view('content.settings.timings-edit');
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

        $horizontalLogo = config('settings.horizontal_logo');
        $verticalLogo = config('settings.vertical_logo');

        if ($request->hasFile('horizontalLogo')) {
            $path = $request->file('horizontalLogo')->store('images/logos', 'public');
            $horizontalLogo = 'storage/'.$path;
        }
        if ($request->hasFile('verticalLogo')) {
            $path2 = $request->file('verticalLogo')->store('images/logos', 'public');
            $verticalLogo = 'storage/'.$path2;
        }

        $envPath = app()->environmentFilePath();
        $envContent = file_get_contents($envPath);
        $address = trim(preg_replace('/\s+/', ' ', $request->address));
        $updatedContent = str_replace(
            [
                'BRAND_NAME="' . config('settings.brand_name') . '"',
                'CLINIC_PHONE="' . config('settings.clinic_phone') . '"',
                'ADDRESS="' . str_replace("\n", '\\n', config('settings.address')) . '"',
                'START_TIME="' . config('settings.start_time') . '"',
                'END_TIME="' . config('settings.end_time') . '"',
                'HORIZONTAL_LOGO="' . config('settings.horizontal_logo') . '"',
                'VERTICAL_LOGO="' . config('settings.vertical_logo') . '"'
            ],
            [
                'BRAND_NAME="' . $request->brand_name . '"',
                'CLINIC_PHONE="' . $request->clinic_phone . '"',
                'ADDRESS="' . $address . '"',
                'START_TIME="' . $request->start_time . '"',
                'END_TIME="' . ($request->end_time + 12). '"',
                'HORIZONTAL_LOGO="' . $horizontalLogo . '"',
                'VERTICAL_LOGO="' . $verticalLogo . '"'

            ],
            $envContent
        );
        file_put_contents($envPath, $updatedContent);
        \Artisan::call('config:clear');

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    public function updateBasicInfo(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'clinic_phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $envPath = app()->environmentFilePath();
        $envContent = file_get_contents($envPath);
        $address = trim(preg_replace('/\s+/', ' ', $request->address));
        $updatedContent = str_replace(
            [
                'BRAND_NAME="' . config('settings.brand_name') . '"',
                'CLINIC_PHONE="' . config('settings.clinic_phone') . '"',
                'CLINIC_EMAIL="' . config('settings.clinic_email') . '"',
                'ADDRESS="' . str_replace("\n", '\\n', config('settings.address')) . '"',
            ],
            [
                'BRAND_NAME="' . $request->brand_name . '"',
                'CLINIC_PHONE="' . $request->clinic_phone . '"',
                'CLINIC_EMAIL="' . $request->clinic_email . '"',
                'ADDRESS="' . $address . '"'

            ],
            $envContent
        );
        file_put_contents($envPath, $updatedContent);
        \Artisan::call('config:clear');

        return redirect()->back()->with('success', 'Info updated successfully!');
    }

    public function updateLogos(Request $request)
    {

        $horizontalLogo = config('settings.horizontal_logo');
        $verticalLogo = config('settings.vertical_logo');

        if ($request->hasFile('horizontalLogo')) {
            $path = $request->file('horizontalLogo')->store('images/logos', 'public');
            $horizontalLogo = 'storage/'.$path;
        }
        if ($request->hasFile('verticalLogo')) {
            $path2 = $request->file('verticalLogo')->store('images/logos', 'public');
            $verticalLogo = 'storage/'.$path2;
        }

        $envPath = app()->environmentFilePath();
        $envContent = file_get_contents($envPath);
        $updatedContent = str_replace(
            [
                'HORIZONTAL_LOGO="' . config('settings.horizontal_logo') . '"',
                'VERTICAL_LOGO="' . config('settings.vertical_logo') . '"'
            ],
            [
                'HORIZONTAL_LOGO="' . $horizontalLogo . '"',
                'VERTICAL_LOGO="' . $verticalLogo . '"'

            ],
            $envContent
        );
        file_put_contents($envPath, $updatedContent);
        \Artisan::call('config:clear');

        return redirect()->back()->with('success', 'Logos updated successfully!');
    }

    public function updateTimings(Request $request)
    {
        $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $envPath = app()->environmentFilePath();
        $envContent = file_get_contents($envPath);
        $updatedContent = str_replace(
            [
                'START_TIME="' . config('settings.start_time') . '"',
                'END_TIME="' . config('settings.end_time') . '"',
            ],
            [
                'START_TIME="' . $request->start_time . '"',
                'END_TIME="' . ($request->end_time + 12). '"',
            ],
            $envContent
        );
        file_put_contents($envPath, $updatedContent);
        \Artisan::call('config:clear');

        return redirect()->back()->with('success', 'Timings updated successfully!');
    }


}
