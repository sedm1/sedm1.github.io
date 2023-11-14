function AddNewManager(){
    openWindow("AddNewManagerWindow")
    $(".AddNewManagerWindow__form").submit((event) => {
        var name = $(".AddNewManagerWindow__name").val()
        var email = $(".AddNewManagerWindow__email").val()
        LenPassword(name, 1, event)
        LenPassword(email, 1, event)
        BorderRed("AddNewManagerWindow__email", event, "Заполните это поле")
        BorderRed("AddNewManagerWindow__name", event, "Заполните это поле")
        $(".RegManager .modal__text-bold").html("Пользователь " + name + " успешно создан!")
        $(".RegManager .modal__text span").html(email)
        openWindow("RegManager")
        event.preventDefault();
        $(".RegManager .form__submit").click(()=>{
            $(".AddNewManagerWindow__form").submit()
        })
        
    })
}
function EditManager(){
    openWindow("EditNewManagerWindow")
    $(".EditNewManagerWindow__form").submit((event) => {
        var name = $(".EditNewManagerWindow__name").val()
        var email = $(".EditNewManagerWindow__email").val()
        LenPassword(name, 1, event)
        LenPassword(email, 1, event)
        BorderRed("EditNewManagerWindow__email", event, "Заполните это поле")
        BorderRed("EditNewManagerWindow__name", event, "Заполните это поле")
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