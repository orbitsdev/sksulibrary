<?php

namespace App\Filament\Pages;

use Filament\Forms;
use App\Models\IdData;
use Filament\Pages\Page;
use WireUi\Traits\Actions;
use Filament\Resources\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class ManageID extends Page implements HasForms

{
    use InteractsWithForms;
    use Actions;
    
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.manage-i-d';


    public $id_data;

    public $director_name;
    public $title_name;
    public $valid_from;
    public $valid_until;


    public function mount(){
        
        $this->id_data = IdData::first();

        if(empty($this->id_data)){
            $this->id_data =  IdData::create([
                'director' =>'ALNE D. QUINOVERA, Phd',
                'title' => 'Director, Library Service & Museum',
                'valid_from' => now()->year,
                'valid_until' => now()->addYear()->year,
            ]);
        }

        $this->form->fill([
            'director_name' =>$this->id_data->director,
            'title_name' => $this->id_data->title,
            'valid_from' =>$this->id_data->valid_from,
            'valid_until' =>$this->id_data->valid_until,
        ]);
        

        
       

    }
    protected function getFormSchema(): array 
    {
        return [

           TextInput::make('director_name')->required()
      
           ->maxLength(50)
           ,

           TextInput::make('title_name')->required()
           ->maxLength(50)
           ,
           
           TextInput::make('valid_from')
           ->required()
           ->minLength(4)
           ->maxLength(4)
           ->helperText('Format should be Year (2021)')
           ->mask(fn (TextInput\Mask $mask) => $mask->pattern('0000'))
           ,

           TextInput::make('valid_until')
           ->required()
           ->minLength(4)
           ->maxLength(4)
           ->helperText('Format should be Year (2022)')
           ->mask(fn (TextInput\Mask $mask) => $mask->pattern('0000'))

           ,
         
         
        ];
    } 

    public function submit(): void
    {

            $id_data = IdData::first();

            if(!empty($id_data)){
                $id_data->update([
                    'director' =>$this->director_name,
                    'title' => $this->title_name,
                    'valid_from' => $this->valid_from,
                    'valid_until' => $this->valid_until,
                ]);
            }else{
                $this->id_data =  IdData::create([
                    'director' =>$this->director_name,
                    'valid_from' => $this->valid_from,
                    'valid_until' => $this->valid_until,
                ]);
            }

            Notification::make() 
            ->title('Saved successfully')
            ->success()
            ->send(); 
            
      
    }
}
