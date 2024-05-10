$('.products__tabs-item').click((e) => {
    $('.products__tabs-item').removeClass('products__tabs-item-active')
    $(e.currentTarget).addClass('products__tabs-item-active')
    let CurrentItem = $(e.currentTarget).data('products')
    $('.products__main').removeClass('products__main-active')
    $('#products__main-'+CurrentItem).addClass('products__main-active')
})
$('.otz__block-slider').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: true,
    arrows: false,
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
$('.info__item-button').click((e) => {
    if ($(e.currentTarget).html() == '<span>-</span> <p>Показать меньше</p>'){
        $(e.currentTarget).html('<span>+</span> <p>Показать больше</p>')
    } else {
        $(e.currentTarget).html('<span>-</span> <p>Показать меньше</p>')
    }
    
    $(e.currentTarget).parent('.info__item-header').parent('.info__item').toggleClass('info__item-active')
})

$('.main__button, .products__modal-button, .header__recall, .main__info-button').click(() => {
    $('.modal__bg').css({'display': 'flex'})
    setTimeout(() => {
        $('.modal__bg').addClass('modal__bg-active')
        $('.modal__window').css({'display': 'flex'})
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
        }, 200)
    }, 100)
})

$('.header__burger').click(() => {
    $('.header__bottom-block').addClass('header__bottom-block-active')
})
$('.header__bottom-close').click(() => {
    $('.header__bottom-block').removeClass('header__bottom-block-active')
})
$('.header__mobile-button').click(() => {
    $('.header__bottom-block').removeClass('header__bottom-block-active')
    $('.modal__bg').css({'display': 'flex'})
    setTimeout(() => {
        $('.modal__bg').addClass('modal__bg-active')
        $('.modal__window').css({'display': 'flex'})
        setTimeout(() => {
            $('.modal__window').addClass('modal__window-active')
        }, 200)
    }, 100)
})
$('.mask-phone').mask('+7 (000) 000 00-00');