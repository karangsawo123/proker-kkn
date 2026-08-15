Kita masuk ke tahap terakhir development/release qualification:

DEV-08 — SYSTEM HARDENING, FORMAL TEST EXECUTION & RELEASE READINESS

Project:
PORTAL INFORMASI DESA BENDUNG

==================================================
CURRENT STATUS
==================================================

DEV-01 Foundation:
COMPLETE

DEV-02 Physical Database:
COMPLETE

DEV-03 Domain Models:
COMPLETE

DEV-04 Authentication & Authorization:
COMPLETE

DEV-05 Public Core:
COMPLETE

DEV-06 Admin Dusun Management:
COMPLETE

DEV-07 Super Admin Management:
COMPLETE

Feature implementation coverage:

UX-SCR-001–028
=
28/28 IMPLEMENTED

Current development regression:

300 tests
1253 assertions
PASS

Current route inventory:

107 routes

Current runtime baseline:

PHP:
8.3.26

Laravel:
13.25.0

MariaDB:
10.4.32

Leaflet:
1.9.4

Domain tables:
11

Framework metadata tables:
1 (`migrations`)

Unexpected SQL tables:
0

==================================================
DEV-08 PURPOSE
==================================================

DEV-08 is NOT a feature-development phase.

Its purpose is:

1. harden the completed MVP;
2. execute the FROZEN formal Testing Specification;
3. record defects;
4. fix verified implementation defects;
5. rerun affected tests/regression;
6. qualify release/pre-production readiness;
7. produce final test evidence.

Do NOT add new product features.

==================================================
PRIMARY TEST SOURCE
==================================================

Use:

docs/07-testing/testing-specification.md
Version 1.1
Status FROZEN FOR MVP

as the formal test design authority.

DO NOT modify the frozen test specification.

Formal results must be stored separately.

==================================================
FORMAL TEST BASELINE
==================================================

Formal test cases:

108

Current formal execution status:

108/108 NOT RUN

Priority:

P0:
53

P1:
47

P2:
8

Automation candidate:

AUTOMATE:
72

MANUAL:
7

HYBRID:
29

Formal coverage includes:

Public User Flows:
10/10

Admin Dusun User Flows:
6/6

Super Admin User Flows:
9/9

Total User Flows:
25/25

Acceptance Criteria:
25/25

Authorization Invariants:
12/12

Data Integrity Rules:
35/35

Validation rules:
17/17

SRS NFR:
17/17

SRS Operations:
6/6

Regression groups:
7

Smoke tests:
14

==================================================
IMPORTANT GOVERNANCE RULE
==================================================

DO NOT convert the existing 300 development tests into automatic formal
PASS merely because they cover similar behavior.

Development tests may be used as EVIDENCE.

Each formal TC-* must still be:

- identified;
- mapped;
- executed or directly evidenced;
- evaluated against its exact preconditions/steps/expected result;
- assigned a formal execution status.

==================================================
FORMAL EXECUTION OUTPUT
==================================================

Create NEW execution artifacts.

Recommended:

docs/07-testing/test-execution-report.md

and:

docs/07-testing/defect-register.md

Optionally:

docs/07-testing/evidence/

for generated non-sensitive evidence.

Do NOT edit:

testing-specification.md

because it is frozen test design.

==================================================
TEST EXECUTION STATUS VOCABULARY
==================================================

For execution artifacts use:

PASS
FAIL
BLOCKED
NOT RUN

Do not invent another formal status unless required by the frozen
Testing Specification.

At DEV-08 start:

108 NOT RUN.

At completion target:

NOT RUN = 0

unless a genuine external pre-production dependency remains unavailable.

If dependency prevents execution:

mark BLOCKED,
not PASS.

==================================================
EXECUTION ORDER
==================================================

Run formal testing in risk order:

PHASE A:
P0 formal test cases.

PHASE B:
P1 formal test cases.

PHASE C:
P2 formal test cases.

PHASE D:
regression + smoke.

PHASE E:
release/pre-production qualification.

Do not start with visual polish while P0 security/integrity remains
untested.

