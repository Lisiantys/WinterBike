<x-app-layout>
    <div class="container">
        <x-h1-title>
            Mes favoris
        </x-h1-title>
        @forelse ($favorites as $favorite)
            <x-events.event-list :event="$favorite" />
            <form method="POST" action="{{ route('favorites.remove', $favorite->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Retirer l'évènement des favoris</button>
            </form>
        @empty
            <p>Vous n'avez pas d'événements en favoris.</p>
        @endforelse
        <div>{{ $favorites->links() }}</div>
    </div>
</x-app-layout>