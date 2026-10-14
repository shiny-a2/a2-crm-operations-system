# Education CRM staging update — 2026-10-14

## What changed

The private Education adaptation reached an isolated WordPress staging installation on the intended VPS. It now models B2B organizations and their student relationships, named staff assignments, bounded student lists, role-scoped summary counts, and follow-up rescheduling with an audit trail. Its Persian operator and admin views were checked in light and dark themes at desktop and mobile widths.

A later staging update made student and organization edits conditional on their current record revision. This prevents a concurrent edit from silently overwriting a newer version. Synthetic tests now cover a successful update and a stale update rejected for each record type.

The next iteration added scoped organization interactions, student stage history, one internal follow-up task for new leads, and recent-activity totals. The Education instance remains independent of the source retail CRM and external AI systems. Core integrity was rechecked against the official WordPress package; synthetic browser, role, API, and backup checks were repeated. Public HTTPS acceptance is still outstanding.

The current staging release adds manager-configurable student stages and permitted transitions. Operators see the configured labels in the Persian workspace; the API rejects a disallowed move and prevents removal of a stage already used by a record. The default policy remains compatible with existing workflows until education managers approve a narrower progression. A separate design draft defines tenant isolation, approved knowledge, and budget-aware routing for a future shared AI service; no AI service is connected to this CRM.

The latest private staging update adds organization contacts, a service catalog, and contract status records without financial or legal terms. Revision checks and role scope cover these records, while managers can see contract counts in operational reports. Synthetic migration, restore, API, and responsive browser checks passed. A read-only audit of the owner's existing bot identified reusable interaction and metering patterns, plus the need for a new tenant boundary and strict budget ledger in the proposed shared AI service. The running bot remains unchanged and disconnected from Education.

## Why it matters

Educational consulting needs both an individual student history and the organization responsible for a partnership. Linking those records and limiting each operator's view makes the workflow usable without importing a retail customer database. An isolated backup and disposable restore drill provide a concrete recovery path for the staging instance.

## Verification and limits

Internal tests used synthetic records to exercise login and logout, manager and consultant access, B2B links, follow-up state, stage-policy permissions, reports, and backup recovery. The pipeline editor and B2B forms were exercised in light and dark themes at desktop and mobile widths. One subdomain DNS record at the current provider is still required; public HTTPS and browser acceptance have not happened. External chat, messaging, phone integration, financial contract terms, payments, richer education fields, full source-system feature parity, and the future Node.js version are outside this release. No customer records, credentials, or server internals are included here.
