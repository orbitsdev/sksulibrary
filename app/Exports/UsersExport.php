<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
// class UsersExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return User::all();
//     }
// }
class UsersExport implements FromView
{
   

    public function view(): View
    {
        return view('exports.users', [
            'users' => User::all()
        ]);
    }
}
