$('.video__slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: true,
    responsive: [
        {
          breakpoint: 800,
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
});
$('.price__item-button').click((e) => {
    let button = $(e.currentTarget)
    let content = button.parent('.price__item-header').siblings('.price__item-content')
    content.toggleClass('price__item-content-active')
    button.toggleClass('price__item-button-active')
})

$('.modal__open').click(() => {
    $('.modal__bg').css({'display': 'flex'})
    setTimeout(() => {
        $('.modal__bg').addClass('modal__bg-active')
        $('.modal__window').css({'display': 'block'})
        setTimeout(() => {
            $('.modal__window').addClass('modal__window-active')
        }, 150)
    }, 150)
})

$('.modal__close').click(() => {
    $('.modal__window').removeClass('modal__window-active')
    setTimeout(() => {
        $('.modal__window').css({'display': ''})
        $('.modal__bg').removeClass('modal__bg-active')
        setTimeout(() => {
            $('.modal__bg').css({'display': ''})
        }, 150)
    }, 150)
})


$('.t__header-button').click((e) => {
    let hui = $(e.currentTarget)
    let huiData = hui.data('tabs')
    
    $('.t__header-button').removeClass('t__header-button-active')
    hui.addClass('t__header-button-active')

    $('.t__main-item').removeClass('t__main-item-active')
    $('#t__main-'+huiData).addClass('t__main-item-active')
})