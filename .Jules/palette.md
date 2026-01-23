## 2024-05-23 - Breadcrumb Accessibility
**Learning:** Breadcrumbs should always be wrapped in a nav element with an appropriate aria-label, and use an ordered list since the path is hierarchical. The current page should be marked with aria-current="page".
**Action:** When implementing or refactoring navigation components, always check for semantic HTML structure and ARIA attributes for current state.

## 2024-05-24 - Skip Links Implementation
**Learning:** Skip links should be the first focusable element in the body. When styling with Tailwind, avoid animating positional properties like `top` or `left` on focus as it causes snapping. Instead, set the position in the base classes and animate `transform` (e.g., `translate-y`) for a smoother reveal.
**Action:** Use base classes like `fixed z-[100] top-4 left-4 -translate-y-[200%]` and `focus:translate-y-0` for accessible skip links.
