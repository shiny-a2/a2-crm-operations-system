# Education business settings candidate

Publication update, 2026-11-05: The confirmed presentation-settings behavior was subsequently published in the 0.1.5 synthetic demo. [Release evidence](education-demo-0.1.5-release.md). The candidate record below retains its original verification scope.

Education now has a locally verified business profile editor for the organization’s name, location and contact details. Managers review changes before saving; other authorized roles receive a readonly view. Persisted names appear in the CRM, and revision checks prevent an older form from overwriting a newer edit.

The profile uses a shared, versioned Core validation contract while retaining the existing business identity and permissions. Settings, change history and retry receipts commit together. Tests cover an interrupted response after a successful save: retrying the approved request produces one recorded change. Failed history writes roll back the change, and revoked permission cannot replay an old request. AI behavior and budgets remain with central A2 Intelligence.

The candidate passed 37 Education database, HTTP and compatibility tests and three shared-contract tests, along with build/type checks and interactive browser verification in light/dark mobile/desktop layouts. The existing catalogue, four-role demo and credential-entry browser gates also passed. These are local synthetic results; this candidate is not deployed. Real-business provisioning, account/license binding, uploads, broader branding and privacy/export administration remain open. Beauty’s current settings runtime is unchanged; adopting this contract there requires its own consumer verification.
