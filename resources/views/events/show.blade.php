<x-app-layout>
    <h1>{{ $event->name }}</h1>
    <p>{{ $event->description }}</p>
    <img id="image-preview" src="{{ Storage::url($event->image_path) }}" alt="Aperçu de l'image" style="max-width: 100%;">
   
    @if (auth()->user() && $event->favoritedBy->contains(auth()->user()->id))
        <p><i class="fa-solid fa-star fa-xl" style="color: #FFD700;">{{ $event->favoritedBy->count() }}</i></p>
    @else
        <p><i class="fa-regular fa-star fa-xl" style="color: #e7ca25;">{{ $event->favoritedBy->count() }}</i></p>
    @endif

    @auth
        @if(auth()->user()->email_verified_at !== null) 
            @php
            $isFavorite = auth()->user()->favoritedEvents->contains($event->id);
            @endphp

            @if($isFavorite)
                <form action="{{ route('favorites.remove', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Retirer des favoris</button>
                </form>
            @else
                <form action="{{ route('favorites.add', $event->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Ajouter au favoris</button>
                </form>
            @endif
        @endif
    @endauth

    @auth
        @if(auth()->user()->id === $event->user_id || auth()->user()->role_id === 4) {{-- ok --}}
            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Modifier l'événement</a>
        @endif
    
        @if(auth()->user()->id === $event->user_id || auth()->user()->role_id === 4) {{-- ok --}}
            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement?');">Supprimer l'événement</button>
            </form>
        @endif
    @endauth
    
    @auth
        @if(auth()->user()->email_verified_at !== null)  {{-- ok --}}
            <form action="{{ route('comments.store', $event->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="description">Commentaire:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer le commentaire</button>
            </form>
        @else
            <h3>Veuillez-vous connecter et vérifier votre compte pour publier un commentaire.</h3>
        @endif
    @endauth

    @guest
        <h3>Veuillez-vous connecter et vérifier votre compte pour publier un commentaire.</h3>
    @endguest
  
    @forelse($comments as $comment)
        <div>
            <img src="{{ Storage::url($comment->user->image_path) }}" alt="Image de l'utilisateur" width="50" height="50">
            <strong><a href="{{ route('profile.show', $comment->user->id) }}">{{ $comment->user->name }}</a></strong>

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
    <p>Soyez le premier à commenter cet évènement !</p>
    @endforelse
    <div>{{ $comments->links() }}</div>
</x-app-layout>