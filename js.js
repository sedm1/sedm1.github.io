$('.slider').slick({
  infinite: true,
  speed: 700,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 1500,
  arrows: false,
  responsive: [
    {
      breakpoint: 950,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint : 500,
      settings: {
        slidesToShow: 1
      }
    }
  ]
});
