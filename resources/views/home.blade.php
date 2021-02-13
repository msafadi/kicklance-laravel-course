@extends('layouts.front')

@section('content')

<div class="home-top-container">
    <div class="home-slider owl-carousel owl-theme owl-carousel-lazy">
        <div class="home-slide" style="background-image: url({{ asset('assets/images/slider/slide1.jpg') }});">
            <img class="owl-lazy" src="{{ asset('assets/images/lazy.png') }}" alt="slider image">
            <div class="home-slide-content container">
                <div>
                    <h2 class="home-slide-subtitle">start the revolution</h2>
                    <h1 class="home-slide-title">
                        drone pro 4
                    </h1>
                    <h2 class="home-slide-foot">from <span>$499</span></h2>
                    <button class="btn btn-dark btn-buy">BUY NOW</button>
                </div>
            </div><!-- End .home-slide-content -->
        </div><!-- End .home-slide -->

        <div class="home-slide" style="background-image: url('{{ asset('assets/images/slider/slide2.jpg') }}');">
            <img class="owl-lazy" src="{{ asset('assets/images/lazy.png') }}" alt="slider image">
            <div class="home-slide-content container">
                <div>
                    <h2 class="home-slide-subtitle">amazing deals</h2>
                    <h1 class="home-slide-title">
                        smartphone
                    </h1>
                    <h2 class="home-slide-foot">from <span>$199</span></h2>
                    <button class="btn btn-dark btn-buy">BUY NOW</button>
                </div>
            </div><!-- End .home-slide-content -->
        </div><!-- End .home-slide -->

        <div class="home-slide" style="background-image: url('{{ asset('assets/images/slider/slide3.jpg') }}');">
            <img class="owl-lazy" src="{{ asset('assets/images/lazy.png') }}" alt="slider image">
            <div class="home-slide-content container">
                <div>
                    <h2 class="home-slide-subtitle">best price of the year</h2>
                    <h1 class="home-slide-title">
                        top accessories
                    </h1>
                    <h2 class="home-slide-foot">from <span>$19</span></h2>
                    <button class="btn btn-dark btn-buy">BUY NOW</button>
                </div>
            </div><!-- End .home-slide-content -->
        </div><!-- End .home-slide -->
    </div>
    <div class="home-slider-sidebar">
        <ul>
            <li class="active">Drones</li>
            <li>Phones</li>
            <li>Accessories</li>
        </ul>
    </div>
</div><!-- End .home-slider -->

<section class="product-panel mt-5">
    <div class="container">
        <div class="section-title">
            <h2>Featured Products</h2>
        </div>
        <div class="product-intro divide-line mt-2 mb-8">
            @foreach($products as $product)
                @include('_partials.product-list-item')
            @endforeach
        </div>
    </div>
</section>

<section class="categories-container">
    <div class="container categories-carousel owl-carousel owl-theme" data-toggle="owl" data-owl-options="{
                    'loop' : false,
                    'margin': 30,
                    'nav': false,
                    'dots': true,
                    'autoHeight': true,
                    'responsive': {
                      '0': {
                        'items': 2,
                        'margin': 0
                      },
                      '576': {
                        'items': 3
                      },
                      '768': {
                        'items': 4
                      },
                      '992': {
                        'items': 5
                      },
                      '1200': {
                        'items': 6
                      }
                    }
                }">
        <div class="category">
            <i class="icon-category-fashion"></i>
            <span>Fashion</span>
        </div>
        <div class="category">
            <i class="icon-category-electronics"></i>
            <span>Electronics</span>
        </div>
        <div class="category">
            <i class="icon-gift"></i>
            <span>Gift</span>
        </div>
        <div class="category">
            <i class="icon-category-garden"></i>
            <span>Garden</span>
        </div>
        <div class="category">
            <i class="icon-category-music"></i>
            <span>Music</span>
        </div>
        <div class="category">
            <i class="icon-category-motors"></i>
            <span>Motors</span>
        </div>
    </div><!-- End .categories-carousel -->
