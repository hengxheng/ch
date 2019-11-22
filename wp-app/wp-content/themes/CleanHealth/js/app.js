jQuery(function($){
    $("#mb-menu-btn").on("click", function(e){
        e.preventDefault();
        $("#mobile-menu-block").toggleClass("opened");
        var icon = $(this).find('i');
        if(icon.hasClass('fa-bars')){
            icon.removeClass('fa-bars').addClass('fa-times');
        }
        else{
            icon.removeClass('fa-times').addClass('fa-bars');
        }
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

    if($(".home-course").length>0){
        var p = $(".home-course").offset().top-800;
        var els = document.querySelectorAll('.home-course span.num');

        $(window).scroll(function(e) {
            var scroll = $(window).scrollTop();
            if(scroll > p){ 
                var i;
                for(i = 0; i<els.length; i++){
                    var el = els[i];
                    var n = parseInt(el.innerHTML);
                        od = new Odometer({
                        el: el,
                        value: 1,
                        format: ',ddd',

                    });
                    od.update(n);
                }
            }
        });
    }

    $("#header-search-btn").on("click", function(e){
        e.preventDefault();
        $("#header-search-block").slideToggle();
    })
});