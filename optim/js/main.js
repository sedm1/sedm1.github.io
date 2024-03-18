$('.burger').click(() => {
    $('.header__menu').addClass('header__menu-active')
})
$('.menu__close').click(() => {
    $('.header__menu').removeClass('header__menu-active')
})