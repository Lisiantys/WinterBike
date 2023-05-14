<x-app-layout>
    <div class="container">
        <h1>Événements en attente</h1>

        <div class="event-list">
            @foreach($pendingEvents as $event)
                <div class="event">
                    <div>
                        <h1 class="text-2xl font-bold underline"><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></h1>
        
                        <p>Du {{ \Carbon\Carbon::parse($event->beginningDate)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($event->endDate)->format('d/m/Y') }} - {{ $event->type->name }} </p>
                        <p>{{ $event->region->name }} - {{ $event->department->name }}</p>
                        <div class="flex items-center">
                            <img src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur" width="50" height="50">
                            <p>Auteur: {{ $event->user->name }}</p>
                        </div>
                        <p>{{ Str::limit($event->description, $limit = 100, $end = '...') }}</p>
                        <p style="color:red;">Message de l'équipe : {{ $event->staffMessage }}</p>
                    </div>
       
                    <form action="{{ route('events.validate', $event) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Valider l'événement</button>
                    </form>
                    <form action="{{ route('events.storeStaffMessage', $event) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="staffMessage">Message du staff :</label>
                            <textarea name="staffMessage" id="staffMessage" class="form-control" required maxlength="255" minlength="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer le message</button>
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
                <p>------------------------------------------------</p>
            @endforeach
        </div>
    </div>
</x-app-layout>