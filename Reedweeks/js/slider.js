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
      slidesToShow: 2,
      slidesToScroll: 1,
    });
  }
  $("#hits_slider_2").slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2000,
    speed: 500,
    responsive: [
      {
        breakpoint: 801,
        settings: {
          slidesToShow: 2
        }
      }

    ]
  });
  if ($(window).width() < '1200'){
    $("#card__slider").slick({
      infinite: true,
      slidesToShow: 6,
      slidesToScroll: 1,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 2000,
      speed: 500,
      centerMode: true,
      responsive: [
        {
          breakpoint: 801,
          settings: {
            slidesToShow: 4
          }
        },
        {
          breakpoint: 601,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 451,
          settings: {
            slidesToShow: 2
          }
        }
      ]
    });
  }
  $("#good_pob__img").slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 1200,
    speed: 500

  })
    
})
