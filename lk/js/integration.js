function DeleteInteGration(name){
    openWindow("DeleteIntegration")
    $(".DeleteIntegration .modal__title").html("Отключение интеграции с " + name)
    $(".form__submit").click(() => {
        //Сюда прописать функцию удаления пользователя, перед закрытием формы
        CloseModalWindow()
        $(".form__submit").off()
    })
}
function IntegrationWithBitrix(){
    openWindow("IntegrationWithBitrix")
    $(".IntegrationWithBitrix__form").submit((e) => {
        if ($(".IntegrationWithBitrix__typeEks").val() == null){
            $('.IntegrationWithBitrix__typeEks').css({"border": "1px solid red"})
            e.preventDefault();
        }
        BorderRed("IntegrationWithBitrix__name", e)
    })

}
function DeleteAllIntegration(){
    openWindow("DeleteAllIntegration")
}
function IntegrationWithAmo(){
    openWindow("IntegrationWithAmo")
    $(".IntegrationWithAmo__form").submit((e) => {
        BorderRed("IntegrationWithAmo__secretKey", e)
        BorderRed("IntegrationWithAmo__id", e)
        BorderRed("IntegrationWithAmo__code", e)
        BorderRed("IntegrationWithAmo__vor", e)
        BorderRed("IntegrationWithAmo__status", e)
        if ($(".IntegrationWithAmo__voronka").val() == null){
            $('.IntegrationWithAmo__voronka').css({"border": "1px solid red"})
            e.preventDefault();
        }
    })
}
function IntegrationWithPotok(){
    openWindow("IntegrationWithPotok")
    $(".IntegrationWithPotok__form").submit((e) => {
        BorderRed("IntegrationWithPotok__token", e)
    })
}

$(".integration__item .DeleteIntButton").click((e) => {
    var name = $(e.target).data("removecompanyname")
    DeleteInteGration(name)
})
$(()=>{
    setTimeout(()=>{
        $(".IntegrationWithPotok #form__item-1 .jq-selectbox__select").slice(0, 1).show();
        $(".IntegrationWithPotok #form__item-2 .jq-selectbox__select").slice(0, 1).show();
        $(".AddNewVacancy").on("click", function(e){
          e.preventDefault();
          $(".IntegrationWithPotok #form__item-1 .jq-selectbox__select:hidden").slice(0, 1).slideDown();
          $(".IntegrationWithPotok #form__item-2 .jq-selectbox__select:hidden").slice(0, 1).slideDown();
        });
    }, 100)
})
