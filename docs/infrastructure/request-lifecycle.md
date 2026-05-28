# Request Lifecycle

The CRM path is an operational state path. Reads, writes, callbacks, audit events, and reports should not all behave like the same request.

```mermaid
flowchart TD
    A[Incoming request] --> B{Request type}
    B -->|chat/event intake| C[Validate source and payload shape]
    C --> D[Idempotency guard]
    D --> E[Write event and audit trail]
    B -->|operator inbox| F[Capability gate]
    F --> G[Read bounded assignment state]
    G --> H[Render inbox view]
    B -->|provider callback| I[Provider adapter boundary]
    I --> J[Normalize status]
    J --> E
    B -->|reporting| K[Read reporting snapshot]
    K --> L[Return manager view or export]
```

## Operating Notes

- Provider callbacks are network-boundary events, not trusted internal writes.
- Operator inbox reads should be bounded and state-aware.
- Reporting should read snapshots where possible instead of rebuilding every view from live operational tables.
- Audit writes belong on important state transitions, not only on error paths.

