import './bootstrap';
import Swiper from 'swiper';
import { Autoplay, Navigation, Pagination, EffectFade } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', function () {
    const heroSwiperEl = document.querySelector('.hero-swiper');

    if (heroSwiperEl) {
        new Swiper(heroSwiperEl, {
            modules: [Autoplay, Navigation, Pagination, EffectFade],
            effect: 'fade',
            fadeEffect: { crossFade: true },
            loop: true,
            speed: 800,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    }
});
