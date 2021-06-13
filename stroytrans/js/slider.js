$(document).ready(function(){
  $('.project__slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2500,
    arrows: false,
    dots:true,
    responsive: [
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 570,
      settings: {
        slidesToShow: 1
      }
    }
    ]
  });
});
