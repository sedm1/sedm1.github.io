new Skroll({
})
    
    .addAnimation("topToBottom",{
        start:function(e){
            e.style["transform"] = "translate(0px, -100px)";
            e.style["opacity"] = 0;
        },
        end:function(e){
            e.style["transform"] = "translate(0px, 0px)";
            e.style["opacity"] = 1;
        }
    })
    .add(".tovar__item",{
        animation:"topToBottom",
        duration:1000,
        delay:100
    })
    .add(".info__img",{
        delay:10,
        duration:900,
        animation:"topToBottom",
    })
    .add(".info__img_2",{
        delay:10,
        duration:900,
        animation:"topToBottom",
    })
    .add(".info__text",{
        animation:"topToBottom",
        delay:150,
        duration:600
    })
    .add(".categori__button",{
        delay:10,
        duration:900,
        animation:"zoomIn"
    })
    
    
.init();