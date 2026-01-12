## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-23 - Skip Links for Keyboard Navigation
**Learning:** A "Skip to content" link is critical for keyboard users to bypass repeated header content. It should be the first focusable element in the body, hidden off-screen until focused, and point to the main content area (e.g., `#main-content`).
**Action:** Ensure all public-facing layouts include a skip link with `href="#main-content"` and proper focus styles (e.g., `focus:top-0`).
