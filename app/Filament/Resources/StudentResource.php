<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Student;
use Filament\Resources\Form;
use Ramsey\Uuid\Guid\Fields;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StudentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StudentResource\RelationManagers;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'University';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            
                
                Fieldset::make('Student Account')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                TextInput::make('id_number')->columnSpan(4)->required(),
                                TextInput::make('barcode')->columnSpan(8)->required(),
                             
                            ]),
                    ]),
                Fieldset::make('Personal Information')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                TextInput::make('first_name')->label('Given name')->columnSpan(4)->required(),
                                TextInput::make('middle_name')->label('Middle Initial')->columnSpan(4)->required(),
                                TextInput::make('last_name')->label('Family Name')->columnSpan(4)->required(),
                            ]),
                    ]),

                    Fieldset::make('Contact & Address')
                    ->schema([
                        Grid::make(12)
                        ->schema([

                            Select::make('sex')->columnSpan(3)->options(['male'=> 'Male', 'female'=> 'Female'])->default('male'),
                            TextInput::make('contact_number')->label('Phone number')->columnSpan(3)->tel(),
                            TextInput::make('street_address')->label('Street')->columnSpan(6),
                            TextInput::make('city')->columnSpan(4),
                            TextInput::make('country')->columnSpan(8),
                            TextInput::make('postal_code')->columnSpan(4),
                            TextInput::make('state')->columnSpan(8),

                          
                        ]),
                    ]),

                    Fieldset::make('University Identification')
                    ->schema([

                        Grid::make(12)
                            ->schema([

                                TextInput::make('campus')->columnSpan(4)->required(),
                                TextInput::make('course')->columnSpan(4)->required(),
                                Select::make('year')->label('Current Year')->options([
                                    'first-year' => '1st Year',
                                    'second-year' => '2nd Year',
                                    'third-year' => '3rd Year',
                                    'fourth-year' => '4th Year',
                                ])->required()->columnSpan(4)->default('first-year'),

                                FileUpload::make('profile')->label('Profile Picture')->columnSpan(12)->disk('public')->directory('users-profile')->required(),
                                FileUpload::make('school_id')->label('School Id Picture')->columnSpan(12)->disk('public')->directory('users-school-id')->required(),
                                FileUpload::make('two_by_two')->label('2x2 Picture')->columnSpan(12)->disk('public')->directory('users-two_by_two')->required(),
                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('id_number')->label('ID Number')->searchable(),
              
                TextColumn::make('first_name')->searchable(),
                TextColumn::make('middle_name')->searchable(),
                TextColumn::make('last_name')->searchable(),
                TextColumn::make('last_name')->searchable(),
                TextColumn::make('sex'),
                TextColumn::make('contact_number')->label('Phone number')->searchable(),
                TextColumn::make('street_address')->label('Street')->searchable(),
                TextColumn::make('city')->searchable(),
                TextColumn::make('country')->searchable(),
                TextColumn::make('state')->searchable(),
                TextColumn::make('postal_code')->searchable(),
                TextColumn::make('campus')->searchable(),
                TextColumn::make('course')->searchable(),
                TextColumn::make('barcode')->searchable(),
                TextColumn::make('status')->searchable(),
                TextColumn::make('year')->searchable(),
                TextColumn::make('profile')->searchable(),
                ImageColumn::make('profile')->label('Profile Picture')->circular()->height(100)->url(fn ($record) => Storage::disk('public')->url($record->profile))
                ->openUrlInNewTab(),
                ImageColumn::make('school_id')->label('School Id Picture')->square()->height(100)->url(fn ($record) => Storage::disk('public')->url($record->school_id))
                ->openUrlInNewTab(),
                ImageColumn::make('two_by_two')->label('2x2 Picture')->square()->height(100)->url(fn ($record) => Storage::disk('public')->url($record->two_by_two))
                ->openUrlInNewTab(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->button(),
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button()->before(function( $action, $record){
            

                    if (Storage::disk('public')->exists($record->profile) && $record->profile != null) {

                            Storage::disk('public')->delete($record->profile);
                    }

                    if (Storage::disk('public')->exists($record->school_id) && $record->school_id != null) {

                            Storage::disk('public')->delete($record->school_id);
                    }

                    if (Storage::disk('public')->exists($record->two_by_two) && $record->two_by_two != null) {

                            Storage::disk('public')->delete($record->two_by_two);
                    }

                }),
            ])
            ->bulkActions([
        
                Tables\Actions\DeleteBulkAction::make(),
            ]);
        }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/index'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }    
}
