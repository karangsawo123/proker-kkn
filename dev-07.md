Kita masuk ke:

DEV-07 — SUPER ADMIN MANAGEMENT

Project:
PORTAL INFORMASI DESA BENDUNG

==================================================
PRE-DEV-07 — DEV-06 CLOSURE VERIFICATION
==================================================

Before implementing DEV-07, mechanically verify the completed
DEV-06 implementation.

Do NOT change product behavior merely to satisfy this preflight.

1. Framework/runtime:

Run using approved PHP 8.3:

php -v
php artisan --version

Expected:

PHP 8.3.x
Laravel Framework 13.x

Previous validated Laravel version:
13.25.0

If reporting metadata says Laravel 12 or another version,
correct REPORTING only after verifying actual installed framework.

Do NOT downgrade/upgrade framework during DEV-07 without a real need.

2. Migration integrity:

Confirm all 11 DEV-02 domain migration files remain unchanged.

Domain tables:
11

Framework metadata:
migrations only

No DEV-06 migration was added.

3. Route inventory:

Run:

php artisan route:list

Record exact current route count.

DEV-06 reports:
28 Admin Dusun routes.

Baseline before DEV-06:
13 routes.

Do not assume final total solely from arithmetic;
record actual Laravel route inventory.

Explicitly confirm Admin Dusun routes still contain:

restore routes = 0
force-delete routes = 0
category CRUD routes = 0
Admin-account management routes = 0
Dusun-status action routes = 0

4. Media runtime:

Verify PHP GD is active.

Verify WebP encode support exists if MediaService outputs WebP.

Verify processed file can be:

stored
read through configured public media path
rendered by existing Public Core.

Database must store storage-relative path only.

5. Soft Delete media:

Mechanically verify for:

Kontak
UMKM
Fasilitas
Agenda

Soft Delete parent does NOT remove retained media files.

This matters because Super Admin RESTORE is implemented in DEV-07.

6. Regression:

Run:

php vendor/bin/phpunit

Expected current baseline approximately:

168 passing tests
848 assertions

Use actual current numbers as authority.

If preflight passes:

DEV-06 = FINAL COMPLETE.

Then continue DEV-07.

==================================================
CURRENT DEVELOPMENT BASELINE
==================================================

DEV-01:
COMPLETE

DEV-02:
COMPLETE

DEV-03:
COMPLETE

DEV-04:
COMPLETE

DEV-05:
COMPLETE

DEV-06:
COMPLETE after preflight passes.

Implemented screen coverage so far:

UX-SCR-001–017

Public:
UX-SCR-001–009

Authentication:
UX-SCR-010

Admin Dusun:
UX-SCR-011–017

Remaining Super Admin screens:

UX-SCR-018–028

Formal Testing Specification v1.1:

108/108 NOT RUN

New/Open Change Requests:

0

Historical:

PDS-CR-001
APPROVED / APPLIED

==================================================
DEV-07 OBJECTIVE
==================================================

Implement the complete MVP:

SUPER ADMIN MANAGEMENT

for UX-SCR-018 through UX-SCR-028.

Screens:

UX-SCR-018
Dashboard Super Admin

UX-SCR-019
Kelola Identitas Desa

UX-SCR-020
Kelola Dusun

UX-SCR-021
Kelola Kontak Pelayanan

UX-SCR-022
Kelola UMKM

UX-SCR-023
Kelola Fasilitas

UX-SCR-024
Kelola Kategori Fasilitas

UX-SCR-025
Kelola Agenda & Kegiatan

UX-SCR-026
Kelola Pengumuman

UX-SCR-027
Data / Peta

UX-SCR-028
Kelola Admin Dusun

After DEV-07:

all 28 frozen screen/context definitions should have actual
implementation coverage.

High-Fidelity PNG coverage remains intentionally:

9/28

Do NOT create Batch 2 or Batch 3.

==================================================
PRIMARY FROZEN SOURCES
==================================================

Read before implementation:

docs/01-requirements/requirements-baseline.md

docs/02-product/PRD.md

docs/03-ux/sitemap.md

docs/03-ux/user-flows.md

docs/03-ux/ui-ux-specification.md

docs/03-ux/wireframe-specification.md

docs/03-ux/visual-design-specification.md

docs/04-system/roles-permissions.md

docs/04-system/erd-data-model.md

docs/04-system/physical-database-schema.md
v1.1 — FROZEN FOR MVP

docs/05-rnd/technical-rnd.md

docs/06-specification/SRS.md
v1.1 — FROZEN FOR MVP

docs/07-testing/testing-specification.md
v1.1 — FROZEN FOR MVP

Also inspect:

- DEV-03 models;
- DEV-04 Policies;
- DEV-05 Public controllers/views;
- DEV-06 Admin controllers/requests/views;
- MediaService;
- coordinate picker;
- map implementation.

==================================================
SUPER ADMIN AUTHORITY
==================================================

SUPER_ADMIN scope:

GLOBAL.

Super Admin manages:

