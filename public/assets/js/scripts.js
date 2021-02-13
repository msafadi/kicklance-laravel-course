(function($) {

    $('[data-toggle="favourites"]').on('click', function(e) {
        e.preventDefault();
        var that = $(this);
        if ($(this).hasClass('active')) {
            $.ajax({
                url: '/favourites/' + $(this).data('id'),
                method: 'delete',
                data: {
                    _token: _csrfToken
                }
            }).done(function(response) {
                that.removeClass('active')
                //alert(response.message)
            });
            return;
        }

        $.post('/favourites', {
            product_id: $(this).data('id'),
            _token: _csrfToken
        }, function(response) {
            that.addClass('active');
            //alert(response.message)
        })
    })

    $('[data-toggle="product-rating"]').on('change', function(e) {
        var pid = $(this).data('id');
        $.post('/ratings/product', {
            product_id: pid,
            rating: $(this).val(),
            _token: _csrfToken
        }, function(response) {
            //that.addClass('active');
            $('.rating-'+pid).css('width', (Math.round(response.rating/5*100)) + "%")
            alert(response.rating)
        })
    })


    $('[data-cart]').on('click', function(e) {
        e.preventDefault();
        $.post($(this).attr('href'), {
            product_id: $(this).data('cart'),
            _token: _csrfToken
        }, function (items) {
            var total = 0;
            $('.dropdown-cart-products').empty()
            for(i in items) {
                item = items[i]
                total += (item.quantity * item.product.final_price)
                $('.dropdown-cart-products').append(`<div class="product">
                <div class="product-details">
                    <h4 class="product-title">
                        <a href="product.html">${item.product.name}</a>
                    </h4>

                    <span class="cart-product-info">
                        <span class="cart-product-qty">${item.quantity}</span>
                        x $${item.product.final_price}
                    </span>
                </div><!-- End .product-details -->

                <figure class="product-image-container">
                    <a href="product.html" class="product-image">
                        <img src="${item.product.image_url}" alt="product">
                    </a>
                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-retweet"></i></a>
                </figure>
            </div>`)
            }
            $('.cart-count').text(items.length)
            $('.cart-total-price').text( total )
        });

    })

})(jQuery);