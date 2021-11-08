$(document).ready(function(){
    $(document).ready(function(){
        $('.left_main').slick({
            vertical: true,
            verticalSwiping: true,
            slidesToShow: 1,
            autoplay: true,
            arrows: false,
            dots: true
        });
      });
    if ($(window).width() < '500'){
        $(".pre-slider").slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
        });
    }
})