</section><!-- End .categories-container -->

<section class="home-products-intro mt-3 mb-1">
    <div class="container">
        <div class="row row-sm">
            <div class="col-xl-6">
                <div class="banner-product bg-grey" style="background-image: url('{{ asset('assets/images/products/product-banner1.jpg') }}');background-position : 54%;">
                    <h2>ACTION <br>CAMERAS</h2>
                    <div class="mr-5">
                        <h4>Starting From<span class="price">$399</span></h4>
                        <button class="btn btn-primary">SHOP NOW</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="banner-product bg-grey" style="background-image: url('{{ asset('assets/images/products/product-banner2.jpg') }}');
                                background-position : 48% 10%;">
                    <div class="ml-5" style="text-align: right">
                        <h4>Starting From<span class="price">$199</span></h4>
                        <button class="btn btn-primary">SHOP NOW</button>
                    </div>
                    <h2>FOR ALL <br>STYLES</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-panel">
    <div class="container">
        <div class="section-title">
            <h2>New Arrivals</h2>
        </div>
        <div class="product-intro divide-line mt-2 mb-8">
            @each('_partials.product-list-item', $products, 'product')
        </div>
    </div>
</section>

<section class="home-products-intro bg-grey" id="specialOffer" style="padding: 4.5rem 0 2rem;">
    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <div class="section-title">
                    <h2>Special Offer</h2>
                </div>
                <div class="banner-product mt-3" style="background-image: url('{{ asset('assets/images/products/product-special.jpg') }}');">
                    <div class="banner-content">
                        <h2>Elec Deals</h2>
                        <h4><span class="old-price">$59.00</span><span class="price">$49.00</span></h4>
                        <button class="btn btn-primary">SHOP NOW</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="home-product-tabs">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="best-sellers-tab" data-toggle="tab" href="#best-sellers" role="tab" aria-controls="best-sellers" aria-selected="true">Best Sellers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="audio-speakers-tab" data-toggle="tab" href="#audio-speakers" role="tab" aria-controls="audio-speakers" aria-selected="false">Audio Speakers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="cameras-tab" data-toggle="tab" href="#cameras" role="tab" aria-controls="cameras" aria-selected="false">Cameras</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="lamps-tab" data-toggle="tab" href="#lamps" role="tab" aria-controls="lamps" aria-selected="false">Lamps</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="computer-tab" data-toggle="tab" href="#computer" role="tab" aria-controls="computer" aria-selected="false">Computer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="mobile-phones-tab" data-toggle="tab" href="#mobile-phones" role="tab" aria-controls="mobile-phones" aria-selected="false">Mobile Phones</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="best-sellers" role="tabpanel" aria-labelledby="best-sellers-tab">
                            <div class="row row-sm">
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-1.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-4.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-7.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-10.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .tab-pane -->
                        <div class="tab-pane fade" id="audio-speakers" role="tabpanel" aria-labelledby="laudio-speakers-tab">
                            <div class="row row-sm">
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-2.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-5.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-8.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-11.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .tab-pane -->

                        <div class="tab-pane fade" id="cameras" role="tabpanel" aria-labelledby="cameras-tab">
                            <div class="row row-sm">
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-3.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-6.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-9.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-12.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .tab-pane -->

                        <div class="tab-pane fade" id="lamps" role="tabpanel" aria-labelledby="lamps-tab">
                            <div class="row row-sm">
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-1.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-2.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-3.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-4.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .tab-pane -->

                        <div class="tab-pane fade" id="computer" role="tabpanel" aria-labelledby="computer-tab">
                            <div class="row row-sm">
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-5.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-6.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-7.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-8.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .tab-pane -->

                        <div class="tab-pane fade" id="mobile-phones" role="tabpanel" aria-labelledby="mobile-phones-tab">
                            <div class="row row-sm">
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-9.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-10.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-11.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                                <div class="col-6 col-md-3">
                                    <div class="product-default inner-quickview inner-icon">
                                        <figure>
                                            <a href="product.html">
                                                <img src="{{ asset('assets/images/products/product-12.jpg') }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <div class="category-wrap">
                                                <div class="category-list">
                                                    <a href="category.html" class="product-category">category</a>
                                                </div>
                                                <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                                            </div>
                                            <h2 class="product-title">
                                                <a href="product.html">Product Short Name</a>
                                            </h2>
                                            <div class="price-box">
                                                <span class="product-price">$49.00</span>
                                            </div><!-- End .price-box -->
                                        </div><!-- End .product-details -->
                                    </div>
                                </div><!-- End .col-md-4 -->
                            </div><!-- End .row -->
                        </div><!-- End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .home-product-tabs -->
            </div>
        </div>
    </div>
