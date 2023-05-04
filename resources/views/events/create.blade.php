<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Create Event</h1>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color:red;">{{ $error }}</p>
        @endforeach
    @endif

    <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Nom de l'évènement* :</label>
            <input type="text" id="name" value="{{ old('name') }}" name="name" required>
        </div>

        <div>
            <label for="image_path">Image* :</label>
            <input type="text" id="image_path" value="{{ old('image_path') }}" name="image_path" required>
        </div>

        <div>
            <label for="beginningDate">Date de début* :</label>
            <input type="datetime-local" id="beginningDate" value="{{ old('beginningDate') }}" name="beginningDate" required>
        </div>

        <div>
            <label for="endDate">Date de Fin* :</label>
            <input type="datetime-local" id="endDate" value="{{ old('endDate') }}" name="endDate" required>
        </div>

        <div>
            <label for="address">Adresse* :</label>
            <input type="text" id="address" value="{{ old('address') }}" name="address" required>
        </div>

        <div>
            <label for="email">Adresse Email* :</label>
            <input type="email" id="email" value="{{ old('email') }}" name="email" required>
        </div>

        <div>
            <label for="phone">Téléphone :</label>
            <input type="text" id="phone" value="{{ old('phone') }}" maxlength="10" name="phone">
        </div>

        <div>
            <label for="website">Website :</label>
            <input type="url" id="website" value="{{ old('website') }}" name="website">
        </div>

        <div>
            <label for="facebook">Facebook :</label>
            <input type="url" id="facebook" value="{{ old('facebook') }}" name="facebook">
        </div>

        <div>
            <label for="description">Description* :</label>
            <textarea id="description" name="description" maxlength="5000" required>{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="department_id">Department* :</label>
            <select id="department_id" name="department_id" required>
                <option value="1" @if(old('department_id') == 1) selected @endif>Catégorie 1</option>
                <option value="2" @if(old('department_id') == 2) selected @endif>Catégorie 2</option>
                <option value="3" @if(old('department_id') == 3) selected @endif>Catégorie 3</option>
            </select>
        </div>
    
        <div>
            <label for="region_id">Region* :</label>
            <select id="region_id" name="category_id" required>
                <option value="">Select a region</option>
                <option value="1" @if(old('category_id') == 1) selected @endif>Catégorie 1</option>
                <option value="2" @if(old('category_id') == 2) selected @endif>Catégorie 2</option>
                <option value="3" @if(old('category_id') == 3) selected @endif>Catégorie 3</option>
            </select>
        </div>
    
        <div>
            <label for="type_id">Type* :</label>
            <select id="type_id" name="type_id" required>
                <option value="">Select a type</option>
                <option value="1" @if(old('type_id') == 1) selected @endif>Catégorie 1</option>
                <option value="2" @if(old('type_id') == 2) selected @endif>Catégorie 2</option>
                <option value="3" @if(old('type_id') == 3) selected @endif>Catégorie 3</option>
            </select>
        </div>

        <button type="submit">Create Event</button>
    </form>
</body>
</html>