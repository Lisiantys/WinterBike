<div>
    <a href="{{ route('events.show', $event->id) }}" class="text-current no-underline">
        <x-events.event-list :event="$event" />
    </a>
    <div class="flex mt-4">
        <x-events.button-gradient href="{{ route('events.edit', $event->id) }}">Modifier</x-events.button-gradient>
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
