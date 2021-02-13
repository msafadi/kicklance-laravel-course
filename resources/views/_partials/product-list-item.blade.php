<div class="col-6 col-lg-2 col-md-3 col-sm-4 product-default inner-quickview inner-icon">
    <figure>
        <a href="product.html">
            <img src="{{ $product->image_url }}">
        </a>
        <div class="btn-icon-group">
            <a class="btn-icon" href="{{ route('cart.store') }}" data-cart="{{ $product->id }}"><i class="icon-bag"></i></a>
        </div>
        <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick View</a>
    </figure>
    <div class="product-details">
        <div class="category-wrap">
            <div class="category-list">
                <a href="category.html" class="product-category">{{ $product->category->name }}</a>
            </div>
            <a href="#" data-toggle="favourites" data-id="{{ $product->id }}" class="btn-icon-wish @if($product->favourite) active @endif"><i class="icon-heart"></i></a>
        </div>
        <h2 class="product-title">
            <a href="product.html">{{ $product->name }}</a>
        </h2>
        <div class="ratings-container">
            <div class="product-ratings">
                <span class="ratings rating-{{ $product->id }}" style="width: {{ round($product->rating/5*100, 2) }}%"></span><!-- End .ratings -->
                <span class="tooltiptext tooltip-top">0</span>
            </div><!-- End .product-ratings -->
        </div><!-- End .product-container -->
        <div class="price-box">
            <span class="old-price">${{ number_format($product->price, 2) }}</span>
            <span class="product-price">${{ number_format($product->sale_price, 2) }}</span>
        </div><!-- End .price-box -->
        <select data-toggle="product-rating" data-id="{{ $product->id }}">
            <option>Rate</option>
            @for($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div><!-- End .product-details -->
</div>