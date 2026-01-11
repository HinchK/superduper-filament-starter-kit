## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-23 - Skip to Content
**Learning:** A "Skip to content" link is a critical accessibility feature that allows keyboard and screen reader users to bypass repetitive navigation links and go directly to the main content.
**Action:** Always verify the presence of a skip link as the first focusable element in the body, especially in layouts with large headers or navigation menus.
