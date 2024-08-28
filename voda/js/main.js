$(function(){
  $('.slider__slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
    responsive: [
      {
        breakpoint: 1000,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 650,
        settings: {
          slidesToShow: 1
        }
      },
    ]
})
  let width = $(window).width()
    $('.sert__slider').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        responsive: [
            {
              breakpoint: 900,
              settings: {
                slidesToShow: 3
              }
            },
            {
                breakpoint: 550,
                settings: {
                  slidesToShow: 2,
                  infinite: false,
                  slidesToShow: 1,
                  centerMode: true,
                  centerPadding: '25px',
                }
            },
        ]
    })
    if (width <= 700){
      $('.e__block').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: false
      })
    }
    $('.header__button').click(() => {
        $('.header__menu').addClass('header__menu-active')
    })
    $('.header__menu-button').click(() => {
        $('.header__menu').removeClass('header__menu-active')
    })
    $('.main__tabs-item').click((e)=> {
      let id = $(e.currentTarget).data('tab')
      $('.main__tabs-item').removeClass('main__tabs-item-active')
      $(e.currentTarget).addClass('main__tabs-item-active')

      $('.main__item-block').removeClass('main__item-block-active')
      $('#main__block-'+id).addClass('main__item-block-active')
    })


    $(".form__button-modal").click(() => {
      $('.modal__bg').css({'display': 'flex'})
      setTimeout(() => {
        $('.modal__bg').addClass('modal__bg-active')
        $('.modal__window').css({'display': 'block'})
        setTimeout(() => {
          $('.modal__window').addClass('modal__window-active')
        }, 150)
      }, 150)
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
})