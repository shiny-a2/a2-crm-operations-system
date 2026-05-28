# Observability And Instrumentation

The CRM needs enough visibility to explain operator workload and provider reliability without exposing customer conversations.

## Measure

- event ingestion count by type;
- duplicate event rejection count;
- provider success, failure, and timeout buckets;
- operator assignment changes;
- inbox queue age;
- reporting snapshot age;
- audit write failures.

## Do Not Log Publicly

- phone numbers;
- message bodies;
- customer names;
- order/customer identifiers;
- provider credentials;
- full callback payloads.

## Threshold Concepts

- provider failures above normal baseline;
- inbox queue age rising during business hours;
- duplicate callbacks increasing;
- reporting snapshot too stale for operational use;
- audit write failure on state-changing actions.

## Debug Workflow

1. Confirm whether the event entered through UI, intake, or provider callback.
2. Check idempotency result before investigating duplicate state.
3. Review provider adapter status, not raw provider payload.
4. Compare inbox state with audit history.
5. Rebuild reporting snapshots outside the operator critical path.

