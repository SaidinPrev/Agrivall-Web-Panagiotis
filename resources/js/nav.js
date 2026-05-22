document.addEventListener('DOMContentLoaded', () => {
    const button = document.querySelector('.navbar-toggler');
    const navOverlay = document.querySelector('.nav-overlay');
    const navbarCollapse = document.querySelector('.navbar-collapse');

    if (!button || !navOverlay || !navbarCollapse) {
        return;
    }

    button.addEventListener('click', () => {
        navOverlay.classList.toggle('active');
    });

    navOverlay.addEventListener('click', (event) => {
        if (event.target === navOverlay) {
            navOverlay.classList.remove('active');
            navbarCollapse.classList.remove('show');
        }
    });
});
