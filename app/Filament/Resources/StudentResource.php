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
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use App\Filament\Resources\StudentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StudentResource\RelationManagers;

class StudentResource extends Resource
{

    public static function getGloballySearchableAttributes(): array
{
    return ['first_name', 'last_name', 'id_number', ];
}
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';


    protected static ?int $navigationSort = 3;

    // protected static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }

    
    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->orderBy('created_at', 'desc');
}

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

                                Select::make('campus_id')->label('Campus') ->options(Campus::all()->pluck('name', 'id'))->searchable()->columnSpan(4),
                                Select::make('course_id')->label('Course') ->options(Course::all()->pluck('name', 'id'))->searchable()->columnSpan(4),
                                Select::make('year')->label('Current Year')->options([
                                    '1st Year' => '1st Year',
                                    '2nd Year' => '2nd Year',
                                    '3rd Year' => '3rd Year',
                                    '4th Year' => '4th Year',
                                    // '5th Year' => '5th Year',
                                ])->required()->columnSpan(4)->default('1st Year'),

                                FileUpload::make('profile')->label('Profile Picture')->columnSpan(12)->disk('public')->directory('users-profile'),
                                FileUpload::make('school_id')->label('School Id Picture')->columnSpan(12)->disk('public')->directory('users-school-id'),
                                FileUpload::make('two_by_two')->label('2x2 Picture')->columnSpan(12)->disk('public')->directory('users-two_by_two'),
                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

              
                // TextColumn::make('id'),
                TextColumn::make('id_number')->label('ID Number')->searchable(),
                TextColumn::make('first_name')->searchable(),
                TextColumn::make('middle_name')->searchable(),
                TextColumn::make('last_name')->searchable(),
                TextColumn::make('last_name')->searchable(),
                TextColumn::make('course.name')->searchable(),
                TextColumn::make('year')->searchable(),
                // TextColumn::make('contact_number')->label('Phone number')->searchable(),
                // TextColumn::make('barcode')->searchable(),
                // TextColumn::make('sex'),
                // TextColumn::make('street_address')->label('Street')->searchable(),
                // TextColumn::make('city')->searchable(),
                // TextColumn::make('country')->searchable(),
                // TextColumn::make('state')->searchable(),
                // TextColumn::make('postal_code')->searchable(),
                // TextColumn::make('campus.name')->searchable(),
              
                // TextColumn::make('status')->searchable(),
                // TextColumn::make('profile')->searchable(),
                // ImageColumn::make('profile')->label('Profile Picture')->circular()->height(100)->url(fn ($record) => Storage::disk('public')->url($record->profile))
                // ->openUrlInNewTab(),
                // ImageColumn::make('school_id')->label('School Id Picture')->square()->height(100)->url(fn ($record) => Storage::disk('public')->url($record->school_id))
                // ->openUrlInNewTab(),
                // ImageColumn::make('two_by_two')->label('2x2 Picture')->square()->height(100)->url(fn ($record) => Storage::disk('public')->url($record->two_by_two))
                // ->openUrlInNewTab(),

            ])
            ->filters([
                // Filter::make('created_at')
                // ->form([
                //     Forms\Components\DatePicker::make('created_from'),
                //     Forms\Components\DatePicker::make('created_until'),
                // ])
                // ->query(function (Builder $query, array $data): Builder {
                //     return $query
                //         ->when(
                //             $data['created_from'],
                //             fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                //         )
                //         ->when(
                //             $data['created_until'],
                //             fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                //         );
                // }),
                // SelectFilter::make('Campus')->relationship('campus', 'name'),
                 SelectFilter::make('course_id')->label('Course')
                ->options(Course::all()->pluck('name', 'id'))->searchable()->multiple(),
                
            ])
            ->actions([

                Tables\Actions\ActionGroup::make([
                    Action::make('View Details')
                    ->button()
                    ->icon('heroicon-o-user')
                    ->label('View Profile')
                    ->action(fn ($record) =>$record)
                    ->modalHeading('Student Details')
                    ->modalContent(fn($record)=>  view('components.student-view', ['record'=> $record])),

                    Tables\Actions\Action::make('View Details')
                    ->button()
                    ->icon('heroicon-o-user')
                    ->label('View Profile')->url(fn ($record): string =>  StudentResource::getUrl('details', $record->id)),

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
                ]),
               
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
            
            'reports' => Pages\Reports::route('/reports'),
            'details' => Pages\StudentDetails::route('/student/details/{id}'),
            'index' => Pages\ListStudents::route('/index'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }    
}
