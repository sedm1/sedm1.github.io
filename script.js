'use strict';

$(document).ready(function () {
    $('.call').click(function (e) {
        $('.alert__wrapper__call').css({display : `flex`});
    });
    $('.aboutus-alert').click(function (e) {
        $('.alert__wrapper__aboutus').css({display : `flex`});
    });
    $('.works-alert').click(function (e) {
        $('.alert__wrapper__works').css({display : `flex`});
    });
    $('.aboutus__menu').click(function (e) {
        console.log('alert')
        $('.wrapper__menu').css({display : `flex`});
    });
    $('.language__active').click(function (e) {
        $('.language__items').toggleClass('flex');
    });
    $('.btn__close').click(function (e) {
        console.log('close')
        $('.alert').css({display : `none`});
        $('.wrapper__menu').css({display : `none`});
    });
    $('.links').click(function (e) {
        $('.wrapper__menu').css({display : `none`});

    });

    $('.menulogo').click(function (e) {
        $('.wrapper__menu').css({display : `none`});
    });
    if(document.documentElement.scroll>1100){
        $('.wrapper__aside').css({display : `none`});
    }


$(window).scroll(function(){
    if ($(window).scrollTop() > 3000) {
        $('.wrapper__aside').css({display : `none`});
    }
    else {
        $('.wrapper__aside').css({display : `flex`});
    };
});

var isResizeble = false;
function isiPhone(){
    return (
        //Пользователь использует iPhone
        (navigator.platform.indexOf("iPhone") != -1)
    );
}

    if($(window).innerWidth() <= 480){
        $(document).scroll(function () {
            var y = $(this).scrollTop();
            var x = $(".jumbotron__content").position();
            if (y > x.top) {


            } else {
                $('.aboutus__nav').css({"position" : "static", "background" : "none"});
            }
        });
        $('a').click(function (e) {
            if(!isiPhone){
                setTimeout(function(){
                   // $('.aboutus__nav').fadeOut(300).css({display : 'none'});
                    console.log($(document).scrollTop());
                    var x = $(document).scrollTop() -93;
                    if(!isResizeble) {
                        x = $(document).scrollTop() -163;
                        isResizeble = true;
                    }
                  //  $(document).scrollTop(x, 100);
                  //  $(document).animate({scrollTop: x}, 400);
                    $('html, body').animate({scrollTop:x},'400');
                }, 1000);
                $('.wrapper__menu').css({display : `none`});
            }else{
                setTimeout(function(){
                   // $('.aboutus__nav').fadeOut(300).css({display : 'none'});
                    console.log($(document).scrollTop());
                    var x = $(document).scrollTop() -93;
                    if(!isResizeble) {
                      //  x = $(document).scrollTop() -163;
                        isResizeble = true;
                    }
                  //  $(document).scrollTop(x, 100);
                  //  $(document).animate({scrollTop: x}, 400);
                    $('html, body').animate({scrollTop:x},'400');
                }, 1000);
                $('.wrapper__menu').css({display : `none`});
            }
        });
    }

    var is_safari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
    var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));

    if(isSafari){
        $('.container').css({zoom : '1.2'});
        $('.wrapper__aside').css({height : '100vh'});
    }

});


const anchors = document.querySelectorAll('a[href^="#"]')

// Цикл по всем ссылкам
for(let anchor of anchors) {
  anchor.addEventListener("click", function(e) {
    e.preventDefault() // Предотвратить стандартное поведение ссылок
    // Атрибут href у ссылки, если его нет то перейти к body (наверх не плавно)
    const goto = anchor.hasAttribute('href') ? anchor.getAttribute('href') : 'body'
    // Плавная прокрутка до элемента с id = href у ссылки
    document.querySelector(goto).scrollIntoView({
      behavior: "smooth",
      block: "start"
    })
  })
}
