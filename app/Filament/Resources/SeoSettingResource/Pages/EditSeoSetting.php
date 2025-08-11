<?php

namespace App\Filament\Resources\SeoSettingResource\Pages;

use App\Filament\Resources\SeoSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeoSetting extends EditRecord
{
    protected static string $resource = SeoSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
