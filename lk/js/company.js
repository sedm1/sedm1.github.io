function AddNewCompany(){
    openWindow("AddNewCompany")
    $(".AddNewCompany__form").submit((event) => {
        var inn = $(".AddNewCompany__inn").val()
        var ip = $(".AddNewCompany__ip").val()
        var nameSite = $(".AddNewCompany__nameSite").val()
        var adress = $(".AddNewCompany__urAdress").val()
        var ogrn = $(".AddNewCompany__ogrn").val()
        LenPassword(inn, 10, "error__mesage", event, "ИНН")
        LenPassword(ip, 1, "error__mesage", event, "ИП")
        LenPassword(nameSite, 1, "error__mesage", event, "Название для сайта")
        LenPassword(adress, 1, "error__mesage", event, "Адресс")
        LenPassword(ogrn, 1, "error__mesage", event, "ОГРН")
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
}