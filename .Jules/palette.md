## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-24 - Contextual Link Accessibility
**Learning:** Generic link text like "Read More" creates a confusing experience for screen reader users. Always provide context via aria-label that includes the item's unique identifier (e.g., title).
**Action:** When implementing list views, verify all "Read More" or "View Details" links have specific aria-labels.

## 2024-05-25 - Skip to Content Links
**Learning:** Custom theme layouts (like `superduper/main`) often miss "Skip to content" links even if the base layout has them. This is a critical accessibility feature that should be present in all public-facing layouts.
**Action:** Always check custom layout components for the presence of a "Skip to content" link as the first focusable element.
