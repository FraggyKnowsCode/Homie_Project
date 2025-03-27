// Initialize Swiper
const swiper = new Swiper('.swiper-container', {
    loop: true,
    autoplay: {
       delay: 4000, // 4 seconds
       disableOnInteraction: false,
    },
    navigation: {
       nextEl: '.swiper-button-next',
       prevEl: '.swiper-button-prev',
    },
    slidesPerView: 1, // Show one slide at a time
    spaceBetween: 10, // Space between slides
 });