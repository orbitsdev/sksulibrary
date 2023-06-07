<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Campus;
use App\Models\Course;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
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
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Accounts';


    public $name;
    public $first_name;
    public $last_name;
    public $email;
    public $password;


    // protected static ?string $navigationGroup = 'Account';


    protected static ?string $recordTitleAttribute = 'name';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // protected static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                FieldSet::make('User Account')
                    ->schema([

                        Grid::make(2)
                            ->schema([
                                TextInput::make('email')->email()->columnSpan(1)->required(),
                                TextInput::make('password')->dehydrateStateUsing(static function (null|String $state): null|String {
                                    return  filled($state) ? Hash::make($state) : null;
                                })->required(function ($livewire) {
                                    return  $livewire instanceof CreateUser;
                                })->dehyDrated(function ($state) {
                                    return filled($state);
                                })->label(function ($livewire) {
                                    return ($livewire instanceof EditUser) ? 'New Password' : 'Password';
                                })->columnSpan(1),
                            ]),



                    ]),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('user_information.profile')->circular()->label('Profile'),
                TextColumn::make('email')->searchable(),
             
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
