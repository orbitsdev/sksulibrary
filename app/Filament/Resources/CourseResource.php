<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Course;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
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
                Select::make('campus_id')
                     ->searchable()
                     ->preload()
                    ->relationship('campus', 'name')->label('What Campus')
                    ->required()
                    ->columnSpan(2)
                 
                    ->createOptionForm([
                        TextInput::make('name')->maxLength(255)->columnSpan(2)->required()->label('Campus Name'),
                    ])
                    ,
                TextInput::make('name')->maxLength(255)->columnSpan(2)->required()->label('Course Name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->label('Course Name'),
                TextColumn::make('id')->searchable()->label('Course ID'),
                TextColumn::make('campus.name')->searchable()->label('Campus Name'),
            ])
            ->filters([


                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                SelectFilter::make('campus')->relationship('campus', 'name'),
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