==================================================
PRE-EXECUTION BASELINE
==================================================

Before formal execution record:

PHP executable
PHP version
Laravel version
MariaDB version
Node/npm
Leaflet version
Git status
route count
migration status
domain table inventory
framework table inventory

Run:

php -v
php artisan --version
php artisan route:list --json
php artisan migrate:status
php vendor/bin/phpunit
composer validate --strict
vendor/bin/pint --test
npm run build

Baseline expected:

300 development tests PASS.

If baseline fails:

STOP formal execution.

Fix regression first.

==================================================
TEST DATABASE
==================================================

Use:

portal_desa_bendung_test

or another explicitly disposable MariaDB test database.

Do NOT execute destructive tests against production data.

Verify:

MariaDB
not SQLite.

Business timezone tests:

Asia/Jakarta.

Synthetic fixture data only.

==================================================
TEST DATA
==================================================

Follow the frozen Testing Specification test-data strategy.

Use synthetic fixtures for:

- one Desa;
- six conceptual Dusun;
- ACTIVE and INACTIVE Dusun;
- Super Admin;
- multiple Admin Dusun;
- logically removed Admin account;
- active and Soft Deleted operational resources;
- UMKM with multiple products;
- resources with/without optional coordinates;
- used/unused facility category;
- DESA/DUSUN Agenda;
- Agenda lifecycle variations;
- Pengumuman active/archive/Soft Deleted;
- valid and invalid media;
- external dependency failure.

Do NOT treat synthetic names as official launch data.

==================================================
FORMAL TRACEABILITY MATRIX
==================================================

Build a formal execution matrix with one row for every TC ID.

Columns should include at minimum:

TC ID
Priority
Automation Candidate
Execution Method
Existing Development Evidence
Execution Date
Environment
Result
Evidence
Defect ID if failed
Notes

Target:

108 unique rows.

No missing TC ID.
No duplicate TC ID.

==================================================
AUTOMATED EVIDENCE MAPPING
==================================================

Before adding new automation:

map each formal AUTOMATE/HYBRID case against existing:

