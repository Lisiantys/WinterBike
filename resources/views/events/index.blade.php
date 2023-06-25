<x-app-layout>
    <x-h1-title>
        Retrouvez les évènements en France
    </x-h1-title>
 
    <div class="flex flex-col md:flex-row-reverse">
        <div class="w-full md:w-5/12 lg:w-4/12 md:h-screen sm:top-24 md:sticky">
            @include('events.partials.form-filter')
        </div>
        <div class="w-full md:w-7/12 lg:w-4/6">
            <div class=" grid grid-cols-1 gap-1 md:pr-8">
                @forelse ($events as $event)
                    <x-events.event-list :event="$event"/>
                @empty
                    <x-events.empty-message>
                        Aucun événement trouvé avec ces options de recherche.
                    </x-events.empty-message>
                @endforelse
            </div>
        </div>
    </div>
    <div>{{ $events->withQueryString()->links('vendor.pagination.custom') }}</div>
    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 mt-6">
        @foreach($topFavorites as $eventFavorite)
            <x-events.event-favorites :event="$eventFavorite" :rank="$loop->iteration" />
        @endforeach
    </div>
</x-app-layout>
