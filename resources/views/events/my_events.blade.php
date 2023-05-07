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
    <h1>Mes evenements</h1>
    <a href="{{ route('events.create') }}">Créer un évènement</a>

    <h2>Événements non validés</h2>
    @foreach ($events->where('is_validated', 0) as $event)
        @include('events.partials.event_card')
    @endforeach

    <h2>Événements validés</h2>
    @foreach ($events->where('is_validated', 1) as $event)
        @include('events.partials.event_card', ['disableEditButton' => true])
    @endforeach
</body>

</html>