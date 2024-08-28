$('.question__item-button').click((e) => {
    let item = $(e.currentTarget)
    item.toggleClass('question__item-button-active')

    item.parent('.question__item-header').siblings('.question__item-main').toggleClass('question__item-main-active')
})
$('.question__item-button').hover(
    (e) => {
        let item = $(e.currentTarget)
        if (item.hasClass('question__item-button-active')){
            item.children('img').attr('src', 'img/krest-active.svg')
        }
    }, 
    (e) => {
        let item = $(e.currentTarget)
        item.children('img').attr('src', 'img/krest.svg')
    }
)
$('.header__button').click(() => {
    $('.header__menu').toggleClass('header__menu-active')
})
let width = $(window).width()

if (width <= 1100){
    $('.header__menu-block li').click(() => {
        console.log('aaa')
        $('.header__menu').removeClass('header__menu-active')
    })
}