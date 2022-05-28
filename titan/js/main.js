$(function() {
    $(".main__slider").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        autoplay: true,
        autoplaySpeed: 2000,
        speed: 800
    })
    $(".brands__slider").slick({
        infinite: true,
        slidesToShow: 10,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1441,
                settings: {
                  slidesToShow: 7,
                  slidesToScroll: 1,
                }
              },
            {
              breakpoint: 1260,
              settings: {
                slidesToShow: 6,
                slidesToScroll: 1,
              }
            },
            {
                breakpoint: 800,
                settings: {
                  slidesToShow: 4,
                  slidesToScroll: 1,
                }
            },
            {
                breakpoint: 500,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1,
                }
            },
            
        ]
    })
    $(".popular__slider").slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        centerMode: true,
        responsive: [
            {
              breakpoint: 1260,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
              }
            },
            {
                breakpoint: 750,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1,
                }
            },
            {
                breakpoint: 600,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,

                }
            }
            
          ]
    })
    $("#no_mobile-input").click(function(){
        OpenSearch()
    })
    $(".clodesearch").click(function(){
        CloseSearch()
    })
    $(".logIn").click(function(){
        openForm()
    })
    var width = $(window).width();
    if(width <= 1000){
        $(".header__input-item").attr("placeholder", "Search...");
    }
    if(width <=750){
        var item = $(".categories__item")
        item.slice(0, 4).css('display', 'flex');
        $("#loadMore").on("click", function(e){
            e.preventDefault();
            $(".categories__item:hidden").slice(0, 4).slideDown().css('display', 'flex');
            if($(".categories__item:hidden").length == 0) {
                $("#loadMore").text("No More").addClass("noContent");
            }
        });
    }
});
function OpenSearch(){
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

