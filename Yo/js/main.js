$(function(){
    //Инициализация анимации
    AOS.init({
        duration: 600,
    });
    //Слайдеры
    $('.card__slider').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false
              }
            }
        ]
    });
})
//Работа при нажатии бургера
function toggleMenu(){
    //Если класса нет, то добавляем сначала класс, а потом делаем непрозрачным
    if($(".header__menu").hasClass("header__menu-active")){
        $(".header__menu").css({"opacity": 0})
        setTimeout(() => {
            $(".header__menu").removeClass("header__menu-active")
        }, 400)
    } else {
        $(".header__menu").addClass("header__menu-active")
        setTimeout(() => {
            $(".header__menu").css({"opacity": 1})
        }, 100)
    }
}