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
        delay:  0,
        wait: -200
    })
    .add(".info__img",{
        delay:0,
        duration:900,
        animation:"topToBottom",
        wait: -200
    })
    .add(".info__img_2",{
        delay:0,
        duration:900,
        animation:"topToBottom",
        wait: -200
    })
    .add(".info__text",{
        animation:"topToBottom",
        delay:0,
        duration:600,
        wait: -200
    })
    .add(".categori__button",{
        delay:0,
        duration:900,
        animation:"zoomIn",
        wait: -200
    })
    
    
.init();