tests/Feature/Domain/*
tests/Feature/Auth/*
tests/Feature/Authorization/*
tests/Feature/Public/*
tests/Feature/Admin/*
tests/Feature/SuperAdmin/*
tests/Unit/*

Current suite:

300 tests.

Reuse existing tests where exact formal behavior matches.

Do NOT duplicate hundreds of tests merely to rename them TC-*.

==================================================
WHEN NEW AUTOMATION IS NEEDED
==================================================

If a formal test case is not adequately covered:

add a focused development/formal regression test.

Keep:

one source of behavior truth.

Do not modify production behavior just to satisfy a mistaken test.

If formal expected result conflicts with frozen higher authority:

STOP
and report contradiction.

==================================================
P0 SECURITY / AUTHORIZATION
==================================================

P0 cases must explicitly verify:

- login;
- removed account rejection;
- stale removed-account session;
- role separation;
- OWN_DUSUN isolation;
- direct foreign-ID access;
- Super Admin GLOBAL behavior;
- explicit authorization exceptions;
- Dusun hard-delete prohibition;
- Admin restore prohibition;
- Admin hard-delete prohibition;
- account lifecycle;
- public visibility;
- destructive integrity.

Do not rely on hidden UI controls.

Test server-side outcomes.

==================================================
AUTHORIZATION COVERAGE
==================================================

Formal target:

AUTH-INV-001–012
=
12/12 PASS.

Use:

TC-AUTH-001–012

one-to-one as defined by Testing Specification.

Also ensure relevant:

TC-AD
TC-SA
TC-DATA
TC-LIFE

support the same boundaries.

==================================================
DATA INTEGRITY FORMAL TESTING
==================================================

Formally verify:

11 domain/application tables.

Framework metadata:

migrations

allowed.

Expected physical SQL table count:

12

unless test-specific temporary structures are isolated outside target
schema.

Verify:

13/13 domain FKs
17/17 CHECK constraints
2/2 business UNIQUE
12/12 non-unique secondary indexes
11/11 PKs

TC-DATA-012 must use the PDS-CR-001 interpretation:

11 domain tables
+
allowed Laravel migrations metadata.

No:

users
sessions
cache
jobs
password reset
roles
permissions
generic media
map-point

tables.

==================================================
MARIADB CONSTRAINT EXECUTION
==================================================

Do not merely inspect migrations.

Exercise invalid/valid values for relevant:

status
role/scope
coordinate pair
coordinate range
Agenda date order
Agenda media role
Pengumuman scope
business uniqueness
FK RESTRICT
CASCADE

and record actual MariaDB outcome.

==================================================
LIFECYCLE TESTING
==================================================

Formally keep separate:

1. Operational Soft Delete
2. Dusun ACTIVE/INACTIVE
3. Admin Account LOGICAL REMOVAL
4. Agenda effective lifecycle
5. Pengumuman Active/Archive

No cross-lifecycle terminology drift.

==================================================
SOFT DELETE
==================================================

Applicable only to:

Kontak
UMKM
Fasilitas
Agenda
Pengumuman

Verify:

Admin:
Soft Delete own only
no Restore
no Hard Delete.

Super Admin:
Soft Delete
Restore
eligible Hard Delete.

Public:
Soft Deleted absent.

==================================================
DUSUN LIFECYCLE
==================================================

Verify:

ACTIVE
→ public eligible.

INACTIVE
→ hidden public.

Bound Admin:
can still login/manage.

Reactivation:
does NOT restore Soft Deleted children.

Hard Delete:
never available.

==================================================
ADMIN ACCOUNT LIFECYCLE
==================================================

Verify:

ACTIVE
LOGICALLY_REMOVED

Removed:

cannot login
retained in DB
username reserved
read-only
no reset password
no reassignment
no remove again
no restore
no reactivate
no hard delete.

Previously authenticated removed account:

next protected request loses access.

==================================================
AGENDA LIFECYCLE
==================================================

Formal date tests must freeze business date.

Use:

Asia/Jakarta.

Verify:

AKAN_DATANG
BERLANGSUNG
SELESAI

end null semantics
manual override
date order
optional time

No persisted effective/calculated status.

==================================================
PENGUMUMAN LIFECYCLE
==================================================

Verify:

expiry today:
ACTIVE

expiry yesterday:
ARCHIVE

expiry tomorrow:
ACTIVE

Archive:
publicly readable when otherwise eligible.

Soft Delete:
not public even if expired.

No archive mutation.

==================================================
VALIDATION FORMAL TESTING
==================================================

Execute:

SRS-VAL-001–017

through:

TC-VAL-001–017.

Verify both:

UI/application validation

and where applicable:

DB backstop.

Invalid input must not leak:

SQL
constraint names
stack traces
filesystem paths
secrets.

==================================================
MEDIA TESTING
==================================================

Formally verify:

valid image
invalid MIME
invalid signature
oversized file
dimension handling
resize/compression
WebP conversion if supported
relative path
replacement
optional media absence
Soft Delete retention
Restore retention
Hard Delete cleanup

No BLOB.

No absolute Windows path.

==================================================
FILE SECURITY
==================================================

Test:

path traversal filenames
double extensions
invalid MIME/signature
unexpected image payload

Application must reject unsafe file behavior.

Do not execute intentionally malicious payloads outside safe test files.

==================================================
PUBLIC TESTING
==================================================

Execute all:

TC-PUB-001–010.

Critical flows include:

QR/Homepage/Dusun
Peta marker/handoff
Kontak WhatsApp handoff.

Verify:

no login required
ACTIVE-only Dusun
empty states
exactly four detail types
no commerce
no unsupported feature.

==================================================
ADMIN DUSUN TESTING
==================================================

Execute:

TC-AD-001–006

plus authorization/validation/lifecycle cases.

Verify:

fixed OWN_DUSUN
no selector
six management areas
direct publish
INACTIVE parent management
no restore/hard delete/category/account management.

==================================================
SUPER ADMIN TESTING
==================================================

Execute:

TC-SA-001–009

plus authorization/lifecycle/integrity cases.

Verify:

GLOBAL scope
ten management areas
Desa identity
Dusun lifecycle
global operational management
categories
Agenda/Pengumuman scope
Data/Peta map-centric
Admin Dusun account management.

==================================================
MAP TESTING
==================================================

Verify:

Peta Desa:
Dusun + category filters.

Peta Dusun:
category only.

Data/Peta:
map-centric internal context.

Marker sources:

Fasilitas
UMKM with coordinates
eligible Kontak Pelayanan.

No:

generic map table
map search
polygons
internal route navigation.

==================================================
MAP PROVIDER FAILURE
==================================================

Test tile/provider failure.

Expected:

non-map page content remains usable.

No page-wide failure.

Record current development provider separately from future production
provider.

==================================================
EXTERNAL HANDOFF TESTING
==================================================

Execute:

TC-EXT-001–006.

Verify:

WhatsApp external handoff
Google Maps external handoff
Leaflet/provider behavior
media dependency
unsupported internal messaging/routing absent.

Do NOT silently finalize:

OPEN-002 WhatsApp exact copy.

==================================================
UI / RESPONSIVE FORMAL TESTING
==================================================

Execute formal:

TC-UI-*
TC-VIS-*

using:

Mobile
Desktop

and Tablet only as derived where the frozen test says applicable.

User has already approved functional continuation despite planned future
visual refinement.

Therefore distinguish:

VISUAL DEFECT
from
FUNCTIONAL DEFECT.

Minor aesthetic preference must not be converted into a product
requirement.

==================================================
ACCESSIBILITY SANITY
==================================================

Formally verify frozen direction:

keyboard navigation
focus visibility
heading hierarchy
labels/errors
touch usability
non-color-only states
semantic structures

Do NOT claim WCAG certification.

==================================================
ERROR / FAILURE TESTING
==================================================

Execute:

TC-ERR-001–008.

Include:

invalid form
authorization denial
missing resource
provider failure
media failure
DB/FK safe failure
empty state
unexpected server failure where safely simulatable.

No technical leakage.

==================================================
NFR / OPERATIONS
==================================================

Formal qualification target:

17/17 SRS NFR
6/6 SRS OPS.

Do not invent numerical SLA.

Evaluate against frozen qualitative direction.

==================================================
PRE-PRODUCTION ENVIRONMENT TESTS
==================================================

Execute:

TC-ENV-001–008

where prerequisites exist.

Important:

some ENV tests require candidate production infrastructure.

Examples:

PHP/Laravel runtime compatibility
MariaDB enforcement
cPanel-compatible hosting
HTTPS/debug/secrets
filesystem durability
backup/restore
production tile provider
handover/operability.

The frozen Testing Specification explicitly treats these as
pre-production qualification dependencies. :contentReference[oaicite:3]{index=3}

If hosting/tile provider/etc. has not yet been selected:

DO NOT PASS these tests artificially.

Mark:

BLOCKED

with exact external dependency.

==================================================
BACKUP / RESTORE
==================================================

TC-ENV-006 requires actual backup + restore verification.

Prepare a safe runbook covering:

database
media
config template without secrets

Restore into:

separate test environment.

Verify application/data/media usable.

Do not restore over current primary development DB.

==================================================
PRODUCTION-LIKE SECURITY CONFIG
==================================================

Qualification must eventually verify:

HTTPS
APP_DEBUG=false
secret keys not committed/exposed
secure session/cookie direction
CSRF
database least privilege where infrastructure supports it.

Do not alter local developer convenience configuration and call it
production-safe.

==================================================
HOSTING QUALIFICATION
==================================================

The project is not PRODUCTION READY merely because local tests pass.

Candidate hosting must be qualified for:

PHP 8.3+
Laravel 13
MariaDB semantics
document root
Composer/dependency deployment
filesystem permissions
persistent media
environment variables
routing
HTTPS
backup/restore
operational access.

==================================================
PRODUCTION TILE PROVIDER
==================================================

Current development OSM tile usage does NOT automatically freeze the
production provider.

TC-ENV-007 must evaluate selected production provider for:

policy
Terms
attribution
quota
expected traffic
browser compatibility
failure behavior.

Until selected:

TC-ENV-007 = BLOCKED.

==================================================
DEFECT REGISTER
==================================================

Create:

docs/07-testing/defect-register.md

Each defect should include:

Defect ID
Formal TC
Severity
Summary
Steps
Expected
Actual
Environment
Evidence
Root Cause
Fix
Retest
Status

Keep severity simple:

CRITICAL
HIGH
MEDIUM
LOW

Do not create issue bureaucracy beyond what is useful.

==================================================
DEFECT HANDLING
==================================================

When a formal TC FAILS:

1. record defect;
2. determine whether implementation or frozen requirement is wrong;
3. if implementation defect:
   fix minimal code;
4. rerun exact failed case;
5. run affected regression group;
6. update execution result.

If fixing requires changing frozen product behavior:

STOP.

Propose Change Request.

Do NOT silently modify specifications.

==================================================
P0 EXIT RULE
==================================================

Do NOT proceed to release readiness while any unresolved:

CRITICAL
or
P0 functional/security/integrity defect

remains.

Target:

P0:
53/53 PASS

or explicitly BLOCKED only by external environment prerequisite not
available yet.

No P0 FAIL.

==================================================
REGRESSION
==================================================

Testing Specification defines seven regression groups:

REG-PUBLIC
REG-AUTH
REG-ADMIN
REG-SUPERADMIN
REG-LIFECYCLE
REG-MAP
REG-VISUAL.

Execute relevant group after every defect fix.

At final local QA:

all seven regression groups should be executed.

==================================================
SMOKE SUITE
==================================================

Execute the defined:

14 P0/P1 smoke tests

after:

- final defect fixes;
- production-like configuration;
- deployment candidate, if available.

Smoke result must be recorded separately.

==================================================
DEVELOPMENT REGRESSION
==================================================

Keep running:

php vendor/bin/phpunit

Expected current baseline:

300 tests
1253 assertions

Numbers may increase if new tests are legitimately added.

Any regression failure must be fixed before formal closure.

==================================================
CODE QUALITY
==================================================

Final source validation:

composer validate --strict
vendor/bin/pint --test
npm run build

Expected:

PASS.

==================================================
SECURITY HARDENING REVIEW
==================================================

Audit completed implementation for:

- APP_DEBUG leakage;
- credentials/secrets committed;
- raw SQL error exposure;
- unsafe Blade raw rendering;
- unsafe JavaScript interpolation;
- upload path traversal;
- weak ownership validation;
- mass assignment widening;
- unsupported routes;
- CSRF;
- session regeneration;
- stale removed-account access;
- destructive action state validation.

Fix only genuine defects.

==================================================
DEPENDENCY AUDIT
==================================================

Review currently installed Composer/npm dependencies.

Report:

direct production dependencies
versions
unused packages if any
known-purpose classification

Do not perform arbitrary major upgrades during DEV-08.

Do not add dependency vulnerability claims without using available
package-manager evidence.

==================================================
NO FEATURE CREEP
==================================================

Do NOT add:

search
polygons
per-Dusun QR
UMKM gallery
citizen accounts
approval workflow
analytics
notifications
page builder
e-commerce
new roles

because testing exposed a convenience opportunity.

==================================================
FORMAL EXECUTION REPORT
==================================================

Create:

docs/07-testing/test-execution-report.md

This file is NOT a replacement for frozen Testing Specification.

Suggested final sections:

1. Document metadata
2. Execution environment
3. Source authority
4. Scope
5. Test data
6. Execution summary
7. P0 result
8. P1 result
9. P2 result
10. Results by TC group
11. 25 User Flow result
12. 25 Acceptance Criteria result
13. 12 Authorization Invariant result
14. 35 Data Integrity result
15. 17 Validation result
16. NFR/OPS result
17. External result
18. Environment qualification
19. Regression
20. Smoke
21. Defect summary
22. Blocked dependencies
23. Release-readiness assessment
24. Source integrity
25. Final conclusion

==================================================
DO NOT MODIFY FROZEN TEST DESIGN
==================================================

Keep:

docs/07-testing/testing-specification.md
v1.1
FROZEN FOR MVP

unchanged.

Execution evidence belongs to:

test-execution-report.md
defect-register.md

==================================================
LOCAL QA VS PRODUCTION READINESS
==================================================

DEV-08 must distinguish:

A.
LOCAL / DEVELOPMENT MVP QUALITY

and:

B.
PRODUCTION RELEASE READINESS.

It is valid to conclude:

LOCAL MVP QA:
PASS

while:

PRODUCTION READINESS:
BLOCKED

if external hosting/tile/domain/handover prerequisites are not resolved.

Never merge those concepts.

==================================================
PRE-PRODUCTION OPEN DEPENDENCIES
==================================================

Do not silently close unresolved upstream operational items such as:

official six Dusun names
final WhatsApp template
actual Super Admin holder
actual six-Dusun admin assignment
post-KKN supervisor
hosting/domain/account ownership
physical board content
production tile provider
Super Admin recovery
actual launch dataset

unless humans have supplied the final decision/data.

==================================================
FINAL LOCAL QA EXIT CRITERIA
==================================================

For LOCAL MVP QA COMPLETE target:

[ ] 108 formal TC accounted for.
[ ] No NOT RUN test that can be executed locally.
[ ] All local P0 PASS.
[ ] No Critical defect open.
[ ] No High security/integrity defect open.
[ ] 25/25 User Flow verified where executable.
[ ] 25/25 Acceptance Criteria verified where executable.
[ ] 12/12 Authorization Invariants PASS.
[ ] 35/35 Data Integrity Rules PASS.
[ ] 17/17 Validation PASS.
[ ] 7/7 regression groups executed.
[ ] 300+ development tests PASS.
[ ] Composer PASS.
[ ] Pint PASS.
[ ] Vite build PASS.
[ ] Frozen docs unchanged except NEW execution artifacts.
[ ] Migration/schema remains frozen-compatible.
[ ] No unapproved feature added.

==================================================
PRODUCTION RELEASE EXIT CRITERIA
==================================================

For PRODUCTION READY target additionally require:

[ ] Candidate hosting qualified.
[ ] PHP/Laravel runtime qualified.
[ ] MariaDB qualified.
[ ] HTTPS/security configuration qualified.
[ ] Production filesystem/media qualified.
[ ] Backup/restore successfully exercised.
[ ] Production tile provider qualified.
[ ] Domain/deployment configuration resolved.
[ ] Operational ownership documented.
[ ] Handover/training assets usable.
[ ] 14/14 smoke PASS on release/deployment candidate.
[ ] No blocking pre-production dependency remains.

==================================================
FINAL REPORT
==================================================

At completion report:

1. DEV-08 phase status

2. Execution artifacts created

3. Environment

4. Development regression:
   tests/assertions

5. Formal TC summary:
   PASS
   FAIL
   BLOCKED
   NOT RUN
   total = 108

6. Priority summary:
   P0
   P1
   P2

7. Automation mode summary:
   AUTOMATE
   MANUAL
   HYBRID

8. Public TC result

9. Admin Dusun TC result

10. Super Admin TC result

11. Authorization:
    12/12

12. Data integrity:
    35/35

13. Validation:
    17/17

14. User Flow:
    25/25

15. Acceptance Criteria:
    25/25

16. Lifecycle result

17. UI/responsive/visual result

18. External integration result

19. Environment qualification:
    TC-ENV-001–008 individually

20. Regression:
    7/7 groups

21. Smoke:
    14 cases

22. Defects:
    total/open/closed
    by severity

23. Code quality/build

24. Schema integrity

25. Security hardening

26. Frozen source integrity

27. Change Requests

28. Blocked external dependencies

29. LOCAL MVP QA:
    PASS/FAIL/BLOCKED

30. PRODUCTION RELEASE READINESS:
    PASS/FAIL/BLOCKED

31. Recommended next operational step

STOP after DEV-08.

Do NOT deploy automatically.
Do NOT insert production data automatically.
Do NOT modify frozen product requirements.