let width = $(window).width()
$('.primer__block').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    centerMode: true,
    centerPadding: '60px',
    responsive: [
        {
            breakpoint: 600,
            settings: {
                centerPadding: '30px',
                dots: false
            }  
        }
    ]
})
$('.dem__info-item').click((e) => {
    $('.dem__info-item').removeClass('dem__info-item-active')
    $(e.currentTarget).addClass('dem__info-item-active')
    let Img = $(e.currentTarget).data('dem')
    $('.dem__img').children().attr('src', Img)
})

$('.mus__item').click((e) => {
    $('.mus__item').removeClass('mus__item-active')
    $(e.currentTarget).addClass('mus__item-active')
    let Img = $(e.currentTarget).data('mus')
    $('.mus__block-img').children().attr('src', Img)
})
if (width <= 600){
    $('.services__block').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        centerMode: true,
        centerPadding: '30px',
        arrows: false, 
        responsive: [
            {
                breakpoint: 390,
                settings: {
                  slidesToShow: 1,
                }  
            }
        ]
    })
}
if (width <= 1200){
    $('.dopser__block').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        centerMode: true,
        centerPadding: '30px',
        arrows: false, 
        responsive: [
            {
                breakpoint: 390,
                settings: {
                  slidesToShow: 1,
                }  
            }
        ]
    })
}

$('.header__burger').click(() => {
    $('header').toggleClass('header-active')
    $('.header__burger').addClass('header__burger-hidden')
    $('.header__burger-close').addClass('header__burger-active')
    $('.header__menu-block').toggleClass('header__menu-block-active')
})
$('.header__burger-close').click(() => {
    $('header').toggleClass('header-active')
    $('.header__burger').removeClass('header__burger-hidden')
    $('.header__burger-close').removeClass('header__burger-active')
    $('.header__menu-block').toggleClass('header__menu-block-active')
})

$('.header__button, .main__item-button, .footer__main-button').click(() => {
    $('.modal__bg').css({'display': 'flex'})
    setTimeout(() => {
        $('.modal__bg').css({'opacity': '1'})
        $('.modal__window').css({'display': 'block'})
        setTimeout(() => {
            $('.modal__window').css({'opacity': '1'})
        }, 200)
    }, 150)
})


$('.modal__window-close').click(() => {
    $('.modal__window').css({'opacity': ''})
    setTimeout(() => {
        $('.modal__window').css({'display': ''})
        $('.modal__bg').css({'opacity': ''})
        setTimeout(() => {
            $('.modal__bg').css({'display': ''})
        }, 200)
    }, 150)
})