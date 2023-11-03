function AddNewCompany(){
    openWindow("AddNewCompany")
    $(".AddNewCompany__form").submit((event) => {
        var inn = $(".AddNewCompany__inn").val()
        var ip = $(".AddNewCompany__ip").val()
        var nameSite = $(".AddNewCompany__nameSite").val()
        LenPassword(inn, 10, "error__mesage", event, "ИНН")
        LenPassword(ip, 1, "error__mesage", event, "ИП")
        LenPassword(nameSite, 1, "error__mesage", event, "Название для сайта")
        BorderRed("AddNewCompany__inn", event)
        BorderRed("AddNewCompany__ip", event)
        BorderRed("AddNewCompany__nameSite", event)
    })
}
function DeleteCompany(){
    openWindow("DeleteCompany")
    $(".form__submit").click(() => {
        CloseModalWindow()
        $(".form__submit").off()
    })
}
function EditNewCompanyWindow(){
    openWindow("EditNewCompanyWindow")
    $(".EditNewCompanyWindow__form").submit((event) => {
        BorderRed("EditNewCompany__inn", event)
        BorderRed("EditNewCompany__ip", event)
        BorderRed("EditNewCompany__nameSite", event)
    })
}