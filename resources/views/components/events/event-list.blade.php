<div class="w-2/5" style="background:red;">
    <h1 class="text-2xl font-bold underline"><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></h1>

    <p>Du {{ \Carbon\Carbon::parse($event->beginningDate)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($event->endDate)->format('d/m/Y') }} - {{ $event->type->name }} </p>
    <p>{{ $event->region->name }} - {{ $event->department->name }}</p>
    <div class="flex items-center">
        <img src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur" width="50" height="50">
        <p>Auteur: {{ $event->user->name }}</p>
    </div>
    <p>{{ Str::limit($event->description, $limit = 100, $end = '...') }}</p>
    @if (auth()->user() && $event->favoritedBy->contains(auth()->user()->id))
        <p><i class="fa-solid fa-star" style="color: #FFD700;">{{ $event->favoritedBy->count() }}</i></p>
    @else
        <p><i class="fa-regular fa-star" style="color: #e7ca25;">{{ $event->favoritedBy->count() }}</i></p>
    @endif
</div>
