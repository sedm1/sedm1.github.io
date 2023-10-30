$(() => {
    //Основные табы
    $(".menu__item").click((e) => {
        //Клики на основнмо меню
        var maintab = $(e.target).data("maintab")
        $(".menu__item").removeClass("menu__item-active")
        $(e.target).addClass("menu__item-active")
        $("section").removeClass("section-active")
        $("."+maintab).addClass("section-active")
    })
    //Профиль
    $(".profile__tab-item").click((e) => {
        SubTabs("profile__tab-item", "profiletab", "profile__main", e)
    })
    //Документы
    $(".document__tab-item").click((e) => {
        SubTabs("document__tab-item", "documenttab", "document__main", e)
    })

    $(".pass").submit(function( event ) {
        var PassNew1 = $("#new__pass").val()
        var PassNew2 = $("#new__pass-2").val()
        EqPassword(PassNew1, PassNew2, "pass__treb", event)
        LenPassword(PassNew1, 8, "pass__treb", event)
        SpecSymbol(PassNew1,/[A-Z]/,"pass__treb", event)
        SpecSymbol(PassNew1,/[a-z]/,"pass__treb", event)
        HasNumber(PassNew1, "pass__treb", event)
    });
})

//Функция для табов, чтобы не переполнять код однотипной фигней
//whereClick - По куда был совершен клик
//dataAtr Атрибут, который нужно получить от кнопки
//WhatReplace - что меняем (какие блоки)
//e - куда был совершен клик
function SubTabs(whereClick, dataAtr, WhatReplace, e){
    var Tab = $(e.target).data(""+dataAtr)
    $("."+whereClick).removeClass(`${whereClick}-active`)
    $(e.target).addClass(`${whereClick}-active`)
    $("."+WhatReplace).removeClass(`${WhatReplace}-active`)
    $(`#${WhatReplace}-${Tab}`).addClass(`${WhatReplace}-active`)
}


//Проверка на цифру
//Какой Input проверяем - Pass
//Куда записать ошибку - ErrorMeassage
//Событие формы - event
function HasNumber(Pass, ErrorMeassage, event){
    if (!Pass.match(/[0-9]/)){
        $("."+ErrorMeassage).text("Нету цифры")
        $("."+ErrorMeassage).css({"color": "red"})
        event.preventDefault();
    }
}
//Проврека равенства паролей
function EqPassword(Pass1, Pass2, ErrorMeassage, event){
    if (Pass1 != Pass2){
        $("."+ErrorMeassage).text("Пароли не совпадают")
        $("."+ErrorMeassage).css({"color": "red"})
        event.preventDefault();
    }
}
//Необходимая длина пароля - LenPass
function LenPassword(Pass, LenPass, ErrorMeassage, event, ErrorField){
    if (Pass.length < LenPass) {
        if (ErrorField){
            $("."+ErrorMeassage).text(`Длина поля ${ErrorField} меньше ${LenPass}` )
        } else{
            $("."+ErrorMeassage).text("Длина меньше " + LenPass)
        }
        
        $("."+ErrorMeassage).css({"color": "red"})
        event.preventDefault();
    }
}
//Регулярка, по которой проверяем - regular
function SpecSymbol(Pass, regular, ErrorMeassage, event){
    if (!Pass.match(regular)){
        $("."+ErrorMeassage).text("Нету прописной буквы")
        $("."+ErrorMeassage).css({"color": "red"})
        event.preventDefault();
    }
}

function openWindow(windowClass){
    $(".bg").addClass("bg-active")
    $("."+windowClass).addClass("modal__window-active")
    $(".form__dis").click(() => {
        CloseModalWindow()
    })
}
function CloseModalWindow(){
    $(".bg").removeClass("bg-active")
    $(".modal__window").removeClass("modal__window-active")
}