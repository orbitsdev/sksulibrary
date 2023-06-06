<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Course;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\UserInformation;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
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

    protected static ?string $navigationGroup = 'Account';



    public $first_name;
    public $last_name;
    public $user_id;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                FileUpload::make('profile')->columnSpan(2)->avatar()->disk('public')->directory('users-profile'),
                Select::make('user_id')->label('User')
                ->options(User::all()->pluck('name', 'id')->toArray())->searchable()->required()->reactive()->afterStateUpdated(function( $state, $set){
                     $user = User::find($state);                    
                     $set('first_name' , $user->name);
                     $set('first_name' , $user->name);
                })->columnSpan(2),
                Select::make('course_id')->label('Course')
                ->options(Course::all()->pluck('name', 'id')->toArray())->searchable()->required()->columnSpan(2),
                Select::make('year')->label('Course')
                ->options([
                    'first-year'=> '1st Year',
                    'second-year'=> '2nd Year',
                    'third-year'=> '3rd Year',
                    'fourth-year'=> '4th Year',
                ])->searchable()->required()->columnSpan(2),
                
                
             
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
