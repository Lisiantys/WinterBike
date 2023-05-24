<x-app-layout>
    <div class="container">
        <x-h1-title>
            Mes évènements
        </x-h1-title>
        <div class="mx-auto flex">
            <div class="h-10 my-2 rounded-md bg-gradient-to-r from-blue-500 to-green-500 p-1">
                <div class="flex h-full w-full items-center justify-center bg-white">
                    <a href="{{ route('events.create') }}" class="text-base px-4 font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-green-500">Créer un évènement</a>
                </div>
            </div>
        </div>
    
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