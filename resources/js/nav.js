document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.querySelector('.site-nav__toggle');
    const menuButtonIcon = document.querySelector('.site-nav__toggle i');
    const navOverlay = document.querySelector('.nav-overlay');
    const navPanel = document.querySelector('.site-nav__panel');
    const siteHeader = document.querySelector('header');
    const dropdownItems = Array.from(document.querySelectorAll('.site-nav__item--dropdown'));

    if (!menuButton || !navOverlay || !navPanel) {
        return;
    }

    const closeDropdown = (dropdownItem) => {
        const dropdownButton = dropdownItem.querySelector('.site-nav__dropdown-toggle');

        dropdownItem.classList.remove('is-open');

        if (dropdownButton) {
            dropdownButton.setAttribute('aria-expanded', 'false');
        }
    };

    const closeAllDropdowns = () => {
        dropdownItems.forEach((dropdownItem) => closeDropdown(dropdownItem));
    };

    const closeMenu = () => {
        closeAllDropdowns();
        navOverlay.classList.remove('active');
        navPanel.classList.remove('is-open');
        menuButton.setAttribute('aria-expanded', 'false');
        menuButtonIcon.classList.remove('fa-xmark');
        menuButtonIcon.classList.add('fa-bars');
        menuButtonIcon.classList.remove('open');
    };

    const toggleMenu = () => {
        const isOpen = navPanel.classList.toggle('is-open');
        navOverlay.classList.toggle('active', isOpen);
        menuButton.setAttribute('aria-expanded', String(isOpen));
        if(isOpen){
            menuButtonIcon.classList.remove('fa-bars');
            menuButtonIcon.classList.add('fa-xmark');
            menuButtonIcon.classList.add('open');
        } else {
            menuButtonIcon.classList.remove('fa-xmark');
            menuButtonIcon.classList.add('fa-bars');
            menuButtonIcon.classList.remove('open');
        }
    };

    menuButton.addEventListener('click', toggleMenu);

    navOverlay.addEventListener('click', (event) => {
        if (event.target === navOverlay) {
            closeMenu();
        }
    });

    navPanel.addEventListener('click', (event) => {
        const link = event.target.closest('a');

        if (link && window.innerWidth < 992) {
            closeMenu();
        }
    });

    dropdownItems.forEach((dropdownItem) => {
        const dropdownButton = dropdownItem.querySelector('.site-nav__dropdown-toggle');

        if (!dropdownButton) {
            return;
        }

        dropdownButton.addEventListener('click', (event) => {
            event.stopPropagation();

            const shouldOpen = !dropdownItem.classList.contains('is-open');

            closeAllDropdowns();

            if (shouldOpen) {
                dropdownItem.classList.add('is-open');
                dropdownButton.setAttribute('aria-expanded', 'true');
            }
        });
    });

    document.addEventListener('click', (event) => {
        dropdownItems.forEach((dropdownItem) => {
            if (!dropdownItem.contains(event.target)) {
                closeDropdown(dropdownItem);
            }
        });
    });

    navOverlay.addEventListener('click', closeAllDropdowns);

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 992) {
            closeMenu();
        }
    });

    if (siteHeader) {
        let lastScrollY = window.scrollY;
        let ticking = false;
        const revealThreshold = 140;
        const delta = 8;

        const updateHeaderVisibility = () => {
            const currentScrollY = window.scrollY;
            const menuIsOpen = navPanel.classList.contains('is-open');

            if (menuIsOpen || currentScrollY <= revealThreshold) {
                siteHeader.classList.remove('site-header--hidden');
            } else if (currentScrollY > lastScrollY + delta) {
                siteHeader.classList.add('site-header--hidden');
            } else if (currentScrollY < lastScrollY - delta) {
                siteHeader.classList.remove('site-header--hidden');
            }

            lastScrollY = currentScrollY;
            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(updateHeaderVisibility);
                ticking = true;
            }
        }, { passive: true });
    }
});
