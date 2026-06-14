# Maintenance Notes

## Operational Learnings

- Operators trust a CRM only when assignment and status are predictable.
- Provider failures need visible states, not silent retries.
- Reporting should not compete with the operator inbox for database resources.
- Admin AJAX, exports, and report filters should resolve against the current WordPress admin origin so host aliases or proxy scheme differences do not look like empty CRM data.
- Commission reports should keep product-category rules separate from payment-gateway rules so mixed orders do not apply a gateway discount to the wrong item group.

## Maintenance Cadence

- Review role/capability examples quarterly.
- Keep provider samples generic.
- Add changelog entries only for meaningful architecture/sample revisions.
