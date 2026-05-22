// Initialization for ES Users
import { Carousel } from "bootstrap";

document.querySelectorAll('[data-bs-ride="carousel"]').forEach((carousel) => {
    Carousel.getOrCreateInstance(carousel);
});
