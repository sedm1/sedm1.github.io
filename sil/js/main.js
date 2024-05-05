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
})
$('.video__block').slick({
    dots: true,
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
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