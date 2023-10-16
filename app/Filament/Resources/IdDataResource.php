<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\IdData;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\Position;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\IdDataResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\IdDataResource\RelationManagers;

class IdDataResource extends Resource
{
    protected static ?string $model = IdData::class;



    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $activeNavigationIcon = 'heroicon-s-user-circle';
    protected static ?string $navigationLabel = 'ID Settings';

    
    public static function getPluralLabel(): ?string
    {
       return 'Settings';

    }

   
    
    
    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->take(1);
}


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Fieldset::make('SET ID DETAILS')
                ->schema([
                    Grid::make(12)
                        ->schema([
                            TextInput::make('director')->label('Director Name')->required()
                            ->maxLength(50)
                            ->columnSpan(12)
                            ,
                 
                            TextInput::make('title')->label('Director Title')->required()
                            ->maxLength(50)
                            ->columnSpan(12)
                            ,
                            
                            TextInput::make('valid_from')
                            ->label('Valid From')
                            ->columnSpan(6)
                            ->required()
                            ->minLength(4)
                            ->maxLength(4)
                            ->helperText('ex. (2021) ')
                            ->mask(fn (TextInput\Mask $mask) => $mask->pattern('0000'))
                            ,
                 
                            TextInput::make('valid_until')
                            ->label('Valid Until')
                            ->columnSpan(6)
                            ->required()
                            ->minLength(4)
                            ->maxLength(4)
                            ->helperText('ex. (2022) ')
                            ->mask(fn (TextInput\Mask $mask) => $mask->pattern('0000'))
                            ,
                 
                            FileUpload::make('logo')->columnSpanFull()->disk('public')->directory('id-data')->label('Upload Logo')->image()
                          
                            ,

                            FileUpload::make('bg')->columnSpanFull()->disk('public')->directory('id-data')->label('Upload Id Background')->image()
                            ,
                            Toggle::make('use')->label('Use Course Abbreviation ')
                            ->columnSpan(6)
                            ,

                        ])]),
               
     
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('director')->label('Director'),
                TextColumn::make('title')->label('Director Title'),
                TextColumn::make('valid_from')->label('Valid From'),
                TextColumn::make('valid_until')->label('Valid Until'),
                TextColumn::make('use')->label('Abrriviation')->formatStateUsing(fn($state) => $state ? 'Abbreviation in Use' : 'Abbreviation Not in Use'),
                ImageColumn::make('logo')->label('ID Logo')->width(90)->height(90)
                ->defaultImageUrl(url('/images/placeholder.jpg'))
                ->url(fn ($record): string => $record->logo ?  Storage::disk('public')->url($record->logo) : asset('images/placeholder.jpg'))
                ->openUrlInNewTab()
                ,
                ImageColumn::make('bg')->label('Background Image')->width(90)->height(90)
                ->defaultImageUrl(url('/images/placeholder.jpg'))
                ->url(fn ($record): string => $record->bg ?  Storage::disk('public')->url($record->bg) : asset('images/placeholder.jpg'))
                ->openUrlInNewTab()
            
                
                ,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageIdData::route('/'),
        ];
    }    
}
