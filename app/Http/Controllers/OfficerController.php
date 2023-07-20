<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficerController extends Controller
{
    

    public function index(){
        return view('officer.login');
    }

    public function login(Request $request){

     $credentials = $request->only('login_id', 'password');

    if (Auth::guard('officer')->attempt($credentials)) {
        // Authentication successful
        return redirect()->intended('/dashboard');
    }

    // Authentication failed
    return redirect()->back()->withErrors(['message' => 'Invalid login ID or password']);

    }
}
