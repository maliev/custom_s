/**
 * Slider
 */
import Swiper from 'swiper'
import {Navigation, Keyboard, A11y} from 'swiper/modules'
document.addEventListener("DOMContentLoaded",  (event) => {
    const gallery = new Swiper('.slider__init-wrapper', {
        speed: 1500,
        parallax: true,
        slidesPerView: 1.1,
        allowTouchMove: true,
        a11y: true,
        spaceBetween: 10,
        modules: [Navigation, Keyboard, A11y],
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
});
