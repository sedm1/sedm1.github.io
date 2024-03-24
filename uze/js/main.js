$('.price__block').slick({
    slidesToShow: 3,
    slidesToScroll: 2,
    dots: true,
    arrows: false,
    responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 2,
          }
        },
        {
            breakpoint: 750,
            settings: {
              slidesToShow: 1,
            }
          }
      ]
})
$('#photo__block-1').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    centerMode: true,
    centerPadding: '50px',
    autoplay: true,
    autoplaySpeed: 2500,
    speed: 800,
    responsive: [
        {
          breakpoint: 1000,
          settings: {
            slidesToShow: 2,
          }
        },
        {
            breakpoint: 650,
            settings: {
              slidesToShow: 1,
              centerPadding: "20px"
            }
        },
    ]
})
$('#photo__block-2').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    centerMode: true,
    centerPadding: '250px',
    autoplay: true,
    autoplaySpeed: 2000,
    speed: 800,
    responsive: [
        {
          breakpoint: 1000,
          settings: {
            slidesToShow: 1,
            centerPadding: '200px',
          }
        },
        {
            breakpoint: 650,
            settings: {
              slidesToShow: 1,
              centerPadding: "20px"
            }
        }
    ]
})
$('.rec__block').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    responsive: [
        {
          breakpoint: 1000,
          settings: {
            slidesToShow: 3,
            centerMode: true,
            centerPadding: '20px'
          }
        },
        {
            breakpoint: 750,
            settings: {
              slidesToShow: 2,
              centerMode: true,
            centerPadding: '20px'
            }
          },
          {
            breakpoint: 500,
            settings: {
              slidesToShow: 1,
              centerMode: true,
            centerPadding: '20px'
            }
          },
    ]
})
AOS.init();
$('.header__open').click(() => {
  $('.header__menu').addClass('header__menu-active')
})
$('.header__menu-close').click(() => {
  $('.header__menu').removeClass('header__menu-active')
})
$('.header__menu-item').click(() => {
  if ($('.header__menu').hasClass('header__menu-active')){
    $('.header__menu').removeClass('header__menu-active')
  }
})
$('.header__info-button, .main__button, .price__item-button').click(() => {
  $('.modal__bg').css({'display': 'flex'})
  $('.modal__bg').addClass('modal__bg-active')
  setTimeout(() => {
    $('.modal__window').css({'display': 'flex'})
    $('.modal__window').addClass('modal__window-active')
  }, 200)
})


$('.modal__window-close').click(() => {
  $('.modal__window').removeClass('modal__window-active')
  setTimeout(() => {
    $('.modal__window').css({'display': ''})
    $('.modal__bg').css({'display': ''})
    $('.modal__bg').removeClass('modal__bg-active')
  }, 200)
})