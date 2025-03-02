<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RealtimeResource\Pages;
use App\Filament\Resources\RealtimeResource\RelationManagers;
use App\Models\Realtime;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RealtimeResource extends Resource
{
    protected static ?string $model = Realtime::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $activeNavigationIcon = 'heroicon-s-identification';
    protected static ?string $navigationLabel = 'Realtime Statistics';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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


            'index' => Pages\RealtimeMonitoring::route('/index'),
           
        ];
    }    
}
