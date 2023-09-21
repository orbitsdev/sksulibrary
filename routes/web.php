<?php

use App\Models\Teller;
use Milon\Barcode\DNS1D;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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

    
    Route::get('/download-barcode/{idNumber}', function($idNumber){
        // Storage::disk('public')->put('/temp/test.png',base64_decode(DNS1D::getBarcodePNG(str($idNumber), 'S25+')));     
    // Generate the barcode image
    // STORE IMAGE
    // DOWLOAD IMAGE USINNG ASTORAGE
    // $barcodeData = DNS1D::getBarcodePNG(str($idNumber), 'S25+');

    // // Create a response with the image data
    // $response = new Response($barcodeData);

    // // Set the content type and disposition headers for download
    // $response->header('Content-Type', 'image/png');
    // $response->header('Content-Disposition', 'attachment; filename="barcode.png"');

    // return $response;
   
    // dd($response);
        // return $response;
 $barcodeData = DNS1D::getBarcodePNG(str($idNumber), 'S25+');

    // Save the barcode image temporarily to the public disk
    $filePath = 'temp/test.png';
    Storage::disk('public')->put($filePath, base64_decode($barcodeData));

    // Create a response to trigger the download using the Storage::download() method
    return Storage::disk('public')->download($filePath, 'barcode.png');
   

    })->name('barcode.download');
});




// Route::get('/testapi', function(){
//     $response = Http::get('https://countriesnow.space/api/v0.1/countries/');
//     return $response;
// });



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



