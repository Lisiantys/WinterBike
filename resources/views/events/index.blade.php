<x-app-layout>
    <div>

        <div class="top-favorites">
            <h2>Événements les plus populaires</h2>
        
            @foreach($topFavorites as $event)
                <div>
                    <x-events.event-list :event="$event" />

                </div>
            @endforeach
        </div>
        
        <h1>Affiche la liste des evenements</h1>

        <form action="{{ route('events.index') }}" method="get">
            <label for="keyword">Mot-clé :</label>
            <input type="text" name="keyword" id="keyword" value="{{ $request->input('keyword') }}">

            <label for="department_id">Département :</label>
            <select name="departement" id="departement">
                <option value="">Sélectionnez un département</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ $request->input('departement') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>

            <label for="region_id">Région :</label>
            <select name="region" id="region">
                <option value="">Sélectionnez une région</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ $request->input('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                @endforeach
            </select>

            <label for="type_id">Type d'événement :</label>
            <select name="type" id="type">
                <option value="">Sélectionnez un type d'événement</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $request->input('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>

            <label for="beginning">Date de début :</label>
            <input type="date" name="beginning" id="beginning" value="{{ $request->input('beginning') }}">

            <label for="end">Date de fin :</label>
            <input type="date" name="end" id="end" value="{{ $request->input('end') }}">

            <button type="submit">Rechercher</button>
        </form>

        <a href="{{ route('events.create') }}">Créer un évènement</a>

        @if($events->isEmpty())
            <p>Il n'y a pas d'événement avec ces options de recherche.</p>
        @else
            @foreach ($events as $event)   
                <x-events.event-list :event="$event" />
            @endforeach
            <div>{{ $events->withQueryString()->links() }}</div>
        @endif
    </div>
</x-app-layout>