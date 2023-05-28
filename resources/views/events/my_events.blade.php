<x-app-layout>
    <x-h1-title>
        Mes évènements
    </x-h1-title>
    <a href="{{ route('events.create') }}" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">
        Créer un événement
    </a>
    <h2 class="text-2xl md:text-3xl my-8">Événements non validés</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($events->where('is_validated', 0) as $event)
            <div>
                <a href="{{ route('events.show', $event->id) }}" class="text-current no-underline">
                    <x-events.event-list :event="$event" />
                </a>
                <div class="flex mt-4">
                    <a href="{{ route('events.edit', $event->id) }}" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Modifier</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="ml-2">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');"
                            class="flex h-10 items-center justify-center text-base px-4 font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-green-500 rounded-md">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <x-events.empty-message>
                Vous n'avez aucun événement à faire valider.
            </x-events.empty-message>
        @endforelse
    </div>

    <h2 class="text-2xl md:text-3xl my-8">Événements validés</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($events->where('is_validated', 1) as $event)
            <div>
                <a href="{{ route('events.show', $event->id) }}" class="text-current no-underline">
                    <x-events.event-list :event="$event" />
                </a>
                <div class="flex mt-4">
                    <a href="{{ route('events.edit', $event->id) }}" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Modifier</a>
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="ml-2">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');"
                            class="flex h-10 items-center justify-center text-base px-4 font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-green-500 rounded-md">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <x-events.empty-message>
                Vous n'avez aucun événement publié.
            </x-events.empty-message>
        @endforelse
    </div>
    <div>{{ $events->links() }}</div>
</x-app-layout>