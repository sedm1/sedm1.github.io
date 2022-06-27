$(function(){
    $(".photo__item").slice(0, 3).show();
    $(".loadMore").on("click", function(e){
      e.preventDefault();
      $(".photo__item:hidden").slice(0, 3).slideDown();
      if($(".photo__item:hidden").length == 0) {
        $(".loadMore").text("Конец").addClass("noContent");
      }
    });
    



    AOS.init({
        offset: 100,
        duration: 1000,
    });
    $(".burger").click(function(){
      $(".left__block").addClass("left__block-active2")
      setTimeout(() => {
        $(".left__block").addClass("left__block-active")
        $(".slider__text").css({"z-index": "0"})
        $(".slider .slick-arrow").css({"z-index": "0"})
        $("header .menu").addClass("menu-active")
        $(".soz__block").addClass("soz__block-active")
      }, 1000)
      
    })
    $(".menu li").click(function(){
      $(".left__block").removeClass("left__block-active2")
      setTimeout(() => {
        $(".left__block").removeClass("left__block-active")
        $(".slider__text").css({"z-index": ""})
        $(".slider .slick-arrow").css({"z-index": ""})
        $("header .menu").removeClass("menu-active")
        $(".soz__block").removeClass("soz__block-active")
      }, 1000)
    })
})