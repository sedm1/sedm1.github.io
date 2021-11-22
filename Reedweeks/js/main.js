$(".button__item").click(function (){
    $(".button__item").removeClass("active")
    $(this).addClass("active");
})
const accordion = document.getElementsByClassName('question__item')
for(var i = 0; i < accordion.length; i++){
    accordion[i].addEventListener('click', function(){
        this.classList.toggle('ans__active')
    })
}
function Blockbody(){
    $("body").toggleClass("overflow")
    $("html").toggleClass("overflow")
    $("header").toggleClass("header-block")
}
function categoriiOpen(){
    changeMenuImg()
    $(".categori__block").toggleClass("open")
    Blockbody()
}
function changeMenuImg(){
    if ($('.imgimg').attr('src') == ("img/menu.svg")){
        $('.imgimg').prop('src', 'img/close.svg')
        $('.imgimg').css({'width': "21px", 'height':'21px'})
    } else{
        $('.imgimg').prop('src', 'img/menu.svg')
        $('.imgimg').css({'width': "", 'height':''})
    }
}
function changeMenuImg404(){
    if ($('.imgimg').attr('src') == ("img/menu_white.svg")){
        $('.imgimg').prop('src', 'img/close.svg')
        $('.imgimg').css({'width': "21px", 'height':'21px'})
    } else{
        $('.imgimg').prop('src', 'img/menu_white.svg')
        $('.imgimg').css({'width': "", 'height':''})
    }
}
function menuOpen2(){
    var locationPage = location.href.match(/[\d\w-]+\.\w+$/)
    //Проверяем страницу на 404, так как в 404 header другого цвета
    if (locationPage[0] == null){
        changeMenuImg()
    } else{
        if (!locationPage[0] == '404.html'){
            changeMenuImg()
            
        } else {
            changeMenuImg404()
        }
    }
    
    
    //Закрывать или открывать окно в зависимости от того, открыто ли меню категорий
    if ($("div.categori__block").hasClass("open")){
        categoriiOpen()
        //$('.imgimg').prop('src', 'img/menu.png')
    } else{
        $(".tovar__buttons").toggleClass("open-2")
        Blockbody()
        
    }
}
$(".search-btn").on("click", function(){
    $(".search-txt").toggleClass("search-txt-active")
})