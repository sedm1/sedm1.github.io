AOS.init();
$('.main__slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    fade: true,
    cssEase: 'linear',
    autoplay: true,
     autoplaySpeed: 4000,
     pauseOnHover: false,
     pauseOnFocus: false,
     speed: 500
    
})
$('.about__slider').slick({
    centerMode: true,
    centerPadding: '300px',
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    autoplay: true,
     autoplaySpeed: 2000,
     pauseOnHover: false,
     pauseOnFocus: false,
     responsive: [
        {
          breakpoint: 1050,
          settings: {
            centerPadding: '100px',
          }
        },
        {
            breakpoint: 550,
            settings: {
              centerPadding: '0px',
              centerMode: false,
            }
          }
      ]
})

//MENU
$('.menu__tabs-item').click((e) => {
    let id = $(e.currentTarget).data('menu')

    $('.menu__tabs-item').removeClass('menu__tabs-item-active')
    $(e.currentTarget).addClass('menu__tabs-item-active')

    $('.menu__block').removeClass('menu__block-active')
    $('#menu__block-'+id).addClass('menu__block-active')
})

//MODAL
$('.modal__button').click(() => {
    $('.modal__bg').css({'display': 'flex'})
    setTimeout(() => {
        $('.modal__bg').addClass('modal__bg-active')
        $('.modal__window').css({'display': 'block'})
        setTimeout(() => {
            $('.modal__window').addClass('modal__window-active')
        }, 150)
    }, 100);
})

$('.modal__window-close').click(() => {
    $('.modal__window').removeClass('modal__window-active')
    
    setTimeout(() => {
        $('.modal__window').css({'display': ''})
        $('.modal__bg').removeClass('modal__bg-active')
        
        setTimeout(() => {
            $('.modal__bg').css({'display': ''})
        }, 150)
    }, 100);
})

//HEADER
$('.header__mobile-burger').click(() => {
    $('.header__menu-block').addClass('header__menu-block-active')
})
$('.header__mobile-close').click(() => {
    $('.header__menu-block').removeClass('header__menu-block-active')
})