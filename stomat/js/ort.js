
$('.services__header-button').click((e) => {
    let hui = $(e.currentTarget)
    let huiData = hui.data('tabs')
    
    $('.services__header-button').removeClass('services__header-button-active')
    hui.addClass('services__header-button-active')

    $('.services__main-item').removeClass('services__main-item-active')
    $('#services__main-'+huiData).addClass('services__main-item-active')
})

$('.otveti__item-button').click((e) => {
    let button = $(e.currentTarget)
    let content = button.parent('.otveti__item-header').siblings('.otveti__item-main')
    content.toggleClass('otveti__item-main-active')
    button.toggleClass('otveti__item-button-active')
})
