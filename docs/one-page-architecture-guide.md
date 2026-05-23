# One-Page Architecture Guide

This file is the roadmap for turning Agrivall into a clean one-page site.

## Objective

Build a single homepage where each section has one clear role:

1. Introduce Agrivall.
2. Show the main offers.
3. Build trust.
4. End with clear actions.

## Recommended Section Order

1. `Header / Navbar`
2. `Hero`
3. `Sobre nosotros`
4. `Nuestra visión/Misión`
4. `Productos`
5. `La casilla`
6. `Valores`
7. `Blog` or `Noticias`
8. `Contacto`
9. `Footer`

## Section Purpose

### 1. Header / Navbar
- Keep the logo visible.
- Use anchor links to move through the page.
- Suggested anchors:
  - `#inicio`
  - `#sobre-nosotros`
  - `#productos`
  - `#casilla`
  - `#valores`
  - `#blog`
  - `#contacto`

### 2. Hero
- Strong first impression.
- Short title.
- Short supporting phrase.
- CTA buttons that move the user down the page.

Current state:
- Hero carousel exists.
- CTA styling exists.

### 3. Sobre nosotros
- Explain who Agrivall is.
- Keep the copy short and warm.
- Suggested content:
  - family identity
  - ecological farming
  - Vall de la Gallinera

### 4. Productos
- Show the main product offer.
- Use cards or visual blocks.
- Each product block should include:
  - image
  - short name
  - one short description

### 5. La casilla
- Present the rural house as a second offer.
- Include:
  - image
  - short inviting text
  - reservation CTA

### 6. Valores
- Show why people should trust the brand.
- Keep it simple.
- Good themes:
  - proximidad
  - producto de temporada
  - agricultura ecológica
  - cuidado de la tierra

### 7. Blog / Noticias
- Optional, but useful if the professor wants richer structure.
- Show latest news or a short introduction to the blog.

### 8. Contacto
- Final action section.
- Include:
  - contact info
  - reservation intention
  - product inquiry option

### 9. Footer
- Lightweight closing section.
- Include legal or social links if needed.

## Build Order

Follow this order while developing:

1. Finish `Hero`
2. Create `Sobre nosotros`
3. Create `Productos`
4. Create `La casilla`
5. Create `Valores`
6. Create `Contacto`
7. Add `Footer`
8. Connect navbar anchors
9. Polish mobile spacing
10. Adapt for bigger screens

## Blade Structure Recommendation

Keep the homepage composed from partials.

Suggested structure:

- `resources/views/home.blade.php`
- `resources/views/partials/headerNav.blade.php`
- `resources/views/partials/hero.blade.php`
- `resources/views/partials/about.blade.php`
- `resources/views/partials/products.blade.php`
- `resources/views/partials/casilla.blade.php`
- `resources/views/partials/values.blade.php`
- `resources/views/partials/contact.blade.php`
- `resources/views/partials/footer.blade.php`

## Mobile-First Rules

While building the one-page site:

1. Start with mobile only.
2. Keep one column first.
3. Add spacing carefully.
4. Make buttons easy to tap.
5. Keep text short.
6. Only add desktop breakpoints after the mobile version feels solid.

## Content Rules

Use this tone across the page:

- warm
- simple
- local
- ecological
- close to the land

Avoid:

- very long paragraphs
- repeated slogans
- too many buttons in one section
- corporate language

## Next Practical Steps

1. Finish the hero CTA layout.
2. Create `about.blade.php`.
3. Add a `section` with `id="sobre-nosotros"`.
4. Write one short paragraph about Agrivall.
5. Then continue with `products.blade.php`.

