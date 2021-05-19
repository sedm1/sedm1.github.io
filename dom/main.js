var body = document.getElementById('body');
var menu = document.getElementById('menu');
var modalwindow = document.getElementById('modalwindow')
var content = document.getElementById('content__info')
function openMenu(){
  body.classList.toggle('overflow');
  menu.classList.toggle('block')
}
function modalWindow(){
  body.classList.toggle('overflow');
  modalwindow.classList.toggle('flex');
  content.classList.toggle('block');
}
