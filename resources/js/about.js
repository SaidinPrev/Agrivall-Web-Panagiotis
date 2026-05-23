document.addEventListener("DOMContentLoaded", () => {
    const aboutRevealElement = document.querySelector(".about-reveal");
    const aboutSection = document.querySelector("#sobre-nosotros");
    const visionPillarElements = document.querySelectorAll(".pillar-reveal");
    const visionMissionSection = document.querySelector("#vision-mission");

    const hasAboutReveal = aboutRevealElement && aboutSection;
    const hasVisionMission =
        visionPillarElements.length > 0 && visionMissionSection;

    if (!hasAboutReveal && !hasVisionMission) {
        return;
    }

    const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

    const updateReveal = () => {
        const viewportHeight = window.innerHeight;

        if (hasAboutReveal) {
            const aboutRect = aboutSection.getBoundingClientRect();

            const aboutEntryProgress = clamp(
                (viewportHeight - aboutRect.top) / (viewportHeight * 0.9),
                0,
                1,
            );
            const aboutExitProgress = clamp(
                aboutRect.bottom / (viewportHeight * 0.9),
                0,
                1,
            );
            const aboutVisibility = Math.min(
                aboutEntryProgress,
                aboutExitProgress,
            );

            aboutRevealElement.style.opacity = String(aboutVisibility);
            aboutRevealElement.style.transform = `translateY(${56 * (1 - aboutVisibility)}px)`;
        }

        if (hasVisionMission) {
            const visionRect = visionMissionSection.getBoundingClientRect();

            const visionEntryProgress = clamp(
                (viewportHeight - visionRect.top) / (viewportHeight * 0.9),
                0,
                1,
            );
            const visionExitProgress = clamp(
                visionRect.bottom / (viewportHeight * 0.9),
                0,
                1,
            );
            const visionVisibility = Math.min(
                visionEntryProgress,
                visionExitProgress,
            );

            visionPillarElements.forEach((pillar) => {
                pillar.style.opacity = String(visionVisibility);
                pillar.style.transform = `translateY(${56 * (1 - visionVisibility)}px)`;
            });
        }
    };

    updateReveal();
    window.addEventListener("scroll", updateReveal, { passive: true });
    window.addEventListener("resize", updateReveal);
});
