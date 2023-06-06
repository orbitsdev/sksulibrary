<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
    





        return new User([
            'name'     => $row[0],
            'email'     => $row[0].'@gmail.com',
            'first_name'     => $row[0],
            'last_name'     => $row[0],
            'password'     => Hash::make('password'),
        ]);
    }
}
