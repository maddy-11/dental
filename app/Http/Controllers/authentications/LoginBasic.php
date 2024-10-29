<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function login(Request $request)
{
    $request->validate([
        'email-username' => 'required|string',
        'password' => 'required|string',
    ]);

    $loginField = $request->input('email-username');
    $password = $request->input('password');
    $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    $credentials = [$fieldType => $loginField, 'password' => $password];

    if (Auth::attempt($credentials, true)) {
        return redirect()->route('dashboard-analytics');
    }
    // Authentication failed...
    return redirect()->back()->withErrors(['message' => 'Invalid credentials']);
}
public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    return redirect()->route('login');
}

}
