<!-- resources/views/image-view.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image View</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Include your CSS -->
</head>
<body>

    <div class="container">
        <button onclick="window.history.back();" class="btn btn-primary">Back</button>

        <div class="image-container">
            <img src="{{ asset('storage/path/to/your/image.jpg') }}" alt="Image" class="img-fluid">
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script> <!-- Include your JS -->
</body>
</html>