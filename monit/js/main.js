$(document).ready(function(){
    clodeModal()
})
function clodeModal(){
    $(".modal__window").hide()
    $(".modal__bg").removeClass("modalActive");
}
function openReg(){
    $(".modal__window").hide()
    $("#reg").show()
    $(".modal__bg").addClass("modalActive");
}
function openLog(){
    $(".modal__window").hide()
    $("#log").show()
    $(".modal__bg").addClass("modalActive");
    
}
function openRek(){
    $(".modal__window").hide()
    $("#rek").show()
    $(".modal__bg").addClass("modalActive");
}