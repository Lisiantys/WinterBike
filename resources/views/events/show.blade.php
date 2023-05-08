<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $event->name }}</title>
</head>
<body>
    @include('events.partials.navbar')
    <h1>{{ $event->name }}</h1>
    <p>{{ $event->description }}</p>
    <img id="image-preview" src="{{ Storage::url($event->image_path) }}" alt="Aperçu de l'image" style="max-width: 100%;">

    @auth
        @if(auth()->user()->id === $event->user_id && $event->is_validated == 0 || auth()->user()->role_id === 4) {{-- ok --}}
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
    
    @if(auth()->check() && auth()->user()->email_verified_at !== null)  {{-- ok --}}
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
    
    @foreach($event->comments as $comment)
    <div>
        <img src="{{ Storage::url($comment->user->image_path) }}" alt="Image de l'utilisateur" width="50" height="50">
        <strong>{{ $comment->user->name }}</strong>
        <p>Le : {{ $comment->created_at->format('d/m/Y H:i') }}</p>
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
    @endforeach

</body>
</html>
