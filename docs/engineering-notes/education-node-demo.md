# Education interactive Node demo — November 2026

Education now has an independently packaged Node application for demonstrating the CRM and student-advisor journey. The demo runs without WordPress or the former parent application, while continuing to consume the pinned shared A2 CRM engine and its canonical access contracts.

A visitor starts a synthetic workspace and can switch between manager, consultant, student and reviewer views. Student consent and counselor review requests lead to the actual CRM queue and counseling-session lifecycle. The guide response is explicitly simulated; no external model, real customer messaging or payment service is connected.

The interface follows the current A2 visual family with Persian right-to-left layout, readable named form selections, a keyboard-accessible theme switch and mobile layouts. Synthetic browser checks cover role changes, consent, chat, counselor claim, session history and readonly behavior in light/dark themes at mobile and desktop widths. PostgreSQL/HTTP tests exercise tenant isolation, stale and mixed sessions, consent withdrawal, replay/conflict, failed provisioning and expiration.

The demo has a 30-minute access window and bounded visitor capacity. Synthetic history is retained; automatic data deletion is not claimed. Full academic guidance, expert-approved knowledge, durable conversation history, real-student privacy decisions and complete feature-parity acceptance remain separate work.

The [public demo](https://education.amiraliyaghouti.com/demo) was verified at its intended destination. WordPress is archived with a full private file/data backup and a disposable database restore comparison; its public routes are retired. Twenty public interactive browser cases and additional settled manager views were checked, alongside public session/tenant denial tests. No private source, customer records, infrastructure addresses or credentials are included in this showcase.
