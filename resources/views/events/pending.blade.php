<x-app-layout>
    <div class="container">
        <x-h1-title>
            Évènements en attentes
        </x-h1-title>

        <div class="event-list">
            @forelse($pendingEvents as $event)
                <div class="event">
                    <x-events.event-list :event="$event" />
       
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
                    <p style="color:red">Message de l'administrateur : {{ $event->staffMessage }}</p>

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
            @empty
                <p>Il n'y a pas de nouveaux évènements à accepter !</p>
            @endforelse
            <div>{{ $pendingEvents->links() }}</div>
        </div>
    </div>
</x-app-layout>