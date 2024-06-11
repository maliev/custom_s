/**
 * Slider
 */
import Swiper from 'swiper'
import {Navigation, Keyboard, A11y} from 'swiper/modules'

document.addEventListener("DOMContentLoaded", (event) => {
    const galleries = document.querySelectorAll('.gallery__slider-init');

    galleries.forEach((el) => {
        let gallery = new Swiper(el, {
            speed: 800,
            parallax: true,
            slidesPerView: 1,
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
                nextEl: el.closest('.gallery__row').querySelector('.gallery__nav-button.swiper-button-next'),
                prevEl: el.closest('.gallery__row').querySelector('.gallery__nav-button.swiper-button-prev'),
                disabledClass: 'disabled_swiper_button',
            },
            breakpoints: {
                // when window width is >= 764px
                575.99: {
                    allowTouchMove: false,
                },
            }
        });

        gallery.on("activeIndexChange", (e) => {
            let activeIndex = e.activeIndex
            const currentCount = e.slidesEl.closest('.gallery__row').querySelector('.gallery__count-current');

            currentCount.innerHTML = ++activeIndex;

        });
    });
});
