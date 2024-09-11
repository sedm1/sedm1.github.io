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
})

$('.services__tabs-item').click((e) => {
    let item = $(e.currentTarget)

    $('.services__tabs-item').removeClass('services__tabs-item-active')
    item.addClass('services__tabs-item-active')

    let id = item.data('services')
    // alert(id)
})