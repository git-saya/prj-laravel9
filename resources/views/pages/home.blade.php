<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h3>baledemy</h3>
    <p>Nonton Video Secara Gratis</p>
    <p>{{ json_encode($langs) }}</p>
    <a href="{{ route('profile', ['name' => 'laravel', 'photos' => 'yes']) }}">Profile</a>
    <script src="js/main.js"></script>
</body>
</html>