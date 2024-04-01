import AOS from 'aos';
import 'aos/dist/aos.css'; // You can also use <link> for styles
// ..
AOS.init();

document.addEventListener('aos:in', ({ detail }) => {
    setTimeout(() => {
        detail.classList.add('move-float')
    }, detail.getAttribute('data-aos-duration'));
});

document.addEventListener('aos:out', ({ detail }) => {
    detail.classList.remove('move-float');
});
