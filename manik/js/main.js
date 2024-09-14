let width = $(window).width()

let WhiteArrow = 'img/arrow-link-white.svg'
let BlackArrow = 'img/arrow-link.svg'

let MenuIcon = 'img/burger.svg'
let CloseIcon = 'img/close.svg'

$(() => {
    $('.about__slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        fade: true,
        cssEase: 'linear'
    })
    $('.works__slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        responsive: [
            {
              breakpoint: 750,
              settings: {
                slidesToShow: 2,
              }
            },
            {
                breakpoint: 450,
                settings: {
                  slidesToShow: 1,
                }
              }
          ]
    })
    $('.reviews__slider').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        responsive: [
          {
            breakpoint: 750,
            settings: {
              slidesToShow: 1,
            }
          }
        ]
    })
    $('.master__slider').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      dots: false,
      arrows: true,
      responsive: [
        {
          breakpoint: 1000,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 650,
          settings: {
            slidesToShow: 1,
          }
        }
      ]
    })
    $('.header__menu-item-child').hover(
      function() {
        $(this).children('.header__menu-submenu').css({"display": 'flex'})
      },
      function(){
        timerId = setTimeout(() => $(this).children('.header__menu-submenu').css({"display": ''}), 1000);
      }
    )
    $('.header__menu-submenu').hover(
      function(){
        clearTimeout(timerId);
        $(this).css({"display": 'flex'})
      }
    )
})

$('.services__tabs-item').click((e) => {
    let item = $(e.currentTarget)

    $('.services__tabs-item').removeClass('services__tabs-item-active')
    item.addClass('services__tabs-item-active')

    let id = item.data('services')

    $('.services__block').removeClass('services__block-active')
    $('#services__block-' + id).addClass('services__block-active')
    // alert(id)
})

$('.link-button').hover(
  function(){
    if ($(this).children('img').attr('src') == WhiteArrow){
      $(this).children('img').attr('src', BlackArrow)
    } else {
      $(this).children('img').attr('src', WhiteArrow)
    }
  },
  function(){
    if ($(this).children('img').attr('src') == WhiteArrow){
      $(this).children('img').attr('src', BlackArrow)
    } else {
      $(this).children('img').attr('src', WhiteArrow)
    }
  }
)
$('.header__burger').click((e) => {
  let item = $(e.currentTarget)
  if (item.children('img').attr('src') == MenuIcon){
    item.children('img').attr('src', CloseIcon)
    $('.header__menu').addClass('header__menu-active')
  } else {
    item.children('img').attr('src', MenuIcon)
    $('.header__menu').removeClass('header__menu-active')
  }
  
})