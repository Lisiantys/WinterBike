<x-app-layout title="Mes événements">
    <h2 class="text-lg md:text-2xl mb-4 py-4 px-6 bg-red-500 rounded-lg font-semibold text-white">Événements en cours de validation</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($events->where('is_validated', 0) as $event)
            @include('events.partials.event-card')
        @empty
            <x-events.empty-message class="bg-white shadow rounded-lg p-4">
                Vous n'avez aucun événement à faire valider.
            </x-events.empty-message>
        @endforelse
    </div>
    <div>{{ $events->links('vendor.pagination.custom') }}</div>


    <h2 class="text-lg md:text-2xl mb-4 py-4 px-6 bg-mint rounded-lg font-semibold text-white">Événements validés</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($events->where('is_validated', 1) as $event)
            @include('events.partials.event-card')
        @empty
            <x-events.empty-message class="bg-white shadow rounded-lg p-4">
                Vous n'avez aucun événement publié.
            </x-events.empty-message>
        @endforelse
    </div>
    <div>{{ $events->links('vendor.pagination.custom') }}</div>
</x-app-layout>