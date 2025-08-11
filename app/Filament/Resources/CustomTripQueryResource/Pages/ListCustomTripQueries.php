<?php

namespace App\Filament\Resources\CustomTripQueryResource\Pages;

use App\Filament\Resources\CustomTripQueryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomTripQueries extends ListRecords
{
    protected static string $resource = CustomTripQueryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
