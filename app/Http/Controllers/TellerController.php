<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TellerController extends Controller
{
    

    public function index(){
        
        if (session()->has('teller_id')) 
        {
            return redirect()->route('teller.queque');
        } else {
            return view('teller.login');
        }

    }


    public function login(Request $request){
        dd($request->all());
    }
    

}
