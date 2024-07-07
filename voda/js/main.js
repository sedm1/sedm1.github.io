$(function(){
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
                  slidesToShow: 2
                }
            },
            {
                breakpoint: 400,
                settings: {
                  infinite: false,
                  slidesToShow: 1,
                  centerMode: true,
                  centerPadding: '25px',
                }
            },
        ]
    })
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
})