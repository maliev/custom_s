/**
 * Slider
 */
import Swiper, {Navigation, Keyboard, A11y} from 'swiper'
Swiper.use([Navigation, Keyboard, A11y]);
document.addEventListener("DOMContentLoaded", function (event) {
    const gallery = new Swiper('.slider__init-wrapper', {
        speed: 1500,
        parallax: true,
        slidesPerView: 1.1,
        allowTouchMove: true,
        a11y: true,
        spaceBetween: 10,
        lazy: {
            loadPrevNext: true,
        },
        keyboard: {
            enabled: true,
            onlyInViewport: false
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
            disabledClass: 'disabled_swiper_button',
        },
        breakpoints: {
            // when window width is >= 764px
            575.99: {
                allowTouchMove: false,
                slidesPerView: 1,
            },
        }
    });

    const tilesSlider = new Swiper('.three-tiles__container', {
        speed: 800,
        slidesPerView: 1,
        allowTouchMove: true,
        spaceBetween: 3,
        loop: false,
        preventClicks: false,
        preventClicksPropagation: false,
        ouchMoveStopPropagation: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
            disabledClass: 'disabled_swiper_button',
        },
        breakpoints: {
            // when window width is >= 764px
            532: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 15,
                allowTouchMove: false,
            },
            1201: {
                slidesPerView: 3,
                spaceBetween: 30,
                allowTouchMove: false,
            },
        }
    });
});
