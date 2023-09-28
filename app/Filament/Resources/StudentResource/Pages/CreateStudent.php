<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Models\Student;
use Filament\Pages\Actions;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\StudentResource;
use WireUi\Traits\Actions as WireActions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class CreateStudent extends CreateRecord
{

    use WireActions;
    protected static string $resource = StudentResource::class;
    protected static bool $canCreateAnother = false;

    public $created_user;

    protected $listeners = ['deleteRecord'];

    protected function handleRecordCreation(array $data): Model

    {

      
        $this->created_user = static::getModel()::create($data);

        return $this->created_user;
    }


    protected function afterCreate(): void
    {   

    $existingStudent = Student::where('first_name', $this->created_user->first_name)
    ->where('last_name', $this->created_user->last_name)
    ->where('id', '!=', $this->created_user->id) // Make sure it's not the same student
    ->first();

if ($existingStudent) {
    Notification::make()
        ->title('Created Data has Similar Name')
        ->danger()
        ->persistent()
        ->body('A similar record already exists (' . $existingStudent->first_name . ' ' . $existingStudent->last_name . ')')
        ->actions([
            Action::make('View Record')
                ->label('View Record')
                ->color('danger')
                ->button()
                ->url(StudentResource::getUrl('edit', $existingStudent)),
        ])
        ->send();
}


        // $hasSimilarName = 
        // $userExist = Student::where('first_name', $this->created_user->first_name)->where('last_name', $this->created_user->last_name)->first();

        // if ($userExist && $userExist->id_number != $this->created_user->id_number) {
        //       Notification::make()
        //         ->title('Created Data has Similar Name')
        //         ->danger()
        //         ->persistent()
        //         ->body('A similar record already exists ('.$userExist->first_name.' '.$userExist->last_name.')')
        //         ->actions([
 
        //             Action::make('undo')
        //                 ->label('View Record')
        //                 ->color('danger')
        //                 ->button()
        //                 ->url(StudentResource::getUrl('edit', $this->created_user)),
                        
        //         ])
        //         ->send();
        // }
    }
    
    
    public function deleteRecord(){
            $this->created_user->delete();
    }
    protected function beforeCreate(): void
    {
    //    dd($data);
       
    }

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
