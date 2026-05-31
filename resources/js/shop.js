// Groups flat API products by product name and variety.
const groupProducts = (productos) => {
    return productos.reduce((groups, producto) => {
        if (!groups[producto.nombre]) {
            groups[producto.nombre] = {};
        }

        if (!groups[producto.nombre][producto.variedad]) {
            groups[producto.nombre][producto.variedad] = [];
        }

        groups[producto.nombre][producto.variedad].push(producto);

        return groups;
    }, {});
};

// Builds select options from any list of items.
const renderSelectOptions = (items, getValue, getLabel) => {
    return items
        .map((item) => {
            return `
                <option value="${getValue(item)}">
                    ${getLabel(item)}
                </option>
            `;
        })
        .join("");
};

// Renders the selected product image and summary.
const renderProductPreview = (productPreview, productSummary, producto) => {
    productPreview.innerHTML = `
        <article class="shop-product-preview__card">
            <img
                src="/${producto.imagen}"
                alt="${producto.nombre} ${producto.variedad}"
                class="shop-product-preview__image"
            >
        </article>
    `;

    productSummary.innerHTML = `
        <h3>${producto.nombre} ${producto.variedad}</h3>
        <p class="shop-product-summary__price">${producto.precio} €</p>
        <p>Formato: ${producto.formato}</p>
        <p class="shop-product-summary__availability ${producto.disponible ? "is-available" : "is-unavailable"}">
            ${producto.disponible ? "Disponible" : "No disponible"}
        </p>
    `;
};

