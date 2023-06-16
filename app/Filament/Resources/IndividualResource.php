<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndividualResource\Pages;
use App\Filament\Resources\IndividualResource\RelationManagers;
use App\Models\Individual;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IndividualResource extends Resource
{
    protected static ?string $model = Individual::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-report';
    protected static ?string $activeNavigationIcon = 'heroicon-s-document-report';
    protected static ?string $navigationLabel = 'Individual Reports';


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
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\IndividualReport::route('/'),
            // 'create' => Pages\CreateIndividual::route('/create'),
            // 'edit' => Pages\EditIndividual::route('/{record}/edit'),
        ];
    }    
}
