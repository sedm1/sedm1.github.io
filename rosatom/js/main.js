$(() => {

    $('.about__block').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        responsive: [
            {
              breakpoint: 1000,
              settings: {
                slidesToShow: 3
              }
            },
            {
                breakpoint: 700,
                settings: {
                  slidesToShow: 2
                }
              },
              {
                breakpoint: 550,
                settings: {
                  slidesToShow: 1,
                  centerMode: true,
                  centerPadding: '60px',
                }
              },
        ]
    })
})

$(".eqiupment__tab-item").click((e) => {
    let item = $(e.currentTarget)
    $(".eqiupment__tab-item").removeClass('eqiupment__tab-active')
    item.addClass('eqiupment__tab-active')

    $('.eqiupment__main-block').removeClass('eqiupment__main-active')
    $('#eqiupment__main-'+item.data('eq')).addClass('eqiupment__main-active')
})
let HeaderButton = $('.header__burger').children('img')
let width = $(window).width()
$('.header__burger').click(() => {
    $('.header__menu').toggleClass('header__menu-active')
    
    if (HeaderButton.attr('src').includes('burger')){
        HeaderButton.attr('src', 'img/header__close.svg')
    } else {
        HeaderButton.attr('src', 'img/burger.svg')
    }
})

if (width <= 900){
    $('.header__menu li').click(() => {
        $('.header__menu').removeClass('header__menu-active')
        HeaderButton.attr('src', 'img/burger.svg')
    })
}