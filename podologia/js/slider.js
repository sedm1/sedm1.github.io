$(function(){
    $(".slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        infinite: true,
        speed: 800, 
        dots: true
    })
    $(".otz__block").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        infinite: true,
        speed: 800,
        arrows: false, 
        dots: true
    })
})