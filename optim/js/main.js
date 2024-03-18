$('.burger').click(() => {
    $('.header__menu').addClass('header__menu-active')
})
$('.menu__close').click(() => {
    $('.header__menu').removeClass('header__menu-active')
})
AOS.init({
    duration: 500,
    offset: 140,
    delay: 100
});