## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-24 - Skip to Content Links in Layouts
**Learning:** Layout components that wrap page content must explicitly include a "Skip to content" link as the first focusable element to allow keyboard users to bypass navigation.
**Action:** Always verify the presence of a skip link in the main layout component (`main.blade.php`, `app.blade.php`, etc.) and ensure it points to the main content container.