- village identity;
- six existing Dusun;
- Kontak Pelayanan globally;
- UMKM globally;
- Fasilitas globally;
- Kategori Fasilitas;
- Agenda/Kegiatan DESA or DUSUN;
- Pengumuman DESA or DUSUN;
- map-centric Data/Peta context;
- Admin Dusun accounts.

Super Admin may also:

RESTORE
and
HARD_DELETE

eligible Soft Deleted operational resources.

Explicit frozen restrictions remain.

SUPER_ADMIN is NOT:

unconditional allow-all.

==================================================
NO GLOBAL GATE BYPASS
==================================================

Preserve DEV-04 authorization design.

Do NOT implement:

Gate::before(...)
that blindly allows every Super Admin action.

Explicit exceptions include:

Dusun hard delete = DENIED.

Admin account restore/reactivation = DENIED.

Other state-specific restrictions remain.

==================================================
UX-SCR-018 — DASHBOARD SUPER ADMIN
==================================================

Replace DEV-04 temporary Super Admin dashboard placeholder.

Dashboard navigation contains exactly these ten management areas:

1. Identitas Desa
2. Dusun
3. Kontak Pelayanan
4. UMKM
5. Fasilitas
6. Kategori Fasilitas
7. Agenda & Kegiatan
8. Pengumuman
9. Data / Peta
10. Admin Dusun

Use a Super Admin utility dashboard shell.

Desktop:
expanded sidebar by default.

Mobile:
navigation panel/drawer.

No Public/Admin-Dusun context selector in authentication.

Super Admin management filters may choose Dusun where relevant.

==================================================
SUPER ADMIN DASHBOARD SUMMARY
==================================================

Small operational counts are allowed if derived from existing data.

For example:

ACTIVE/INACTIVE Dusun
active UMKM
active Fasilitas
Agenda
Pengumuman
Admin Dusun accounts

Do NOT add:

analytics platform
visitor tracking
charts
KPI engine
traffic statistics

unless frozen source explicitly requires them.

==================================================
UX-SCR-019 — IDENTITAS DESA
==================================================

Implement management of the single Desa identity record.

Use exact physical schema columns.

No multiple Desa CRUD.

No:

Create second Desa
Delete Desa
Page Builder
Homepage ordering UI.

Super Admin may update supported identity/profile/contact/media
fields according to frozen schema.

Use existing MediaService where media fields apply.

No migration changes.

==================================================
DESA SINGLETON SEMANTICS
==================================================

Treat the frozen single Desa row as application identity context.

Do not introduce generic multi-tenant Desa switching.

If no row exists in development/test environment:

handle safely according to existing bootstrap/test strategy.

Do not silently create production village facts.

==================================================
UX-SCR-020 — KELOLA DUSUN
==================================================

Manage the existing six Dusun records.

Allowed Super Admin behavior:

VIEW
UPDATE supported profile
ACTIVATE
DEACTIVATE

No hard delete.

No soft delete.

No Add Dusun MVP flow.

Do NOT create:

Create Dusun button
Delete Dusun
Restore Dusun
Duplicate Dusun.

DATA-004 Add Dusun remains FUTURE.

==================================================
DUSUN STATUS
==================================================

Allowed status values exactly:

ACTIVE
INACTIVE.

Status changes must use explicit confirmation.

When changed to INACTIVE:

- row retained;
- children retained;
- Admin Dusun accounts retained;
- public Dusun/children hidden;
- bound Admin Dusun remains able to login/manage.

When changed back ACTIVE:

eligible non-Soft-Deleted children become public again.

Previously Soft Deleted children:

MUST NOT auto-restore.

Do not touch child deleted_at during status transition.

==================================================
DUSUN PROFILE VS STATUS
==================================================

Keep:

profile update

separate from:

activate/deactivate.

A profile Save action must not silently change status.

A status action must not overwrite unrelated profile fields.

==================================================
UX-SCR-021 — GLOBAL KONTAK PELAYANAN
==================================================

Implement global management:

List
Create
Edit
Soft Delete
Restore
Hard Delete when eligible.

Super Admin chooses target Dusun.

Dusun selection is required for this Dusun-owned resource.

Do not derive Super Admin resource scope from its own account dusun_id;
Super Admin has no OWN_DUSUN binding.

==================================================
UX-SCR-022 — GLOBAL UMKM
==================================================

Implement global:

List
Create
Edit
Soft Delete
Restore
Hard Delete.

Super Admin chooses target Dusun.

Reuse DEV-06:

- validation semantics;
- MediaService;
- product reconciliation;
- coordinate picker.

Produk UMKM remains parent-managed.

No independent Produk management page.

No commerce.

==================================================
UX-SCR-023 — GLOBAL FASILITAS
==================================================

Implement global:

List
Create
Edit
Soft Delete
Restore
Hard Delete.

Super Admin chooses:

Dusun
+
existing Kategori Fasilitas.

Coordinates required.

Category must belong to same Desa context.

Reuse coordinate/media behavior from DEV-06.

