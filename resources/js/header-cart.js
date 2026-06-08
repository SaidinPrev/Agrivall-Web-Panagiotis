const formatCurrency = (value) => {
    return `${Number(value).toFixed(2)} €`;
};

const renderHeaderCart = (dropdownSummary, counter, cartData) => {
    const { items, line_count: lineCount, total } = cartData;

    counter.textContent = lineCount;
    counter.classList.toggle("is-empty", lineCount === 0);

    if (lineCount === 0) {
        dropdownSummary.innerHTML = "<p>Tu carrito está vacío.</p>";
        return;
    }

    dropdownSummary.innerHTML = `
        <ul class="site-nav__cart-items">
            ${items
                .map((item) => {
                    return `
                        <li class="site-nav__cart-item">
                            <div>
                                <strong>${item.producto.nombre} ${item.producto.variedad}</strong>
                                <span>${item.producto.formato} x ${item.cantidad}</span>
                            </div>
                            <span>${formatCurrency(item.subtotal)}</span>
                        </li>
                    `;
                })
                .join("")}
        </ul>
        <p class="site-nav__cart-total">Total: ${formatCurrency(total)}</p>
    `;
};

document.addEventListener("DOMContentLoaded", () => {
    const cartToggle = document.querySelector("[data-cart-toggle]");
    const cartDropdown = document.querySelector("[data-cart-dropdown]");
    const cartSummary = document.querySelector("[data-cart-summary]");
    const cartCount = document.querySelector("[data-cart-count]");

    if (!cartToggle || !cartDropdown || !cartSummary || !cartCount) {
        return;
    }

    const cartItem = cartToggle.closest(".site-nav__item--cart");

    const closeCart = () => {
        cartItem?.classList.remove("is-open");
        cartToggle.setAttribute("aria-expanded", "false");
    };

    const openCart = () => {
        cartItem?.classList.add("is-open");
        cartToggle.setAttribute("aria-expanded", "true");
    };

    const loadCart = async () => {
        try {
            const response = await fetch("/cart", {
                headers: {
                    Accept: "application/json",
                },
            });

            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }

            const cartData = await response.json();
            renderHeaderCart(cartSummary, cartCount, cartData);
        } catch (error) {
            console.error(error);
        }
    };

    cartToggle.addEventListener("click", async () => {
        if (cartItem?.classList.contains("is-open")) {
            closeCart();
            return;
        }

        await loadCart();
        openCart();
    });

    document.addEventListener("click", (event) => {
        if (cartItem && !cartItem.contains(event.target)) {
            closeCart();
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") {
            closeCart();
        }
    });

    window.addEventListener("cart:updated", (event) => {
        if (event.detail) {
            renderHeaderCart(cartSummary, cartCount, event.detail);
            return;
        }

        loadCart();
    });

    loadCart();
});
