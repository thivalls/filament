<x-filament-panels::page>
    @if ($this->hasInfolist())
        {{ $this->infolist }}
    @else
        {{ $this->form }}
    @endif
 
    @if (count($relationManagers = $this->getRelationManagers()))
        <x-filament-panels::resources.relation-managers
            :active-manager="$activeRelationManager"
            :managers="$relationManagers"
            :owner-record="$record"
            :page-class="static::class"
        />
    @endif

    <div>
        <h2 class="text-2xl">Imóveis Indicados</h2>
        <ul>
            @foreach($properties as $property)
            <li>{{ $property->name }}</li>
            @endforeach
        </ul>
    </div>

</x-filament-panels::page>