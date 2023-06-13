<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\DayRecord;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\DayRecordResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DayRecordResource\RelationManagers;

class DayRecordResource extends Resource
{
    protected static ?string $model = DayRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-list';
    protected static ?string $activeNavigationIcon = 'heroicon-s-clipboard-list';

    protected static ?string $navigationLabel = 'Record List';

    protected static ?string $modelLabel = 'Recorded Days';


    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()->orderBy('created_at', 'desc');
}
    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

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

                TextColumn::make('created_at')->label('Date ')->formatStateUsing(function ($record) {
                    return $record->created_at->format('F d, Y ');
                    // return $record->created_at->format('F d, Y - l');

                })->searchable()->color('warning'),

                // TextColumn::make('created_at')->dateTime('F d, Y - l')->label('Date Recorded')->searchable(),
                TextColumn::make('daylogins')->label('Records')->formatStateUsing(function ($record) {
                    return $record->daylogins->count();
                }),


                //   TextColumn::make('student.first_name')->label('Student Name') ->formatStateUsing(function ($record){ 
                //         return strtoupper( $record->student->first_name . ' ' . $record->student->last_name);
                //     }),
                //   TextColumn::make('student.year')->label('Year '),
                //   TextColumn::make('student.course.name')->label('Course'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\Action::make('View')->button()->action(function ($record){
                //    dd(DayRecordResource::getUrl('record' ,$record));
                // }) ,
                Tables\Actions\Action::make('View')->button()->url(fn ($record): string =>  DayRecordResource::getUrl('loginrecord', $record)),
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
          
            // 'realtimemonitoring' => RealtimeMonitoring::route('/realtimemonitoring'),
            'index' => Pages\ListDayRecords::route('/index'),
            'loginrecord' => Pages\LoginRecord::route('/loginrecord/{id}'),
            // 'create' => Pages\CreateDayRecord::route('/create'),
            // 'edit' => Pages\EditDayRecord::route('/{record}/edit'),
        ];
    }
}
