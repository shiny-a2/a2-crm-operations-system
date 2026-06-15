# Changelog

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
