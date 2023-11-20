function AddNewCompany(){
    openWindow("AddNewCompany")
    $(".AddNewCompany__form").submit((event) => {
        var inn = $(".AddNewCompany__inn").val()
        var ip = $(".AddNewCompany__ip").val()
        var nameSite = $(".AddNewCompany__nameSite").val()
        LenPassword(inn, 10, event)
        LenPassword(ip, 1, event,)
        LenPassword(nameSite, 1, event)
        BorderRed("AddNewCompany__inn", event, "Заполните это поле")
        BorderRed("AddNewCompany__ip", event, "Заполните это поле")
        BorderRed("AddNewCompany__nameSite", event, "Заполните это поле")
    })
}
$(".removeCompany").click((e)=>{
    var name = $(e.target).data("namecompany")
    $(".DeleteCompany .modal__title").html('Удаление компании ' +  "&quot" + name +  "&quot;")
    openWindow("DeleteCompany")
    $(".form__submit").click(() => {
        CloseModalWindow()
        $(".form__submit").off()
    })
})
function EditNewCompanyWindow(){
    openWindow("EditNewCompanyWindow")
    $(".EditNewCompanyWindow__form").submit((event) => {
        BorderRed("EditNewCompany__inn", event, "Заполните это поле")
        BorderRed("EditNewCompany__ip", event, "Заполните это поле")
        BorderRed("EditNewCompany__nameSite", event, "Заполните это поле")
    })
}