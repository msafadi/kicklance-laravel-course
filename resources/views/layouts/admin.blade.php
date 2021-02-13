<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | @yield('title', 'Default Value')</title>
    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>">
    
</head>

<body>
    <header class="bg-dark text-white">
        <div class="container">
            <div class="d-flex">
                <div>
                    <h1 class="h3 py-2"><?= config('app.name') ?></h1>
                </div>
                <div class="ml-auto pt-3">
                    <a href="{{ route('profile.show') }}">{{ Auth::user()->name }}</a>
                    <a href="#" onclick="document.getElementById('logout').submit()">Logout</a>
                    <form action="{{ route('logout') }}" method="post" class="d-none" id="logout">
                        @csrf
                        <button type="submit"></button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row py-5">
            <div class="col-md-3">
                <nav class="nav nav-pills flex-column">
                    @section('nav')
                    <a href="/admin/categories" class="nav-link active">Categories</a>
                    <a href="" class="nav-link">Products</a>
                    <a href="" class="nav-link">Orders</a>
                    @show
                </nav>
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
        
    </div>
    <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

    // Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;

    var pusher = new Pusher('9bbd1071bbb820b9aef1', {
      cluster: 'ap2',
      authEndpoint: '/broadcasting/auth'
    });

    var channel = pusher.subscribe('private-orders');
    channel.bind('order-created', function(data) {
        alert(`New order created #` + data.order.id);
      //alert(JSON.stringify(data));
    });
  </script>
</body>

</html>