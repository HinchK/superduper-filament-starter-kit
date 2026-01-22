## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-24 - Skip Links in Main Layouts
**Learning:** Public-facing main layouts must include a "Skip to main content" link as the first focusable element. This is critical for keyboard navigation users to bypass repeated header navigation.
**Action:** When creating or auditing a layout component (like `main.blade.php`), ensure a skip link is present and points to the main content wrapper (e.g., `#main-content`).
