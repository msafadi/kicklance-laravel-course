@extends('layouts.front')

@section('content')

<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div><!-- End .container -->
</nav>


<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <h2>{{ __('My Orders / Order #:order', ['order' => $order->id]) }}</h2>

            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->item->quantity }}</td>
                        <td>{{ $product->item->price }}</td>
                        <td>{{ $product->item->quantity * $product->item->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <section>
                <h3>Payment</h3>
                <form accept-charset="UTF-8" action="https://api.moyasar.com/v1/payments.html" method="POST">
                    <input type="hidden" name="callback_url" value="{{ url(route('payment.callback', [$order->id])) }}" />
                    <input type="hidden" name="publishable_api_key" value="{{ config('services.moyasar.key') }}" />
                    <input type="hidden" name="amount" value="{{ $order->total }}" />
                    <input type="hidden" name="source[type]" value="creditcard" />
                    <input type="hidden" name="description" value="Order id {{ $order->id }} by {{ Auth::user()->name }}" />

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Card Holder" name="source[name]" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Card Number" name="source[number]" />
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Expiry Month" name="source[month]" />
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="Expiry Year" name="source[year]" />
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" placeholder="CVC" name="source[cvc]" />
                    </div>

                    <button type="submit" class="btn btn-primary">Pay</button>
                </form>

            </section>
        </div><!-- End .col-lg-9 -->

        <aside class="sidebar col-lg-3">
            <div class="widget widget-dashboard">
                <h3 class="widget-title">My Account</h3>

                <ul class="list">
                    <li class="active"><a href="#">Account Dashboard</a></li>
                    <li><a href="#">Account Information</a></li>
                    <li><a href="#">Address Book</a></li>
                    <li><a href="#">My Orders</a></li>
                    <li><a href="#">Billing Agreements</a></li>
                    <li><a href="#">Recurring Profiles</a></li>
                    <li><a href="#">My Product Reviews</a></li>
                    <li><a href="#">My Tags</a></li>
                    <li><a href="#">My Wishlist</a></li>
                    <li><a href="#">My Applications</a></li>
                    <li><a href="#">Newsletter Subscriptions</a></li>
                    <li><a href="#">My Downloadable Products</a></li>
                </ul>
            </div><!-- End .widget -->
        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->

<div class="mb-5"></div><!-- margin -->

@endsection