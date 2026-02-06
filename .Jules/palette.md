## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-24 - Contextual Link Accessibility
**Learning:** Generic link text like "Read More" creates a confusing experience for screen reader users. Always provide context via aria-label that includes the item's unique identifier (e.g., title).
**Action:** When implementing list views, verify all "Read More" or "View Details" links have specific aria-labels.

## 2024-05-24 - Skip Link Visibility
**Learning:** Skip links must have a z-index higher than fixed headers (often z-50) to be visible when focused.
**Action:** Use z-[60] or higher for skip links to ensure they layer correctly over sticky/fixed navigation.
