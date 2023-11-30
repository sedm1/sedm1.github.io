function MakeNewMail(){
    openWindow("MakeNewMail")
    $('.MakeNewMail-email').on('keyup',function(){
        CheckMail($(this).val())
    })
    
}
function EditMail(){
    openWindow("EditMail")
    CheckMail($('#EditMail-email').val())
    $('#EditMail-email').on('keyup',function(){
        CheckMail($('#EditMail-email').val())
    })
    $(".EditMail__form .form__dis").click(()=>{
        CloseModalWindow()
        openWindow("RealDeleteMail")
    })
}
function RedachMail(){
    openWindow("RedachMail")
    CheckMail($('#RedachMail-email').val())
    $('#RedachMail-email').on('keyup',function(){
        CheckMail($('#RedachMail-email').val())
    })
    $(".RedachMail__form .form__dis").click(()=>{
        CloseModalWindow()
        openWindow("RealDeleteMail")
    })
}
function MakeNewShablon(){
    openWindow("MakeNewShablon")
    $(".MakeNewShablon__form").submit((e)=>{
        $(".MakeNewShablon__title").on( "focusout", function() {
            BorderRedOnKeyIp("MakeNewShablon__title", "Введите название шаблона")
        })
        $(".MakeNewShablon__shablon").on( "focusout", function() {
            BorderRedOnKeyIp("MakeNewShablon__shablon", "Пожалуйста, напишите структуру письма")
        })
        BorderRed("MakeNewShablon__title", e, "Введите название шаблона")
        BorderRed("MakeNewShablon__shablon", e, "Пожалуйста, напишите структуру письма")
    })
    $(".MakeNewShablon__button").click((e)=> {
        var item = $(e.target).text()
        $('.MakeNewShablon__shablon').val($.trim($('.MakeNewShablon__shablon').val() + " {"+item+"} "));
    })
}
function EditShablon(){
    openWindow("EditShablon")
    $(".EditShablon__form").submit((e)=>{
        $(".EditShablon__title").on( "focusout", function() {
            BorderRedOnKeyIp("EditShablon__title", "Введите название шаблона")
        })
        $(".EditShablon__shablon").on( "focusout", function() {
            BorderRedOnKeyIp("EditShablon__shablon", "Пожалуйста, напишите структуру письма")
        })
        BorderRed("EditShablon__title", e, "Введите название шаблона")
        BorderRed("EditShablon__shablon", e, "Пожалуйста, напишите структуру письма")
    })
    $(".EditShablon__button").click((e)=> {
        var item = $(e.target).text()
        $('.EditShablon__shablon').val($.trim($('.EditShablon__shablon').val() + " {"+item+"} "));
    })
}
$(".MakeNewMail__form").submit((e) => {
    $(".MakeNewMail-pass").on( "focusout", function() {
        BorderRedOnKeyIp("MakeNewMail-pass", "Пожалуйста, введите пароль")
    })
    $(".MakeNewMail-email").on( "focusout", function() {
        BorderRedOnKeyIp("MakeNewMail-email", "Пожалуйста, введите адрес электронной почты")
    })
    BorderRed("MakeNewMail-email", e, "Пожалуйста, введите адрес электронной почты")
    BorderRed("MakeNewMail-pass", e, "Пожалуйста, введите пароль")
})
function CheckMail(mail){
    if (mail.includes("@gmail")){
        RemoveMailIcon("Gmail")
    } else if (($(this).val()).includes("@mail")){
        RemoveMailIcon("Mail")
    } else if (($(this).val()).includes("@yandex")){
        RemoveMailIcon("Yandex")
    } else if (($(this).val()).includes("@outlook")){
        RemoveMailIcon("Outlook")
    } else {
        RemoveMailIcon("Else")
    }
}
function RemoveMailIcon(mail){
    if (mail == "Gmail"){
        $(".MailChange").attr("src", "img/gmail.png")
    } else if(mail == "Mail"){
        $(".MailChange").attr("src", "img/mail.png")
    } else if(mail == "Yandex"){
        $(".MailChange").attr("src", "img/yandex.png")
    } else if(mail == "Outlook"){
        $(".MailChange").attr("src", "img/onemail.png")
    }  else {
        $(".MailChange").attr("src", "img/mail-static.png")
    }
    
}




