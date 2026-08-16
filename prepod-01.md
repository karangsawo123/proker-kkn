Kita masuk ke:

PREPROD-01 — PRODUCTION DECISIONS & OWNERSHIP

Project:
PORTAL INFORMASI DESA BENDUNG

==================================================
CURRENT PROJECT STATUS
==================================================

DEV-01 through DEV-08:
COMPLETE

Feature implementation:
28/28 screens/contexts implemented

Local MVP QA:
PASS

Formal Testing:
106 PASS
0 FAIL
2 BLOCKED
0 NOT RUN

Blocked formal cases:

TC-ENV-003
Candidate cPanel Hosting

TC-ENV-007
Production Tile Provider

Open defects:
0

Production release readiness:
BLOCKED

Current Git baseline:

branch:
experiment/public-core-enhancements

DEV-08 completion commit:
1ca20ea

Do NOT modify frozen product specifications.

Do NOT implement new product features.

Do NOT deploy production yet.

==================================================
PRIMARY OPERATIONAL DOCUMENT
==================================================

Use:

docs/08-operations/preproduction-readiness.md

as the working operational decision register.

Also read:

docs/07-testing/test-execution-report.md
docs/07-testing/defect-register.md
docs/05-rnd/technical-rnd.md
docs/06-specification/SRS.md
docs/04-system/physical-database-schema.md
docs/04-system/roles-permissions.md
docs/01-requirements/requirements-baseline.md

Do not modify frozen files unless a formally approved Change Request is
required.

==================================================
PREPROD-01 OBJECTIVE
==================================================

Resolve and document human/stakeholder production decisions required
before staging deployment.

This phase is NOT deployment.

This phase is NOT feature development.

Target outcome:

a production decision baseline sufficiently complete to begin:

PREPROD-02 — Staging Deployment.

==================================================
DECISION REGISTER
==================================================

Review all existing items in:

docs/08-operations/preproduction-readiness.md

At minimum cover these 14 operational items:

1. Candidate cPanel hosting/provider/package
2. Production domain
3. Production tile provider
4. Hosting/domain/account ownership
5. Billing contact
6. Recovery contact
7. Final Super Admin holder
8. Admin Dusun assignment for all six Dusun
9. Final WhatsApp message template — OPEN-002
10. Super Admin recovery procedure — OPEN-010
11. Actual launch dataset
12. Backup ownership and schedule
13. Post-KKN handover/supervisor
14. Final physical board / QR destination

For each item maintain:

Status
Decision
Owner
Evidence
Blocking Production YES/NO
Notes

Do NOT invent human names, credentials, domains, prices, or account
ownership.

==================================================
DECISION STATUS VOCABULARY
==================================================

Use:

OPEN
PROPOSED
APPROVED
BLOCKED
NOT APPLICABLE

Only mark APPROVED when the human/stakeholder has actually decided it.

==================================================
1. HOSTING DECISION
==================================================

TC-ENV-003 remains BLOCKED until a real candidate hosting target is
chosen.

Hosting candidate must be suitable for the frozen technical baseline:

PHP 8.3+
Laravel 13
MariaDB-compatible database
Composer/Laravel deployment support
configurable document root or Laravel-compatible public directory
persistent filesystem for media
environment variables
HTTPS
cron/scheduler capability if later required
backup capability
file permissions compatible with Laravel storage/cache
sufficient upload limits
cPanel-compatible shared hosting direction

Do NOT approve hosting based only on marketing claims.

Candidate must later be tested in PREPROD-02/03.

==================================================
HOSTING EVALUATION OUTPUT
==================================================

Once a human supplies one or more hosting candidates, prepare a
comparison covering:

PHP support
database engine/version
SSH availability
Composer availability
document-root configuration
storage permissions
SSL
backup
database limits
disk capacity
bandwidth
file upload limits
cron
support
account ownership
renewal/billing implications

Do not purchase anything automatically.

