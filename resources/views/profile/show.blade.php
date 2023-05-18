<x-app-layout>

    <img src="{{ Storage::url($user->image_path) }}" alt="Image de l'utilisateur" width="50" height="50">
    <h1>{{ $user->name }}</h1>
    <p>{{ $user->role->name }}</p>
    <p>Inscription le : {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('LL') }}</p>

    @auth
        @if(auth()->user()->id === $user->id)
            <a href="{{ route('profile.edit') }}">Modifier le profil</a>
        @endif
    @endauth

    <h2>Événements créés par l'utilisateur</h2>
    @forelse($events as $event)
        <div>
            <x-events.event-list :event="$event"/>
            <!-- Afficher plus d'informations sur l'événement si vous le souhaitez -->
        </div>
    @empty
        <p>L'utilisateur n'a pas publié d'évènements</p>
    @endforelse
    <div>{{ $events->links() }}</div>


    <h2>Commentaires de l'utilisateur</h2>
    @forelse($comments as $comment)
    <div>
        <img src="{{ Storage::url($comment->user->image_path) }}" alt="Image de l'utilisateur" width="50" height="50">
        <strong>{{ $comment->user->name }}</strong> <p> a posté un commentaire sur <strong><a href="{{ route('events.show', $comment->event->id) }}">{{ $comment->event->name }}</a></strong></p>
        <p>Le : {{ \Carbon\Carbon::parse($comment->created_at)->isoFormat('LLL') }}</p>

        <p>{{ $comment->description }}</p>

        @auth
            @if(auth()->user()->id === $comment->user_id || auth()->user()->role_id === 4 || auth()->user()->role_id === 3)
                {{-- ok --}}
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">Supprimer</button>
                </form>
            @endif
        @endauth
    </div>
    @empty
        <p>L'utilisateur n'a pas publié de commentaires</p>
    @endforelse
    <div>{{ $comments->links() }}</div>
</x-app-layout>