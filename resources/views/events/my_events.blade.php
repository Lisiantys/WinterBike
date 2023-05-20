<x-app-layout>
    <div class="container">
        <x-h1-title>
            Mes évènements
        </x-h1-title>
        <a href="{{ route('events.create') }}">Créer un évènement</a>
    
        <h2 style="font-size: 24px;">Événements non validés</h2>
        @forelse ($events->where('is_validated', 0) as $event)
            @include('events.partials.event_card')
        @empty
            <p>Vous n'avez pas d'évènement à faire valider</p>
        @endforelse
    
        <h2 style="font-size: 24px;">Événements validés</h2>
        @forelse ($events->where('is_validated', 1) as $event)
            @include('events.partials.event_card')
        @empty
            <p>Vous n'avez pas d'évènement publié</p>
        @endforelse
        <div>{{ $events->links() }}</div>
    </div>
</x-app-layout>