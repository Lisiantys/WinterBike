<form action="{{ route('events.index') }}" method="get" class="w-full lg:mt-0 mb-6" id="searchForm">
    <div class="mb-6">
        <label for="keyword" class="font-medium text-gray-700">Mot-clé :</label>
        <input type="text" name="keyword" id="keyword" value="{{ $request->input('keyword') }}" class="border border-gray-200 rounded py-2 focus:outline-none focus:border-blue-300 w-full">
    </div>
    <div class="mb-6">
        <label for="department_id" class="font-medium text-gray-700">Département :</label>
        <select name="departement" id="departement" class="block appearance-none w-full bg-white border border-gray-200 py-2 rounded focus:outline-none focus:border-blue-300">
            <option value="">Sélectionnez un département</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}" {{ $request->input('departement') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-6">
        <label for="region_id" class="font-medium text-gray-700">Région :</label>
        <select name="region" id="region" class="block appearance-none w-full bg-white border border-gray-200 py-2 rounded focus:outline-none focus:border-blue-300">
            <option value="">Sélectionnez une région</option>
            @foreach ($regions as $region)
                <option value="{{ $region->id }}" {{ $request->input('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-6">
        <label for="type_id" class="font-medium text-gray-700">Type d'événement :</label>
        <select name="type" id="type" class="block appearance-none w-full bg-white border border-gray-200 py-2 rounded focus:outline-none focus:border-blue-300">
            <option value="">Sélectionnez un type d'événement</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" {{ $request->input('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-6">
        <label for="beginning" class="font-medium text-gray-700">Date de début :</label>
        <input type="date" name="beginning" id="beginning" value="{{ $request->input('beginning') }}" class="border border-gray-200 rounded py-2 focus:outline-none focus:border-blue-300 w-full">
    </div>
    <div class="mb-6">
        <label for="end" class="font-medium text-gray-700">Date de fin :</label>
        <input type="date" name="end" id="end" value="{{ $request->input('end') }}" class="border border-gray-200 rounded py-2 focus:outline-none focus:border-blue-300 w-full">
    </div>
    <div class="flex flex-col justify-center col-span-full">
        <button type="submit" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white px-4 py-2 rounded text-base">Filtrer les événements</button>
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