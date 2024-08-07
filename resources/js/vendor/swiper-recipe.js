import Swiper from "swiper";

import { Autoplay, Navigation } from "swiper/modules";

const recipeSwiper = new Swiper("#recipe-swiper", {
    modules: [Autoplay, Navigation],

    // Optional parameters
    loop: true,
    navigation: {
        enabled: true,
        nextEl: ".swiper-button-next",
        // prevEl: ".swiper-button-prev",
    },
    // Default parameters
    slidesPerView: 3,
    spaceBetween: 10,
    // Responsive breakpoints
    breakpoints: {
        // when window width is >= 320px
        // 320: {
        //     slidesPerView: 2,
        //     spaceBetween: 20,
        // },
        // when window width is >= 480px
        768: {
            slidesPerView: 5,
            spaceBetween: 30,
        },
        // when window width is >= 640px
        1024: {
            slidesPerView: 7,
        },
    },
    updateOnWindowResize: true,

    autoplay: {
        delay: 5000,
        pauseOnMouseEnter: true,
    },
});
