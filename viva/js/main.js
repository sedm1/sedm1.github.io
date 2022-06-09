$(function(){
    $("#includedHeader").load("blocks/Header.html"); 
    $("#includedFooter").load("blocks/Footer.html"); 
    $('html, body').animate({ scrollTop: 0 })
    FormClose()
})
function FormClose(){
    $(".redact-2").hide()
    $(".profile__redict").hide()
}
$(".redact-1").click(function(){
    $(".redact-1").hide()
    $(".redact-2").show()
    $(".profile__redict").show()
})