==================================================
2. DOMAIN DECISION
==================================================

Record:

final domain or subdomain strategy
registrar/account owner
renewal owner
DNS owner

Do NOT finalize QR destination until domain ownership and persistence
are considered stable.

Avoid tying printed physical QR directly to temporary local/staging
URLs.

==================================================
3. PRODUCTION TILE PROVIDER
==================================================

TC-ENV-007 remains BLOCKED until a real production provider is selected.

Remember:

Leaflet
=
map JavaScript library.

Leaflet is NOT the tile provider.

Current OpenStreetMap tile endpoint used during development does NOT
automatically become the approved production provider.

Production candidate must later be qualified for:

Terms of Use
attribution
expected load
quota/rate policy
availability expectations
browser access
HTTPS
cost
account/API-key ownership
failure behavior

Do NOT silently freeze a provider.

==================================================
4. ACCOUNT OWNERSHIP
==================================================

Determine operational ownership for:

hosting
domain
tile-provider account/API key
production database credentials
backup storage
Super Admin credentials

Prefer durable institutional ownership rather than temporary personal
ownership where practical.

Record who is responsible after the KKN team leaves.

Do not store passwords or secrets in the readiness document.

==================================================
5. SUPER ADMIN HOLDER
==================================================

OPEN-004 / related operational decision must identify who will hold
normal Super Admin responsibility after handover.

Record role/person responsibility only after stakeholder confirmation.

Do NOT create the production account yet unless explicitly instructed
later during data/setup phase.

==================================================
6. ADMIN DUSUN ASSIGNMENT
==================================================

Prepare an assignment matrix for exactly six existing Dusun.

For each Dusun record:

Dusun
Assigned Admin/operator
Confirmed YES/NO
Training required YES/NO
Account creation status

Do not invent the official six Dusun names if they are still unresolved.

Use actual final names only once supplied by stakeholder or launch
dataset.

Multiple Admin Dusun accounts per Dusun remain technically supported,
but operational assignment should reflect the agreed handover model.

==================================================
7. WHATSAPP TEMPLATE — OPEN-002
==================================================

Do not silently close OPEN-002.

Prepare a minimal proposal for stakeholder review.

The final template should avoid:

commerce language
automatic commitments
sensitive-data assumptions

It should remain an external WhatsApp handoff.

Only mark APPROVED after human decision.

==================================================
8. SUPER ADMIN RECOVERY — OPEN-010
==================================================

Do NOT add a public/self-service forgot-password feature.

Define an operational recovery procedure for Super Admin.

Potential procedure should consider:

authorized responsible person
identity verification offline
database/application access authority
credential reset steps
audit/record of recovery
handover contacts

Do NOT modify the product authentication model.

This is an operations runbook decision.

==================================================
9. LAUNCH DATASET
==================================================

Define what data must exist before launch.

At minimum consider:

Desa identity
six Dusun
Dusun profile
Kadus information
Kontak Pelayanan
UMKM
Fasilitas
Agenda if available
Pengumuman if available
map coordinates where applicable
Admin Dusun accounts

Do not require fake content just to fill sections.

"Belum ada data" remains valid for genuinely unavailable optional data.

==================================================
DATA COLLECTION WORKFLOW
==================================================

Prepare an operational data-entry workflow suitable for KKN collection.

Expected direction:

field interview/data collection
→ validation/permission check
→ login as assigned Admin Dusun
→ enter own-Dusun data
→ review public rendering
→ correction if necessary

Super Admin handles:

Desa-level content
categories
Dusun lifecycle
global correction/support
Admin account setup

Do not create approval workflow.

Direct publish remains frozen behavior.

==================================================
10. DATA PRIVACY / PUBLICATION CHECK
==================================================

Before launch data entry, establish an offline checklist for:

WhatsApp publication permission
personal photo publication permission
private/home location publication permission
accuracy of names/roles
map coordinate accuracy

