# Mobile Floating Control Resilience

Commerce CRM surfaces often include customer-facing floating controls such as support entry points, lead-capture prompts, promotion buttons, or quick contact actions. On mobile storefronts, those controls compete with bottom navigation, sticky product action bars, browser safe areas, and late-loading theme widgets.

The production lesson is that fixed pixel offsets do not survive real storefront layouts. A control that is clear on one device can overlap checkout actions or bottom navigation on another device because the footer stack height changes by page type, viewport, browser chrome, and product state.

## Design Approach

- Treat bottom UI as a measured runtime stack instead of a hard-coded mobile breakpoint.
- Recalculate placement when the viewport, orientation, visual viewport, DOM, or sticky surface size changes.
- Keep support and promotion controls aligned to the same placement source so they move together.
- Preserve safe-area handling for iOS-style devices without requiring a device-specific stylesheet.
- Avoid publishing private selectors, customer journeys, campaign rules, or production implementation details.

## Why It Matters

- Checkout and product action buttons remain reachable.
- Customer support entry points stay visible without covering revenue-critical controls.
- Promotion prompts behave consistently across product pages, listing pages, and content pages.
- The public UI becomes easier to maintain because new sticky surfaces do not require another round of page-specific magic numbers.

This note describes the architecture concern only. The private implementation, campaign text, styling details, production selectors, and customer data remain outside the public showcase.

## Storefront invitation layout

A separate mobile layout check found that an invitation could briefly paint while its dialog was still settling, causing a large page shift on some loads. The production adjustment keeps the dialog out of paint until its first layout has settled and avoids moving keyboard focus before the visitor acts. The first Tab still enters the dialog, and the visitor can dismiss and reopen it. The close target and placeholder contrast were checked in light and dark mobile and desktop views. Controlled and live browser checks improved the measured shift; field reporting needs a fresh observation period.
