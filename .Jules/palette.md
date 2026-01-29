## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-24 - Standalone Views & Inline Styles
**Learning:** `resources/views/welcome.blade.php` is often a standalone view with inline Tailwind styles and no inheritance from the main layout. It requires separate accessibility checks (skip link, landmarks) as it doesn't share the global components.
**Action:** When auditing accessibility, explicitly check standalone entry points like `welcome.blade.php` or `error.blade.php` as they often miss global layout fixes.
