<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Campus;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CampusResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CampusResource\RelationManagers;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;

class CampusResource extends Resource
{
    protected static ?string $model = Campus::class;

    protected static ?string $navigationIcon = 'heroicon-o-library';
    protected static ?string $activeNavigationIcon = 'heroicon-s-library';



    // protected static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->maxLength(255)->columnSpan(2)->required()->label('Campus Name'),
                Repeater::make('courses')
                ->relationship()
                ->schema([
                    TextInput::make('name')->required()->label('Course Name')->required(),
                   
                ])
                ->columnSpanFull(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                // TagsColumn::make('courses.name')->separator(',')
                // ->wrap()
                // ,
                TextColumn::make('courses_count')->counts('courses')->label('Total Course')->color('primary'),
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
            'index' => Pages\ManageCampuses::route('/index'),
        ];
    }
}
