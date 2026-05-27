document.addEventListener("DOMContentLoaded", () => {
    const casillaSection = document.querySelector("#casilla");

    if (!casillaSection) {
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                casillaSection.classList.toggle("is-visible", entry.isIntersecting);
            });
        },
        {
            threshold: 0.35,
        },
    );

    observer.observe(casillaSection);
});
