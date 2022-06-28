$(function(){
    $(".payments__slider").slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [
            {
              breakpoint: 1220,
              settings: {
                slidesToShow: 4,
              }
            },
            {
                breakpoint: 750,
                settings: {
                  slidesToShow: 2,
                }
              }
        ]
    })
  AOS.init({
    offset: 100,
    duration: 1000,
  });
})