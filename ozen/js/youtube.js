'use strict';

var videos = document.getElementsByClassName("youtube");
var nb_videos = videos.length;
for (var i=0; i < nb_videos; i++) {
    // Размещаем над постером кнопку Play, чтобы создать эффект плеера
    var play = document.createElement("div");
    play.setAttribute("class","play");
    videos[i].appendChild(play);
    var iframe = document.createElement("iframe");
    var iframe_url = "https://www.youtube.com/embed/" + videos[i].id + "?autoplay=1&autohide=1";
    if (videos[i].getAttribute("data-params")) iframe_url+='&'+videos[i].getAttribute("data-params");
    iframe.setAttribute("src",iframe_url);
    iframe.setAttribute("frameborder",'0');
    // Высота и ширина iFrame будет как у элемента-родителя
    iframe.style.width  = videos[i].style.width;
    iframe.style.height = videos[i].style.height;
    // Заменяем начальное изображение (постер) на iFrame
    videos[i].parentNode.replaceChild(iframe, videos[i]);
}