## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-24 - Skip Link Consistency
**Learning:** Public-facing layouts were missing 'Skip to main content' links, while admin layouts had them with inline CSS.
**Action:** Always include a skip link in the main layout (`<main id="main-content">`) using standard Tailwind utility classes (`sr-only focus:not-sr-only`) to ensure keyboard accessibility and visual consistency.
