$('.products__tabs-item').click((e) => {
    $('.products__tabs-item').removeClass('products__tabs-item-active')
    $(e.currentTarget).addClass('products__tabs-item-active')
    let CurrentItem = $(e.currentTarget).data('products')
    $('.products__main').removeClass('products__main-active')
    $('#products__main-'+CurrentItem).addClass('products__main-active')
})