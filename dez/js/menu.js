$(".header__button").click(() => {
    $(".header").toggleClass("header-active")
    var headerButton = $(".header__button").children()[0]
    if (headerButton.src.indexOf("close.svg") > 0) {
        headerButton.src = "img/svg/menu.svg"
    } else {
        headerButton.src = "img/svg/close.svg"
    }
    if (!$(".menu").hasClass("menu-active")){
        
        $(".menu").css({"display": "flex"})
    } else {
        setTimeout(function(){
            $(".menu").css({"display": "none"})
        }, 300);
    }
    setTimeout(function(){
        $(".menu").toggleClass("menu-active")
    }, 50);
    
})