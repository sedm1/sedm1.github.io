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
$(".option__icon").on("click", parseData)
function parseData(){
    var atribut = $(this).attr('data-art')
    $(".option_text__item").removeClass("openText")
    $(".option__item").removeClass("cart-active")
    if (atribut == 1){
        $("#option__text-1").addClass("openText")
        $("#option___title-1").addClass("cart-active")
    } else{
        $("#option___title-"+ atribut).addClass("cart-active")
        $("#option__text-"+ atribut).addClass("openText")
    }
    
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
        $('.imgimg').prop('src', 'img/close-white.svg')
        $('.imgimg').css({'width': "21px", 'height':'21px'})
    } else{
        $('.imgimg').prop('src', 'img/menu_white.svg')
        $('.imgimg').css({'width': "", 'height':''})
    }
}
function menuOpen2(){
    var locationPage = location.href.match(/[\d\w-]+\.\w+$/)
    //Проверяем страницу на 404, так как в 404 header другого цвета
    if (window.location.pathname == '/Reedweeks/'){
        changeMenuImg()
    } else{
        if (locationPage[0] == '404.html'){
            changeMenuImg404()
        } else {
            changeMenuImg()
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
function openModal(){
    $(".modalPhoneBg").toggleClass("block")
    $("body").toggleClass("over")
}
function getImGSrc(any){
    $(".main__poni").attr('src', any);
}
$(".search-btn").on("click", function(){
    $(".search-txt").toggleClass("search-txt-active")
})

$(".phone__open").click(function(){
    $("#modal__title").text("Получить звонок")
    openModal()
})
$(".arrowModal").click(function(){
    openModal()
})

if(/iPhone|iPad|iPod/i.test(navigator.userAgent)){
    $(".goog").hide()
}

$(".like__item").click(function(){
    $(this).toggleClass("likeActive")
    if ($(this).children("img").attr('src') == "img/like.svg"){
        $(this).children("img").attr('src',"img/like_white.svg")
    } else{
        $(this).children("img").attr('src',"img/like.svg")
    }
    
})
$(".addbutton").click(function(){
    var item = $(this).parents(".tovar__item")
    item.css("transform", "scale(1.1)")
    setTimeout(function (){
        item.css("transform", "scale(1)")
    }, 200)
})

function changeToFlex(){
    $("#changeToBlock").children().attr("src", "img/rd_1.svg")
    $("#changeToFlex").children().attr("src", "img/kv_2.svg")
    $("#changeBlock").css("display", "flex")
    var tovar = $(".main__container .tovar__item")
    tovar.css({"width": "", "padding": "", "flex-direction": "", "justify-content": ""})
    //Обращаемся на прямую
    $(".main__container .tovar__img").css({"height": "", "margin": "", "margin-right": ""})
    $(".main__container .tovar_up").css("display", "")
    $(".main__container .tovar__title").css({"fontSize": "", "line-height": "", "max-width": "", "height": ""})
    $(".main__container .tovar__down").css({"flex-direction": "", "align-items": "", "margin-bottom": ""})
    $(".main__container .addbutton").css({"min-width": "", "height":""})
    $(".main__container .mb__icon").css({"margin-bottom": "", "margin-right": ""})
    $(".main__container .tovar__price").css({"margin-right": ""})
    $(".main__container .mab__item").css({"width": "", "height":""})
    $(".main__container .mab__item img").css({"width": "", "height":""})

}

function changeToBlock(){
    $("#changeToFlex").children().attr("src", "img/kv_1.svg")
    $("#changeToBlock").children().attr("src", "img/rd_2.svg")
    $("#changeBlock").css("display", "block")
    var tovar = $(".main__container .tovar__item")
    tovar.css({"width": "100%", "padding": "28px 21px", "flex-direction": "row", "justify-content": "space-between"})
    //Обращаемся на прямую
    $(".main__container .tovar__img").css({"height": "190px", "margin": "0", "margin-right": "20px"})
    $(".main__container .tovar_up").css("display", "flex")
    $(".main__container .tovar__title").css({"fontSize": "25px", "line-height": "29px", "max-width": "439px", "height": "80%"})
    $(".main__container .tovar__down").css({"flex-direction": "row", "align-items": "flex-end", "margin-bottom": "16px"})
    $(".main__container .addbutton").css({"min-width": "250px", "height":"53px"})
    $(".main__container .mb__icon").css({"margin-bottom": "2px", "margin-right": "35px"})
    $(".main__container .tovar__price").css({"margin-right": "15px"})
    $(".main__container .mab__item").css({"width": "30px", "height":"30px"})
    $(".main__container .mab__item img").css({"width": "20px", "height":"20px"})
}
if ($(window).width() < 850){
    $(document).ready(function(){
        $(".card__item").slice(0, 1).show();
        $("#col_tov").text("Ещё " + $(".card__item:hidden").length + " товара, показать?")
        $("#loadMore").on("click", function(e){
            e.preventDefault();
            $(".card__item:hidden").slice(0, 1).slideDown();
            $("#col_tov").text("Ещё " + $(".card__item:hidden").length + " товара, показать?")
            if($(".card__item:hidden").length == 0) {
                $("#col_tov").text("Больше товара нет").addClass("noContent");
            }
        });
    })
}

