<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h3>Product</h3>
    <p>{{ json_encode($products) }}</p>

    @for ($i = 0; $i < 5; $i++)
        <p>The current value is <strong>{{ $i }}</strong> </p>
    @endfor

    <ul>
        @forelse($products as $product)
        @continue($product['price'] == 0)
        <li @class([
            'bg-new' => $loop->first
        ])>
            <img src="{{ asset('images/products/' .$product['filename']) }}" alt="{{ $product['title'] }}">
            <h4>{{ $product['title'] }} {{ $loop->iteration }}</h4>
            <span>Price: <strong>{{ $product['price'] }}</strong></span>
            <p>{{ $product['description'] }}</p>
            @php 
                $total = $loop->count
            @endphp
        </li> 
        @empty
        <li>Product not found</li>
        @endforelse
    </ul>

    <p>Jumlah: <strong>{{ $total }}</strong></p>
</body>
</html>