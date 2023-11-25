<x-filament-panels::page>
    <h2 class="text-2xl font-bold">teste</h2>

    <ul>
        @foreach($properties as $property)
        <li>{{ $property->name }}</li>
        @endforeach
    </ul>
</x-filament-panels::page>
