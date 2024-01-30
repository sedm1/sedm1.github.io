$(() => {
    $('.zak__block').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrow: true,
        dots: false,
        responsive: [
            {
              breakpoint: 1000,
              settings: {
                slidesToShow: 2,
              }
            },
            {
                breakpoint: 620,
                settings: {
                  slidesToShow: 1,
                }
              },
          ]
    })
    $(".met__slider").slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrow: true,
        dots: false,
        centerMode: true,
        centerPadding: '60px',
        responsive: [
            {
              breakpoint: 1000,
              settings: {
                centerMode: false,
                centerPadding: '0px',
                infinite: true
              }
            },
          ]
    })
    $('.main__button, .header__info-button').click(() => {
      $(".modal__bg").addClass('modal__bg-active')
      setTimeout(() => {
        $('.modal__window').addClass('modal__window-active')
      }, 100)
    })
    $('.modal__close').click(() => {
      $('.modal__window').removeClass('modal__window-active')
      setTimeout(() => {
        $(".modal__bg").removeClass('modal__bg-active')
      }, 200)
    })
    $('.header__button').click(() => {
      $('.header__menu').toggleClass('header__menu-active')
    })
})