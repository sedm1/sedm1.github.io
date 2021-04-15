var menu = document.getElementById('menu2');
var bg =document.getElementById("black__bg");
var body = document.getElementById("body");
var wind = document.getElementById("window");
function openMenu(){
  body.classList.toggle("overflow");
  bg.classList.toggle('block');
  menu.classList.toggle('block')
}
function openWindow(){
  wind.classList.toggle('flex');
}
function closeWindow(){
  wind.classList.toggle('flex');
}
addEventListener("click", function(e) {
    if (e.target === bg ) {
      menu.classList.toggle('block');
      bg.classList.toggle('block');
    };
  });
