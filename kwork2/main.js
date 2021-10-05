$(document).ready(function(){
    $('.slider__block').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: true, 
        adaptiveHeight: true
    });
    $("#tabs-1").show();
});
//Получаем значение tab, которое должно быть активным
function tabs(val){
    $('div.tabs__item').hide();
    $("#tabs-" + val).show();
}
function menu(){
    $(".menu").toggleClass('block');
    setTimeout(Menublock, 500);
}
var Menublock = function(){
    $(".menu").toggleClass('menuactive');
    $("body").toggleClass('overflow')
};
