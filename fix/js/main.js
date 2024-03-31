$('.brands__tabs-item').click((e) => {
    $('.brands__tabs-item').removeClass('brands__tabs-active')
    $(e.currentTarget).addClass('brands__tabs-active')
    let DataTab = $(e.currentTarget).data('brand')
    $('.brands__block-item').removeClass('brands__block-active')
    $('#brands__block-' + DataTab).addClass('brands__block-active')
})
$('.port__video-item').click((e) => {
    let video = $(e.currentTarget).children('video')[0]
    let button = $(e.currentTarget).children('button')
    button.hide()
    video.paused ? video.play() : video.pause();
    video.paused ? button.show() : button.hide();
})
let width = $(window).width()
if (width <= 700){
    $('.port__photo-block').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true
    })
    $('.port__video-block').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true
    })
}
$('.header__mobile-button').click(() => {
    if ($('.header__mobile-button').children().attr("src").includes('menu')){
        $('.header__mobile-button').children().attr("src", 'img/close.png')
    } else {
        $('.header__mobile-button').children().attr("src", 'img/menu.png')
    }
    
    $('.header__menu-block').toggleClass('header__menu-block-active')
})

$('.banner__button, .services__item-button, .cont__button, .footer__button').click(() => {
    $('.modal__bg').css({'display': 'flex'})
    setTimeout(() => {
        $('.modal__bg').addClass('modal__bg-active')
        $('.modal__window').css({'display': 'block'})
        setTimeout(() => {
            $('.modal__window').addClass('modal__window-active')
        }, 50)
    }, 50)
})
$('.modal__window-close').click(() => {
    $('.modal__window').removeClass('modal__window-active')
    setTimeout(() => {
        $('.modal__window').css({'display': ''})
        $('.modal__bg').removeClass('modal__bg-active')
        setTimeout(() => {
            $('.modal__bg').css({'display': ''})
        }, 150)
    }, 150)
})
AOS.init({
    offset: 230
});
