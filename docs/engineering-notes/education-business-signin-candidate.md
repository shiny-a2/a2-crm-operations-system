# Education business sign-in candidate

Publication update, 2026-11-05: The public entry page was published in 0.1.5; real business credential access remains unavailable and the credential adapter remains a restricted local test capability. [Release evidence](education-demo-0.1.5-release.md). The candidate record below retains its original verification scope.

The Education source candidate now connects business sign-in to its existing shared CRM identity and permissions. After checking a username and password, it offers only the account’s authorized branches and opens the CRM in that branch. Removing branch access also prevents further use of an existing session. This avoids adding a separate user directory for the Education product.

The interface includes clear Persian errors, password visibility, keyboard-accessible branch selection, account context and sign-out feedback. The interactive public demo stays separate and continues to refuse real-account credentials. This candidate is enabled only in an isolated local test environment; it has not been deployed as production account access. Business provisioning, recovery, licensing and editable business settings remain open. AI behavior and cost control continue to belong to central A2 Intelligence.

Validation passed 25 automated database, HTTP and compatibility tests. Browser checks covered light and dark themes at mobile and desktop widths for the credential flow and the existing four-role demo. The build and type checks passed. These results support this bounded candidate; they do not establish whole-product readiness or owner acceptance.
