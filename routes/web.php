<?php

use App\Models\User;
use App\Models\Teller;
use App\Models\Student;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
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
        // $student = Student::first();
      
        // if ($student) {
        //     // Generate the barcode data
        //     $barcodeData = DNS1D::getBarcodePNG(strval($student->id_number), 'S25+');
        //     // $barcodeData =    DNS2D::getBarcodePNG(strval($student->id_number), 'QRCODE');
         
        
        //     // Generate a filename based on student information
        //     $lastName = $student->last_name ?? 'UnknownLastName';
        //     $firstName = $student->first_name ?? 'UnknownFirstName';
        //     // $filename = "{$student->last_name}-{$student->first_name}-{$student->id_number}.png";
        //     // $filename = ucfirst($lastName) . '-' . ucfirst($firstName) . '-' . $student->id_number . '.png';
        //     $filename = strtoupper($lastName . '-' . $firstName . '-' . $student->id_number . '.png');
        
        //     // Define the path where the barcode image will be saved temporarily
        //     $filePath = 'temp/' . $filename;
        
        //     // Save the barcode image temporarily to the public disk
        //     Storage::disk('public')->put($filePath, base64_decode($barcodeData));
        
        //     // Create a response to trigger the download using the Storage::download() method
        //     return Storage::disk('public')->download($filePath, $filename);
        // }
        
        // // If the student is not found, you might want to return a response indicating that.
        // return response('Student not found', 404);


        $student = Student::where('id_number', $idNumber)->first();
    
        if ($student) {
            // Create an instance of DNS2D
            $qrCode = new DNS2D();
            
            // Generate the QR code data
            $qrCodeData = $qrCode->getBarcodePNG($student->id_number, 'QRCODE');
            // $qrCodeData = $qrCode->getBarcodePNG(strval($student->id_number), 'QRCODE');
            
            // Generate a filename based on student information
            $lastName = $student->last_name ?? 'UnknownLastName';
            $firstName = $student->first_name ?? 'UnknownFirstName';
            $filename = strtoupper($lastName . '-' . $firstName . '-' . $student->id_number . '.png');
            
            // Define the path where the QR code image will be saved temporarily
            $filePath = 'temp/' . $filename;
            
            // Save the QR code image temporarily to the public disk
            Storage::disk('public')->put($filePath, base64_decode($qrCodeData));
            
            // Create a response to trigger the download using the Storage::download() method
            return Storage::disk('public')->download($filePath, $filename);
        }
        
        // If the student is not found, you might want to return a response indicating that.
        return response('Student not found', 404);
        
   

    })->name('barcode.download');
});

Route::get('/generate-id', function(){
    $students = Student::get();
    $data = [
        'title' => 'Welcome to ItSolutionStuff.com',
        'date' => date('m/d/Y'),
        'students' => $students
    ];
    
    $pdf = Pdf::loadView('PDF.id-layout', $data);
    return $pdf->download('invoice.pdf');

});


Route::get('/generate-view', function(){
    $students = Student::get();
    $data = [
        'title' => 'Welcome to ItSolutionStuff.com',
        'date' => date('m/d/Y'),
        'students' => $students
    ];
    return view('PDF.id-layout-view', $data);

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



