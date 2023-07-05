<form action="{{ route('events.index') }}" method="get" class="w-full bg-greyed rounded-lg p-5 space-y-2" id="searchForm">

    <x-events.input-field name="keyword" label="Mot-clé" :value="$request->input('keyword')" />

    <x-events.select-field name="departement" label="Département">
        <option value="">Sélectionnez un département</option>
        @foreach ($departments as $department)
            <option value="{{ $department->id }}" {{ $request->input('departement') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
        @endforeach
    </x-events.select-field>

    <x-events.select-field name="region" label="Région">
        <option value="">Sélectionnez une région</option>
        @foreach ($regions as $region)
            <option value="{{ $region->id }}" {{ $request->input('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
        @endforeach
    </x-events.select-field>

    <x-events.select-field name="type" label="Type d'événement">
        <option value="">Sélectionnez un type d'événement</option>
        @foreach ($types as $type)
            <option value="{{ $type->id }}" {{ $request->input('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
        @endforeach
    </x-events.select-field>

    <x-events.input-field type="date" name="beginning" label="Date de début" :value="$request->input('beginning')" />

    <x-events.input-field type="date" name="end" label="Date de fin" :value="$request->input('end')" />

    <div class="flex flex-col justify-center col-span-full">
        <x-events.button-gradient type="submit">Filtrer les événements</x-events.button-gradient>
        <button type="button" onclick="resetForm();" class="h-10 mt-2 font-semibold bg-red-500 text-white px-4 py-2 rounded text-base">Supprimer les filtres</button>
    </div>
</form>

<script>
    function resetForm() {
        document.getElementById('keyword').value = '';
        document.getElementById('departement').value = '';
        document.getElementById('region').value = '';
        document.getElementById('type').value = '';
        document.getElementById('beginning').value = '';
        document.getElementById('end').value = '';
    }
</script>