// Renders the current shopping cart.
const renderCart = (cartRoot, cart) => {
    if (cart.length === 0) {
        cartRoot.innerHTML = `
            <h2>Tu carrito</h2>
            <p>Añade productos para empezar tu pedido.</p>
        `;

        return;
    }

    const total = cart.reduce((sum, item) => {
        return sum + Number(item.producto.precio) * item.cantidad;
    }, 0);

    cartRoot.innerHTML = `
        <h2>Tu carrito</h2>
        <ul class="shop-cart__items">
            ${cart
                .map((item) => {
                    return `
                        <li class="shop-cart__item">
                            <span>
                                ${item.producto.nombre} ${item.producto.variedad}
                                ${item.producto.formato}
                                x ${item.cantidad}
                            </span>
                            <button
                                type="button"
                                class="shop-cart__remove"
                                data-product-id="${item.producto.id}"
                            >
                                Eliminar
                            </button>
                        </li>
                    `;
                })
                .join("")}
        </ul>
        <p class="shop-cart__total">
            Total: ${total.toFixed(2)} €
        </p>
        <button type="button" class="shop-cart__checkout">
            Finalizar pedido
        </button>
    `;
    const removeButtons = cartRoot.querySelectorAll(".shop-cart__remove");

    removeButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const productId = Number(button.dataset.productId);
            const itemIndex = cart.findIndex((item) => {
                return item.producto.id === productId;
            });

            if (itemIndex === -1) {
                return;
            }

            cart.splice(itemIndex, 1);
            renderCart(cartRoot, cart);
        });
    });

    const checkoutButton = cartRoot.querySelector(".shop-cart__checkout");
    if (checkoutButton) {
        checkoutButton.addEventListener("click", async () => {
            const cartPayload = {
                items: cart.map((item) => {
                    return {
                        producto_id: item.producto.id,
                        cantidad: item.cantidad,
                    };
                }),
            };
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute("content");
            const url = "/cart";

            try {
                const response = await fetch(url, {
                    method: "POST",
                    body: JSON.stringify(cartPayload),
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                });
                const data = await response.json();
                console.log(data);

                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`);
                }
                window.location.href = "/checkout";
            } catch (error) {
                console.error(error);
            }
        });
    }
};

// Renders the consultation flow for herbs, which are not sold online.
const renderHerbInquiry = (productsRoot, optionsRoot, cartRoot) => {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    productsRoot.innerHTML = `
        <article class="shop-product-preview__card shop-herb-preview">
            <img
                src="/imgs/herbVariety.jpg"
                alt="Hierbas comestibles"
                class="shop-product-preview__image"
            >
        </article>
    `;

    optionsRoot.innerHTML = `
        <form class="shop-herb-form" action="/consulta-hierbas" method="POST">
            <input type="hidden" name="_token" value="${csrfToken}">
            <h2>Consulta sobre hierbas comestibles</h2>
            <p>
                Este producto se trabaja bajo consulta para restaurantes, hoteles y negocios.
                Cuéntanos qué necesitas y te responderemos por email.
            </p>

            <label class="shop-configurator__field">
                <span>Nombre</span>
                <input type="text" name="nombre" required minlength="5">
            </label>

            <label class="shop-configurator__field">
                <span>Email</span>
                <input type="email" name="email" required>
            </label>

            <label class="shop-configurator__field">
                <span>Teléfono</span>
                <input type="tel" name="telefono">
            </label>

            <label class="shop-configurator__field">
                <span>Mensaje</span>
                <textarea name="mensaje" required minlength="15"></textarea>
            </label>

            <button type="submit" class="shop-configurator__submit">
                Enviar consulta
            </button>
        </form>
    `;

    cartRoot.innerHTML = `
        <div class="shop-herb-note">
            <h2>Venta bajo consulta</h2>
            <p>
                Las hierbas comestibles no se compran directamente online.
                Revisaremos disponibilidad, variedades y cantidades según tu solicitud.
            </p>
        </div>
    `;
};

// Renders the shop configurator with the first product dropdown.
const renderProductConfigurator = (
    productsRoot,
    optionsRoot,
    cartRoot,
    groupedProducts,
    cart,
    requestedProduct,
) => {
    const productNames = Object.keys(groupedProducts);
    const selectedProductName = productNames.includes(requestedProduct)
        ? requestedProduct
        : productNames[0];
    const varietyNames = Object.keys(groupedProducts[selectedProductName]);
    const selectedVarietyName = varietyNames[0];
    const formatProducts =
        groupedProducts[selectedProductName][selectedVarietyName];

    productsRoot.innerHTML = `
        <div id="shop-product-preview" class="shop-product-preview"></div>
    `;

    optionsRoot.innerHTML = `
        <div class="shop-configurator">
            <h2>Configura tu pedido</h2>
            <div id="shop-product-summary" class="shop-product-summary"></div>

            <label class="shop-configurator__field">
                <span>Producto</span>
                <select id="shop-product-select">
                    ${renderSelectOptions(
                        productNames,
                        (productName) => productName,
                        (productName) => productName,
                    )}
                </select>
            </label>

            <label class="shop-configurator__field">
                <span>Variedad</span>
                <select id="shop-variety-select">
                    ${renderSelectOptions(
                        varietyNames,
                        (varietyName) => varietyName,
                        (varietyName) => varietyName,
                    )}
                </select>
            </label>

            <label class="shop-configurator__field">
                <span>Formato</span>
                <select id="shop-format-select">
                    ${renderSelectOptions(
                        formatProducts,
                        (producto) => producto.id,
                        (producto) => producto.formato,
                    )}
                </select>
            </label>

            <label class="shop-configurator__field">
                <span>Cantidad</span>
                <input
                    id="shop-quantity-input"
                    type="number"
                    min="1"
                    value="1"
                >
            </label>

            <button
                id="shop-add-to-cart"
                type="button"
                class="shop-configurator__submit"
            >
                Añadir al carrito
            </button>
            <p id="shop-feedback" class="shop-configurator__feedback"></p>
        </div>
    `;

    const productSelect = optionsRoot.querySelector("#shop-product-select");
    const varietySelect = optionsRoot.querySelector("#shop-variety-select");
    const formatSelect = optionsRoot.querySelector("#shop-format-select");
    const productPreview = productsRoot.querySelector("#shop-product-preview");
    const productSummary = optionsRoot.querySelector("#shop-product-summary");
    const quantityInput = optionsRoot.querySelector("#shop-quantity-input");
    const addToCartButton = optionsRoot.querySelector("#shop-add-to-cart");
    const feedback = optionsRoot.querySelector("#shop-feedback");

    productSelect.value = selectedProductName;
    varietySelect.value = selectedVarietyName;
    formatSelect.value = formatProducts[0].id;

    renderProductPreview(productPreview, productSummary, formatProducts[0]);

    productSelect.addEventListener("change", () => {
        const selectedProductName = productSelect.value;
        const updatedVarietyNames = Object.keys(
            groupedProducts[selectedProductName],
        );
        const selectedVarietyName = updatedVarietyNames[0];
        const updatedFormatProducts =
            groupedProducts[selectedProductName][selectedVarietyName];

        varietySelect.innerHTML = renderSelectOptions(
            updatedVarietyNames,
            (varietyName) => varietyName,
            (varietyName) => varietyName,
        );

        formatSelect.innerHTML = renderSelectOptions(
            updatedFormatProducts,
            (producto) => producto.id,
            (producto) => producto.formato,
        );
        renderProductPreview(
            productPreview,
            productSummary,
            updatedFormatProducts[0],
        );
    });

    varietySelect.addEventListener("change", () => {
        const selectedProductName = productSelect.value;
        const selectedVarietyName = varietySelect.value;
        const updatedFormatProducts =
            groupedProducts[selectedProductName][selectedVarietyName];

        formatSelect.innerHTML = renderSelectOptions(
            updatedFormatProducts,
            (producto) => producto.id,
            (producto) => producto.formato,
        );
        renderProductPreview(
            productPreview,
            productSummary,
            updatedFormatProducts[0],
        );
    });

    formatSelect.addEventListener("change", () => {
        const selectedProductName = productSelect.value;
        const selectedVarietyName = varietySelect.value;
        const selectedProductId = Number(formatSelect.value);
        const formatProducts =
            groupedProducts[selectedProductName][selectedVarietyName];

        const selectedProduct = formatProducts.find((producto) => {
            return producto.id === selectedProductId;
        });

        renderProductPreview(productPreview, productSummary, selectedProduct);
    });

    addToCartButton.addEventListener("click", () => {
        const selectedProductName = productSelect.value;
        const selectedVarietyName = varietySelect.value;
        const selectedProductId = Number(formatSelect.value);
        const cantidad = Number(quantityInput.value);
        if (!Number.isInteger(cantidad) || cantidad < 1) {
            feedback.textContent = "Introduce una cantidad válida.";
            return;
        }
        const formatProducts =
            groupedProducts[selectedProductName][selectedVarietyName];

        const selectedProduct = formatProducts.find((producto) => {
            return producto.id === selectedProductId;
        });

        const existingCartItem = cart.find((item) => {
            return item.producto.id === selectedProduct.id;
        });

        const quantityAlreadyInCart = existingCartItem
            ? existingCartItem.cantidad
            : 0;
        const requestedQuantity = quantityAlreadyInCart + cantidad;
        if (requestedQuantity > selectedProduct.stock) {
            feedback.textContent = "No hay suficiente stock para esa cantidad.";
            return;
        }

        if (existingCartItem) {
            existingCartItem.cantidad += cantidad;
        } else {
            cart.push({
                producto: selectedProduct,
                cantidad,
            });
        }
        quantityInput.value = 1;
        feedback.textContent = "Producto añadido al carrito.";
        renderCart(cartRoot, cart);
    });
};

document.addEventListener("DOMContentLoaded", () => {
    const productsRoot = document.querySelector("#shop-products-root");
    const optionsRoot = document.querySelector("#shop-options-root");
    const cartRoot = document.querySelector("#shop-cart-root");
    const cart = [];

    if (!productsRoot || !optionsRoot || !cartRoot) {
        return;
    }

    renderCart(cartRoot, cart);

    const searchParams = new URLSearchParams(window.location.search);
    const requestedProduct = searchParams.get("producto");

    if (requestedProduct === "hierbas") {
        renderHerbInquiry(productsRoot, optionsRoot, cartRoot);
        return;
    }

    fetch("/api/productos")
        .then((response) => response.json())
        .then((productos) => {
            const groupedProducts = groupProducts(productos);

            renderProductConfigurator(
                productsRoot,
                optionsRoot,
                cartRoot,
                groupedProducts,
                cart,
                requestedProduct,
            );
        })
        .catch(() => {
            productsRoot.innerHTML =
                "<p>No se han podido cargar los productos.</p>";
        });
});
