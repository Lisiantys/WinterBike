{{-- <x-app-layout>
    <x-h1-title>
        Publier votre évènement
    </x-h1-title>

    <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf
    
        <img id="image-preview" alt="Aperçu de l'image" style="display: none;" class="mx-auto h-96 rounded-lg">

        <div class="flex flex-col items-center space-y-4">
            <label for="image_path" class="text-lg font-bold">Image (Obligatoire) :</label>
            <input type="file" id="image_path" name="image_path" onchange="loadImagePreview(event)" accept="image/jpeg,image/png,image/jpg,image/svg,image/webp" max-size="2048" required class="px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('image_path')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
            <div>
                <label for="name" class="block text-lg font-bold">Nom de l'évènement (Obligatoire) :</label>
                <input type="text" id="name" value="{{ old('name') }}" name="name" required maxlength="255" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="type_id" class="block text-lg font-bold">Type (Obligatoire) :</label>
                <select id="type_id" name="type_id" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <label for="beginningDate" class="block text-lg font-bold">Date de début (Obligatoire) :</label>
                <input type="date" id="beginningDate" value="{{ old('beginningDate') }}" name="beginningDate" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('beginningDate')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="endDate" class="block text-lg font-bold">Date de fin (Obligatoire) :</label>
                <input type="date" id="endDate" value="{{ old('endDate') }}" name="endDate" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('endDate')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="department_id" class="block text-lg font-bold">Département (Obligatoire) :</label>
                <select id="department_id" name="department_id" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <label for="region_id" class="block text-lg font-bold">Région (Obligatoire) :</label>
                <select id="region_id" name="region_id" required class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <label for="email" class="block text-lg font-bold">Adresse Email :</label>
                <input type="email" id="email" value="{{ old('email') }}" name="email" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
    
            <div>
                <label for="phone" class="block text-lg font-bold">Téléphone :</label>
                <input type="text" id="phone" value="{{ old('phone') }}" name="phone" minlength="10" maxlength="10" placeholder="ex:0612345678" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
    
            <div>
                <label for="website" class="block text-lg font-bold">Website :</label>
                <input type="url" id="website" value="{{ old('website') }}" name="website" placeholder="www.nomDuSite.com" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
    
            <div>
                <label for="facebook" class="block text-lg font-bold">Facebook :</label>
                <input type="url" id="facebook" value="{{ old('facebook') }}" name="facebook" placeholder="www.facebook.com" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <div>
            <label for="address" class="block text-lg font-bold">Adresse (Obligatoire) :</label>
            <input type="text" id="address" value="{{ old('address') }}" name="address" required maxlength="255" placeholder="123 Rue Fictive, Dordogne 24170" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('address')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-lg font-bold">Description (Obligatoire) :</label>
            <textarea id="description" name="description" rows="10" required maxlength="2000" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 text-white bg-gradient-to-r from-blue-500 to-green-500 rounded-lg">Créer l'évènement</button>
        </div>
    </form>
    
    <p>Tout événement crée devra être validée par l'équipe de Winter Bike, pour être rendu public.</p>
    
    <script>
        function loadImagePreview(event) {
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
            imagePreview.style.display = 'block';
        }
    </script>
    
</x-app-layout> --}}

<x-app-layout>
    <x-h1-title>
        Publier votre évènement
    </x-h1-title>

    <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <x-events.image-upload name="image_path" label="Image (Obligatoire)" accept="image/jpeg,image/png,image/jpg,image/svg,image/webp" max-size="2048" />

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
            <x-events.input-field name="name" type="text" label="Nom de l'évènement (Obligatoire)" required maxlength="255" />

            <x-events.select-field name="type_id" label="Type (Obligatoire)" required>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </x-events.select-field>

            <x-events.input-field name="beginningDate" type="date" label="Date de début (Obligatoire)" required />

            <x-events.input-field name="endDate" type="date" label="Date de fin (Obligatoire)" required />

            <x-events.select-field name="department_id" label="Département (Obligatoire)" required>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </x-events.select-field>

            <x-events.select-field name="region_id" label="Région (Obligatoire)" required>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                @endforeach
            </x-events.select-field>

            <x-events.input-field name="email" type="email" label="Adresse Email" />

            <x-events.input-field name="phone" type="text" label="Téléphone" minlength="10" maxlength="10" placeholder="ex:0612345678" />

            <x-events.input-field name="website" type="url" label="Website" placeholder="www.nomDuSite.com" />

            <x-events.input-field name="facebook" type="url" label="Facebook" placeholder="www.facebook.com" />
        </div>

        <x-events.input-field name="address" type="text" label="Adresse (Obligatoire)" required maxlength="255" placeholder="123 Rue Fictive, Dordogne 24170" />

        <x-events.textarea-field name="description" label="Description (Obligatoire)" rows="10" required maxlength="2000" />

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 text-white bg-gradient-to-r from-blue-500 to-green-500 rounded-lg">Créer l'évènement</button>
        </div>
    </form>
    
    <p>Tout événement crée devra être validée par l'équipe de Winter Bike, pour être rendu public.</p>
</x-app-layout>
