<?php

namespace App\Http\Livewire\Teller;

use App\Models\Teller;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Login extends Component
{


    public $id_number;
    public $password;

    protected $rules = [

        'id_number' => 'required',

        'password' => 'required',

    ];



    public function  login(){

        $teller = Teller::where('id_number', $this->id_number)->where('password', $this->password)->first();

        if (!$teller) {
            $this->addError('id_number', 'Invalid credentials');
        };
        
        if ($teller) {
            // Store the teller's ID or other necessary data in the session
            session(['teller_id' => $teller->id]);
            // Redirect the teller to the Teller dashboard or perform any other necessary actions
            return redirect()->route('teller.queque');
        }
      

    }

   

    public function render()
    {
        return view('livewire.teller.login');
    }
}
