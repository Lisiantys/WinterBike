<x-app-layout>
    <h1>Affiche la liste des evenements</h1>

    <form action="{{ route('events.index') }}" method="get">
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

    @if($events->isEmpty())
        <p>Il n'y a pas d'événement avec ces options de recherche.</p>
    @else
        @foreach ($events as $event)   
        <div>
            <img src="" alt="">
        </div>
        <div class="w-2/5" style="background:red;">
                <h1 class="text-2xl font-bold underline"><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></h1>

                <p>Du {{ \Carbon\Carbon::parse($event->beginningDate)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($event->endDate)->format('d/m/Y') }} - {{ $event->type->name }} </p>
                <p>{{ $event->region->name }} - {{ $event->department->name }}</p>
                <div class="flex items-center">
                    <img src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur" width="50" height="50">
                    <p>Auteur: {{ $event->user->name }}</p>
                </div>
                <p>{{ Str::limit($event->description, $limit = 100, $end = '...') }}</p>
            </div>
        @endforeach
        <div class="pagination">{{ $events->links() }}</div>
    @endif
</x-app-layout>