<x-app-layout>
    <h1>Mes favoris</h1>
    @foreach ($favorites as $favorite)
    @if ($favorite->event)
        <p>{{ $favorite->event->name }}</p>
    @else
        <p>Pas d'événement associé à ce favori.</p>
    @endif
@endforeach
</x-app-layout>