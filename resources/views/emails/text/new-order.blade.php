Hello {{ $name }}

You have a new order (Order # {{ $order->id }})
Check your orders
{{ url(route('admin.products.index')) }}
