<?php

namespace App\Filament\Resources\SalesResource\Pages;

use App\Filament\Resources\SalesResource;
use Filament\Resources\Pages\Page;

class SalesDailyReport extends Page
{
    protected static string $resource = SalesResource::class;

    protected static string $view = 'filament.resources.sales-resource.pages.sales-daily-report';
}
