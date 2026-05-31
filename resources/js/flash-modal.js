document.addEventListener("DOMContentLoaded", () => {
    const modal = document.querySelector("[data-flash-modal]");

    if (!modal) {
        return;
    }

    const closeButton = modal.querySelector("[data-flash-close]");
    closeButton.addEventListener("click", () => {
        modal.remove();
    });
});
