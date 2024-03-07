$('.rent__block').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    centerMode: true,
    dots: true,
    centerPadding: '150px',
    responsive: [
        {
          breakpoint: 800,
          settings: {
            centerPadding: '0px',
            centerMode: false
          }
        }
      ]
})
$('.menu__button').click(() => {
    $('.modal__bg').css({'display': 'block'})
    setTimeout(() => {
        $('.modal__bg').addClass('modal__bg-active')
        $('.header__right').addClass('header__right-active')
        $('.menu__button').css({'display': 'none'})
        $('.menu__button-close').css({'display': 'block'})
    }, 500)
})
$('.menu__button-close').click(() => {
    $('.header__right').removeClass('header__right-active')
    $('.modal__bg').removeClass('modal__bg-active')
    setTimeout(() => {
        $('.modal__bg').css({'display': ''})
        $('.menu__button').css({'display': ''})
        $('.menu__button-close').css({'display': ''})
    }, 500)
})