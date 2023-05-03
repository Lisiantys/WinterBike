<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Affiche la liste des evenements</h1>
    @foreach ($events as $event)
    <div>
        <h1><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></h1>
    </div>
       
    @endforeach
</body>
</html>