<?php

namespace App\Filament\Pages;

use Filament\Forms;
use App\Models\IdData;
use Filament\Pages\Page;
use WireUi\Traits\Actions;
use Filament\Resources\Form;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class ManageID extends Page implements HasForms

{
    use InteractsWithForms;
    use Actions;
    use WithFileUploads;
    
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.manage-i-d';


    public $id_data;

    public $director_name;
    public $title_name;
    public $valid_from;
    public $valid_until;
    public $logo;
    public $bg;


    public function mount(){
        
        $this->id_data = IdData::first();

        if(empty($this->id_data)){
            $this->id_data =  IdData::create([
                'director' =>'ALNE D. QUINOVERA, Phd',
                'title' => 'Director, Library Service & Museum',
                'valid_from' => now()->year,
                'valid_until' => now()->addYear()->year,
                // 'logo' => 'sksulogo.png',
                // 'bg' => null,
               
            ]);
        }

        $this->form->fill([
            'director_name' =>$this->id_data->director,
            'title_name' => $this->id_data->title,
            'valid_from' =>$this->id_data->valid_from,
            'valid_until' =>$this->id_data->valid_until,
            // 'logo' => $this->id_data->logo,
            // 'bg' => $this->id_data->bg,
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
           ->label('Valid From')

           ->required()
           ->minLength(4)
           ->maxLength(4)
           ->helperText('Format should be Year (2021)')
           ->mask(fn (TextInput\Mask $mask) => $mask->pattern('0000'))
           ,

           TextInput::make('valid_until')
           ->label('Valid Until')

           ->required()
           ->minLength(4)
           ->maxLength(4)
           ->helperText('Format should be Year (2022)')
           ->mask(fn (TextInput\Mask $mask) => $mask->pattern('0000'))
           ,

        //    FileUpload::make('logo')->columnSpanFull()->disk('public')->directory('id-data')->label('Upload Logo')->image(),
        //    FileUpload::make('bg')->columnSpanFull()->disk('public')->directory('id-data')->label('Upload Id Background')->image(),

        
           
         
         
        ];
    } 

    
    public function submit(): void
    {       

        // $data = [
        //     $this->logo,
        //     $this->bg,
        // ];
          
            $id_data = IdData::first();
            

            if(!empty($id_data)){
                $this->uploadLogo();
                $id_data->update([
                    'director' =>$this->director_name,
                    'title' => $this->title_name,
                    'valid_from' => $this->valid_from,
                    'valid_until' => $this->valid_until,
                    // 'logo' => $this->logo,
                    // 'bg' => $this->bg,
                ]);

            }else{

              
                $this->id_data =  IdData::create([
                    'director' =>$this->director_name,
                    'valid_from' => $this->valid_from,
                    'valid_until' => $this->valid_until,
                    // 'logo' => $this->logo,
                    // 'bg' => $this->bg,
                ]);

                
            }

            Notification::make() 
            ->title('Saved successfully')
            ->success()
            ->send(); 
            
      
    }

    function uploadLogo(){
        if(!empty($this->logo)){
            foreach ($this->logo as $uploadedFile) {
                // Get the original name of the file
                $originalName = $uploadedFile->getClientOriginalName();
    
                // Move the file to the public folder
                $pathInPublic = 'public/' . $originalName; // You can customize the destination path
    
                // Use Storage facade to move the file
                Storage::put($pathInPublic, file_get_contents($uploadedFile));
    
                // Now you can get the public URL of the file
                $publicUrl = Storage::url($pathInPublic);
    
                // Do whatever you need with the public URL or path
                // ...
    
                // Optionally, you can delete the file from the original storage location
                Storage::delete($uploadedFile->hashName());
            }
            
            // $this->logo->store('photos');
            // foreach($this->bg as $imagefile){
              
            //     $receipt_image_path = $imagefile->storeAs('iddata',$imagefile->getClientOriginalName());
          
        //     // Get just filename
        //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);            
        //    // Get just ext
        //     $extension = $this->logo->file('cover_image')->getClientOriginalExtension();
        //     //Filename to store
        //     $fileNameToStore = $filename.'_'.time().'.'.$extension;                       
        //   // Upload Image
        //     $path = $this->logo->file('cover_image')->    storeAs('public/cover_images', $fileNameToStore);
        
    }
}

    function uploadBg(){
        if(!empty($this->bg)){
            foreach($this->bg as $imagefile){
                $receipt_image_path = $imagefile->storeAs('iddata',$imagefile->getClientOriginalName());
            }
        }
       
    }
    
    

}
