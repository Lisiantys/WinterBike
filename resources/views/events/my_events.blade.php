<x-app-layout>
    <h1>Mes evenements</h1>
    <a href="{{ route('events.create') }}">Créer un évènement</a>

    <h2>Événements non validés</h2>
    @forelse ($events->where('is_validated', 0) as $event)
        @include('events.partials.event_card')
    @empty
    <p>Vous n'avez pas d'évènement à faire valider</p>
    @endforelse

    <h2>Événements validés</h2>
    @forelse ($events->where('is_validated', 1) as $event)
        @include('events.partials.event_card')
    @empty
    <p>Vous n'avez pas d'évènement publié</p>
    @endforelse

    {{ $events->withQueryString()->links('pagination-links') }}


</x-app-layout>