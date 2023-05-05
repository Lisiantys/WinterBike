<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            @auth
            <ul>
                <li><a href="{{ route('index') }}">Évènement</a></li>
                <li><a href="{{ route('events.myEvents') }}">Mes Évènements</a></li>
                <li><a href="">Évènements en attente</a></li>
                <li><a href="">Gérer les Utilisateurs</a></li>
            </ul>
            @endauth
            @guest
            <ul>
                <li><a href="{{ route('index') }}">Évènement</a></li>
            </ul>
            @endguest
        </nav>
    </header>
    <h1>Affiche la liste des evenements</h1>
    @foreach ($events as $event)
    <div>
        <h1><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></h1>
    </div>
       
    @endforeach
</body>
</html>