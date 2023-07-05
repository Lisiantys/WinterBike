<x-app-layout title="Mes Favoris">
    <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
        @forelse ($favorites as $favorite)
            <x-events.event-list :event="$favorite" :isFavoriteView="true" />
        @empty
            <x-events.empty-message class="bg-white shadow rounded-lg p-4">
                Vous n'avez aucun événement en favoris.
            </x-events.empty-message>
        @endforelse
    </div> 
    <div>{{ $favorites->links('vendor.pagination.custom') }}</div>
</x-app-layout>