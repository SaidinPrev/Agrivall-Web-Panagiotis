document.addEventListener('DOMContentLoaded', () => {
    const backToTopButton = document.querySelector('.back-to-top');
    const aboutSection = document.querySelector('#sobre-nosotros');

    if (!backToTopButton || !aboutSection) {
        return;
    }

    const updateBackToTopVisibility = () => {
        const showFrom = aboutSection.offsetTop;
        const isVisible = window.scrollY >= showFrom;

        backToTopButton.classList.toggle('is-visible', isVisible);
    };

    updateBackToTopVisibility();
    window.addEventListener('scroll', updateBackToTopVisibility, { passive: true });
    window.addEventListener('resize', updateBackToTopVisibility);
});
