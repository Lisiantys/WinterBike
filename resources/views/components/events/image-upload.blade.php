<div class="flex items-center justify-center w-full h-96 border-2 border-dashed rounded-lg cursor-pointer" id="drop_zone">
    <div class="text-center" id="placeholder">
        <i class="fas fa-camera text-xl text-gray-500"></i>
        <p class="mt-1 text-sm text-gray-500">Glissez une image ici ou cliquez pour sélectionner une image</p>
        <input type="file" class="hidden" name="image_path" id="image" accept="image/*" required>
        <p id="error" class="hidden text-red-500"></p>
    </div>
    <img id="preview" src="#" alt="Aperçu de l'image" class="hidden w-full h-full object-cover rounded-lg" />
</div>

<script>
    const dropZone = document.getElementById('drop_zone');
    const fileInput = document.getElementById('image');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');
    const error = document.getElementById('error');

    const maxSize = 2048 * 1024; // Taille maximale en octets (2 Mo)
    const allowedFormats = ['image/jpeg', 'image/png', 'image/jpg', 'image/svg+xml', 'image/webp'];
    // Sur un clic, déclenchez l'input de fichier
    dropZone.addEventListener('click', (e) => {
        fileInput.click();
    });

    // Au survol, changez le style de la zone de dépôt
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.style.backgroundColor = '#eee';
    });

    // Quand on sort de la zone, revenez à la normale
    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.style.backgroundColor = 'none';
    });

    // Quand on dépose le fichier
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.style.backgroundColor = 'none';

        const files = e.dataTransfer.files;

        fileInput.files = files;
    });

    // À la sélection d'un fichier, affichez un aperçu
    fileInput.addEventListener('change', (e) => {
        const reader = new FileReader();
        const file = fileInput.files[0];


        // Vérifiez le format du fichier
        if (!allowedFormats.includes(file.type)) {
            error.innerText = "Format de fichier non autorisé. Veuillez choisir une image JPEG, PNG, JPG, SVG ou WEBP.";
            error.classList.remove('hidden');
            return;
        }

        // Vérifiez la taille du fichier
        if (file.size > maxSize) {
            error.innerText = "Le fichier est trop gros. La taille maximale autorisée est de 2 Mo.";
            error.classList.remove('hidden');
            return;
        }

        reader.onload = (e) => {

            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');  // Cacher le placeholder
            error.classList.add('hidden'); // Cacher le message d'erreur
        }

        reader.readAsDataURL(file);
    });

</script>