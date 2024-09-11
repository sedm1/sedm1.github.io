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
    })
    $('.reviews__slider').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
    })
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