==================================================
UX-SCR-024 — KATEGORI FASILITAS
==================================================

This management area is SUPER ADMIN only.

Implement:

List
Create
Edit
Delete

using exact schema.

Business uniqueness remains:

category name unique per Desa
using frozen database constraint.

No Dusun ownership.

No category Soft Delete unless schema says so;
current physical design does not.

Delete behavior:

physical delete only when unused.

FK RESTRICT prevents deletion while referenced by Fasilitas.

==================================================
CATEGORY DELETE ERROR
==================================================

When an in-use category cannot be deleted:

- database remains unchanged;
- show safe actionable message;
- do NOT expose MariaDB constraint name;
- do NOT show SQL.

Do not automatically reassign Fasilitas.

Do not cascade-delete Fasilitas.

==================================================
UX-SCR-025 — GLOBAL AGENDA & KEGIATAN
==================================================

Implement global:

List
Create
Edit
Soft Delete
Restore
Hard Delete.

Super Admin form may choose:

scope_level:

DESA
or
DUSUN.

If:

DESA
→ dusun_id MUST be null.

If:

DUSUN
→ target Dusun REQUIRED.

desa_id remains root Desa.

UI must show conditional Dusun selector only for DUSUN scope.

==================================================
AGENDA TWO STATE AXES
==================================================

Keep separate:

EFFECTIVE LIFECYCLE:

AKAN_DATANG
BERLANGSUNG
SELESAI

from:

RECORD STATUS:

Active/non-Soft-Deleted
Soft Deleted.

Management filters and labels must not collapse these axes.

Examples:

SELESAI + Active
SELESAI + Soft Deleted

are conceptually different.

Never label Soft Deleted as SELESAI.

==================================================
UX-SCR-026 — GLOBAL PENGUMUMAN
==================================================

Implement global:

List
Create
Edit
Soft Delete
Restore
Hard Delete.

Super Admin may choose scope:

DESA
or
DUSUN.

Conditional Dusun selector as above.

Public lifecycle:

Aktif
Arsip

derived from:

tanggal_kedaluwarsa.

Record lifecycle:

Active/non-deleted
Soft Deleted.

These are independent.

==================================================
PENGUMUMAN — NO ARCHIVE ACTION
==================================================

Do NOT create:

Archive
Unarchive
Move to Archive

mutation.

Archive is derived from expiry.

A Soft Deleted announcement must never become publicly visible merely
because it is expired.

Restore only removes deleted_at;
public eligibility is then derived normally.

==================================================
SUPER ADMIN MANAGEMENT LIST — SOFT DELETE
==================================================

For exactly five operational resources:

KontakPelayanan
UMKM
Fasilitas
AgendaKegiatan
Pengumuman

Super Admin management area must provide a Record Status filter.

Conceptual values:

Aktif
Soft Deleted
All

or equivalent frozen UI wording.

Do NOT call:

Soft Deleted

"Arsip".

==================================================
RESTORE UI
==================================================

Restore is available only in applicable Super Admin management areas
for Soft Deleted records.

No generic global recycle bin.

No restore function in:

Data/Peta.

No Admin Dusun restore.

==================================================
HARD DELETE UI
==================================================

Hard Delete is destructive and must be visually separated.

Use explicit confirmation.

Copy must communicate:

permanent deletion
cannot be restored.

Do not confuse with:

Nonaktifkan / Soft Delete.

==================================================
HARD DELETE ELIGIBILITY
==================================================

For the five SoftDelete resources:

Super Admin Hard Delete should operate only against an already
Soft Deleted record unless a frozen source explicitly states otherwise.

Do NOT expose force-delete as the normal first deletion operation.

Normal lifecycle:

Active
→ Soft Delete / Nonaktifkan
→ Restore OR Hard Delete.

Server-side state validation is required.

==================================================
FK RESTRICTION ON HARD DELETE
==================================================

Respect MariaDB FK semantics.

Do NOT globally disable foreign key checks.

If target cannot be hard-deleted due to valid FK restrictions:

- abort atomically;
- retain data;
- return safe actionable feedback;
- do not expose SQL/constraint names.

==================================================
HARD DELETE + MEDIA CLEANUP
==================================================

This phase completes permanent file lifecycle.

For a hard-deleted parent with stored media:

1. collect media path(s);
2. perform authorized database hard delete safely;
3. only after successful DB deletion remove eligible filesystem files;
4. tolerate already-missing optional files safely;
5. do not leave DB row pointing at removed media on failure.

Relevant media:

Kontak photo
UMKM main photo
Fasilitas photo
Agenda media

and any other frozen operational parent media field.

==================================================
AGENDA HARD DELETE
==================================================

AgendaMedia database children use DB CASCADE.

Before force deleting an Agenda:

collect its media paths.

After successful database delete:

clean those media files.

Do NOT add observer cascade for database rows.

DB CASCADE remains authority.

==================================================
UMKM HARD DELETE
==================================================

ProdukUmkm children use DB CASCADE.

