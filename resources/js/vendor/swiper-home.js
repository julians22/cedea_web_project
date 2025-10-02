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
    autoplay: {
        delay: 10000,
        pauseOnMouseEnter: true,
    },
}).on("slideChange", function (swiper) {
    // const activeSlide = swiper.slides[swiper.activeIndex];
    // console.log(swiper);
    // if (swiper.previousIndex !== swiper.activeIndex) {
    //     Motion.animate(
    //         // activeSlide.querySelector("img"),
    //         // {
    //         //     rotate: [0, 360],
    //         // },
    //         // {
    //         //     duration: 1,
    //         //     type: "spring",
    //         //     bounce: 0.25,
    //         // },
    //     );
    // }
});
