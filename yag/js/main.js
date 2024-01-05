$(".tabs__header-item").click((e) => {
    var item = e.currentTarget.dataset['tab']
    $(".tabs__header-item").removeClass("tabs__header-item-active")
    $(".tabs__header-item").css({"background": ""})
    $(e.currentTarget).addClass("tabs__header-item-active")
    $(".tabs__item").removeClass("tabs__item-active")
    $("#tabs__item-" + item).addClass("tabs__item-active")
})
$(".type__checkbox").on("click", function() {
    $(".tabs__item").removeClass("tabs__item-active")
    $("#tabs__item-black").addClass("tabs__item-active")
    $(".tabs__header-item-active").css({"background": "#04121B"})
});
$(".type__checkbox-checked").on("click", function() {
    $(".tabs__item").removeClass("tabs__item-active")
    $("#tabs__item-1").addClass("tabs__item-active")
    $(".tabs__header-item-active").css({"background": ""})
});


