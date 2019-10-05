jQuery(function($){
    $("#mb-menu-btn").on("click", function(e){
        e.preventDefault();
        $("#mobile-menu-block").toggleClass("opened");
    });

    $("#menu-mobile-menu .menu-item-has-children>a").on("click", function(e){
        e.preventDefault();
        $(this).next("ul.sub-menu").slideToggle();
    });

    //woocommerce

    $(".psm-close").on("click", function(e){
        e.preventDefault();
        $(".product-single-overlay, .product-single-msg, .product-single-error-msg").hide();
    });

    $(".product-single-overlay").on("click", function(e){
        e.preventDefault();
        $(".product-single-overlay, .product-single-msg, .product-single-error-msg").hide();
    });
});