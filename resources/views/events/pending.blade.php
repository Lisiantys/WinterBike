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

                    <form action="{{ route('events.validate', $event) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Valider l'événement</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>