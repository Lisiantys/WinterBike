<x-app-layout title="Modifier votre événement">

    <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="flex w-full bg-red-500">
            <x-events.image-preview id="image-preview" src="{{ Storage::url($event->image_path) }}" alt="Aperçu de l'image"></x-events.image-preview>
    
            <x-events.image-upload name="image_path" label="Image" onchange="loadImagePreview(event)" accept="image/jpeg,image/png,image/jpg,image/svg,image/webp" max-size="2048"></x-events.image-upload>
         </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
            <x-events.input-field name="name" label="Nom de l'événement (Obligatoire)" value="{{ $event->name }}" required maxlength="255"></x-events.input-field>

            <x-events.select-field name="type_id" label="Type (Obligatoire)">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $event->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </x-events.select-field>

            <x-events.input-field type="date" name="beginningDate" label="Date de début (Obligatoire)" value="{{ $event->beginningDate }}" required></x-events.input-field>

            <x-events.input-field type="date" name="endDate" label="Date de fin (Obligatoire)" value="{{ $event->endDate }}" required></x-events.input-field>

            <x-events.select-field name="department_id" label="Département (Obligatoire)">
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ $event->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </x-events.select-field>

            <x-events.select-field name="region_id" label="Région (Obligatoire)">
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ $event->region_id == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                @endforeach
            </x-events.select-field>

            <x-events.input-field type="email" name="email" label="Adresse Email" value="{{ $event->email }}"></x-events.input-field>

            <x-events.input-field type="text" name="phone" label="Téléphone" value="{{ $event->phone }}" minlength="10" maxlength="10" placeholder="ex:0612345678"></x-events.input-field>

            <x-events.input-field type="url" name="website" label="Website" value="{{ $event->website }}" placeholder="www.nomDuSite.com"></x-events.input-field>

            <x-events.input-field type="url" name="facebook" label="Facebook" value="{{ $event->facebook }}" placeholder="www.facebook.com"></x-events.input-field>
        </div>
    
        <x-events.input-field name="address" label="Adresse (Obligatoire)" value="{{ $event->address }}" required maxlength="255" placeholder="123 Rue Fictive, Dordogne 24170"></x-events.input-field>

        <x-events.textarea-field name="description" label="Description (Obligatoire)" rows="10" maxlength="2000" :value="$event->description" required />
    
        <div class="flex justify-end">
            <x-events.button-gradient type="submit">Mettre à jour l'événement</x-events.button-gradient>
        </div>
    </form>

    <p>Tout événement modifié devra être validée par l'équipe de Winter Bike, pour être rendu public.</p>

</x-app-layout>
