const priceForms = document.querySelectorAll("[data-admin-inline-price]");
const statusOpenButtons = document.querySelectorAll("[data-admin-status-open]");
const statusCloseButtons = document.querySelectorAll("[data-admin-status-close]");
const statusDialogs = document.querySelectorAll("[data-admin-status-dialog]");

priceForms.forEach((form) => {
    const trigger = form.querySelector("[data-admin-price-trigger]");
    const editor = form.querySelector("[data-admin-price-editor]");
    const cancel = form.querySelector("[data-admin-price-cancel]");
    const input = form.querySelector('input[name="precio"]');

    if (!trigger || !editor || !cancel || !input) {
        return;
    }

    trigger.addEventListener("click", () => {
        trigger.classList.add("d-none");
        editor.classList.remove("d-none");
        input.focus();
        input.select();
    });

    cancel.addEventListener("click", () => {
        editor.classList.add("d-none");
        trigger.classList.remove("d-none");
    });
});

statusOpenButtons.forEach((button) => {
    const dialogId = button.getAttribute("data-admin-status-open");
    const dialog = dialogId ? document.getElementById(dialogId) : null;

    if (!(dialog instanceof HTMLDialogElement)) {
        return;
    }

    button.addEventListener("click", () => {
        dialog.showModal();
    });
});

statusCloseButtons.forEach((button) => {
    button.addEventListener("click", () => {
        const dialog = button.closest("dialog");

        if (dialog instanceof HTMLDialogElement) {
            dialog.close();
        }
    });
});

statusDialogs.forEach((dialog) => {
    if (!(dialog instanceof HTMLDialogElement)) {
        return;
    }

    dialog.addEventListener("click", (event) => {
        if (event.target === dialog) {
            dialog.close();
        }
    });
});
