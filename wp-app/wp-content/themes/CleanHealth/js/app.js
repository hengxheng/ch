jQuery(function($){
    $("#mb-menu-btn").on("click", function(e){
        e.preventDefault();
        $("#mobile-menu-block").toggleClass("opened");
    });

    $("#menu-mobile-menu .menu-item-has-children>a").on("click", function(e){
        e.preventDefault();
        $(this).next("ul.sub-menu").slideToggle();
    });
});