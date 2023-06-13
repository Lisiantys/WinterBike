<x-app-layout>
    <x-h1-title>
        Retrouvez les évènements en France
    </x-h1-title>

    <div class="w-full flex flex-col sm:flex-row">
        @include('events.partials.form-filter')
        <div class="w-full sm:w-1/2 sm:pl-2">
            @foreach($topFavorites as $event)
                <div>
                    <x-events.event-list :event="$event" :isTopFavorite="true" />
                </div>
            @endforeach
        </div>
    </div>

    <div class="w-full">
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($events as $event)
                <x-events.event-list :event="$event"/>
            @empty
                <x-events.empty-message>
                    Aucun événement trouvé avec ces options de recherche.
                </x-events.empty-message>
            @endforelse
        </div>
        <div>{{ $events->withQueryString()->links('vendor.pagination.custom') }}</div>
    </div>

</x-app-layout>