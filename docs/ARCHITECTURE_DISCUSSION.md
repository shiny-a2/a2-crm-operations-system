# Architecture Discussion

The CRM architecture keeps workflow rules in services and data access in repositories. This is not ceremonial layering; it keeps provider calls, assignment rules, reporting reads, and audit behavior from becoming one large admin handler.

The main compromise is that WordPress gives convenient user/capability primitives but also encourages mixing UI, hooks, and data access. The public samples push against that by keeping boundaries explicit.

## Open Questions

- Which reports should be live and which should use snapshots?
- How much provider status should be stored before retention becomes a privacy concern?
- Should assignment locks be strict or advisory?

