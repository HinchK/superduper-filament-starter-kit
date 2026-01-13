## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-23 - SVG Accessibility
**Learning:** Purely decorative SVGs (like icons accompanying text) should have `aria-hidden="true"` to avoid screen reader noise. Meaningful SVGs (like logos) must have `role="img"` and a descriptive `aria-label`.
**Action:** Audit all SVGs in views to ensure they are properly labeled or hidden based on their context.
