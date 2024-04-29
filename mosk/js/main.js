
let width = $(window).width()
if (width <= 900){
  $('.spec__block').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: true,
    responsive: [
      {
        breakpoint: 650,
        settings: {
          slidesToShow: 1,
        }
      },
  ]
  })
}
$('.header__mobile-button').click(() => {
  $('.header__menu-block').addClass('header__menu-block-active')
})
$('.header__mobile-krest').click(() => {
  $('.header__menu-block').removeClass('header__menu-block-active')
})
$('.vid__block-button').click(() => {
  $('.modal__bg').css({'display': 'flex'})
  setTimeout(() => {
    $('.modal__bg').addClass('modal__bg-active')
    $('.modal__window').css({'display': 'block'})
    setTimeout(() => {
      $('.modal__window').addClass('modal__window-active')
    }, 200)
  }, 100)
})
$('.modal__window-close').click(() => {
  $('.modal__window').removeClass('modal__window-active')
  setTimeout(() => {
    $('.modal__window').css({'display': ''})
    $('.modal__bg').removeClass('modal__bg-active')
    setTimeout(() => {
      $('.modal__bg').css({'display': ''})
    }, 100)
  }, 200)
})
if (width <= 800){
  $('.header__menu-item').click(() => {
    $('.header__menu-block ').removeClass('header__menu-block-active')
  })
}


$('.services__item').click((e) => {
  let Item = $(e.currentTarget).data('window')
  console.log(Item)
  $('.modal__bg').css({'display': 'flex'})
  setTimeout(() => {
    $('.modal__bg').addClass('modal__bg-active')
    $('.modal__price').addClass('modal__price-active')
    setTimeout(() => {
      $('#modal__price-'+Item).addClass('modal__price-active')
    }, 200)
  }, 100)
})




$('.modal__main-button').click((e) => {
  $(e.currentTarget).toggleClass('modal__main-button-active')
  $(e.currentTarget).parent().siblings('.modal__main-block').toggleClass('modal__main-block-active')
})

$('.modal__price-button').click(() => {
  
  $('.modal__price, .modal__price-item').removeClass('modal__price-active')
  setTimeout(() => {
    $('.modal__bg').removeClass('modal__bg-active')
    setTimeout(() => {
      $('.modal__bg').css({'display': ''})
    }, 100)
  }, 200)
})


$('.price__item-button').click((e) => {
  $(e.currentTarget).toggleClass('price__item-button-active')
  $(e.currentTarget).parent('.price__item-header').siblings('.price__item-main').toggleClass('price__item-main-active')
})