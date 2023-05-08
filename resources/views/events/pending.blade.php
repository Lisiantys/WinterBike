<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('events.partials.navbar')
    <div class="container">
        <h1>Événements en attente</h1>

        <div class="event-list">
            @foreach($pendingEvents as $event)
                <div class="event">
                    
                        <h2>{{ $event->name }}</h2>
                        <p>{{ $event->description }}</p>
                        <img src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur" width="50" height="50">
                    

                    <form action="{{ route('events.validate', $event) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Valider l'événement</button>
                    </form>
                    @if(auth()->user()->role_id === 4) {{-- ok --}}
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="fromEventPending" value="pending">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement?');">Supprimer l'événement</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>