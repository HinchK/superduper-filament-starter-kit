## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-24 - Contextual Link Accessibility
**Learning:** Generic link text like "Read More" creates a confusing experience for screen reader users. Always provide context via aria-label that includes the item's unique identifier (e.g., title).
**Action:** When implementing list views, verify all "Read More" or "View Details" links have specific aria-labels.

## 2024-05-25 - Icon-only Link Accessibility
**Learning:** Links that contain only icons (e.g. social media links) are invisible to screen readers without an accessible name.
**Action:** Always add `aria-label` to icon-only links describing the destination, and add `aria-hidden="true"` to the icon element itself.
