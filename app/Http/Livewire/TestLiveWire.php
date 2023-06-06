<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Imports\UsersImport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class TestLiveWire extends Component


{


    use WithFileUploads;

    public $file;

    
    public function render()
    {
        return view('livewire.test-live-wire');
    }


    public function save()
    {

        $data[]  =  Excel::toArray(new UsersImport, $this->file);
        dd($data);
        // // $this->validate([
        // //     'file' => 'required',
        // // ]);
 
        // dd($this->file);
    }
}
