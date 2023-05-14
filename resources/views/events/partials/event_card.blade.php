<a href="{{ route('events.show', $event->id) }}" style="text-decoration: none; color: inherit;">
    <x-events.event-list :event="$event" />
    @if (!is_null($event->staffMessage) && $event->is_validated === 0)
        <p style="color:red">Message de l'administrateur : {{ $event->staffMessage }}</p>
    @endif
</a>

<a href="{{ route('events.edit', $event->id) }}">Modifier</a>
<form action="{{ route('events.destroy', $event->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">Supprimer</button>
</form>

