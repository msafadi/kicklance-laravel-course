<div class="dropdown cart-dropdown">
    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
        <i class="minicart-icon"></i>
        <span class="cart-count" id="cc1">{{ $items->count() }}</span>
    </a>

    <div class="dropdown-menu">
        <div class="dropdownmenu-wrapper">
            <div class="dropdown-cart-header">
                <span><span class="cart-count">{{ $items->count() }}</span> Items</span>

                <a href="cart.html">View Cart</a>
            </div><!-- End .dropdown-cart-header -->
            <div class="dropdown-cart-products">
                @foreach ($items as $item)
                <div class="product">
                    <div class="product-details">
                        <h4 class="product-title">
                            <a href="product.html">{{ $item->product->name }}</a>
                        </h4>

                        <span class="cart-product-info">
                            <span class="cart-product-qty">{{ $item->quantity }}</span>
                            x ${{ $item->product->final_price }}
                        </span>
                    </div><!-- End .product-details -->

                    <figure class="product-image-container">
                        <a href="product.html" class="product-image">
                            <img src="{{ $item->product->image_url }}" alt="product">
                        </a>
                        <a href="#" class="btn-remove" title="Remove Product"><i class="icon-retweet"></i></a>
                    </figure>
                </div><!-- End .product -->
                @endforeach
            </div><!-- End .cart-product -->

            <div class="dropdown-cart-total">
                <span>Total</span>

                <span class="cart-total-price">${{ number_format($total, 2) }}</span>
            </div><!-- End .dropdown-cart-total -->

            <div class="dropdown-cart-action">
                <a href="checkout-shipping.html" class="btn btn-block">Checkout</a>
            </div><!-- End .dropdown-cart-total -->
        </div><!-- End .dropdownmenu-wrapper -->
    </div><!-- End .dropdown-menu -->
</div><!-- End .dropdown -->