$(document).ready(function(){
    checksum()
})
$('.bbb').on('input', function() {
    if($(this).val() != '') {
        $(this).next().hide()
    } else {
        $(this).next().show()
    }
    });
function sum (x){
    var s = 0;
    for (i = 0; i < x.length; i++){
        s += Number(x[i])
    }
    return s
}
function checksum(){
    var m = new Array;
    for (var i = 0; i < $(".item__price").length; i++){
        var a = $(".item__price")[i]
        var sumi = $(a).attr("data-sum");
        m.push(sumi)
    }
    $(".itog__price").text(sum(m) + "₽")
    
}
$(".item__delete").click(function(){
    $(this).parents(".card__item").remove();
    checksum()
})
$(".col__right").click(function(){
    var number = Number($(this).prev().text())
    number += 1
    $(this).prev().text(number)
    var parent = $(this).parents(".item__left")
    var price = $(parent).children(".item__price")
    var nachprice = Number(price.attr("data-nachsum"))
    var dataprice = price.attr("data-sum")
    dataprice = number * nachprice
    price.attr("data-sum", dataprice)
    checksum()
})
$(".col__left").click(function(){
    var number = Number($(this).next().text())
    number = number - 1
    console.log(number)
    $(this).next().text(number)
    if (number > 0){
        var parent = $(this).parents(".item__left")
        var price = $(parent).children(".item__price")
        var nachprice = Number(price.attr("data-nachsum"))
        var dataprice = price.attr("data-sum")
        dataprice = number * nachprice
        price.attr("data-sum", dataprice)
        checksum()
    } else{
        var parent = $(this).parents(".card__item").remove();
        checksum()
    }
})