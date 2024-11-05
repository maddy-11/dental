<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\ContactMail;

class HomeView extends Controller
{
    public function index(){
        $services = Service::all();
        $doctors = User::where('status','Doctor')->get();
        return view('index', compact('services', 'doctors'));
    }

    public function send(Request $request) 
{
    $email = 'mahmoodshah321@gmail.com';
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    $data = [
        'name' => $validated['name'],
        'email' => $validated['email'],
        'subject' => $validated['subject'],
        'message' => $validated['message'],
    ];

    try {
        Mail::to('mahmoodshah321@gmail.com')->send(new ContactMail($data));
    } catch (\Exception $e) {
        return response('Failed to send email: ' . $e->getMessage(), 500);
    }
    return response('OK', 200);
}
    
    public function all_users(){
        $users = User::all();
        return view('content.pages.all-users', ['users'=>$users]);
    }

}
