$(".tabs__header-item").click((e) => {
    var item = e.currentTarget.dataset['tab']
    $(".tabs__header-item").removeClass("tabs__header-item-active")
    $(e.currentTarget).addClass("tabs__header-item-active")
    $(".tabs__item").removeClass("tabs__item-active")
    $("#tabs__item-" + item).addClass("tabs__item-active")
})