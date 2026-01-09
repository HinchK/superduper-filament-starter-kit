## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.
## 2025-05-15 - Interactive Code Snippets
**Learning:** Static command snippets with icons can be misleading. Converting them to interactive "Copy to Clipboard" buttons significantly improves usability and meets user expectations.
**Action:** When displaying command-line instructions, wrap them in an Alpine.js component to enable one-click copying with visual feedback.
