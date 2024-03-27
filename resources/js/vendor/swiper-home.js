import Swiper from 'swiper';
import { Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/pagination';

const swiper = new Swiper('.home-swiper', {

    modules: [Pagination, Autoplay],

    // Optional parameters
    loop: true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
        dynamicMainBullets: 3,
        enabled: true,
        clickable: true
    },

    autoHeight: true,
    autoplay: {
        delay: 5000,
        pauseOnMouseEnter: true
    }
});

