## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-23 - Layout Consistency
**Learning:** Layout files used for public-facing pages (e.g., specific theme layouts like `superduper/main.blade.php`) may lack accessibility features present in the default backend/app layouts (e.g., `layouts/app.blade.php`).
**Action:** Always audit custom theme layouts for standard accessibility features like "Skip to content" links, even if they are present in the core framework layouts.
