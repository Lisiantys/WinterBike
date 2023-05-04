<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Mes evenements</h1>
    <a href="{{ route('events.create') }}">Créer un évènement</a>
    @foreach ($events as $event)
        <h2>{{ $event->name }}</h2>
        <p>{{ $event->description }}</p>
        <a href="{{ route('events.edit', $event->id) }}">Modifier</a>
        <form action="{{ route('events.destroy', $event->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">Supprimer</button>
        </form>
    @endforeach
</body>
</html>