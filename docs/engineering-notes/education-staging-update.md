# Education CRM staging update — 2026-10-14

## What changed

The private Education adaptation reached an isolated WordPress staging installation on the intended VPS. It now models B2B organizations and their student relationships, named staff assignments, bounded student lists, role-scoped summary counts, and follow-up rescheduling with an audit trail. Its Persian operator and admin views were checked in light and dark themes at desktop and mobile widths.

A later staging update made student and organization edits conditional on their current record revision. This prevents a concurrent edit from silently overwriting a newer version. Synthetic tests now cover a successful update and a stale update rejected for each record type.

The next iteration added scoped organization interactions, student stage history, one internal follow-up task for new leads, and recent-activity totals. The Education instance remains independent of the source retail CRM and external AI systems. Core integrity was rechecked against the official WordPress package; synthetic browser, role, API, and backup checks were repeated.

The current staging release adds manager-configurable student stages and permitted transitions. Operators see the configured labels in the Persian workspace; the API rejects a disallowed move and prevents removal of a stage already used by a record. The default policy remains compatible with existing workflows until education managers approve a narrower progression. A separate design draft defines tenant isolation, approved knowledge, and budget-aware routing for a future shared AI service; no AI service is connected to this CRM.

The latest private staging update adds organization contacts, a service catalog, and contract status records without financial or legal terms. Revision checks and role scope cover these records, while managers can see contract counts in operational reports. Synthetic migration, restore, API, and responsive browser checks passed. A read-only audit of the owner's existing bot identified reusable interaction and metering patterns, plus the need for a new tenant boundary and strict budget ledger in the proposed shared AI service. The running bot remains unchanged and disconnected from Education.

The next staging release adds an internal inbox for overdue follow-ups and a bounded audit timeline visible to managers. A scheduled scan prevents duplicate alerts, respects current student assignments, and sends no external message. Read state is audited. Synthetic role, API, repeat-migration, backup-restore, and light/dark desktop/mobile browser checks passed. Public HTTPS acceptance remains pending.

## Why it matters

Educational consulting needs both an individual student history and the organization responsible for a partnership. Linking those records and limiting each operator's view makes the workflow usable without importing a retail customer database. An isolated backup and disposable restore drill provide a concrete recovery path for the staging instance.

## Verification and limits

The client-review preparation update adds an internal, role-scoped feedback form with private screenshots, clearer evidence for human customer matching, and a list for manually entered demo leads. Management reporting now names lead-to-contract conversion separately from opportunity win rate. Synthetic finance, role, browser, repeat-migration and encrypted restore checks passed, and local staging monitoring checks service and backup freshness. These changes help reviewers collect specific findings without publishing business records. The client walkthrough and production decision are still pending.

The latest private update added configurable organization stages, scoped B2B filters and report exports, and validated educational profile fields with audit history. The WordPress CRM is now available through a public HTTPS staging URL for client review. Browser acceptance covered administrator login/logout, organization and student creation, draft contracts, follow-ups, reports, and role boundaries in responsive light/dark layouts. Why it matters: reviewers can test the real CRM workflow while production acceptance remains a separate decision.

The review login now has a dedicated Persian A2 design, and the login, WordPress administration, and operator workspace share one locally served Persian typeface. Desktop and mobile light/dark checks covered the login and existing CRM interactions; the WordPress authentication and role rules remain in place.

Internal tests used synthetic records to exercise login and logout, manager and consultant access, B2B links, follow-up state, stage-policy permissions, internal notifications, audit visibility, reports, and backup recovery. The pipeline editor, B2B forms, and notification/audit controls were exercised in light and dark themes at desktop and mobile widths. Encrypted off-server backups and a recovery drill were checked. External chat, messaging, phone integration, financial contract terms, payments, full source-system feature parity, and the future Node.js version are outside this release. No customer records, credentials, or server internals are included here.
