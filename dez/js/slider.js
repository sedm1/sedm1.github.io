$(document).ready(function(){
    $('.history__slider').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: true,
        responsive: [
            {
              breakpoint: 1180,
              settings: {
                arrows: false
              }
            },
            {
                breakpoint: 970,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '60px',
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 420,
                settings: {
                    arrows: false,
                    centerMode: false,
                    centerPadding: '0px',
                    slidesToShow: 1,
                }
            }
        ]
    });
    $('.spec__main').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        responsive: [
            {
              breakpoint: 1180,
              settings: {
                arrows: false
              }
            },
            {
                breakpoint: 970,
                settings: {
                    slidesToShow: 2,
                    arrows: false
                }
            }
            ,
            {
                breakpoint: 670,
                settings: {
                    slidesToShow: 1,
                    arrows: false
                }
            }
        ]
    });
    $('.diplom-slider').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              }
            },
        ]
    })
});