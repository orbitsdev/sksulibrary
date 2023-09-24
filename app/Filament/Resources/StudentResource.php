<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use App\Models\City;
use App\Models\User;
use Filament\Tables;
use App\Models\State;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Country;
use App\Models\Student;
use Filament\Resources\Form;
use Ramsey\Uuid\Guid\Fields;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Grid;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Illuminate\Database\Eloquent\Model;
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

   

    public $collections = [];
    public static function getGloballySearchableAttributes(): array
{
    return ['first_name', 'last_name', 'id_number', ];
}


public static function getGlobalSearchResultDetails(Model $record): array
{
    return [
        'Student' => $record?->first_name . ' '. $record?->last_name . ' '. $record?->middle_name,
    ];
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
    return parent::getEloquentQuery()->orderBy('id_number', 'asc');
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            
                
                Fieldset::make('Student Account')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                TextInput::make('id_number')->columnSpan(4)->required()->unique(ignoreRecord: true)
                                ->numeric()
                                ->mask(fn (TextInput\Mask $mask) => $mask
                                    ->numeric())
                                
                                ->label('Id Number'),
                                // TextInput::make('barcode')->columnSpan(8)->required(),
                             
                            ]),
                    ]),
                Fieldset::make('Personal Information')
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                TextInput::make('last_name')->label('Last Name')->columnSpan(3)->required()
                                ->mask(function (TextInput\Mask $mask) {
                                    $mask->pattern('[A-Za-z]+');
                                })
                                
                                ,
                                
                                
                                TextInput::make('first_name')->label('First Name')->columnSpan(3)->required()
                                ->mask(function (TextInput\Mask $mask) {
                                    $mask->pattern('[A-Za-z]+');
                                })
                                ,
                                TextInput::make('middle_name')->label('Middle Name')->columnSpan(3)->required()
                                ->mask(function (TextInput\Mask $mask) {
                                    $mask->pattern('[A-Za-z]+');
                                })
                                ,
                                Select::make('sex')->columnSpan(3)->options(['male'=> 'Male', 'female'=> 'Female'])->default('male')
                                ->required()
                                ,
                            ]),
                    ]),

                    Fieldset::make('Contact & Address')
                    ->schema([
                        Grid::make(12)
                        ->schema([

                            TextInput::make('contact_number')->label('Phone number')
                            ->columnSpan(6)
                            ->required()
                            // ->prefix('+63')
                            ->minLength(11)
                            ->maxLength(11)
                            ->numeric()
                            ->mask(fn (TextInput\Mask $mask) => $mask
                                ->numeric())
                            ,
                           
                            Select::make('country')
                            ->columnSpan(6)
                            ->required()
                            ->options([
                                'Philippines' =>'Philippines'
                            ])
                            ->disablePlaceholderSelection()
                            ->default('Philippines')
                            ->reactive()
                            ->afterStateUpdated(function (Closure $get,Closure $set, $state,)  {
                              
                            }),
                           
                            Select::make('region')
                            ->columnSpan(4)
                            ->required()
                            // ->options(DB::table('philippine_regions')->pluck('region_description', 'region_code'))
                            ->options(DB::table('philippine_regions')->pluck('region_description', 'region_description'))
                            ->default('REGION XII (SOCCSKSARGEN)')
                            ->reactive()
                            ->afterStateUpdated(function (Closure $get,Closure $set, $state) {
                                // dd($state);
                            })
                            ->searchable()
                            ->preload(),
                            Select::make('province')
                            ->columnSpan(4)
                            ->required()
                            ->options(function (Closure $get,Closure $set, $state){
                                $region_code = DB::table('philippine_regions')->where('region_description',$get('region'))->first();
                                if($region_code){

                                    return DB::table('philippine_provinces')->where('region_code', $region_code->region_code)->pluck('province_description', 'province_description');
                                }

                                return [];
                            //    return DB::table('philippine_provinces')->where('region_code', $get('region'))->pluck('province_description', 'province_code');
                            })
                         
                            ->reactive()
                            ->afterStateUpdated(function (Closure $get,Closure $set, $state) {
                                // dd($state);
                            })
                            ->searchable()
                            ->preload(),
                            Select::make('city')
                            ->columnSpan(4)
                            ->required()
                            ->options(function (Closure $get,Closure $set, $state){
                            //    return DB::table('philippine_cities')->where('province_code', $get('province'))->pluck('city_municipality_description', 'city_municipality_code');
                            $province_code = DB::table('philippine_provinces')->where('province_description',$get('province'))->first();
                            if($province_code){

                                return DB::table('philippine_cities')->where('province_code',$province_code->province_code)->pluck('city_municipality_description', 'city_municipality_description');
                            } 
                            return [];
                            })
                            ->reactive()
                            ->afterStateUpdated(function (Closure $get,Closure $set, $state) {
                                // dd($state);
                            })
                            ->searchable()
                            ->preload(),
                            Select::make('barangay')
                            ->columnSpan(4)
                            ->required()
                            ->options(function (Closure $get,Closure $set, $state){
                            //    return DB::table('philippine_barangays')->where('city_municipality_code', $get('city'))->pluck('barangay_description', 'barangay_code');
                            $city = DB::table('philippine_cities')->where('city_municipality_description',$get('city'))->first();
                                if($city){

                                    return DB::table('philippine_barangays')->where('city_municipality_code',$city->city_municipality_code)->pluck('barangay_description', 'barangay_description');
                                }

                                return [];
                            })
                            ->label('Barangay')
                            ->reactive()
                            ->afterStateUpdated(function (Closure $get,Closure $set, $state) {
                                // dd($state);
                            })
                            ->searchable()
                            ->preload()
                            
                            ,
                            TextInput::make('street_address')->label('Street')->columnSpan(4)->label('Street Address')->required(),
                            // Select::make('country')
                            // ->options([
                            //     'Philippines' =>'Philippines'
                            // ])
                            // ->default(function(){
                            //     return 'Philippines';
                            // })
                            // ->columnSpan(4)
                            // ->required(),
                            // Select::make('city')
                            // ->columnSpan(4)
                            // ->required()
                            // ->options(function(Closure $get,Closure $set, $state){
                            //    return City::pluck('name', 'id')->map(function ($name) {
                            //     return ucfirst($name);
                            // });
                            // })
                            // ->reactive()
                            // ->afterStateUpdated(function (Closure $get,Closure $set, $state) {
                            //     // dd($state);
                            // })
                            // ->preload(),
                           
                            // Select::make('city')
                            // ->columnSpan(4)
                            // ->required()
                            // ->options(function(Closure $get,Closure $set, $state){
                            //    return City::when($get('province'), function ($query) use ($get) {
                            //     $query->where('state_id', (int)$get('province'));
                            // })->pluck('name', 'id')->map(function ($name) {
                            //     return ucfirst($name);
                            // });
                            // })
                            // ->reactive()
                            // ->afterStateUpdated(function (Closure $get,Closure $set, $state) {
                            //     // dd($state);
                            // })
                            // ->preload(),
                           
                            // TextInput::make('city')->columnSpan(4)->required(),
                            TextInput::make('postal_code')->columnSpan(4)->required()
                            ->mask(fn (TextInput\Mask $mask) => $mask
                            ->numeric())
                        ,
                        

                          
                        ]),
                    ]),

                    Fieldset::make('University Identification')
                    ->schema([

                        Grid::make(12)
                            ->schema([

                                Select::make('campus_id')->label('Campus') ->options(Campus::all()->pluck('name', 'id'))->searchable()->columnSpan(4)
                                ->reactive()
                                ->required()
                                ,
                                Select::make('course_id')->label('Course') ->options(function($get){   
                                    return Course::when($get('campus_id'), function($query) use($get){
                                        $query->where('campus_id', $get('campus_id'));
                                    })->pluck('name','id');
                                })
                                
                                ->searchable()
                                ->columnSpan(4)
                                ->required()
                                ,
                                Select::make('year')->label('Current Year')->options([
                                    '1st Year' => '1st Year',
                                    '2nd Year' => '2nd Year',
                                    '3rd Year' => '3rd Year',
                                    '4th Year' => '4th Year',
                                    // '5th Year' => '5th Year',
                                ])
                                ->required()->columnSpan(4)->default('1st Year'),
                             

                                FileUpload::make('profile')->label('Profile Picture')->columnSpan(12)->disk('public')->directory('users-profile')->label('Image'),
                                // FileUpload::make('school_id')->label('School Id Picture')->columnSpan(12)->disk('public')->directory('users-school-id'),
                                // FileUpload::make('two_by_two')->label('2x2 Picture')->columnSpan(12)->disk('public')->directory('users-two_by_two'),
                            ]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

              
                // TextColumn::make('id'),
                // ImageColumn::make('profile')->circular()->label('Profile')->url(function(Student $record){
                //     if(!empty($record->profile)){
                //         return Storage::disk('public')->url($record->profile);

                //     }
                // })->openUrlInNewTab(),
                // ImageColumn::make('school_id')->square()->label('School Id')->url(function(Student $record){
                //     if(!empty($record->school_id)){
                //         return Storage::disk('public')->url($record->school_id);

                //     }
                // })->openUrlInNewTab(),
                // ImageColumn::make('two_by_two')->square()->label('2x2 Picture')->url(function(Student $record){
                //     if(!empty($record->two_by_two)){
                //         return Storage::disk('public')->url($record->two_by_two);
                //     }
                // })->openUrlInNewTab(),
                TextColumn::make('id_number')->label('ID Number')->searchable(),
                // TextColumn::make('first_name')->searchable()->formatStateUsing(function(Student $record){
                //     return $record?->last_name. ',' . $record?->first_name .' ' . $record?->middle_name;
                // })
                // ->searchable(query: function (Builder $query, string $search): Builder {
                //     return $query
                //         ->where('first_name', 'like', "%{$search}%")
                //         ->orWhere('middle_name', 'like', "%{$search}%")
                //         ->orWhere('last_name', 'like', "%{$search}%")
                //         ;
                // })->label('Student Name')
                // ,
                TextColumn::make('first_name')->label('First Name')->searchable(),
                TextColumn::make('middle_name')->label('Middle Name')->searchable(),
                TextColumn::make('last_name')->label('Last Name')->searchable(),
                TextColumn::make('course.campus.name')->searchable()->label('Campus'),
                TextColumn::make('course.name')->searchable()->label('Course'),
                TextColumn::make('year')->searchable()->label('Year'),
                ViewColumn::make('')->view('tables.columns.bar-code'),
              

            ])
            ->filters([
             
                // SelectFilter::make('campus')
                // ->label('Campus')
                // ->options(
                //     function () {
                //         // could be more discerning here, and select a distinct list of aircraft id's
                //         // that actually appear in the Daily Logs, so we aren't presenting filter options
                //         // which don't exist in the table, but in my case we know they are all used
                //         return Campus::all()->pluck('name', 'id')->toArray();
                //     }
                // )
                // ->query(function (Builder $query, array $data) {
                //     if (!empty($data['value']))
                //     {
                //         // if we have a value (the aircraft ID from our options() query), just query a nested
                //         // set of whereHas() clauses to reach our target, in this case two deep
                //         $query->whereHas(
                //             'course.campus',
                //             function($query) use ($data){
                //                 $query->where('id', $data['value']);
                //             }
                //         );
                //     }
                // }),
                //  SelectFilter::make('course_id')->label('Course')
                // ->options(Course::all()->pluck('name', 'id'))->searchable()->multiple()->label('By Course'),
                SelectFilter::make('campus')
    ->label('Campus')
    ->form([
        // Campus dropdown
        Select::make('campus_id')
            ->label('Campus Name')
            ->options(fn () => Campus::all()->pluck('name', 'id')->toArray())
            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                $courseId = (int) $get('course_id');
                $campus = Campus::find($state);

                if ($campus && $courseId && $course = Course::find($courseId)) {
                    if ($course->campus_id !== $campus->id) {
                        // Course doesn't belong to the selected campus, unselect it
                        $set('course_id', null);
                    }
                }
            })
            ->reactive(),

        // Course dropdown
        Select::make('course_id')
            ->label('Course')
            ->options(function (callable $get, callable $set) {
                $campus = Campus::find($get('campus_id'));

                if ($campus) {
                    return $campus->courses->pluck('name', 'id');
                }

                return Course::all()->pluck('name', 'id');
            }),
    ])
    ->query(function (Builder $query, array $data) {
        $courseId = (int) $data['course_id'];
        $campusId = (int) $data['campus_id'];

        // Apply filters to your query based on campus and course selections
        if (!empty($campusId)) {
            $query->where('campus_id', $campusId);
        }

        if (!empty($courseId)) {
            $query->where('course_id', $courseId);
        }
    })

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
            
            // 'individualReport' => Pages\StudentReport::route('/individualReport'),
            'reports' => Pages\Reports::route('/reports'),
            'details' => Pages\StudentDetails::route('/student/details/{id}'),
            'index' => Pages\ListStudents::route('/index'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }    
}
