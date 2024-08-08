import Swiper from "swiper";
import { Autoplay, Pagination } from "swiper/modules";

// let vh = Math.max(
//     document.documentElement.clientHeight || 0,
//     window.innerHeight || 0
// );
// let headerHeight = document.querySelector("header").getBoundingClientRect()[
//     "height"
// ];

const homeSwiper = new Swiper("#home-swiper", {
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
});
