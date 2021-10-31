$(document).ready(function(){
    $('.sertificat').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: false,
        responsive: [
            {
              breakpoint: 1160,
              settings: {
                slidesToShow: 2
              }
            },
            {
                breakpoint: 750,
                settings: {
                  slidesToShow: 1
                }
              }
            
          ]
    });
  });