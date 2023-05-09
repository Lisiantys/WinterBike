<a href="{{ route('events.show', $event->id) }}" style="text-decoration: none; color: inherit;">
    <h3>{{ $event->name }}</h3>
    <img src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur" width="50" height="50">
    <p>{{ $event->description }}</p>
    @if (!is_null($event->staffMessage) && $event->is_validated === 0)
        <p style="color:red">Message de l'administrateur : {{ $event->staffMessage }}</p>
    @endif
</a>
@if((!isset($disableEditButton) || !$disableEditButton) || (auth()->user() && auth()->user()->role_id === 4))
    <a href="{{ route('events.edit', $event->id) }}">Modifier</a>
@endif
<form action="{{ route('events.destroy', $event->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">Supprimer</button>
</form>

