<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Course;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CourseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CourseResource\RelationManagers;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?int $navigationSort = 2;
    
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $activeNavigationIcon = 'heroicon-s-academic-cap';



     
    //  protected static function getNavigationBadge(): ?string
    //  {
    //      return static::getModel()::count();
    //  }
 


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->maxLength(255)->columnSpan(2)->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('name')->searchable(),
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
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCourses::route('/'),
        ];
    }    
}
