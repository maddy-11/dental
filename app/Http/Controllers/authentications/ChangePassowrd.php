<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ChangePassowrd extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-forgot-password-basic');
  }


    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('dashboard-analytics');
    }

    public function reset($id)
    {
        $user = User::findOrFail($id);
        $new_password = $user->username;
        $user->password = Hash::make($new_password);
        $user->save();
        return back()->with('success', "Password Reset Successful");
    }
}
