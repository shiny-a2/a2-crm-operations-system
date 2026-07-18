# Changelog

## 0.3.34 - Production Source Provenance Before Security Refactoring

- Added a public-safe note about capturing the deployed CRM source as a byte-verifiable private baseline before identity, chat, and public-form security work begins.
- Documented the safety boundary: environment-specific configuration stays outside Git, source and JavaScript syntax are checked, and the baseline records provenance without changing live runtime state.
- Kept production source, checksums, filenames, versions, provider configuration, client identity, security findings, and operational paths private.

## 0.3.33 - Signed Loopback For Background Work Without WP-Cron Note

- Added a public-safe note about running a slow background job (e.g. an assistant reply) on platforms where the built-in scheduler is disabled: instead of relying on the scheduler, fire a non-blocking loopback request to a dedicated internal endpoint that does the work immediately in its own request, so the visitor's request still returns instantly.
- Documented protecting that endpoint without a user session: gate it with an HMAC signature (keyed by a platform secret) rather than a CSRF token, and have the background run set abort-tolerance and a higher time limit so it completes after the triggering caller disconnects; keep the scheduler path as a fallback and guard against duplicate work.

## 0.3.32 - Full-Automation Toggle For Assistant Replies Note

- Added a public-safe note about an optional "answer every conversation" mode for the chat assistant: a default-off toggle that, when enabled, has the assistant respond to all conversations and ignore the auto-pause that normally keeps it silent once a human has stepped in or a handoff was requested (the human is still notified on handoff). This makes full automation an explicit operator choice rather than a hidden default.

## 0.3.31 - Async Assistant Reply Off The Request Path Note

- Added a public-safe note about moving a slow assistant reply out of the visitor's request: persist the inbound message and return immediately, then generate the reply in a background job so it runs free of the request-time fail-fast timeout policy and the visitor isn't kept waiting; the UI shows the reply on its next poll.
- Documented two supporting practices: a unique key per inbound message so a duplicate-job guard doesn't collapse rapid back-and-forth, and debug breadcrumbs at every decision point of the auto-reply so a silent skip (such as a conversation a human has already taken over) is easy to pinpoint.

## 0.3.30 - Capturing Customer Name From Bots/Chat Note

- Added a public-safe note about writing a customer's name back into the CRM from conversational channels: a token-protected endpoint that upserts a contact by its messaging-platform id (reusing the existing per-channel id column rather than adding a new one), and an in-chat path where an assistant reply that includes an extracted name updates the conversation's linked contact with no extra network call.
- Emphasized two correctness rules: do a targeted name-only update so unrelated contact fields (phone/email/etc.) are never wiped, and apply a storage-safe name cleanup (normalize alternate letter forms, collapse spacing) distinct from the aggressive search-normalizer used for matching.

## 0.3.29 - Audience Export Should Union All Phone Sources Note

- Added a public-safe note about audience exports that read only the fully-formed "contacts" table and therefore under-count: many numbers live as lighter "lead" records (captured from popups/forms) that were never promoted to a contact. Unioning both sources and de-duplicating by phone yields the full reachable audience.
- Documented preserving consent semantics across the union: consent/opt-out status is taken from the richer contact record, lead-only numbers default to opt-in, and suppression-list membership still forces opt-out — with totals computed over the de-duplicated set.

## 0.3.28 - Per-Integration Timeout Override Under A Fail-Fast Egress Policy Note

