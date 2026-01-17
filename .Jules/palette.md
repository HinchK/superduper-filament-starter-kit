## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-23 - Decorative SVGs in Blade
**Learning:** Blade templates often contain raw SVG icons for decoration or navigation cues that lack accessibility attributes. These can be noisy for screen readers.
**Action:** Always add `aria-hidden="true"` to decorative SVGs. For meaningful SVGs (like logos), use `role="img"` and a descriptive `aria-label`.
