<x-app-layout>
    <x-h1-title>
        Mes favoris
    </x-h1-title>
    <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
        @forelse ($favorites as $favorite)
            <x-events.event-list :event="$favorite" :isFavoriteView="true" />
        @empty
            <x-events.empty-message>
                Vous n'avez aucun événement en favoris.
            </x-events.empty-message>
        @endforelse
    </div>
    <div>{{ $favorites->links() }}</div>
</x-app-layout>