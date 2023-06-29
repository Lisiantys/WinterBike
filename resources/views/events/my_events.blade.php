<x-app-layout title="Mes événements">
    <h2 class="text-2xl md:text-3xl my-8">Événements non validés</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($events->where('is_validated', 0) as $event)
            @include('events.partials.event-card')
        @empty
            <x-events.empty-message>
                Vous n'avez aucun événement à faire valider.
            </x-events.empty-message>
        @endforelse
    </div>
    <div>{{ $events->links('vendor.pagination.custom') }}</div>


    <h2 class="text-2xl md:text-3xl my-8">Événements validés</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($events->where('is_validated', 1) as $event)
            @include('events.partials.event-card')
        @empty
            <x-events.empty-message>
                Vous n'avez aucun événement publié.
            </x-events.empty-message>
        @endforelse
    </div>
    <div>{{ $events->links('vendor.pagination.custom') }}</div>
</x-app-layout>