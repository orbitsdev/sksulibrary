<?php

use App\Models\Teller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TellerController;
use App\Http\Controllers\OfficerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    // return redirect()->route('teller.index');
    return view('welcome');
})->name('attendance');
// Route::middleware([ 'auth:sanctum',  config('jetstream.auth_session'), 'verified'])->group(function () {

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



// Route::get('/queque', function(){
//     return view('queque.index');
// })->name('queque.index');
Route::get('/queque/monitor', function(){
    return view('queque.monitor');
})->name('queque.monitor');

Route::prefix('teller')->name('teller.')->group(function(){

    Route::get('/login', [TellerController::class,'index'])->name('index');
    Route::post('/login', [TellerController::class,'login'])->name('login');
    Route::get('/queque', function(){
        

        
        if (session()->has('teller_id')) 
        {
            $teller = Teller::find(session()->get('teller_id'));
            if($teller){
                return view('teller.queque',);

            }else{
            session()->forget('teller_id');
               return redirect()->route('teller.login');
            }
            // return redirect()->route('dashboard');
        } else {
            return redirect()->route('teller.login');
        }
    })->name('queque');
    

});