- Added a public-safe note about a subtle interaction between a hardened egress policy and a slow-but-legitimate upstream: when the platform clamps every outbound request timeout to a low value for admin responsiveness, a call to an assistant/service that needs several seconds will time out and the dependent automation silently does nothing — even though a manual shell request to the same upstream succeeds (it isn't subject to the platform-level filter).
- Documented the resolution: re-assert a longer timeout for only the specific integration's host via a late-priority request-args adjustment, so the global fail-fast protection stays in force for every other outbound call, and log upstream errors/empty responses behind a debug flag for fast diagnosis.

## 0.3.27 - Cache-Resilient CSRF Token For Public Widgets Note

- Added a public-safe note about a common failure mode for public AJAX widgets on full-page-cached sites: the CSRF token embedded in cached page HTML expires, so requests are rejected and the widget shows a generic error. The fix is to fetch a fresh token at runtime from an always-uncached endpoint on load and to retry once with a refreshed token when a request is rejected as a token failure.
- Noted that this also restores any downstream automatic behaviour gated on the request succeeding (e.g. an automated reply that only runs once the inbound message is accepted).

## 0.3.26 - Consent-Aware Contacts Export Endpoint Note

- Added a public-safe note about exposing a read-only, paginated contacts export for an outreach/messaging integration, authenticated with a dedicated, separately-revocable token (distinct from the main integration token) and disabled by default until that token is set.
- Documented honouring opt-out from every source of truth: the export treats a contact as opted-out if either the contact's consent field says so or the suppression/blacklist list contains the number, and supports an opt-in-only filter so the messaging side never contacts a suppressed number.
- Reiterated pagination and bounded page-size discipline for large directory exports, and constant-time token comparison for the access check.

## 0.3.25 - Optional AI Chat Auto-Reply With Human Handoff Note

- Added a public-safe note about an optional, default-off auto-reply for the website chat: when enabled, an external assistant service answers a visitor's message automatically and the answer is stored as a normal chat message, kept separate from the operator-facing "suggest a reply" capability so each can be toggled independently.
- Documented the human-handoff discipline: the conversation is flagged so the assistant stops and a human is notified both when the assistant itself signals a handoff and the moment any operator replies, so the bot never talks over a human. The after-hours canned message is suppressed while auto-reply is active to avoid conflicting automatic responses.
- Noted a self-healing schema pattern for adding a per-conversation metadata field on older installs (used to carry the paused flag) so the feature works immediately without a manual migration step.

## 0.3.24 - Calendar-Aware Date Sort-Key Note

- Added a public-safe note about normalizing dates before sorting a settlement ledger: manually-entered rows can carry a localized calendar/format (alternate digits, alternate separators, non-zero-padded, or a different calendar system) that a naive string sort misorders. Deriving a normalized canonical date key (converting digits, separators, padding, and calendar) before comparison makes every row sort at its true date regardless of how it was entered.

## 0.3.23 - Chronological Ledger Ordering Note

- Added a public-safe note about ordering settlement ledger lines (receipts and expenses) chronologically rather than by how they were assembled (manual entries before auto-generated ones), so the on-screen tables and the spreadsheet export both read in date order.

## 0.3.22 - Bounded Drill-Down Rendering Note

- Added a public-safe note about bounding how many rows a report drill-down renders at once: render the newest N (with the true total shown and a notice), rather than rendering every record in a bucket and performing per-row external lookups for each on a single load. This keeps "show the list behind this number" fast on large buckets without changing any matching, counting, or calculation logic, and lets the caller request a larger page when needed.

## 0.3.21 - Safe Indexing, Query Robustness, And Self-Service Completeness Note

- Added a public-safe note about adding a dedicated time index to the high-volume events table so time-ranged report drill-downs use an index instead of scanning, applied idempotently on activation/repair.
- Documented replacing an unbounded "build a giant id list in code then query it" pattern with an EXISTS subquery, so a "returning customers" style drill-down can't silently return nothing when the id list outgrows the database packet limit.
- Reiterated the per-request memoization discipline: existence/availability checks that were repeated inside a row loop should run once per request, not once per row.
- Added a public-safe note about completing a self-service surface: an address book that previously showed only a couple of fields read-only is now a full, validated, save-capable form for billing and shipping details.
- Documented resolving foreign-key identifiers to human-readable names (contact and owner) in back-office list views, with an explicit "showing first N rows" notice wherever a list is capped.

## 0.3.20 - Report Buckets On High-Performance Order Storage Note

- Added a public-safe note about extending storage-agnostic order reads from individual customer views to the aggregate management/range reports, so order-based report buckets (successful purchase, cancelled, failed), the funnel "purchased" stage, and failed/cancelled revenue sums stay correct when a store moves orders to a high-performance storage backend.
- Documented centralizing the "customers with orders in status X during range Y" lookup so a single storage-aware implementation feeds every report bucket and drill-down that depends on it, rather than duplicating storage assumptions across many call sites.
- Reiterated the gating discipline: each storage-backend branch is enabled only when that backend is actually active, with the original query retained as a fallback, so stores on the classic backend are byte-for-byte unchanged.

## 0.3.19 - Order Storage Compatibility, Drill-Down Performance, And Invoice Detail Note

- Added a public-safe note about keeping customer order history visible regardless of the commerce platform's order-storage backend: when a store moves orders to a high-performance storage engine, list views that read the legacy storage directly must fall back to a storage-agnostic lookup, and that fallback should be gated so stores on the legacy backend keep their fast path.
- Documented drill-down performance patterns for management reporting: caching per-customer order-status breakdowns, memoizing a repeated lookup so it runs once per customer per request instead of several times, and avoiding an extra lookup for customers with no orders — all aimed at keeping the "show the list behind this number" action responsive.
- Clarified an inclusive-date-range rule (the end day of a range must be fully included) and a status-labeling rule (show the platform's real status name, including custom statuses, rather than a raw internal slug) for order-history views.
- Added a public-safe note about a reporting-consistency fix: a daily trend chart must dedupe by customer the same way its headline metric does, so the chart total and the metric agree.
- Documented enriching a commission/settlement export's order rows with the product name(s) of each order so the invoice detail is self-explanatory.

## 0.3.18 - Operator Console Performance And Cross-Channel Reporting Note

- Added a public-safe note about keeping the operator console responsive by loading expensive per-row enrichments (product suggestions) lazily and cached, scoping lookup maps to the rows actually shown instead of scanning whole tables, and never performing a blocking external AI request during a list render.
- Documented counting in-progress orders via a paginated total rather than loading every record id, as a general pattern for portal summary widgets.
- Clarified a loyalty-points unit rule: in-store amounts captured in the display unit must be normalized to the same base unit as online amounts before points are computed, to avoid an order-of-magnitude under-award on stores configured in the smaller currency unit.
- Added public-safe notes about cross-channel reporting: combined online and in-store revenue summaries on one dashboard (with consistent unit normalization), and per-operator in-store sales (orders, gross, returns, net) attributed to the operator who booked them.
- Documented usability and honesty improvements: searchable in-store customer lists that span all dates, a visible loyalty points-history ledger, removing a perpetually-empty "pending" figure, and hiding navigation entries that have no implementation rather than showing blank panels.

## 0.3.17 - In-Person Orders Visibility And Integrity Note

- Added a public-safe note about always giving operators a direct, range-filtered list of the in-person orders that the summary counters already total, so a recorded sale is never counted-but-invisible, including walk-ins that are explicitly flagged as not yet linked to a customer record.
- Documented promoting a first-time walk-in into a managed customer record at the moment a sale is recorded, so the buyer appears in lists and reporting instead of existing only as a detached order.
- Clarified classification-integrity rules so an in-person customer is not silently reclassified by a later website interaction, and so records with a blank classification are still surfaced rather than disappearing from operational lists.
- Added a public-safe note about counting "today" against the store's local day and recording an audit entry whenever an in-person order is created or edited.
- Documented data-protection hardening as operational boundaries: keeping exported back-office data files out of public reach, neutralizing spreadsheet-formula injection in exports, requiring an action token on a data export, rate-limiting and minimizing the data returned by public lookup/submit endpoints, and constraining a call-recording download to a validated path.

## 0.3.16 - Editable In-Person Select Lists Note

- Added a public-safe note about allowing operators to extend structured in-person order select lists from inside the workflow instead of falling back to free-text fields.
- Documented clearer manual line-item insertion for cases where an in-person product is not represented by the online catalog.

## 0.3.15 - In-Person Store Operations Note

- Added a public-safe note about treating in-person store orders as managed CRM operations with editable customer records, structured payment/source/warehouse metadata, and financial history boundaries.
- Documented return and exchange adjustments as explicit operational events so totals and loyalty feedback can change without hiding what was exchanged or refunded.

## 0.3.14 - Clean Admin Export Route Note

- Added a public-safe note about serving finance spreadsheet exports without admin page chrome.
- Documented using a headerless export path so downloaded files contain only report data.

## 0.3.13 - Clean Finance Export Note

- Added a public-safe note about replacing cluttered report dumps with separated spreadsheet tabs for finance review.
- Documented exporting financial amounts as real spreadsheet number cells instead of formatted text.

## 0.3.12 - Commission Reconciliation Note

- Added a public-safe note about reconciling split-payment or adjusted orders so totals are counted once while payment shares remain visible.
- Documented why finance exports should expose final totals, main payment shares, and remaining collection shares separately.

## 0.3.11 - Commission Remaining Export Note

- Added a public-safe note about separating remaining/extra collection amounts from main product commission buckets.
- Documented a managerial spreadsheet export pattern for commission reports without exposing production order data.

## 0.3.10 - Checkout Acquaintance Reporting Note

- Added a public-safe note about showing checkout questionnaire distributions separately for successful orders and all orders.
- Documented using distinct chart treatments when two adjacent report cards share the same source field but different order scopes.

## 0.3.9 - Source Bucket Separation Note

- Clarified that operator-selected "purchased elsewhere" CRM statuses are a separate reporting bucket from order-attribution source reporting.
- Added a public-safe note about reconciling order-source reports with all successful orders, including Direct, Admin/Internal, Unknown, and checkout questionnaire buckets.

## 0.3.8 - Attribution And Dwell Reporting Note

- Added a public-safe note about deriving external-buyer buckets from order attribution metadata instead of manual CRM statuses.
- Documented event-grouped dwell and no-activity metrics, including warnings when tracking gaps make historical event-based reports incomplete.

## 0.3.7 - Report Lookup Performance Note

- Added a public-safe note about replacing per-record identity lookups in reporting code with a single bulk lookup map.
- Documented preserving lookup precedence while removing N+1 database queries from admin report render paths.

## 0.3.6 - Admin Report Filter Diagnostics Note

- Added a public-safe note about using plugin-specific admin report range parameters when generic date query names can be intercepted by security layers.
- Documented event-table diagnostics as a maintenance pattern for distinguishing empty reports from blocked requests or stale cached HTML.

## 0.3.5 - Direct Admin Route Guard Note

- Added a public-safe note about registering direct admin report routes defensively when an operations page is linked outside the normal menu flow.
- Documented guarded report rendering so runtime failures can surface as admin notices instead of missing-page symptoms.

## 0.3.4 - Report Range Resilience Note

- Added a public-safe note about bounding expensive reporting scans so wide date ranges do not destabilize an admin page.
- Documented cache-key refreshes as part of report performance fixes.

## 0.3.3 - Commission Rule Note

- Added a public-safe note that commission logic should separate category-based product rates from gateway-based payment adjustments.
- Documented mixed-order commission handling as an operational accuracy concern for reporting.

## 0.3.2 - Admin Origin Reliability Note

- Added a public-safe maintenance note for keeping CRM admin actions on the current WordPress admin origin in mixed host/proxy environments.
- Documented report/filter form actions as an operational reliability concern for date-range reporting.

## 0.3.1 - Mobile Floating UI Note

- Added a public-safe engineering note about keeping mobile support and promotion controls above changing bottom navigation and product action surfaces.
- Updated the README quality/failure-prevention path to include measured mobile placement as a maintenance concern.

## 0.3.0 - Activity Layer

- Added roadmap, known limitations, contribution notes, and issue template.
- Added repository, provider adapter, and audit logger samples.

## 0.2.0 - Engineering Case Study Rebuild

- Reworked README around production context, role boundaries, reporting cost, provider failure, and auditability.
- Added architecture map and operational tradeoffs.

## 0.1.0 - Initial Public Showcase

- Published public-safe CRM architecture overview and basic samples.

## Compatibility Notes

- Samples assume WordPress user/capability APIs.
- Provider adapters are illustrative and intentionally do not include real SMS/VoIP credentials or endpoints.
