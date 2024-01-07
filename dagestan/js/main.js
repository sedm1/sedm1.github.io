$(() => {
    $(".what__slider").slick({
        centerMode: true,
        centerPadding: '200px',
        slidesToShow: 1,
        dots: true,
        infinite: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                  centerPadding: '50px',
                }
            },
            {
                breakpoint: 700,
                settings: {
                  centerPadding: '30px',
                }
            }
        ]
    })
    $(".marsh__slider").slick({
        slidesToShow: 3,
        dots: true,
        infinite: true,
        prevArrow: "<button class='slick-prev'><img src='../img/arrow-left.png' alt='Arrow'></button>",
        nextArrow: "<button class='slick-next'><img src='../img/arrow-right.png' alt='Arrow'></button>",
        responsive: [
            {
                breakpoint: 1100,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    })
    $(".otz__slider-1").slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,
        dots: false,
        infinite: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 2,
                    centerPadding: '40px',
                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '20px',
                }
            },
        ]
    })
    $(".otz__slider-2").slick({
        centerMode: true,
        centerPadding: '300px',
        slidesToShow: 2,
        dots: false,
        infinite: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 2,
                    centerPadding: '40px',
                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '20px',
                }
            },
        ]
    })
    $(".otz__video").slick({
        centerMode: true,
        centerPadding: '200px',
        slidesToShow: 1,
        dots: false,
        infinite: true,
        arrows: true,
        prevArrow: "<button class='slick-prev'><img src='../img/arrow-left.png' alt='Arrow'></button>",
        nextArrow: "<button class='slick-next'><img src='../img/arrow-right.png' alt='Arrow'></button>",
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    centerPadding: '40px',
                }
            },
            {
                breakpoint: 550,
                settings: {
                    centerPadding: '20px',
                }
            },
        ]
    })
    $(".prem__block").slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: true,
        infinite: true,
        arrows: true,
        prevArrow: "<button class='slick-prev'><img src='../img/arrow-left.png' alt='Arrow'></button>",
        nextArrow: "<button class='slick-next'><img src='../img/arrow-right.png' alt='Arrow'></button>",
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    })
    if ($(window).width() <= '1000'){
        $(".comand__block").slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: true,
            infinite: true,
            arrows: true,
            prevArrow: "<button class='slick-prev'><img src='../img/arrow-left.png' alt='Arrow'></button>",
            nextArrow: "<button class='slick-next'><img src='../img/arrow-right.png' alt='Arrow'></button>",
            responsive: [
                {
                    breakpoint: 750,
                    settings: {
                        slidesToShow: 1,
                    }
                },
            ]
        })
    }
})
$(".item__modal-open").click(() => {
    $(".date__tabs-modal").toggleClass("date__tabs-modal-active")
})
$(".date__tabs-item").click((e) => {
    //Логика переключения табов
    var ActiveItem = e.currentTarget.dataset.tab
    $(".date__info-item").removeClass("date__info-item-active")
    $("#item-" + ActiveItem).addClass("date__info-item-active")

    //Логика смены цвета
    $(".date__tabs-item").removeClass("date__tabs-item-active")
    if ($(".date__tabs-item").parent().hasClass("date__tabs-modal-active")){
        $(".item__modal-open").addClass("item__modal-open-active")
        $(".date__tabs-modal").removeClass("date__tabs-modal-active")
    } else {
        $(".item__modal-open").removeClass("item__modal-open-active")
    }
    $(e.currentTarget).addClass("date__tabs-item-active")
})
$(".item__modal-open").click((e) => {
    $(e.currentTarget).addClass("item__modal-open-active")
})
$(".header__burger").click(() => {
    $(".mobile__menu").toggleClass("mobile__menu-active")
})
$(".pols__item").click((e) => {
    $($(e.currentTarget).children()[1]).slideToggle()
    $(e.currentTarget).find(".pols__button").toggleClass("pols__button-active")
})