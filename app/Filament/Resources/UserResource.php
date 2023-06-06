<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?int $navigationSort = 2;

   

    public $name;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    

    protected static ?string $navigationGroup = 'Account';


    protected static ?string $recordTitleAttribute = 'name';

    
    protected static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}

  
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->hidden()->reactive()->afterStateUpdated(function( $state, $set){
               }),
                TextInput::make('first_name')->reactive()->afterStateUpdated(function( $state, $set){
                
                    $set('first_name' , $state);

               }),
                TextInput::make('last_name')->reactive()->afterStateUpdated(function( $state, $set){
                    $set('last_name' , $state);
               }),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')->dehydrateStateUsing(static function (null|String $state) : null|String {
                  return  filled($state) ? Hash::make($state) : null;        
                })->required(function($livewire){
                    return  $livewire instanceOf CreateUser;
                })->dehyDrated(function($state){
                    return filled($state);
                })->label(function($livewire){
                    return ($livewire instanceOf EditUser) ? 'New Password' : 'Password';
                }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->searchable(),
                TextColumn::make('last_name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('password')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
