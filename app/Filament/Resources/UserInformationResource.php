<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Campus;
use App\Models\Course;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\UserInformation;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserInformationResource\Pages;
use App\Filament\Resources\UserInformationResource\RelationManagers;

class UserInformationResource extends Resource
{
    protected static ?string $model = UserInformation::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'User Information';


    // protected static ?string $navigationGroup = 'Account';

    // protected static bool $shouldRegisterNavigation = false;



    public $first_name;
    public $last_name;
    public $user_id;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Fieldset::make('Target Account')
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->options(User::all()->pluck('email', 'id'))
                            ->searchable()->columnSpan(2)->required(),


                    ]),
                Fieldset::make('Personal Information')
                    ->schema([

                        Grid::make(12)
                            ->schema([

                                TextInput::make('userInformation.first_name')->columnSpan(4)->required(),
                                TextInput::make('userInformation.middle_name')->columnSpan(4)->required(),
                                TextInput::make('userInformation.last_name')->columnSpan(4)->required(),

                            ]),

                    ]),

                Fieldset::make('Additional Information')
                    ->schema([
                        Select::make('user_id')
                            ->label('Email')
                            ->options(User::all()->pluck('email', 'id'))
                            ->searchable()->columnSpan(2)->required(),
                        Grid::make(12)
                            ->schema([

                                TextInput::make('userInformation.contact_number')->columnSpan(4),
                                TextInput::make('userInformation.street_address')->columnSpan(4),

                                Select::make('userInformation.city')->options([
                                    'isulan' => 'Isulan',
                                    'married' => 'Married',
                                    'divorced' => 'Divorced',
                                    'widowed' => 'Widowed',
                                    'separated' => 'Separated',
                                ])->columnSpan(4),

                                Select::make('userInformation.country')->options([
                                    'philippines' => 'Philippines',
                                ])->columnSpan(4),
                                Select::make('userInformation.country')->options([
                                    '' => 'None',
                                    'state' => 'State',
                                ])->columnSpan(4),

                                TextInput::make('userInformation.postal_code')->columnSpan(4),
                            ]),

                    ]),

                Fieldset::make('Additional Information')
                    ->schema([
                        Select::make('user_id')
                            ->label('Email')
                            ->options(User::all()->pluck('email', 'id'))
                            ->searchable()->columnSpan(2)->required(),
                        Grid::make(12)
                            ->schema([
                                TextInput::make('userInformation.first_name')->columnSpan(4)->required(),
                                TextInput::make('userInformation.middle_name')->columnSpan(4)->required(),
                                TextInput::make('userInformation.last_name')->columnSpan(4)->required(),
                                TextInput::make('userInformation.contact_number')->columnSpan(4),
                                TextInput::make('userInformation.street_address')->columnSpan(4),

                                Select::make('userInformation.city')->options([
                                    'isulan' => 'Isulan',
                                    'married' => 'Married',
                                    'divorced' => 'Divorced',
                                    'widowed' => 'Widowed',
                                    'separated' => 'Separated',
                                ])->columnSpan(4),

                                Select::make('userInformation.country')->options([
                                    'philippines' => 'Philippines',
                                ])->columnSpan(4),
                                Select::make('userInformation.country')->options([
                                    '' => 'None',
                                    'state' => 'State',
                                ])->columnSpan(4),

                                TextInput::make('userInformation.postal_code')->columnSpan(4),
                            ]),





                    ]),


                Fieldset::make('University Identification')
                    ->schema([

                        Grid::make(12)
                            ->schema([

                                Select::make('userInformation.campus_id')->options(Campus::all()->pluck('name', 'id'))->required()->columnSpan(4),
                                Select::make('userInformation.course_id')->options(Course::all()->pluck('name', 'id'))->required()->columnSpan(4),
                                // TextInput::make('userInformation.barcode')->columnSpan(2)->required(),

                                Select::make('userInformation.year')->options([
                                    'first-year' => '1st Year',
                                    'second-year' => '2nd Year',
                                    'third-year' => '3rd Year',
                                    'fourth-year' => '4th Year',
                                ])->required()->columnSpan(4),

                                FileUpload::make('userInformation.prfile')->columnSpan(12)->disk('public')->directory('users-profile')->required(),
                                FileUpload::make('userInformation.school_id')->columnSpan(12)->disk('public')->directory('users-school-id')->required(),
                                FileUpload::make('userInformation.two_by_two')->columnSpan(12)->disk('public')->directory('users-two_by_two')->required(),
                            ]),

                    ]),

                
                
             
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id'),
                TextColumn::make('user.email')->label('Email'),
                TextColumn::make('user.first_name')->label('First Name'),
                TextColumn::make('user.last_name')->label('Last Name'),
                // TextColumn::make('profile')->label('Path'),
                ImageColumn::make('profile')->disk('public')->width(50)->height(50)->url(function($record){
                    return Storage::url($record->profile);
                })
                ->openUrlInNewTab()->circular()
                // ImageColumn::make('profile')->disk('public')->width(100)->height(100)->action(function ($record) {
                  
                //      dd($record);
                //     Storage::url($record->profile);

                // }),
                // TextColumn::make('profile')->label('path'),
                // // TextColumn::make('profile')->label('Last Name'),
                // ImageColumn::make('profile')->disk('public'),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\Action::make('view')->mountUsing(fn (Forms\ComponentContainer $form, $record) => $form->fill([
                //     'authorId' => $record->a,
                // ]))->form([
                //     Forms\Components\Select::make('authorId')
                //         ->label('Author')
                //         ->options(User::query()->pluck('name', 'id'))
                //         ->required(),
                // ]),
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListUserInformation::route('/'),
            'create' => Pages\CreateUserInformation::route('/create'),
            'edit' => Pages\EditUserInformation::route('/{record}/edit'),
        ];
    }    
}
