<x-app-layout>
    <h1>Mes evenements</h1>
    <a href="{{ route('events.create') }}">Créer un évènement</a>

    <h2>Événements non validés</h2>
    @foreach ($events->where('is_validated', 0) as $event)
        @include('events.partials.event_card')
    @endforeach

    <h2>Événements validés</h2>
    @foreach ($events->where('is_validated', 1) as $event)
        @include('events.partials.event_card')
    @endforeach
</x-app-layout>