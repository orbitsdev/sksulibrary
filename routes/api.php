<?php

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/testapi', function(){
    $response = Http::get('https://api.countrystatecity.in/v1/countries');
    return response()->json(['data'=>$response]);
});

Route::post('/create-card', function (Request $request){
    $newCard = Card::create([
        'card_number' => $request->card_number,
    ]);
    return response()->json(['success'=>true, 'data'=> $newCard, ]);
});

Route::get('/fetch-cards', function (Request $request){
    $data = Card::all();
    return response()->json(['success'=>true, 'data'=>$data, ]);
});