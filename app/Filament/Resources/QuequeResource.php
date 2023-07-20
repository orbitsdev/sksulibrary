<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Queque;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\QuequeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuequeResource\RelationManagers;

class QuequeResource extends Resource
{
    protected static ?string $model = Queque::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';
    protected static ?string $activeNavigationIcon = 'heroicon-s-light-bulb';

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('number')->maxLength(255)->columnSpan(2)->required(),
                Select::make('status')
    ->options([
        'waiting' => 'Waiting',
        'hold' => 'Hold',
        'completed' => 'Completed',
        'processing' => 'Processing',
    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable(),
                TextColumn::make('number')->label('Queqye number')->searchable(),
                TextColumn::make('status')->label('Status')->searchable(),
                TextColumn::make('updated_at')->label('Date')->formatStateUsing(function($record){
                                      return $record->updated_at->diffForHumans();

                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),

                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageQueques::route('/'),
        ];
    }    
}
