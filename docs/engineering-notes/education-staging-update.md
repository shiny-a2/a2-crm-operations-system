# Education CRM staging update — 2026-10-14

## What changed

The private Education adaptation reached an isolated WordPress staging installation on the intended VPS. It now models B2B organizations and their student relationships, named staff assignments, bounded student lists, role-scoped summary counts, and follow-up rescheduling with an audit trail. Its Persian operator and admin views were checked in light and dark themes at desktop and mobile widths.

A later staging update made student and organization edits conditional on their current record revision. This prevents a concurrent edit from silently overwriting a newer version. Synthetic tests now cover a successful update and a stale update rejected for each record type.

## Why it matters

Educational consulting needs both an individual student history and the organization responsible for a partnership. Linking those records and limiting each operator's view makes the workflow usable without importing a retail customer database. An isolated backup and disposable restore drill provide a concrete recovery path for the staging instance.

## Verification and limits

Internal tests used synthetic records to exercise login and logout, manager and consultant access, B2B links, follow-up state, reports, and backup recovery. A separate authoritative DNS preflight now resolves the known web routes from outside the server. The HTTPS release gate checks both parent delegation and public resolver answers before certificate issuance, and the prepared public route limits login requests and closes an unused remote publishing endpoint. Synthetic browser checks are prepared for the final URL. Domain delegation and public HTTPS acceptance have not happened. External chat, messaging, phone integration, payments, richer education fields, full source-system feature parity, and the future Node.js version are outside this release. No customer records, credentials, or server internals are included here.
