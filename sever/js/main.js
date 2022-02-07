$(function(){
    $("#slider").slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true,
        responsive: [
            {
              breakpoint: 1170,
              settings: {
                slidesToShow: 1,
              }
            },
          ]
    })
})
$(".question__item").on("click", function(){
    $(this).children(".question__answer").toggleClass("question__answer-active")
    $(this).children(".question__arrow").toggleClass("question__arrow-active")
})

AOS.init({
    duration: 600,
});