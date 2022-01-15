$(document).ready(function(){
    closeAllModal()
})
$("#city__b").click(openCityWindow)
$(".closeCity").click(closeCityWindow)
$(".recall__a__big").click(openRecall)
$(".closeRecall").click(closeRecall)
function closeCityWindow(){
    closeAllModal()
    $(".modalCity").hide()
    $("body").toggleClass("body__active")
}
function openCityWindow(){
    $("#modalBg").show()
    $(".modalCity").show()
    $("body").toggleClass("body__active")
}
function openRecall(){
    $("#modalBg").show()
    $(".recall__modal").show()
    $("body").toggleClass("body__active")
}
function closeRecall(){
    closeAllModal()
    $(".recall__modal").hide()
    $("body").toggleClass("body__active")
}
function closeAllModal(){
    $("#modalBg").hide()
    $(".modalCity").hide()
    $(".recall__modal").hide()
    
}
function OpenBg(){
    $("#modalBg").show()
}

$(".city__item").click(function(){
    $("#city__b").text($(this).text())
    closeCityWindow()
})

$(".search").click(function(){
    $(".form__search").toggleClass("search__input-active")
})
$(".burder").click(function(){
    $(".menu").toggleClass("menu-actve")
})
$(".closeMenu").click(function(){
    $(".menu").toggleClass("menu-actve")
})
$(".menu__recall").click(function(){
    openRecall()
    $(".menu").toggleClass("menu-actve")
})
$(".list").click(function(){
    $(".list__aa").toggleClass("list__aa-active")
})