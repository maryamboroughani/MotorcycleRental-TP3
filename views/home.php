<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/MotorcycleRental-mvc/public/css/style.css">
</head>
<body>
    {{ include('layouts/header.php', { title: 'Home' }) }}
    <main>
        <div class="container">
            <!-- Render dynamic content here -->
            {{ data }}
        </div>
    </main>
    {{ include('layouts/footer.php') }}
</body>
</html>
