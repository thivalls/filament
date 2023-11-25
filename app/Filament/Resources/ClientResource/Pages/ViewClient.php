<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Models\Client;
use App\Models\Property;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewClient extends ViewRecord
{
    public $properties = [1,2,3];

    protected static string $resource = ClientResource::class;
    protected static string $view = 'filament.resources.pages.view-client';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->authorizeAccess();

        if (! $this->hasInfolist()) {
            $this->fillForm();
        }

        $this->properties = Property::whereBetween('price', [$this->record->start_financing, $this->record->end_financing])->get();
    }
}
