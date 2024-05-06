$('.main__slider').slick({
    dots: true,
    speed: 800,
    fade: true,
    cssEase: 'linear',
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 3000,
    pauseOnFocus: false,
    pauseOnHover: false, 
    slickPause: false
})
$('.price__item-header').click((e) => {
    $(e.currentTarget).parent('.price__item').toggleClass('price__item-active')
})
$('.works__block').slick({
    dots: true,
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
        {
          breakpoint: 800,
          settings: {
            centerMode: true,
            slidesToShow: 3,
            centerPadding: '20px',
          }
        },
        {
            breakpoint: 600,
            settings: {
              centerMode: true,
              slidesToShow: 2,
              centerPadding: '20px',
            }
          },
          {
            breakpoint: 400,
            settings: {
              centerMode: true,
              slidesToShow: 1,
              centerPadding: '20px',
            }
          },
      ]
})
$('.video__block').slick({
    dots: true,
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
        {
          breakpoint: 1000,
          settings: {
            slidesToShow: 3,
          }
        },
        {
            breakpoint: 800,
            settings: {
              slidesToShow: 2,
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 1,
            }
          },
      ]
})
$('.header__info-button, .main__item-button, .services__item-button, .about__info-button, .rem__info-button').click(() => {
    $('.modal__bg').css({'display': 'flex'})
    setTimeout(() => {
        $('.modal__bg').addClass('modal__bg-active')
        $('.modal__window').css({'display': 'flex'})
        setTimeout(() => {
            $('.modal__window').addClass('modal__window-active')
        }, 200)
    }, 150)
})
$('.modal__window-close').click(() => {
    $('.modal__window').removeClass('modal__window-active')
    setTimeout(() => {
        $('.modal__window').css({'display': ''})
        $('.modal__bg').removeClass('modal__bg-active')
        
        setTimeout(() => {
            $('.modal__bg').css({'display': ''})
        }, 200)
    }, 150)
})

let width = $(window).width()
if (width <= 700){
    $('.services__block').slick({
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        centerMode: true,
        centerPadding: '60px',
        responsive: [
            {
              breakpoint: 500,
              settings: {
                centerPadding: '30px',
              }
            },
          ]
    })
}
if(width <= 1330){
    $('.header__menu-item').click(() => {
        $('.header__menu-block').removeClass('header__menu-block-active')
    })
}
$('.header__burger').click(() => {
    $('.header__menu-block').toggleClass('header__menu-block-active')
})