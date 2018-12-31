(function(){
    'use strict';
    ACMESTORE.homeslider.initCarousel = function(){
        $('.hero-slider').slick({
            slidesToShow: 1,
            autoplay: true,
            arrows: false,
            dots: false,
            fad: true,
            autoplayHoverPause: true,
            slideToScroll: 1
        });
    }
})();