No duplicate model cascade observer.

If UMKM has main media:

clean file only after successful permanent DB delete.

==================================================
RESTORE + MEDIA
==================================================

Restore must NOT create or recreate media.

Retained media path/file from Soft Delete should simply remain available
when resource becomes eligible again.

If optional file is unexpectedly missing:

resource must degrade safely using placeholder.

Do not fail restore solely because an optional physical image is
missing unless frozen integrity requires otherwise.

==================================================
UX-SCR-027 — DATA / PETA
==================================================

CRITICAL FROZEN BOUNDARY:

Data/Peta is MAP-CENTRIC ONLY.

It is NOT:

Recycle Bin
Soft Deleted Manager
Generic CRUD
Generic Map Point Manager
Restore area
Hard Delete area.

Implement:

- global Dusun filter;
- global category filter;
- map canvas;
- markers;
- popup;
- source/context links.

No record mutation.

==================================================
DATA/PETA INTERNAL VISIBILITY
==================================================

Do NOT blindly reuse Public Core visibility scope.

This is an authenticated Super Admin management context.

Derive eligible operational map data according to the frozen Data/Peta
contract.

At minimum:

Soft Deleted records should not become mutation targets here.

Do not add restore/hard-delete controls.

If parent Dusun INACTIVE records are shown for internal management
context, clearly retain their Dusun/status context.

Read frozen UI/SRS before deciding exact internal projection.

Do NOT silently copy the public map query if that would hide records
Super Admin is supposed to inspect.

==================================================
DATA/PETA MARKER SOURCES
==================================================

No generic map table/model.

Sources remain:

Fasilitas
UMKM with coordinates
authorized/eligible Kontak Pelayanan coordinates

Taxonomy remains:

Semua
= UI only

UMKM
Pelayanan
dynamic Kategori Fasilitas.

No MapCategory persistence.

==================================================
DATA/PETA MAP FEATURES
==================================================

No:

map search
geocoder
Dusun polygon
drawing tools
generic marker CRUD.

Use existing Leaflet/configurable tile approach.

Production tile provider remains unresolved.

==================================================
UX-SCR-028 — KELOLA ADMIN DUSUN
==================================================

Super Admin manages:

ADMIN_DUSUN accounts only.

Do NOT provide:

Create Super Admin
Role selector
Promote to Super Admin
Change target role to SUPER_ADMIN.

Role is fixed:

ADMIN_DUSUN.

==================================================
ADMIN DUSUN ACCOUNT CREATE
==================================================

Create fields use exact schema/business requirements.

At minimum:

username
password
Dusun assignment.

Role:

server-forced ADMIN_DUSUN.

Dusun:

exactly one.

Username:

global unique.

Password:

secure Laravel hash.

Do not persist plaintext password.

==================================================
ADMIN ACCOUNT LIST
==================================================

Display both:

ACTIVE Admin Dusun account
and
LOGICALLY REMOVED retained identity

with distinct state.

Removed account row remains historical/read-only.

Do not remove it from DB.

==================================================
ACTIVE ADMIN ACCOUNT ACTIONS
==================================================

For eligible ACTIVE Admin Dusun account, Super Admin may perform:

- update/manage permitted account data;
- assign/reassign Dusun;
- reset password;
- logical removal.

Follow existing AdminAccountPolicy.

==================================================
REMOVED ADMIN ACCOUNT — READ ONLY
==================================================

For:

removed_at IS NOT NULL

the row is retained identity/history.

Do NOT expose:

edit/reassign
reset password
remove again
restore
reactivate
undelete
username reuse
merge identity.

This is NOT Soft Delete.

No generic restore semantics.

==================================================
LOGICAL REMOVAL
==================================================

Logical removal sets:

removed_at

according to frozen persistence.

After success:

- account cannot login;
- existing protected session loses access on next request through
  existing middleware;
- username remains globally reserved;
- identity row retained.

Do NOT hard delete the account.

==================================================
ADMIN ACCOUNT USERNAME
==================================================

Global username uniqueness includes removed rows.

Do NOT allow replacing a removed account using the same username.

Replacement account must have a different username.

Do not implement username recycling.

==================================================
RESET PASSWORD
==================================================

Super Admin may reset password of eligible ACTIVE Admin Dusun account.

Implement authenticated management action.

New password must be hashed through Laravel.

Do not expose current hash.

Do not implement:

email reset token
forgot-password flow
self-service recovery.

OPEN-010 Super Admin recovery remains unresolved/non-blocking.

==================================================
RESET PASSWORD UX
==================================================

Use a dedicated focused form/dialog consistent with frozen UX.

Require:

new password
confirmation

using frozen validation if exact rules exist.

Do not display existing password.

After reset:

old password must fail;
new password must authenticate.

Existing sessions:

follow frozen security/auth behavior if specified.

Do not invent global session revocation architecture unless required.

==================================================
ASSIGN DUSUN
==================================================

