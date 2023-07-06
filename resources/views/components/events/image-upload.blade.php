<div class="flex flex-grow  items-center justify-center h-96 border-2 border-dashed rounded-lg cursor-pointer" id="drop_zone">
    <div class="text-center" id="placeholder">
        <i class="fas fa-camera text-xl text-gray-500"></i>
        <p class="mt-1 text-sm text-gray-500">Cliquez pour sélectionner une image</p>
        <input type="file" class="hidden" name="image_path" id="image" accept="image/*">
        @if($errors->has('image_path'))
            @foreach ($errors->get('image_path') as $message)
                <p class="text-red-500">{{ $message }}</p>
            @endforeach
        @endif
    </div>
    <img id="preview" src="#" alt="Aperçu de l'image" class="hidden w-full h-full object-cover rounded-lg" />
</div>

<script>
    const dropZone = document.getElementById('drop_zone');
    const fileInput = document.getElementById('image');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');

    // Sur un clic, déclenchez l'input de fichier
    dropZone.addEventListener('click', (e) => {
        fileInput.click();
    });

    // À la sélection d'un fichier, affichez un aperçu
    fileInput.addEventListener('change', (e) => {
        const reader = new FileReader();
        const file = fileInput.files[0];

        reader.onload = (e) => {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');  // Cacher le placeholder
        }

        reader.readAsDataURL(file);
    });

</script>
