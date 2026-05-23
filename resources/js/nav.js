document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.querySelector('.site-nav__toggle');
    const navOverlay = document.querySelector('.nav-overlay');
    const navPanel = document.querySelector('.site-nav__panel');
    const dropdownItem = document.querySelector('.site-nav__item--dropdown');
    const dropdownButton = document.querySelector('.site-nav__dropdown-toggle');

    if (!menuButton || !navOverlay || !navPanel) {
        return;
    }

    const closeMenu = () => {
        navOverlay.classList.remove('active');
        navPanel.classList.remove('is-open');
        menuButton.setAttribute('aria-expanded', 'false');
    };

    const toggleMenu = () => {
        const isOpen = navPanel.classList.toggle('is-open');
        navOverlay.classList.toggle('active', isOpen);
        menuButton.setAttribute('aria-expanded', String(isOpen));
    };

    menuButton.addEventListener('click', toggleMenu);

    navOverlay.addEventListener('click', (event) => {
        if (event.target === navOverlay) {
            closeMenu();
        }
    });

    if (dropdownItem && dropdownButton) {
        const closeDropdown = () => {
            dropdownItem.classList.remove('is-open');
            dropdownButton.setAttribute('aria-expanded', 'false');
        };

        dropdownButton.addEventListener('click', () => {
            const isOpen = dropdownItem.classList.toggle('is-open');
            dropdownButton.setAttribute('aria-expanded', String(isOpen));
        });

        document.addEventListener('click', (event) => {
            if (!dropdownItem.contains(event.target)) {
                closeDropdown();
            }
        });

        navOverlay.addEventListener('click', closeDropdown);
    }

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
            closeMenu();
        }
    });
});
