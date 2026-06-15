# Maintenance Notes

## Operational Learnings

- Operators trust a CRM only when assignment and status are predictable.
- Provider failures need visible states, not silent retries.
- Reporting should not compete with the operator inbox for database resources.
- Admin AJAX, exports, and report filters should resolve against the current WordPress admin origin so host aliases or proxy scheme differences do not look like empty CRM data.
- Commission reports should keep product-category rules separate from payment-gateway rules so mixed orders do not apply a gateway discount to the wrong item group.
- Remaining or extra collection amounts should be reported as their own commission bucket when their rate policy differs from the main payment gateway.
- Split-payment or adjusted orders need a single reconciled final total plus visible payment shares; otherwise commission and receipt reports can double-count the remaining amount.
- Management reports should offer spreadsheet exports that match on-screen totals so finance review does not depend on manual copying.
- Finance exports are easier to audit when summary, bucket totals, payment gateways, order rows, and settlement rows are separated into spreadsheet tabs with numeric cells.
- Wide-range reports should have bounded scans and cache versioning so a single dashboard request cannot fail like a missing admin page.
- Critical admin report routes should be reachable directly and fail visibly with an operator-facing notice rather than falling through as a missing page.
- Admin report filters should prefer namespaced range parameters and preserve legacy compatibility so external security rules cannot turn date filtering into a missing-page symptom.
- Report diagnostics should expose raw event coverage, valid identity counts, and event-name breakdowns before assuming a dashboard KPI is actually zero.
- Report render paths should avoid per-record identity lookups; build bulk lookup maps first and keep any existing precedence rules explicit.
- Keep operator-selected CRM outcome buckets separate from order-attribution source buckets; source reports should reconcile with all successful orders, including Direct, Admin/Internal, Unknown, and checkout questionnaire values.
- When the same checkout questionnaire field is useful for both successful-order and all-order reporting, show those scopes as separate cards so failed or pending orders do not distort conversion-oriented views.
- Behavior metrics should rely on grouped tracking events and clearly flag known tracking gaps.

## Maintenance Cadence

- Review role/capability examples quarterly.
- Keep provider samples generic.
- Add changelog entries only for meaningful architecture/sample revisions.
