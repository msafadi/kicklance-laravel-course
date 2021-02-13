<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <p>Hello {{ $name }}</p>

    <p>You have a new order (Order # {{ $order->id }})</p>
    <p><a href="{{ url(route('admin.products.index')) }}">Check your orders</a></p>

    <img src="{{ $message->embed(public_path('images/default-image.png')) }}">
</body>
</html>
