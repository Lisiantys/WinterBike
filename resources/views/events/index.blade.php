<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .pagination nav{
            display: flex;
        }
        .pagination nav .hidden{
            display: flex;
        }
    </style>
</head>
<body>
   @include('events.partials.navbar')
    <h1>Affiche la liste des evenements</h1>
    @foreach ($events as $event)
        <div>
            <h1><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></h1>
            <img src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur" width="50" height="50">
            <p>Auteur: {{ $event->user->name }}</p>
        </div>
    @endforeach
    <div class="pagination">{{ $events->links() }}</div>
    
</body>
</html>