<a href="{{ route('events.show', $event->id) }}" style="text-decoration: none; color: inherit;">
    <x-events.event-list :event="$event" />
</a>

<div class="flex mb-4">
    <a href="{{ route('events.edit', $event->id) }}" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Modifier</a>
    <form action="{{ route('events.destroy', $event->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="h-10 rounded-md bg-gradient-to-r from-blue-500 to-green-500 p-1">
            <div class="flex h-full w-full items-center justify-center bg-white">
                <button 
                type="submit"
                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');"
                class="text-base px-4 font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-green-500">
                Supprimer
                </button>
            </div>
        </div>
    </form>
</div>

