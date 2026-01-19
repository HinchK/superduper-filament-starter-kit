## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-23 - Fragmented Layout Accessibility
**Learning:** Public-facing layouts often miss accessibility features present in admin dashboards. Always verify critical a11y features like 'Skip to content' across ALL layout files, not just the main app shell.
**Action:** When auditing accessibility, check `resources/views/components/layouts` AND `resources/views/components/{theme}/main.blade.php`.