Super Admin may assign/reassign an ACTIVE Admin Dusun account to
exactly one existing Dusun.

Do not allow null assignment for ADMIN_DUSUN.

Do not allow assignment mutation on a removed account.

No multi-Dusun assignment.

==================================================
ACCOUNT ROLE-SCOPE INTEGRITY
==================================================

Database CHECK remains:

ADMIN_DUSUN
→ dusun_id non-null

SUPER_ADMIN
→ dusun_id null.

Normal account-management UI creates only ADMIN_DUSUN.

Do not create another Super Admin through this feature.

==================================================
SUPER ADMIN OWN ACCOUNT
==================================================

UX-SCR-028 is Admin Dusun account management.

Do not transform it into a generic account-management system.

Existing authenticated Super Admin account does not need to be editable
through the Admin Dusun list.

No Super Admin self-service recovery feature.

==================================================
GLOBAL RESOURCE CREATE — DUSUN OWNERSHIP
==================================================

For:

Kontak
UMKM
Fasilitas

Super Admin form may explicitly select target Dusun.

Server validation must ensure:

selected Dusun exists
and
belongs to current Desa context.

Do not trust arbitrary foreign IDs.

==================================================
GLOBAL RESOURCE UPDATE
==================================================

Where frozen behavior permits, Super Admin may change target Dusun
assignment for globally managed Dusun-owned resources if the schema and
UI contract allow it.

Do NOT assume reassignment is allowed solely because Super Admin is
GLOBAL.

Read frozen forms/specification.

If target Dusun field is not an editable frozen field:

keep binding unchanged.

==================================================
FORM REQUESTS
==================================================

Create dedicated Super Admin Form Requests or safely reusable request
logic.

Do NOT weaken Admin Dusun requests so that ADMIN_DUSUN can submit
Super Admin-only fields.

Role-specific validation/normalization must remain clear.

Do not rely on hidden form fields for security.

==================================================
SERVER-SIDE SCOPE
==================================================

All Super Admin writes still require:

Policy authorization
+
validated domain IDs
+
database constraints.

GLOBAL does not mean unvalidated payload.

==================================================
SUPER ADMIN ROUTE MIDDLEWARE
==================================================

All Super Admin management routes must use:

auth
admin.active
role:SUPER_ADMIN

Do NOT expose management routes publicly.

Do NOT share them with ADMIN_DUSUN.

==================================================
SUPER ADMIN ROUTE STRUCTURE
==================================================

Use conventional route families under:

/super-admin/...

Expected concepts:

super-admin.dashboard

super-admin.desa.*
super-admin.dusun.*
super-admin.kontak.*
super-admin.umkm.*
super-admin.fasilitas.*
super-admin.kategori-fasilitas.*
super-admin.agenda.*
super-admin.pengumuman.*
super-admin.data-peta.*
super-admin.admin-dusun.*

Exact URIs may be recorded as DEV07 implementation decisions where not
frozen.

==================================================
NO ADD DUSUN ROUTE
==================================================

Super Admin route inventory must contain:

Dusun create routes = 0
Dusun hard delete routes = 0
Dusun restore routes = 0.

Only profile/status management.

==================================================
DATA/PETA ROUTE BOUNDARY
==================================================

Data/Peta route may provide:

index/view/filter/map context.

It must contain:

create routes = 0
update routes = 0
delete routes = 0
restore routes = 0
force-delete routes = 0.

==================================================
SUPER ADMIN LAYOUT
==================================================

Create/reuse shared management shell appropriate for Super Admin.

Do not accidentally show Admin Dusun fixed-context semantics.

Always indicate:

Super Admin
Global management context.

Navigation:
ten management areas exactly.

Visual family:

Warm Natural
+
administrative utility density.

==================================================
RESPONSIVE MANAGEMENT UI
==================================================

No High-Fidelity PNGs exist for UX-SCR-018–028.

Implement from:

Wireframe
+
Visual Design Specification.

Desktop:
sidebar/table-oriented management.

Mobile:
navigation panel
stacked resource rows
usable forms
usable filters.

Visual polish can be refined later.

Do not create Batch 3.

==================================================
SUPER ADMIN LIST FILTERS
==================================================

Implement filters only where frozen/useful.

Likely contexts:

Dusun
Record Status
Scope
Agenda lifecycle
Pengumuman lifecycle
Category

Do not add broad arbitrary search/filter platform.

Do not create persisted filter state.

==================================================
SOFT DELETED FILTER
==================================================

Only Super Admin management areas for applicable resources show
Soft Deleted record state.

Use the SAME management area.

Do NOT create:

Recycle Bin page
Deleted Data dashboard
Soft Delete menu
Data/Peta deletion manager.

==================================================
DIRECT PUBLISH
==================================================

Valid Super Admin create/update changes take effect immediately
according to normal public eligibility.

No approval workflow.

Example:

DUSUN content under INACTIVE Dusun
→ write succeeds
→ remains hidden public.

DESA eligible content
→ publicly eligible according to lifecycle.

==================================================
MEDIA
==================================================

