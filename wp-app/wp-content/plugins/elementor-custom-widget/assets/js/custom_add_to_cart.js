jQuery(function($){  
    $(".add-to-cart-btn").click(function(e){ 
      e.preventDefault();
      var btn = $(this);
      btn.addClass('loading');
      $.ajax({
          // url:wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'add_to_cart' ),
          url:wc_add_to_cart_params.ajax_url,
          method: 'post',
          data: { 
              'action': 'my_add_to_cart',
              'product_id': $(this).data('product_id'),
              'quantity': $(this).data('quantity')
          }
      }).done( function (response) {
            btn.removeClass('loading');

            if( response.error != 'undefined' && response.error ){
              $(".product-single-error-msg").show();
              $(".product-single-overlay").show();
            }
            else{
              var cartMsg = response.item_no+" ITEMS - $"+response.total_amount;
              $(".product-single-msg").show();
              $(".product-single-overlay").show();
              $("#header-cart-text").text(cartMsg);
              $("#mobile-header-cart").text(cartMsg);
              $("#mh-header-cart").text(response.item_no);
            }
      });
  
    });
  });