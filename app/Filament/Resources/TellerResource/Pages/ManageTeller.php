<?php

namespace App\Filament\Resources\TellerResource\Pages;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Teller;
use Filament\Resources\Pages\Page;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TellerResource;

class ManageTeller extends Page implements Tables\Contracts\HasTable, Forms\Contracts\HasForms
{
    use Tables\Concerns\InteractsWithTable;
    use Forms\Concerns\InteractsWithForms;
    protected static string $resource = TellerResource::class;
    protected static string $view = 'filament.resources.teller-resource.pages.manage-teller';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        dd($data);

        return $data;
    }


    protected function getTableColumns(): array

    {

        return [
            TextColumn::make('user.email')->searchable(),
            TextColumn::make('teller_name')->label('Teller Name')->searchable(),
            TextColumn::make('teller_number')->label('Teller number')->searchable(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ActionGroup::make([
                DeleteAction::make('Delete')->button()->label('Delete'),

            ])
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            Tables\Actions\DeleteBulkAction::make(),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            CreateAction::make('create')->button()->icon('heroicon-s-plus')->label('Add Teller ') ->using(function (array $data): Model {

               

                return static::getModel()::create($data);
            })->form([

                Select::make('user_id')
                    ->options(

                        User::query()->whereDoesntHave('teller')->get()->pluck('email', 'id')
                        // User::query()
                        //     ->whereDoesntHave('teller')
                        //     ->get()
                        //     ->pluck(['name', 'id'])
                )
                ->required()
                ->searchable(),
                Forms\Components\TextInput::make('teller_name')
                ->label('Name')
                ->required(),
                Forms\Components\TextInput::make('teller_number')
                ->label('Desk number')
                ->unique()
                ->required(),


            ])->modalHeading('Creating Teller Account'),
        ];
    }


    protected function getTableQuery(): Builder
    {
        return Teller::query();
    }
}
