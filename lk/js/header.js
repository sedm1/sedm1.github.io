function OpenAside(){
    $(".bg").toggleClass("bg-active")
    $("aside").toggleClass("aside-active")
    $(document).click(function(e) {
        if ($(e.target).hasClass("bg-active")){
            OpenAside()
            //Убираем прослушку, чтобы избежать утечки памяти
            $(document).off()
        }
    });
    $(".menu__item").click(()=> {
        $(".bg").removeClass("bg-active")
        $("aside").removeClass("aside-active")
    })
}
function OpenMenu(){
    $(".bg").toggleClass("bg-active")
    $(".header__menu").toggleClass("header__menu-active")
    $(document).click(function(e) {
        if ($(e.target).hasClass("bg-active")){
            OpenMenu()
            //Убираем прослушку, чтобы избежать утечки памяти
            $(document).off()
        }
    });
}