new Skroll({
    mobile:true
})
    .add(".info__img",{
        delay:10,
        duration:900,
        animation:"zoomIn"
    })
    .add(".info__img_2",{
        delay:10,
        duration:900,
        animation:"zoomIn"
    })
    .add(".info__text",{
        animation:"flipInX",
        delay:150,
        duration:600
    })
    .add(".categori__button",{
        delay:10,
        duration:900,
        animation:"zoomIn"
    })
    .addAnimation("topToBottom",{
        start:function(e){
            e.style["transform"] = "translate(0px, -500px)";
            e.style["opacity"] = 0;
        },
        end:function(e){
            e.style["transform"] = "translate(0px, 0px)";
            e.style["opacity"] = 1;
        }
    })
    .add(".question__item",{
        animation:"topToBottom",
        duration:700,
        delay:100
    })
    .add(".tovar__item",{
        animation:"topToBottom",
        duration:700,
        delay:100
    })
    
    
.init();