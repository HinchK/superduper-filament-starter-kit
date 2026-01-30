## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-24 - Skip to Content Links
**Learning:** Global layouts must include a "Skip to content" link as the first focusable element in the body. This is crucial for keyboard users to bypass repetitive navigation. Ideally, it should be visually hidden until focused (`sr-only focus:not-sr-only`).
**Action:** Always verify the presence of a skip link in the main layout component (`resources/views/layouts/app.blade.php` or similar) pointing to the main content area ID.
