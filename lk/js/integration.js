function DeleteInteGration(){
    openWindow("DeleteIntegration")
    $(".form__submit").click(() => {
        //Сюда прописать функцию удаления пользователя, перед закрытием формы
        CloseModalWindow()
        $(".form__submit").off()
    })
}
function IntegrationWithBitrix(){
    openWindow("IntegrationWithBitrix")
}
function IntegrationWithAmo(){
    openWindow("IntegrationWithAmo")
}
function IntegrationWithPotok(){
    openWindow("IntegrationWithPotok")
}