</section>

<section class="mt-3 mb-3">
    <div class="container">
        <div class="owl-carousel owl-theme text-center" data-toggle="owl" data-owl-options="{
                        'loop' : false,
                        'nav': false,
                        'dots': true,
                        'margin': 20,
                        'autoHeight': true,
                        'autoplay': true,
                        'autoplayTimeout': 5000,
                        'responsive': {
                          '0': {
                            'items': 2
                          },
                          '570': {
                            'items': 2
                          },
                          '830': {
                            'items': 3
                          },
                          '1220': {
                            'items': 4
                          }
                        }
                    }">
            <div class="home-product-list">
                <img src="{{ asset('assets/images/products/small/product-white-1.jpg') }}">
                <div class="product-details">
                    <h4 class="product-title">
                        <a href="product.html">Top Sharp <br>Knives</a>
                    </h4>
                    <button class="btn btn-dark">SHOP NOW</button>
                </div>
            </div>
            <div class="home-product-list">
                <img src="{{ asset('assets/images/products/small/product-white-2.jpg') }}">
                <div class="product-details">
                    <h4 class="product-title">
                        <a href="product.html">HD Vision <br>Web Cameras</a>
                    </h4>
                    <button class="btn btn-dark">SHOP NOW</button>
                </div>
            </div>
            <div class="home-product-list">
                <img src="{{ asset('assets/images/products/small/product-white-3.jpg') }}">
                <div class="product-details">
                    <h4 class="product-title">
                        <a href="product.html">Mobiles <br>And Tablets</a>
                    </h4>
                    <button class="btn btn-dark">SHOP NOW</button>
                </div>
            </div>
            <div class="home-product-list">
                <img src="{{ asset('assets/images/products/small/product-white-4.jpg') }}">
                <div class="product-details">
                    <h4 class="product-title">
                        <a href="product.html">Smart <br> Watches</a>
                    </h4>
                    <button class="btn btn-dark">SHOP NOW</button>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <i class="icon-shipping"></i>

                    <div class="info-box-content">
                        <h4 class="info-title">FREE SHIPPING & RETURNS</h4>
                        <h4 class="info-subtitle">All Orders Over $99</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapibus.</p>
                    </div><!-- End .info-box-content -->
                </div><!-- End .info-box -->
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <i class="icon-money"></i>

                    <div class="info-box-content">
                        <h4 class="info-title">MONEY BACK GUARANTEE</h4>
                        <h4 class="info-subtitle">Safe & Fast</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapibus.</p>
                    </div><!-- End .info-box-content -->
                </div><!-- End .info-box -->
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <i class="icon-support"></i>

                    <div class="info-box-content">
                        <h4 class="info-title">ONLINE SUPPORT</h4>
                        <h4 class="info-subtitle">Need Assistence?</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapibus.</p>
                    </div><!-- End .info-box-content -->
                </div><!-- End .info-box -->
            </div>
        </div>
    </div><!-- End .container -->
</section><!-- End .info-boxes-container -->

