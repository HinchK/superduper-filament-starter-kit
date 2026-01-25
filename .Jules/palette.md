## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2026-01-25 - Skip Links and SVG Noise
**Learning:** 'Skip to content' links are critical for keyboard navigation efficiency but often missed on standalone pages like 'welcome.blade.php'. Decorative SVGs without aria-hidden="true" create significant noise for screen reader users.
**Action:** Audit all layout files and standalone pages for skip links pointing to a valid #main-content. Systematically apply aria-hidden="true" to decorative icons and role="img" with labels to meaningful ones.
