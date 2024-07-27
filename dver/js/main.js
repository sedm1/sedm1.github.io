$(function(){
    $('.main__slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnFocus: false,
        pauseOnHover: false
    });
    $('.about__slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        speed: 500
    });
    $('.project__slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        speed: 500,
        responsive: [
            {
               breakpoint: 1100,
               settings: "unslick"
            }
         ]
    })
    $('.slider__slider').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        speed: 500,
        centerMode: true,
        centerPadding: '80px',
        responsive: [
            {
               breakpoint: 760,
               settings: {
                slidesToShow: 1
              }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1,
                    centerMode: false,
               }
             }
         ]
    })
    $('.header__button').click(() => {
        $('.header__menu').addClass('header__menu-active')
    })
    $('.header__menu-close').click(() => {
        $('.header__menu').removeClass('header__menu-active')
    })
    $('.modal-form').click(() => {
        $('.modal__bg').css({'display': 'flex'})
        setTimeout(() => {
            $('.modal__bg').addClass('modal__bg-active')
            $('.modal__window').css({'display': 'block'})
            setTimeout(() => {
                $('.modal__window').addClass('modal__window-active')
            }, 150)
        }, 150)
    })
    $('.modal__window-close').click(() => {
        $('.modal__window').removeClass('modal__window-active')
        setTimeout(() => {
            $('.modal__window').css({'display': ''})
            $('.modal__bg').removeClass('modal__bg-active')
            setTimeout(() => {
                $('.modal__bg').css({'display': ''})
            }, 150)
        }, 150)
    })
})






$('.slider__item').click((e) => {
    let item = $(e.currentTarget)
    let itemImgSrc = item.children('img').attr('src')
    $('.modal__bg').css({'display': 'flex'})
    setTimeout(() => {
        $('.modal__bg').addClass('modal__bg-active')
        $('.modal__photo').css({'display': 'flex'})
        $('.modal__photo-img').attr('src', itemImgSrc)
        setTimeout(() => {
            $('.modal__photo').addClass('modal__photo-active')
        }, 150)
    }, 150)
})

$('.modal__photo-close').click(() => {
    $('.modal__photo').removeClass('modal__photo-active')
    setTimeout(() => {
        $('.modal__photo').css({'display': ''})
        $('.modal__bg').removeClass('modal__bg-active')
        setTimeout(() => {
            $('.modal__bg').css({'display': ''})
        }, 150)
    }, 150)
})


let header = $('header');
 $(window).scroll(function() {
   if($(window).scrollTop() > 200) {
    header.addClass('header_fixed');
   } else {
    header.removeClass('header_fixed');
   }
 });