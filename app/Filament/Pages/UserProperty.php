<?php

namespace App\Filament\Pages;

use App\Models\Client;
use App\Models\Property;
use Filament\Pages\Page;

class UserProperty extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.user-property';

    public $client;
    public $properties;

    public function mount() {
        $this->client = Client::find(2);
        $this->properties = Property::whereBetween('price', [$this->client->start_financing, $this->client->end_financing])->get();
    }
}

