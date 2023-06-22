<x-app-layout>

   <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 ">
        @foreach($topFavorites as $eventFavorite)
            <x-events.event-favorites :event="$eventFavorite" :rank="$loop->iteration" />
        @endforeach
    </div>

    <x-h1-title>
        Retrouvez les évènements en France
    </x-h1-title>
 
    <div class="flex flex-col md:flex-row-reverse">
        <div class="w-full md:w-5/12 2xl:w-1/4 md:h-screen overflow-auto md:top-0 pt-4 md:sticky" style="max-height: 100vh;">
            @include('events.partials.form-filter')
        </div>
        <div class="w-full md:w-8/12 lg:w-4/6 2xl:w-3/4">
            <div class="mt-4 grid grid-cols-1 2xl:grid-cols-2 gap-4 sm:pr-2 2xl:px-2">
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
    </div>
</x-app-layout>
