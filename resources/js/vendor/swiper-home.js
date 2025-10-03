import { delay } from "motion";
import Swiper from "swiper";
import { Autoplay, Pagination } from "swiper/modules";

// let vh = Math.max(
//     document.documentElement.clientHeight || 0,
//     window.innerHeight || 0
// );
// let headerHeight = document.querySelector("header").getBoundingClientRect()[
//     "height"
// ];

const headerBanner = new Swiper("#header-banner", {
    modules: [Pagination, Autoplay],

    // Optional parameters
    loop: true,
    effect: "fade",

    // If we need pagination
    pagination: {
        el: ".swiper-pagination",
        // dynamicBullets: true,
        // dynamicMainBullets: 3,
        enabled: true,
        clickable: true,
    },
    updateOnWindowResize: true,
    // height: vh - headerHeight,
    // autoHeight: true,
    autoplay: { delay: 10000, pauseOnMouseEnter: true },
    on: {
        init: function (swiper) {
            const activeSlide = swiper.slides[swiper.activeIndex];

            const productImage = activeSlide.querySelector("img.product");

            if (productImage) {
                Motion.animate(
                    activeSlide.querySelector("img.product"),
                    { scale: [0.7, 1], opacity: [0, 1] },
                    { duration: 1, delay: 0.4, type: "spring", bounce: 0.7 },
                );

                Motion.animate(
                    activeSlide.querySelectorAll("img.banner-particle"),
                    { scale: [0.7, 1], opacity: [0, 1] },
                    {
                        delay: Motion.stagger(0.05),
                        duration: 2,
                        type: "spring",
                        bounce: 0.7,
                    },
                );
            }
        },
    },
}).on("slideChange", function (swiper) {
    const activeSlide = swiper.slides[swiper.activeIndex];
    const productImage = activeSlide.querySelector("img.product");

    if (swiper.activeIndex !== swiper.previousIndex) {
        if (productImage) {
            Motion.animate(
                activeSlide.querySelector("img.product"),
                { scale: [0.7, 1], opacity: [0, 1] },
                { duration: 1, delay: 0.4, type: "spring", bounce: 0.7 },
            );

            Motion.animate(
                activeSlide.querySelectorAll("img.banner-particle"),
                { scale: [0.7, 1], opacity: [0, 1] },
                {
                    delay: Motion.stagger(0.05),
                    duration: 2,
                    type: "spring",
                    bounce: 0.7,
                },
            );
        }
    }
});
