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
$('.header__menu-item').click(() => {
  if ($('.modal__bg').hasClass('modal__bg-active')){
    $('.header__right').removeClass('header__right-active')
    $('.modal__bg').removeClass('modal__bg-active')
    setTimeout(() => {
        $('.modal__bg').css({'display': ''})
        $('.menu__button').css({'display': ''})
        $('.menu__button-close').css({'display': ''})
    }, 500)
  }
})

$('.main__button, .header__button, .price__item-button, .footer__button').click(() => {
  $('.modal_bg').css({'display': 'flex'})
  $('.modal_bg').addClass('modal_bg-active')
  $('.modal__window').css({'display': 'block'})
  setTimeout(() => {
    $('.modal__window').addClass('modal__window-active')
  }, 200)
})
$('.modal__window-close').click(() => {
  $('.modal__window').removeClass('modal__window-active')
  $('.modal__window').css({'display': ''})
  $('.modal_bg').removeClass('modal_bg-active')
  setTimeout(() => {
    $('.modal_bg').css({'display': ''})
  }, 200)
})
$('.recall__button').click(() => {
  $('.recall__links').toggleClass('recall__links-active')
})