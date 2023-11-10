function AddNewManager(){
    openWindow("AddNewManagerWindow")
    $(".AddNewManagerWindow__form").submit((event) => {
        var name = $(".AddNewManagerWindow__name").val()
        var phone = $(".AddNewManagerWindow__phone").val()
        var email = $(".AddNewManagerWindow__email").val()
        LenPassword(name, 1, event)
        LenPassword(phone, 11, event)
        LenPassword(email, 1, event)
        BorderRed("AddNewManagerWindow__email", event)
        BorderRed("AddNewManagerWindow__name", event)
    })
}
function EditManager(){
    openWindow("EditNewManagerWindow")
    $(".EditNewManagerWindow__form").submit((event) => {
        var name = $(".EditNewManagerWindow__name").val()
        var phone = $(".EditNewManagerWindow__phone").val()
        var email = $(".EditNewManagerWindow__email").val()
        LenPassword(name, 1, event)
        LenPassword(phone, 11, event)
        LenPassword(email, 1, event)
        BorderRed("EditNewManagerWindow__email", event)
        BorderRed("EditNewManagerWindow__name", event)
    })
    
}
function DeleteManager(){
    openWindow("DeleteManager")
    var name = $(".ManagerName").data("name")
    $(".DeleteManager .modal__title").html('Удаление менеджера ' + name)
    $(".form__submit").click(() => {
        //Сюда прописать функцию удаления пользователя, перед закрытием формы
        CloseModalWindow()
        $(".form__submit").off()
    })
    
}