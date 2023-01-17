<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@isset($title) {{ $title }} @endisset</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h3>Hi, {{ $name }}</h3>
    <nav>
        <a href="/">Home</a> | 
        <a href="about">About</a> |
        <a href="products">Product</a> |
        
        @if($auth)
            <a href="" class="btn">Login</a>
        @else
            <a href="" class="btn">Logout</a>
        @endif
    </nav>
    <p>Daftar dan Belajar Mulai Dari Sini!</p>
    @switch($day)
        @case(7)
            <p>Hari <cite>Sunday</cite></p>
            @break
    
        @case(1)
            <p>Hari <cite>Monday</cite></p>
            @break

        @case(4)
            <p>Hari <cite>Tuesday</cite></p>
            @break
    
        @default
            <p>Invalid params</p>
    @endswitch

    @if($score === 0) 
        <mark>Point {{ $score }}, coba main lagi</mark>
    @elseif($score === 4)
        <mark>Selamat, kamu pemenangnya..</mark>
    @else
        <mark>Point {{ $score }}</mark>
    @endif

    <p>{{ json_encode($langs) }}</p>

    @empty($image)
        <img src="https://via.placeholder.com/350x150" alt="Logo">
    @endempty
</body>
</html>