$(function() {
    $(".main__slider").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
    })
    $(".brands__slider").slick({
        infinite: true,
        slidesToShow: 10,
        slidesToScroll: 1
    })
    $(".header__input-item").click(function(){
        OpenSearch()
    })
    $(".clodesearch").click(function(){
        CloseSearch()
    })
    $(".logIn").click(function(){
        openForm()
    })
});
function OpenSearch(item){
    $(".logo").hide()
    $(".mainheader__links").hide()
    $(".mainheader").addClass("mainheader-active")
    $(".mainheader__input").addClass("header__input-item-active")
    $(".search").addClass("search-active")
    $(".clodesearch").addClass("clodesearch-active")
}
function CloseSearch(){
    $(".logo").show()
    $(".mainheader__links").show()
    $(".mainheader").removeClass("mainheader-active")
    $(".mainheader__input").removeClass("header__input-item-active")
    $(".search").removeClass("search-active")
    $(".clodesearch").removeClass("clodesearch-active")
}
function openForm(){
    $(".login__form").toggleClass("login__form-active")
}