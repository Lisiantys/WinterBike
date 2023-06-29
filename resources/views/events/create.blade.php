<x-app-layout title="Publier votre évènement">

    <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <x-events.image-upload name="image_path" label="Image (Obligatoire)" accept="image/jpeg,image/png,image/jpg,image/svg,image/webp" max-size="2048" required />

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
            <x-events.button-gradient type="submit">Créer l'événement</x-events.button-gradient>
        </div>
    </form>
    
    <p>Tout événement crée devra être validée par l'équipe de Winter Bike, pour être rendu public.</p>
</x-app-layout>
