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

@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <h2>{{ __('My Orders') }}</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>{{ __('Total') }}</th>
                        <th>Status</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td><a href="{{ route('orders.show', [$order->id]) }}">{{ $order->id }}</a></td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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