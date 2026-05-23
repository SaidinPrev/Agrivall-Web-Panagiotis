document.addEventListener("DOMContentLoaded", () => {
    const casillaRevealElement = document.querySelector(".casilla-reveal");
    const casillaSection = document.querySelector("#casilla");

    if (!casillaRevealElement || !casillaSection) {
        return;
    }

    const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

    const updateReveal = () => {
        const viewportHeight = window.innerHeight;
        const casillaRect = casillaSection.getBoundingClientRect();

        const casillaEntryProgress = clamp(
            (viewportHeight - casillaRect.top) / (viewportHeight * 0.9),
            0,
            1,
        );
        const casillaExitProgress = clamp(
            casillaRect.bottom / (viewportHeight * 0.9),
            0,
            1,
        );
        const casillaVisibility = Math.min(
            casillaEntryProgress,
            casillaExitProgress,
        );

        casillaRevealElement.style.opacity = String(casillaVisibility);
        casillaRevealElement.style.transform = `translateY(${56 * (1 - casillaVisibility)}px)`;
    };

    updateReveal();
    window.addEventListener("scroll", updateReveal, { passive: true });
    window.addEventListener("resize", updateReveal);
});