Do NOT add consent tables or digital consent workflow.

==================================================
11. BACKUP OWNERSHIP
==================================================

Record:

who performs backups
frequency
where database backups are stored
where media backups are stored
who can restore
how often restore is tested

Do not freeze final backup retention unless stakeholder decides it.

Existing DEV-08 backup/restore verification is technical evidence, not
a final operational ownership decision.

==================================================
12. HANDOVER OWNERSHIP
==================================================

Identify:

post-KKN supervisor/operator
technical contact if available
Super Admin holder
hosting/domain owner
backup owner

Prepare responsibility boundaries.

Do not assume KKN students remain long-term operators.

==================================================
13. PHYSICAL BOARD / QR
==================================================

The MVP has:

one main information board
at Balai Desa

with one QR pointing to Homepage.

Per-Dusun QR remains FUTURE.

Do not introduce six Dusun QR boards.

Final QR should be generated only after production URL/domain is stable.

Physical-board copy/design may remain a separate operational task.

==================================================
14. RELEASE BRANCH / SOURCE BASELINE
==================================================

Do not modify source unnecessarily during PREPROD-01.

Record the source baseline:

branch
commit
working-tree status

If Git working tree is not clean:

report why.

Do not merge/rebase automatically without instruction.

==================================================
PREPROD-01 DOES NOT INCLUDE
==================================================

Do NOT:

deploy staging
deploy production
purchase hosting
purchase domain
create live database
insert official data
create production Admin accounts
print QR
change frozen schema
change authentication architecture
add features

This is a DECISION / OWNERSHIP phase.

==================================================
HUMAN DECISION REQUIRED
==================================================

If information is missing, explicitly list it as:

NEEDS HUMAN DECISION

Do NOT invent an answer.

Group questions so the team can answer them efficiently.

Prefer a compact decision checklist rather than asking one question at a
time.

==================================================
PREPROD-01 EXIT CRITERIA
==================================================

PREPROD-01 may be considered COMPLETE when at minimum:

[ ] Candidate hosting selected.
[ ] Domain strategy selected.
[ ] Production tile provider selected.
[ ] Hosting/domain owner identified.
[ ] Billing owner identified.
[ ] Recovery owner identified.
[ ] Super Admin holder identified.
[ ] Six-Dusun Admin assignment plan defined.
[ ] OPEN-002 WhatsApp template decided or explicitly deferred with owner.
[ ] OPEN-010 recovery procedure defined.
[ ] Launch dataset collection plan defined.
[ ] Backup owner/process defined.
[ ] Post-KKN handover owner defined.
[ ] Physical QR/domain dependency acknowledged.
[ ] No secrets stored in docs.
[ ] No product feature change.
[ ] No new CR unless genuinely required.

If hosting/tile choices are not yet decided:

PREPROD-01 remains IN PROGRESS.

==================================================
FINAL REPORT
==================================================

Report:

1. Phase:
   PREPROD-01 — Production Decisions & Ownership

2. Source baseline:
   branch
   commit
   Git status

3. Production decisions:
   APPROVED count
   PROPOSED count
   OPEN count
   BLOCKED count

4. Hosting:
   status
   selected candidate if human-approved

5. Domain:
   status

6. Tile provider:
   status

7. Account/ownership:
   status

8. Super Admin holder:
   status

9. Six-Dusun Admin assignment:
   status

10. WhatsApp OPEN-002:
    status

11. Super Admin recovery OPEN-010:
    status

12. Launch dataset:
    status

13. Backup:
    status

14. Handover:
    status

15. Physical board/QR:
    status

16. Remaining human decisions:
    exact list

17. New Change Requests:
    count

18. Blockers

19. PREPROD-01 COMPLETE:
    YES/NO

20. READY FOR:
    PREPROD-02 — STAGING DEPLOYMENT
    YES/NO

STOP.

Do NOT deploy automatically.