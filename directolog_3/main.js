function openMenu(){
  var menu = document.getElementById('menu2');
  var bg =document.getElementById("black__bg");
  var body = document.getElementById("body");
  body.classList.toggle("overflow");
  bg.classList.toggle('block');
  menu.classList.toggle('block')
}
var wind = document.getElementById("window");
function openWindow(){
  wind.classList.toggle('flex');
}
function closeWindow(){
  wind.classList.toggle('flex');
}
