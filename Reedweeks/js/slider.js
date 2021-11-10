$(document).ready(function(){
  if ($(window).width() > '790'){
    $('.left_main').slick({
      vertical: true,
      verticalSwiping: true,
      slidesToShow: 1,
      arrows: false,
      dots: true,
    });
  } else {
    $('.left_main').slick({
      slidesToShow: 1,
      arrows: false,
      dots: true,
    });
  }
    
    if ($(window).width() < '500'){
        $(".pre-slider").slick({
            infinite: true,
            slidesToShow: 1.2,
            slidesToScroll: 1,
            responsive: [
                {
                  breakpoint: 400,
                  settings: {
                    slidesToShow: 1.1,
                    slidesToScroll: 1
                  }
                }
              ]
        });
    }
})
