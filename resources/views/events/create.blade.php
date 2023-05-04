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

    <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Nom de l'évènement* :</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="image_path">Image* :</label>
            <input type="text" id="image_path" name="image_path" required>
        </div>

        <div>
            <label for="beginningDate">Date de début* :</label>
            <input type="datetime-local" id="beginningDate" name="beginningDate" required>
        </div>

        <div>
            <label for="endDate">Date de Fin* :</label>
            <input type="datetime-local" id="endDate" name="endDate" required>
        </div>

        <div>
            <label for="address">Adresse* :</label>
            <input type="text" id="address" name="address" required>
        </div>

        <div>
            <label for="email">Adresse Email* :</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="phone">Téléphone :</label>
            <input type="text" id="phone" name="phone">
        </div>

        <div>
            <label for="website">Website :</label>
            <input type="url" id="website" name="website">
        </div>

        <div>
            <label for="facebook">Facebook :</label>
            <input type="url" id="facebook" name="facebook">
        </div>

        <div>
            <label for="description">Description* :</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <div>
            <label for="department_id">Department* :</label>
            <select id="department_id" name="department_id" required>
                <!-- Replace with the actual options from the departments table -->
                <option value="">Select a department</option>
                <option value="1">Department 1</option>
                <option value="2">Department 2</option>
            </select>
        </div>
    
        <div>
            <label for="region_id">Region* :</label>
            <select id="region_id" name="region_id" required>
                <!-- Replace with the actual options from the regions table -->
                <option value="">Select a region</option>
                <option value="1">Region 1</option>
                <option value="2">Region 2</option>
            </select>
        </div>
    
        <div>
            <label for="type_id">Type* :</label>
            <select id="type_id" name="type_id" required>
                <!-- Replace with the actual options from the types table -->
                <option value="">Select a type</option>
                <option value="1">Type 1</option>
                <option value="2">Type 2</option>
            </select>
        </div>

        <!-- Add other fields like department_id, region_id, type_id, and user_id as needed -->

        <button type="submit">Create Event</button>
    </form>
</body>
</html>