Reuse DEV-06 MediaService.

Do not create another incompatible upload pipeline.

Super Admin forms use the same safe:

MIME/signature validation
size/dimension handling
resize/compression
relative paths
WebP conversion

as applicable.

Hard-delete cleanup is the main new media lifecycle responsibility in
DEV-07.

==================================================
COORDINATE PICKER
==================================================

Reuse DEV-06 coordinate picker.

No geocoding search.

No polygon.

No automatic address-to-coordinate inference.

==================================================
APPLICATION VALIDATION
==================================================

All database integrity rules remain enforced.

Application layer must produce safe user-facing validation rather than
leaking MariaDB errors.

Especially test:

- conditional scope/Dusun;
- category FK;
- unique username;
- unique category name per Desa;
- coordinates;
- dates;
- account role/scope;
- removed target state.

==================================================
DESTRUCTIVE CONFIRMATIONS
==================================================

Distinguish visually and semantically:

Nonaktifkan
Restore
Hapus Permanen
Remove Account
Deactivate Dusun

They are different actions.

Do not use one generic "Delete" flow for all lifecycle semantics.

==================================================
NO MANUAL ORDERING
==================================================

Do not add:

priority
featured
sort order
drag/drop
homepage ordering.

No migration changes.

==================================================
NO NEW DOMAIN TABLES
==================================================

Expected migration changes:

ZERO.

Do NOT add:

roles
permissions
map_points
archives
admin_history
recycle_bin
password_reset_tokens
sessions
generic_media
audit_logs

or another table.

Laravel migrations metadata remains the only framework metadata table.

==================================================
DEVELOPMENT TESTS — SUPER ADMIN
==================================================

Add MariaDB-backed tests.

These remain DEVELOPMENT tests, not formal TC execution.

At minimum cover the following.

==================================================
DASHBOARD TESTS
==================================================

1. SUPER_ADMIN accesses real dashboard.

2. ADMIN_DUSUN is rejected from Super Admin area.

3. Ten management navigation areas exist.

4. Global context displayed.

==================================================
DESA TESTS
==================================================

5. Super Admin views Desa identity.

6. Super Admin updates allowed fields.

7. Admin Dusun cannot use endpoint.

8. No create-second-Desa route.

9. No Desa delete route.

10. Public Homepage reflects valid identity update.

==================================================
DUSUN TESTS
==================================================

11. List six existing Dusun.

12. Update supported Dusun profile.

13. ACTIVE → INACTIVE.

14. INACTIVE hides Public Dusun/children.

15. bound Admin remains able to login/manage.

16. INACTIVE → ACTIVE.

17. reactivation restores public eligibility only for non-Soft-Deleted
    children.

18. Soft Deleted child not auto-restored.

19. Add Dusun route absent.

20. hard-delete Dusun route absent.

==================================================
GLOBAL KONTAK TESTS
==================================================

21. Create for selected Dusun.

22. Update globally.

23. target Dusun validation.

24. Soft Delete.

25. Soft Deleted filter.

26. Restore.

27. Hard Delete Soft Deleted record.

28. media retained on Soft Delete.

29. media retained on Restore.

30. media cleaned after successful hard delete.

==================================================
GLOBAL UMKM TESTS
==================================================

31. Create selected-Dusun UMKM.

32. products reconcile.

33. Soft Delete.

34. Restore.

35. Hard Delete.

36. product DB CASCADE verified.

37. media cleanup after hard delete.

38. no commerce.

==================================================
GLOBAL FASILITAS TESTS
==================================================

39. Create selected-Dusun Fasilitas.

40. valid category selection.

41. coordinates required.

42. Soft Delete.

43. Restore.

44. Hard Delete.

45. media cleanup.

==================================================
KATEGORI TESTS
==================================================

46. Super Admin lists categories.

47. Create category.

48. Update category.

49. duplicate per Desa rejected safely.

50. delete unused category succeeds.

51. delete in-use category fails safely.

52. Fasilitas remains retained after failed restricted delete.

53. ADMIN_DUSUN cannot access mutation endpoint.

==================================================
GLOBAL AGENDA TESTS
==================================================

54. Create DESA Agenda.

55. DESA forces dusun_id null.

56. Create DUSUN Agenda with target Dusun.

57. DUSUN requires Dusun.

58. invalid conditional scope rejected.

59. update.

60. lifecycle status derived.

61. Soft Delete.

62. Record Status filter.

63. Restore.

64. Hard Delete Soft Deleted Agenda.

65. AgendaMedia DB cascade.

66. media files cleaned after hard delete.

67. Soft Delete does not remove Agenda media.

==================================================
GLOBAL PENGUMUMAN TESTS
==================================================

68. Create DESA Pengumuman.

69. Create DUSUN Pengumuman.

70. conditional Dusun validation.

71. Active/Arsip remains expiry-derived.

72. no Archive mutation.

73. Soft Delete.

74. Soft Deleted filter.

75. Soft Deleted absent Public archive.

