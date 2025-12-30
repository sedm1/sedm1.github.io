let width = $(window).width()
$('.services__slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    fade: true,
    arrows: false,
    autoplaySpeed: 3000
});
const video = $('.video__item');
const playButton = $('.video__button');

playButton.addEventListener('click', () => {
    if (video.paused) {
        video.play();
    } else {
        video.pause();
    }
});

$('.video__button').addEventListener('mouseenter', () => {
    if (!video.paused) {
        playButton.css({'opacity': 1})
    }
});

document.querySelector('.video__button').addEventListener('mouseleave', () => {
    if (!video.paused) {
        playButton.style.opacity = '0';
    }
});

$('.sertif__slider').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    draggable: true,
    responsive: [{
        breakpoint: 1200,
        settings: {
            slidesToShow: 3,
        }}, {
        breakpoint: 900,
        settings: {
            slidesToShow: 2,
        }}, {
        breakpoint: 650,
        settings: {
            slidesToShow: 1,
        }
    }]
});
