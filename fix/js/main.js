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
if (width <= 1200){
    $('.header__menu li').click(() => {
        if ($('.header__mobile-button').children().attr("src").includes('menu')){
            $('.header__mobile-button').children().attr("src", 'img/close.png')
        } else {
            $('.header__mobile-button').children().attr("src", 'img/menu.png')
        }
        $('.header__menu-block').removeClass('header__menu-block-active')
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

$('.banner__button, .services__item-button, .cont__button, .footer__button, .cost__res-button').click(() => {
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
$('.cost__main-select').customSelect({
    includeValue: true,
});
$('.cost__tabs-item').click((e) => {
    let costItem = $(e.currentTarget).data('cost')
    $('.cost__tabs-item').removeClass('cost__tabs-active')
    $(e.currentTarget).addClass('cost__tabs-active')
    $('.cost__main-item').removeClass('cost__main-active')
    $('#cost__item-' + costItem).addClass('cost__main-active')
})
$('.cost__res-item').hide()
$('.cost__button').hide()
$('.cost__main-button').click(() => {
    // Код для поиска
    // 1 цифра - номер блока
    // 2 цифра - модель
    // 3 цифра - услуга
    let code = ''
    //Получение активного блока
    let first = $('.cost__tabs-active').data('cost')
    first.toString()
    code += first
    //Получение модели (именно из активного класса)
    let second = $('.cost__main-active .cost__main-1').val()
    second.toString()
    code += second
    //Получение услуги (именно из активного класса)
    let third = $('.cost__main-active .cost__main-2').val()
    third.toString()
    code += third


    $('.cost__main-block').hide(500)
    $('.cost__tabs').hide(500)
    $('.cost__button').show(500)
    $('#' + code).show(500)


    $('.cost__button').click(() => {
        $('.cost__button').hide(500)
        $('#' + code).hide(500)
        
        $('.cost__main-block').show(500)
        $('.cost__tabs').show(500)
        
    })
})
