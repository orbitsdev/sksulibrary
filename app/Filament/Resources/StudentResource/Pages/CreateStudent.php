<?php

namespace App\Filament\Resources\StudentResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Support\Facades\Http;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\StudentResource;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;
    
    protected function beforeFill(): void
    {   
    //     $url = 'https://countriesnow.space/api/v0.1/countries/';
    //     $response = Http::withOptions(['verify' => false])->get($url)->json();
        
    //  $collections = collect($response['data']);

    // $url = "https://countriesnow.space/api/v0.1/countries/cities";
    // $requestData = [
    //     'country' => 'Philippines',
    // ];

    // $response = Http::withOptions(['verify' => false])
    //     ->post($url, $requestData)
    //     ->json();
    //    $collections = collect($response['data']);
    //   dd($collections);
       
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
