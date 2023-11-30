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
        $(".IntegrationWithBitrix__name").on( "focusout", function() {
            BorderRedOnKeyIp("IntegrationWithBitrix__name", "Заполните это поле")
        })
        if ($("select.IntegrationWithBitrix__typeEks").val() == null){
            $('.IntegrationWithBitrix__typeEks .jq-selectbox__select').css({"border": "1px solid red"})
            e.preventDefault();
        } else{
            $('.IntegrationWithBitrix__typeEks .jq-selectbox__select').css({"border": "1px solid transparent"})
        }
        BorderRed("IntegrationWithBitrix__name", e, "Заполните это поле")
    })

}
function DeleteAllIntegration(){
    openWindow("DeleteAllIntegration")
}
function IntegrationWithAmo(){
    openWindow("IntegrationWithAmo")
    $(".IntegrationWithAmo__form").submit((e) => {
        $(".IntegrationWithAmo__secretKey").on( "focusout", function() {
            BorderRedOnKeyIp("IntegrationWithAmo__secretKey", "Заполните это поле")
        })
        $(".IntegrationWithAmo__id").on( "focusout", function() {
            BorderRedOnKeyIp("IntegrationWithAmo__id", "Заполните это поле")
        })
        $(".IntegrationWithAmo__code").on( "focusout", function() {
            BorderRedOnKeyIp("IntegrationWithAmo__code", "Заполните это поле")
        })
        $(".IntegrationWithAmo__status").on( "focusout", function() {
            BorderRedOnKeyIp("IntegrationWithAmo__status", "Заполните это поле")
        })
        BorderRed("IntegrationWithAmo__secretKey", e, "Заполните это поле")
        BorderRed("IntegrationWithAmo__id", e, "Заполните это поле")
        BorderRed("IntegrationWithAmo__code", e, "Заполните это поле")
        BorderRed("IntegrationWithAmo__status", e, "Заполните это поле")
        if ($("select.IntegrationWithAmo__voronka").val() == null){
            $('.IntegrationWithAmo__voronka .jq-selectbox__select').css({"border": "1px solid red"})
            e.preventDefault();
        } else{
            $('.IntegrationWithAmo__voronka .jq-selectbox__select').css({"border": "1px solid transparent"})
        }
    })
}
function IntegrationWithPotok(){
    openWindow("IntegrationWithPotok")
    $(".IntegrationWithPotok__form").submit((e) => {
        
        $(".IntegrationWithPotok__token").on( "focusout", function() {
            BorderRedOnKeyIp("IntegrationWithPotok__token", "Заполните это поле")
        })
        BorderRed("IntegrationWithPotok__token", e, "Заполните это поле")
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