<section class="home-products-intro" id="topProducts" style="padding : 7rem 0 1rem;">
    <div class="container">
        <div class="row row-sm">
            <div class="col-sm-6 col-xl-3">
                <div class="section-title mb-4">
                    <h4>Featured Products</h4>
                </div>
                <div class="product-default left-details row row-sm mb-0">
                    <figure class="col-4">
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-1.jpg') }}">
                        </a>
                    </figure>
                    <div class="product-details col-8">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
                <div class="product-default left-details row row-sm mb-0">
                    <figure class="col-4">
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-2.jpg') }}">
                        </a>
                    </figure>
                    <div class="product-details col-8">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
                <div class="product-default left-details row row-sm mb-0">
                    <figure class="col-4">
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-3.jpg') }}">
                        </a>
                    </figure>
                    <div class="product-details col-8">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="section-title mb-4">
                    <h4>Top Selling Products</h4>
                </div>
                <div class="product-default left-details row row-sm mb-0">
                    <figure class="col-4">
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-4.jpg') }}">
                        </a>
                    </figure>
                    <div class="product-details col-8">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
                <div class="product-default left-details row row-sm mb-0">
                    <figure class="col-4">
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-5.jpg') }}">
                        </a>
                    </figure>
                    <div class="product-details col-8">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
                <div class="product-default left-details row row-sm mb-0">
                    <figure class="col-4">
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-6.jpg') }}">
                        </a>
                    </figure>
                    <div class="product-details col-8">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="section-title mb-4">
                    <h4>On Sale Products</h4>
                </div>
                <div class="product-default left-details row row-sm mb-0">
                    <figure class="col-4">
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-7.jpg') }}">
                        </a>
                    </figure>
                    <div class="product-details col-8">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
                <div class="product-default left-details row row-sm mb-0">
                    <figure class="col-4">
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-8.jpg') }}">
                        </a>
                    </figure>
                    <div class="product-details col-8">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
                <div class="product-default left-details row row-sm mb-0">
                    <figure class="col-4">
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-9.jpg') }}">
                        </a>
                    </figure>
                    <div class="product-details col-8">
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="product-default inner-quickview inner-icon center-details count-down">
                    <h2 class="product-name">Flash Deals</h2>
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-deal.jpg') }}">
                        </a>
                        <div class="label-group">
                            <span class="product-label label-primary">SALE</span>
                            <span class="product-label label-dark">- 90%</span>
                        </div>
                    </figure>
                    <div class="product-details">
                        <h2 class="product-title">
                            <a href="product.html">1080p Wifi IP Camera</a>
                        </h2>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <span class="old-price">$59.00</span>
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                    <div class="count-down-panel">
                        <h4>OFFER ENDS IN:
                            <span class="countdown" data-plugin-countdown data-plugin-options="{'date': '2020/06/10 12:00:00', 'numberClass': 'font-weight-extra-bold'}"></span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mt-3 mb-7" id="topBrands">
    <div class="section-title mb-5">
        <h4>Top Brands</h4>
    </div>
    <div class="partners-carousel owl-carousel owl-theme text-center" data-toggle="owl" data-owl-options="{
                    'loop' : true,
                    'nav': false,
                    'dots': true,
                    'autoHeight': true,
                    'autoplay': true,
                    'autoplayTimeout': 5000,
                    'responsive': {
                      '0': {
                        'items': 2,
                        'margin': 0
                      },
                      '480': {
                        'items': 3
                      },
                      '768': {
                        'items': 4
                      },
                      '992': {
                        'items': 5
                      }
                    }
                }">
        <img src="{{ asset('assets/images/logos/1.png') }}" alt="logo">
        <img src="{{ asset('assets/images/logos/2.png') }}" alt="logo">
        <img src="{{ asset('assets/images/logos/3.png') }}" alt="logo">
        <img src="{{ asset('assets/images/logos/4.png') }}" alt="logo">
        <img src="{{ asset('assets/images/logos/5.png') }}" alt="logo">
    </div>
</section>

@endsection