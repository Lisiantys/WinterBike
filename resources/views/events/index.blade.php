<x-app-layout>
    <h1>Affiche la liste des evenements</h1>

    <form action="{{ route('events.index') }}" method="get">
        <label for="department_id">Département :</label>
        <select name="department_id" id="department_id">
            <option value="">Sélectionnez un département</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ $request->input('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
            @endforeach
        </select>

        <label for="region_id">Région :</label>
        <select name="region_id" id="region_id">
            <option value="">Sélectionnez une région</option>
            @foreach ($regions as $region)
                <option value="{{ $region->id }}" {{ $request->input('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
            @endforeach
        </select>

        <label for="type_id">Type d'événement :</label>
        <select name="type_id" id="type_id">
            <option value="">Sélectionnez un type d'événement</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ $request->input('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
            @endforeach
        </select>

        <label for="beginning_date">Date de début :</label>
        <input type="date" name="beginning_date" id="beginning_date" value="{{ $request->input('beginning_date') }}">

        <label for="end_date">Date de fin :</label>
        <input type="date" name="end_date" id="end_date" value="{{ $request->input('end_date') }}">

        <button type="submit">Rechercher</button>
    </form>

    @if($events->isEmpty())
        <p>Il n'y a pas d'événement avec ces options de recherche.</p>
    @else
        @foreach ($events as $event)
            <div>
                <h1><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></h1>
                <img src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur" width="50" height="50">
                <p>Auteur: {{ $event->user->name }}</p>
            </div>
        @endforeach
        <div class="pagination">{{ $events->links() }}</div>
    @endif
</x-app-layout>