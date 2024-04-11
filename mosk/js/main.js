$('.volos__block').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
          }
        },
        {
            breakpoint: 650,
            settings: {
              slidesToShow: 2,
              dots: false
            }
          },
          {
            breakpoint: 450,
            settings: {
              slidesToShow: 1,
              dots: false,
              arrows: true
            }
          },
    ]
})
$('.cosm__block').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
        }
      },
      {
          breakpoint: 650,
          settings: {
            slidesToShow: 2,
            dots: false
          }
        },
        {
          breakpoint: 450,
          settings: {
            slidesToShow: 1,
            dots: false,
            arrows: true
          }
        },
  ]
})
let width = $(window).width()
if (width <= 900){
  $('.spec__block').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: true,
    responsive: [
      {
        breakpoint: 650,
        settings: {
          slidesToShow: 1,
        }
      },
  ]
  })
}
$('.header__mobile-button').click(() => {
  $('.header__menu-block').addClass('header__menu-block-active')
})
$('.header__mobile-krest').click(() => {
  $('.header__menu-block').removeClass('header__menu-block-active')
})
$('.vid__block-button').click(() => {
  $('.modal__bg').css({'display': 'flex'})
  setTimeout(() => {
    $('.modal__bg').addClass('modal__bg-active')
    setTimeout(() => {
      $('.modal__window').addClass('modal__window-active')
    }, 200)
  }, 100)
})
$('.modal__window-close').click(() => {
  $('.modal__window').removeClass('modal__window-active')
  setTimeout(() => {
    $('.modal__bg').removeClass('modal__bg-active')
    setTimeout(() => {
      $('.modal__bg').css({'display': ''})
    }, 100)
  }, 200)
})
if (width <= 800){
  $('.header__menu-item').click(() => {
    $('.header__menu-block ').removeClass('header__menu-block-active')
  })
}