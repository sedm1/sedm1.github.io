function MakeNewMail(){
    openWindow("MakeNewMail")
    $('#MakeNewMail-email').on('keyup',function(){
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
        BorderRed("MakeNewShablon__title", e)
    })
    $(".MakeNewShablon__button").click((e)=> {
        var item = $(e.target).text()
        $('.MakeNewShablon__shablon').val($.trim($('.MakeNewShablon__shablon').val() + " {"+item+"} "));
    })
}
function EditShablon(){
    openWindow("EditShablon")
    $(".EditShablon__form").submit((e)=>{
        BorderRed("EditShablon__title", e)
    })
    $(".EditShablon__button").click((e)=> {
        var item = $(e.target).text()
        $('.EditShablon__shablon').val($.trim($('.EditShablon__shablon').val() + " {"+item+"} "));
    })
}
$(".MakeNewMail__form").submit((e) => {
    var email = $("#MakeNewMail-email").val()
    var pass = $("#MakeNewMail-pass").val()
    LenPassword(email, 1, "error__mesage", e, "Почта")
    LenPassword(pass, 1, "error__mesage", e, "Пароль")
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