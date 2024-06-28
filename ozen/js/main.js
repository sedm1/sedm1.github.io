$(()=>{
    AOS.init();
})
$('.header__mobile-button, .main__menu-button').click(() => {
    $('.main__menu').toggleClass('main__menu-active')
})
$('.diller__img img').click(() => {
    $('.modal__bg').css({'display': 'flex'})
    setTimeout(() => {
        $('.modal__bg').addClass('modal__bg-active')
        $('.modal__sert').css({'display': 'block'})
        setTimeout(() => {
            $('.modal__sert').addClass('modal__sert-active')
        }, 150)
    }, 200)
})
$('.modal__bg').click(() => {
    if ($('.modal__sert').hasClass('modal__sert-active')){
        $('.modal__sert').removeClass('modal__sert-active')
        setTimeout(() => {
            $('.modal__sert').css({'display': ''})
            $('.modal__bg').removeClass('modal__bg-active')
            
            setTimeout(() => {
                $('.modal__bg').css({'display': ''})
            }, 150)
        }, 200)
    }
})