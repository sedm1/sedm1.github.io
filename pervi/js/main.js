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
    arrows: false
})
$('.info__item-button').click((e) => {
    if ($(e.currentTarget).html() == '<span>-</span> Показать меньше'){
        $(e.currentTarget).html('<span>+</span> Показать больше')
    } else {
        $(e.currentTarget).html('<span>-</span> Показать меньше')
    }
    
    $(e.currentTarget).parent('.info__item-header').parent('.info__item').toggleClass('info__item-active')
})