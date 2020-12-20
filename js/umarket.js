$(document).ready(function(){
    'use strict';
 // Кнопка вверх
 let buttonUp = $('#btnUp');
 buttonUp.on('click', function (event) {
    //  event.preventDefault();
     $('html, body').animate({
         scrollTop: $('body').offset().top
     }, 800);
 });

// Боковая панель email
$('#rightEmail').on('click',function(){
    $('#popup-email').slideToggle();
});

// Закрыть форму по клику на крестик
$('.close-modal-email').on('click',function(e){
    e.preventDefault();
    $('#popup-email').slideToggle();
});


});