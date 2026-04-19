# The Design System: Editorial Precision & Vibrant Minimalist

## 1. Overview & Creative North Star: "The Curated Canvas"
This design system is built on the principle of **The Curated Canvas**. It rejects the cluttered "template" look of traditional e-commerce in favor of a high-end editorial experience. The goal is to create a digital space that feels like a physical art gallery: pure white walls, surgical precision in typography, and intense pops of color that command attention.

To achieve this, we leverage **Visual Silence**. By utilizing extreme amounts of negative space and removing structural crutches like borders and dividers, we force the user’s focus onto the product and the action. We break the grid through intentional asymmetry—overlapping images and staggered typography—to create a sense of movement and "soul" that standard frameworks lack.

---

## 2. Colors: High-Contrast Vitality
The palette is a study in tension between the clinical purity of white and the electric energy of Indigo.

*   **Primary Accent:** `primary_container` (#4F46E5). This is our "Vibrant Indigo." It is the pulse of the system, reserved strictly for calls to action and active states.
*   **The Ink:** `on_surface` (#111827). A deep charcoal that provides a more sophisticated, "ink-on-paper" feel than pure black.
*   **The Foundation:** `surface_container_lowest` (#FFFFFF). Our background is never "off-white." It is pure, high-contrast white.

### The "No-Line" Rule
**Borders are prohibited.** There are no 1px solid lines to section off content. Boundaries must be defined solely through:
1.  **Negative Space:** Using the spacing scale to create mental boundaries.
2.  **Tonal Transitions:** Moving from `surface_container_lowest` (#FFFFFF) to `surface_container_low` (#F3F3F4) to define a secondary section.

### Signature Textures
To prevent the UI from feeling "flat," we utilize **Tonal Vibrancy**. For primary hero buttons or high-impact cards, use a subtle linear gradient transitioning from `primary` (#3525CD) to `primary_container` (#4F46E5) at a 135-degree angle. This provides a tactile "glow" that flat hex codes cannot replicate.

---

## 3. Typography: The Manrope Scale
We use **Manrope** for its geometric clarity and modern humanist touch. It bridges the gap between technical precision and high-end fashion.

*   **Display (lg/md):** Use these for editorial impact. Set them with tight letter-spacing (-0.02em) to create a "block" of text that acts as a visual element.
*   **Headlines:** These are the anchors. Always in `on_surface` (#111827). High-contrast pairing with white space is non-negotiable.
*   **Body (lg/md):** Designed for maximum legibility. Use `body-lg` (1rem) for product descriptions to maintain a premium feel.
*   **Labels:** Use `label-md` in all-caps with increased letter-spacing (+0.05em) for category tags to distinguish them from interactive body text.

---

## 4. Elevation & Depth: Tonal Layering
In this system, depth is not "added"—it is "revealed." We move away from traditional shadows in favor of light and transparency.

### The Layering Principle
Depth is achieved by "stacking" surface tiers. To make a card feel elevated, place a `surface_container_lowest` (#FFFFFF) object on top of a `surface_container_low` (#F3F3F4) background. This creates a "soft lift" that is felt rather than seen.

### Ambient Shadows
When a floating element (like a modal or a primary dropdown) requires a shadow, it must be an **Ambient Shadow**:
*   **Opacity:** 3% to 4%.
*   **Blur:** High (30px to 60px).
*   **Color:** Use a tinted version of the surface color (a soft Indigo-tinted charcoal) rather than grey. It should look like a soft atmospheric glow.

### Glassmorphism & Depth
For navigation bars and floating filters, use a "Frosted Glass" effect. Apply `surface_container_lowest` with 80% opacity and a `backdrop-filter: blur(20px)`. This allows the vibrant colors of the content to bleed through as the user scrolls, creating a sense of environmental integration.

---

## 5. Components: The Primitive Set

### Buttons
*   **Primary:** Background `primary_container` (#4F46E5), text `on_primary` (#FFFFFF). Corner radius: `md` (0.375rem). No shadow.
*   **Secondary:** Background `transparent`, "Ghost Border" (outline-variant at 20% opacity), text `on_surface`.
*   **Tertiary:** Pure text with a 2px Indigo underline that expands on hover.

### Input Fields
*   **Style:** Minimalist. No background. Only a bottom "Ghost Border" (outline-variant at 20%).
*   **Active State:** The bottom border transforms into a 2px `primary_container` (#4F46E5) line.
*   **Error State:** Use `error` (#BA1A1A) text only for the helper message; do not turn the entire field red.

### Cards & Product Grids
*   **Rule:** Forbid divider lines. Use `surface_container_lowest` (#FFFFFF) for the card body. 
*   **Interaction:** On hover, the card does not rise; instead, the image within the card should subtly scale (1.05x) and the "Ambient Shadow" should increase from 3% to 5% opacity.

### Selection Chips
*   **Inactive:** `surface_container_high` (#E8E8E8) with `on_surface_variant` text.
*   **Active:** `primary_container` (#4F46E5) with `on_primary` (#FFFFFF) text.

---

## 6. Do's and Don'ts

### Do:
*   **Embrace Asymmetry:** Place a `display-lg` header partially overlapping an image to create an editorial, magazine-style layout.
*   **Maximize White Space:** If you think there is enough padding, double it. Premium brands thrive on "wasted" space.
*   **Use High Contrast:** Ensure `on_surface` text always sits on `surface_container_lowest` for maximum "pop."

### Don't:
*   **Don't use grey borders:** Never use a 1px #DDD or #CCC border to separate content. Use space or a shift to `#F3F3F4`.
*   **Don't use drab tones:** Avoid "muddy" greys. If you need a neutral, use a cool-toned charcoal or a very light blue-grey (`surface_variant`).
*   **Don't crowd the UI:** This system is about "The Curated Canvas." If a screen feels busy, remove elements until only the essential remain.
*   **Don't use standard drop shadows:** Avoid the "fuzzy black" shadow. If the shadow is noticeable at first glance, it is too heavy. Decrease opacity to 0.03.