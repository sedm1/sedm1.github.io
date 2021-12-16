$("#choise").slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
        {
          breakpoint: 1168,
          settings: {
            slidesToShow: 3,
          }
        },
        {
            breakpoint: 750,
            settings: {
              slidesToShow: 2,
            }
          },
        {
            breakpoint: 500,
            settings: {
              slidesToShow: 1,
            }
          },
        
      ]
})
