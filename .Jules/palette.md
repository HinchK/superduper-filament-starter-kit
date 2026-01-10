## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-23 - Skip to Content Link
**Learning:** Every public-facing layout must have a 'Skip to content' link as the first focusable element to allow keyboard users to bypass navigation.
**Action:** Check `main.blade.php` or equivalent layout files for the presence of this link.