76. Restore.

77. Restore recomputes normal public lifecycle.

78. Hard Delete Soft Deleted record.

==================================================
DATA/PETA TESTS
==================================================

79. Super Admin accesses Data/Peta.

80. Admin Dusun rejected.

81. Dusun filter exists.

82. category filter exists.

83. marker sources correct.

84. no generic marker CRUD.

85. no restore action.

86. no hard-delete action.

87. no search.

88. no polygon.

89. popup links to source/context management appropriately.

==================================================
ADMIN DUSUN ACCOUNT TESTS
==================================================

90. list Admin Dusun accounts only.

91. create ADMIN_DUSUN account.

92. role is forced ADMIN_DUSUN.

93. no role selector.

94. exactly one Dusun assignment required.

95. username unique.

96. removed username cannot be reused.

97. password stored hashed.

98. active account may be reassigned to Dusun.

99. removed account cannot be reassigned.

100. reset active Admin password.

101. old password fails after reset.

102. new password succeeds.

103. Admin Dusun cannot reset another account.

104. logical removal sets removed_at.

105. removed account cannot login.

106. previously authenticated removed account loses protected access
     on next request.

107. removed identity remains visible read-only to Super Admin.

108. removed account cannot be reset.

109. removed account cannot be removed again.

110. no restore/reactivate route.

111. no hard-delete route.

112. no create-Super-Admin path.

==================================================
CROSS-ROLE SECURITY TESTS
==================================================

113. Admin Dusun cannot access Desa management.

114. Admin Dusun cannot access Dusun lifecycle actions.

115. Admin Dusun cannot access Category mutation.

116. Admin Dusun cannot access Soft Deleted global filter endpoints if
     separate route behavior exists.

117. Admin Dusun cannot Restore.

118. Admin Dusun cannot Hard Delete.

119. Admin Dusun cannot manage Admin accounts.

120. Public User cannot access any Super Admin management route.

==================================================
DESTRUCTIVE STATE TESTS
==================================================

121. forceDelete active operational record is rejected.

122. forceDelete Soft Deleted eligible record succeeds.

123. restore active/non-trashed target rejected safely.

124. hard delete cannot bypass DB FK restriction.

125. Dusun hard delete denied regardless of SUPER_ADMIN.

126. removed AdminAccount is never treated as Soft Deleted.

==================================================
PUBLIC REGRESSION TESTS
==================================================

127. Super Admin update eligible resource reflected Public.

128. Soft Delete removes Public visibility.

129. Restore returns Public visibility only if otherwise eligible.

130. Hard Delete leaves no Public detail.

131. DUSUN content under INACTIVE parent remains non-public.

132. DESA scoped Agenda/Pengumuman public behavior remains correct.

==================================================
FORMAL TESTING BOUNDARY
==================================================

Testing Specification v1.1:

108 formal test cases.

Status remains:

108/108 NOT RUN.

Do NOT mark formal cases PASS.

DEV-07 development tests may overlap:

TC-SA-001–009
TC-AUTH
TC-DATA
TC-LIFE
TC-VAL
TC-ERR
TC-UI-005
TC-EXT

but are implementation/regression checks only.

==================================================
REGRESSION
==================================================

All previous development suites must remain PASS:

DEV-03 Persistence
DEV-04 Authentication
DEV-04 Authorization
DEV-05 Public
DEV-06 Admin Dusun

DEV-07 must not weaken OWN_DUSUN while adding GLOBAL workflows.

==================================================
ROUTE AUDIT AFTER DEV-07
==================================================

Report exact counts.

Explicitly confirm:

Dusun create routes = 0
Dusun hard-delete routes = 0
Dusun restore routes = 0

Data/Peta mutation routes = 0

Admin account restore routes = 0
Admin account hard-delete routes = 0
Create Super Admin routes = 0

Public registration routes = 0
Self-service password-reset routes = 0.

==================================================
SCHEMA INTEGRITY
==================================================

DEV-02 migrations expected changes:

0.

Domain tables:

11/11.

Unauthorized framework tables:

0.

Do not solve Super Admin features by changing schema.

==================================================
VISUAL / RESPONSIVE
==================================================

No High-Fidelity Batch 3.

For UX-SCR-018–028 use:

Wireframe Specification
+
Visual Design Specification.

Implement usable:

Desktop
Mobile.

Human visual refinement may occur later.

Functional/authorization correctness remains mandatory now.

==================================================
ACCESSIBILITY
==================================================

Maintain:

labels
field errors
focus visibility
keyboard navigation
accessible destructive confirmations
status text
responsive management navigation
table/mobile row semantics.

No certification claim.

==================================================
DEV IMPLEMENTATION DECISIONS
==================================================

Record minimum necessary implementation choices as:

DEV07-DEC-001
DEV07-DEC-002
...

Potential examples:

- Super Admin route naming;
- pagination;
- management filter query convention;
- hard-delete confirmation phrase;
- reset-password validation specifics where not numerically frozen;
- internal Data/Peta projection details allowed by source.

