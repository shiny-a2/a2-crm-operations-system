# Failure Mode Matrix

| Failure mode | Likely cause | Detection signal | Safe behavior | Recovery path | What not to do |
| --- | --- | --- | --- | --- | --- |
| SMS provider failure | Provider outage or credential/config issue | Provider failure bucket rises | Mark message pending/failed visibly | Retry through adapter or switch provider | Hide failure from operators |
| VoIP callback delay | Network/provider delay | Late callback age | Accept late event idempotently | Reconcile against audit trail | Overwrite newer state blindly |
| Duplicate event ingestion | Provider retries or user double submit | Idempotency guard rejects duplicate | Keep first accepted event | Review duplicate key logic | Create duplicate customer tasks |
| Operator assignment race | Two operators claim same item | Conflicting transition attempt | Allow one transition, reject the other | Use atomic assignment rule | Last-write-wins without audit |
| Reporting query overload | Dashboard rebuilds live data | Slow dashboard and DB pressure | Serve snapshot or stale notice | Rebuild snapshot in background | Run heavy live report per view |

