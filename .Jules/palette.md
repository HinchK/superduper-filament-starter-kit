## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-24 - Layout Consistency
**Learning:** Public-facing layouts (`superduper/main.blade.php`) missed critical accessibility features (skip link) that were present in internal layouts (`layouts/app.blade.php`).
**Action:** When auditing accessibility, cross-reference public vs. internal layouts to ensure consistent baseline accessibility standards.
