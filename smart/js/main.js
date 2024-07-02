$(function(){
    $('.main__img-slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true
    })
})
$('.header__info-button').click(() => {
    $('.header__menu-block').addClass('header__menu-block-active')
})