Do not turn them into frozen product requirements.

==================================================
CHANGE CONTROL
==================================================

Historical:

PDS-CR-001
APPROVED / APPLIED.

New Change Requests target:

0.

If implementation exposes a genuine frozen contradiction:

STOP affected feature.

Report exact source/requirement.

Do not silently reinterpret.

==================================================
VALIDATION COMMANDS
==================================================

Using PHP 8.3:

php -v

php artisan --version

php artisan route:list

php artisan migrate:status

php vendor/bin/phpunit

composer validate --strict

vendor/bin/pint --test

npm run build

Also verify:

GD/WebP support
media filesystem integrity
actual MariaDB test connection.

==================================================
DEV-07 COMPLETION CHECKLIST
==================================================

DEV-07 complete only when:

[ ] DEV-06 preflight PASS.
[ ] UX-SCR-018 implemented.
[ ] UX-SCR-019 implemented.
[ ] UX-SCR-020 implemented.
[ ] UX-SCR-021 implemented.
[ ] UX-SCR-022 implemented.
[ ] UX-SCR-023 implemented.
[ ] UX-SCR-024 implemented.
[ ] UX-SCR-025 implemented.
[ ] UX-SCR-026 implemented.
[ ] UX-SCR-027 implemented map-centric only.
[ ] UX-SCR-028 implemented.
[ ] Ten Super Admin areas exactly.
[ ] Global scope implemented server-side.
[ ] No Gate::before unrestricted bypass.
[ ] Desa singleton management.
[ ] No second Desa create.
[ ] Dusun ACTIVE/INACTIVE works.
[ ] No Add Dusun.
[ ] No Dusun hard delete.
[ ] Reactivation does not restore Soft Deleted children.
[ ] Global Kontak management.
[ ] Global UMKM management.
[ ] Global Fasilitas management.
[ ] Category management.
[ ] Category FK RESTRICT safe handling.
[ ] Agenda DESA/DUSUN scope.
[ ] Pengumuman DESA/DUSUN scope.
[ ] Five resources support Soft Deleted filter.
[ ] Restore only Super Admin.
[ ] Hard Delete only applicable Super Admin flow.
[ ] Hard Delete active records rejected.
[ ] Soft Delete media retained.
[ ] Restore media retained.
[ ] Hard Delete media cleanup safe.
[ ] Data/Peta has no CRUD.
[ ] Data/Peta has no restore/hard-delete.
[ ] Data/Peta has no search/polygon.
[ ] AdminAccount create ADMIN_DUSUN only.
[ ] No role selector.
[ ] Reset password works.
[ ] Logical removal works.
[ ] Removed identity retained.
[ ] Removed username remains reserved.
[ ] No account restore/reactivate.
[ ] No account hard delete.
[ ] Existing stale-session removal protection still works.
[ ] Direct publishing remains correct.
[ ] No migrations changed.
[ ] All previous regression PASS.
[ ] DEV-07 tests PASS.
[ ] Composer PASS.
[ ] Pint PASS.
[ ] Vite PASS.
[ ] Formal tests remain 108/108 NOT RUN.
[ ] Frozen docs unchanged.
[ ] High-Fidelity PNG unchanged.
[ ] New Change Requests = 0 if compatible.

==================================================
FINAL REPORT
==================================================

Report:

1. Phase
   DEV-07 — Super Admin Management

2. DEV-06 closure preflight

3. Environment
   PHP
   Laravel
   MariaDB
   GD/WebP
   Node/npm

4. Super Admin screen coverage
   UX-SCR-018–028 individually

5. Route inventory

6. Dashboard / ten management areas

7. Desa management

8. Dusun management
   ACTIVE/INACTIVE
   no Add/Hard Delete

9. Global Kontak

10. Global UMKM

11. Global Fasilitas

12. Kategori Fasilitas
    uniqueness/FK RESTRICT

13. Global Agenda
    DESA/DUSUN
    lifecycle/record axes

14. Global Pengumuman
    DESA/DUSUN
    Archive/record axes

15. Soft Delete management
    five resources
    filter/restore/hard-delete

16. Permanent media cleanup

17. Data/Peta
    map-centric boundary

18. Admin Dusun account management
    create
    assign
    reset password
    logical removal
    read-only removed identity

19. Security boundary / policy regression

20. Development decisions

21. Automated tests
    previous
    DEV-07
    total methods/assertions

22. Build/code quality

23. Schema/migration integrity

24. Formal Testing Specification
    108/108 NOT RUN

25. Frozen source integrity

26. Change control

27. Blockers

28. Completion:
    DEV-07 COMPLETE YES/NO

29. Readiness:
    READY FOR DEV-08 — SYSTEM HARDENING & FORMAL TEST EXECUTION
    YES/NO

STOP after DEV-07.

Do NOT begin formal Testing Specification execution yet.
Do NOT begin DEV-08 automatically.
Do NOT add production data.
Do NOT create Batch 2/3 mockups.