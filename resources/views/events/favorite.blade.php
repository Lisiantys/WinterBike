<x-app-layout>
    <h1>Mes favoris</h1>
    @if($favorites->isEmpty())
    <p>Vous n'avez pas d'événements en favoris.</p>
    @endif
@foreach ($favorites as $favorite)
    <x-events.event-list :event="$favorite" />
    <form method="POST" action="{{ route('favorites.remove', $favorite->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Retirer l'évènement des favoris</button>
    </form>
    <p>Nombre de favoris : {{ $favorite->favoritedBy->count() }}</p>
@endforeach
</x-app-layout>