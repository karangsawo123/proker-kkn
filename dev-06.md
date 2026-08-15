Kita masuk ke:

DEV-06 — ADMIN DUSUN MANAGEMENT

Project:
PORTAL INFORMASI DESA BENDUNG

==================================================
PRE-DEV-06 — CLOSE DEV-05 FIRST
==================================================

Before implementing ANY DEV-06 feature, perform these small DEV-05
closure normalizations.

1. Verify actual framework version using PHP 8.3:

php artisan --version

Expected current implementation:

Laravel Framework 13.25.0

The DEV-05 report incorrectly states "Laravel 12".

Correct reporting/walkthrough metadata to the ACTUAL installed version.

Do NOT downgrade Laravel.
Do NOT modify composer requirements.

2. Normalize public empty-state presentation.

Frozen canonical empty state:

"Belum ada data"

The implementation MAY retain contextual explanatory copy underneath.

Recommended pattern:

Belum ada data
Belum ada pengumuman aktif.

or:

Belum ada data
Belum ada UMKM yang terdaftar.

The canonical phrase "Belum ada data" must be present consistently.

Do NOT fabricate records.

3. Normalize visual-review reporting.

Do NOT report:

100% pixel parity

unless objectively measured.

Use:

Human Visual Review:
APPROVED FOR FUNCTIONAL CONTINUATION

Visual refinement:
DEFERRED / may be refined later by human review.

This does NOT reopen Visual Design or High-Fidelity sources.

4. Re-run affected Public tests.

If all pass:

DEV-05 status becomes:

FINAL COMPLETE.

Then and only then continue DEV-06.

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
FINAL COMPLETE after the preflight above passes.

Current implementation baseline includes:

Laravel:
13.x
(expected installed 13.25.0; verify mechanically)

PHP:
8.3.26

MariaDB:
10.4.32

Domain tables:
11/11

Domain models:
11/11

Domain relationships:
13/13

Authentication:
COMPLETE

Authorization:
12/12 Authorization Invariants development-tested

Public Core:
UX-SCR-001–009 IMPLEMENTED

Admin Login:
UX-SCR-010 IMPLEMENTED

Formal Testing Specification:
108/108 NOT RUN

Open Change Requests:
0

==================================================
DEV-06 OBJECTIVE
==================================================

Implement the complete MVP ADMIN DUSUN MANAGEMENT surface:

UX-SCR-011 through UX-SCR-017.

Screens:

UX-SCR-011
Dashboard Dusun

UX-SCR-012
Kelola Profil Dusun

UX-SCR-013
Kelola Kontak Pelayanan

UX-SCR-014
Kelola UMKM

UX-SCR-015
Kelola Fasilitas

UX-SCR-016
Kelola Agenda & Kegiatan

UX-SCR-017
Kelola Pengumuman

DEV-06 is the write-side for:

ADMIN_DUSUN
OWN_DUSUN only.

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

Also inspect actual implementation from:

DEV-02 migrations
DEV-03 models
DEV-04 Policies/Auth
DEV-05 Public Core

==================================================
ADMIN DUSUN AUTHORITY
==================================================

Frozen scope:

ADMIN_DUSUN
=
OWN_DUSUN ONLY.

Admin Dusun may manage:

- own Profil Dusun;
- own Kontak Pelayanan;
- own UMKM + Produk UMKM;
- own Fasilitas;
- own Agenda/Kegiatan DUSUN;
- own Pengumuman DUSUN;
- location/media through their parent resources.

Admin Dusun may:

CREATE
VIEW
UPDATE
SOFT_DELETE

where applicable.

Changes apply directly without approval.

Admin Dusun SHALL NOT:

- access another Dusun;
- select/switch Dusun;
- manage Desa-level content;
- manage Kategori Fasilitas;
- create/manage Admin accounts;
- reset passwords;
- change Dusun ACTIVE/INACTIVE status;
- RESTORE;
- HARD_DELETE;
- manually prioritize/order data.

==================================================
OWN_DUSUN — CRITICAL SECURITY RULE
==================================================

Never accept client input as ownership authority.

Do NOT trust:

dusun_id
desa_id
scope_level

submitted by Admin Dusun.

For every create/update operation derive server-side:

authenticated AdminAccount.dusun_id

and corresponding Desa context.

A malicious request containing:

dusun_id = another Dusun

must NOT create/update a foreign record.

OWN_DUSUN must be enforced by:

- authenticated identity;
- Policy;
- server-side scoped query.

UI hiding is not sufficient.

==================================================
INACTIVE DUSUN
==================================================

Admin whose bound Dusun is:

INACTIVE

must still:

- login;
- access Dashboard;
- access all six management areas;
- create/update/manage permitted OWN_DUSUN data.

Dashboard must display an informational notice that the Dusun is
currently INACTIVE publicly.

Admin must NOT see:

Activate
Reactivate
Change Status

action.

Only Super Admin controls Dusun status.

Public behavior remains:

INACTIVE Dusun and children are hidden publicly.

==================================================
UX-SCR-011 — DASHBOARD DUSUN
==================================================

Replace the temporary DEV-04 Admin Dusun dashboard placeholder with
the real UX-SCR-011.

Must show:

- ADMIN DUSUN role/context;
- fixed current Dusun identity;
- no Dusun selector;
- navigation to exactly six management areas:

1. Profil Dusun
2. Kontak Pelayanan
3. UMKM
4. Fasilitas
5. Agenda & Kegiatan
6. Pengumuman

Desktop:

expanded/persistent sidebar by default,
collapsible if implementation remains simple.

Mobile:

navigation panel/drawer.

No new management area.

==================================================
DASHBOARD SUMMARY
==================================================

Small summary counts MAY be shown if derived from existing data.

Examples:

active Kontak
active UMKM
active Fasilitas
Agenda count
Pengumuman count

Do NOT create:

analytics
charts
KPIs
traffic tracking
visitor statistics

not present in frozen requirements.

If summaries are used:

active/non-Soft-Deleted data only unless clearly labeled otherwise.

==================================================
ADMIN MANAGEMENT LIST PATTERN
==================================================

For UX-SCR-013–017:

Desktop:

page title
+
primary Create action
+
optional lifecycle/filter context
+
table
+
row actions.

Mobile:

page title
+
Create
+
stacked management cards/rows.

Normal Admin Dusun list SHALL display only:

non-Soft-Deleted records.

After Admin selects:

Nonaktifkan

the record must leave the normal list.

DO NOT provide:

Soft Deleted tab
Recycle Bin
Deleted filter
Restore
Hard Delete

for Admin Dusun.

==================================================
ADMIN EMPTY STATES
==================================================

Management empty state should:

- clearly state there is no current data;
- provide Create action where actor has CREATE permission.

Do not fabricate data.

Public canonical "Belum ada data" does not require every Admin
management empty state to use identical public copy.

==================================================
CREATE / EDIT PRESENTATION
==================================================

Create/Edit is a state of the management area.

Do not add new Sitemap page types.

Implementation MAY use conventional nested route/form pages.

UI structure:

Page title
Field groups
Validation
Cancel
Save

No wizard.

Mobile:
single-column.

Desktop:
grouping/two-column only where reading order remains clear.

==================================================
SAVE ACTION ORDER
==================================================

Preserve Wireframe decision:

Cancel / Back
then
Save

Destructive Nonaktifkan must not visually compete with Save.

==================================================
DIRECT PUBLISH
==================================================

Valid Admin Dusun creates/updates:

take effect immediately according to:

- record lifecycle;
- parent Dusun eligibility;
- expiry/date lifecycle;
- privacy precondition.

There is NO:

Submit for Approval
Request Review
Approve
Reject
Moderation Queue.

==================================================
FORM REQUESTS
==================================================

Implement focused Laravel Form Requests for Admin Dusun writes.

Do NOT accept broad `$request->all()` persistence.

Do NOT loosen model mass assignment to:

$guarded = []

Existing conservative model guarding should remain.

Map validated fields explicitly to models.

Application validation is required even though MariaDB CHECK
constraints already exist.

==================================================
VALIDATION ERROR UX
==================================================

Validation failures must:

- preserve safe submitted values;
- associate errors with fields;
- show concise error summary where appropriate;
- not expose SQL;
- not expose CHECK/FK constraint names;
- not expose filesystem paths;
- not expose stack traces.

Prevent double submit through UI submitting/loading state.

==================================================
UX-SCR-012 — KELOLA PROFIL DUSUN
==================================================

Implement OWN_DUSUN profile editing.

Use exact columns supported by Physical Database Schema.

Conceptually supported profile fields include:

- nama Dusun;
- optional banner/foto;
- deskripsi singkat;
- nama Kepala Dusun;
- jumlah RT;
- jumlah RW.

Read actual migration/schema before mapping exact field names.

Admin may edit supported own profile fields including name.

Admin SHALL NOT edit:

- desa_id;
- status_dusun;
- another Dusun;
- account binding.

No Dusun selector.

Display current status as read-only context only if useful.

If INACTIVE:

display informational notice.

No activation control.

==================================================
UX-SCR-013 — KELOLA KONTAK PELAYANAN
==================================================

Implement:

List
Create
Edit
Nonaktifkan / Soft Delete

OWN_DUSUN only.

Use exact schema columns.

Frozen form semantics:

Required:

- nama;
- jabatan/role text;
- WhatsApp.

Optional:

- foto;
- alamat;
- latitude;
- longitude.

Coordinate pair:

both NULL
OR
both provided.

Latitude:
-90..90

Longitude:
-180..180

No status column.

`deleted_at` is the sole operational active/nonactive representation.

Do NOT create:

is_active
status_kontak
active checkbox.

==================================================
KONTAK PRIVACY
==================================================

Do NOT add:

consent checkbox
consent database field
upload surat izin
digital approval workflow.

Offline publication permission is a precondition.

A short informational helper may remind Admin that personal/private
location should only be entered if publication permission has been
obtained.

That helper must NOT become a digital consent record.

==================================================
UX-SCR-014 — KELOLA UMKM
==================================================

Implement:

List
Create
Edit
Nonaktifkan / Soft Delete.

Fields according to actual schema/frozen contract include:

- nama;
- pemilik;
- jenis;
- deskripsi;
- alamat;
- WhatsApp;
- jam operasional;
- optional one main photo;
- optional latitude/longitude pair.

Produk UMKM:

repeatable child rows within parent form.

Admin can:

add product row
edit product row
remove product row

through parent UMKM management.

Products have no independent management area.

==================================================
UMKM TRANSACTION BOUNDARY
==================================================

Use a database transaction for UMKM + product reconciliation.

If parent or child persistence fails:

do not leave partially updated product state.

Use the existing DB CASCADE only for actual parent hard-delete behavior
later; Admin Dusun does not hard-delete UMKM.

Do NOT duplicate cascade with observers.

==================================================
UMKM — NO COMMERCE
==================================================

Do NOT introduce:

price
stock
SKU
currency
cart
checkout
payment
order
purchase
marketplace CTA.

Produk are informational only.

==================================================
UX-SCR-015 — KELOLA FASILITAS
==================================================

Implement:

List
Create
Edit
Nonaktifkan / Soft Delete.

Admin chooses an existing:

Kategori Fasilitas.

Admin may VIEW/use available categories.

Admin may NOT:

create
rename
delete
manage

Kategori Fasilitas.

Category must belong to the same Desa context.

Use exact schema fields.

Coordinates:

REQUIRED.

Latitude:
-90..90

Longitude:
-180..180

Optional:

photo
WhatsApp

as frozen.

==================================================
UX-SCR-016 — KELOLA AGENDA & KEGIATAN
==================================================

Implement:

List
Create
Edit
Nonaktifkan / Soft Delete.

For Admin Dusun:

scope is ALWAYS:

DUSUN.

Set server-side:

scope_level = DUSUN

dusun_id = authenticated own Dusun

desa_id = parent Desa

Do NOT display editable:

scope selector
Dusun selector.

A read-only context label such as:

Scope: Dusun
[Nama Dusun]

is appropriate.

==================================================
AGENDA FIELDS
==================================================

Use exact migration/schema.

Frozen form concept includes:

- title;
- description/content;
- tanggal mulai;
- optional tanggal selesai;
- optional time;
- location;
- optional manual status override;
- media.

Date rule:

tanggal_selesai
must be null or >= tanggal_mulai.

When end is null:

start acts as effective end.

==================================================
AGENDA STATUS AXES
==================================================

Display lifecycle status separately from record lifecycle.

Effective Agenda status:

AKAN_DATANG
BERLANGSUNG
SELESAI

derived from date/time plus optional manual override.

Operational lifecycle:

active/non-Soft-Deleted
or
Soft Deleted.

For Admin normal list:

Soft Deleted records are absent.

Do NOT call a Soft Deleted Agenda:

SELESAI.

Do NOT call SELESAI:

Nonaktif.

==================================================
AGENDA MANUAL OVERRIDE
==================================================

Allowed values:

null
AKAN_DATANG
BERLANGSUNG
SELESAI

Use exact frozen value set.

Do not persist:

effective_status
calculated_status.

==================================================
AGENDA MEDIA
==================================================

Agenda may have repeatable media through:

agenda_medias.

Allowed media roles:

POSTER_AWAL
DOKUMENTASI.

Admin manages Agenda media only through the parent Agenda.

No independent Media management page.

Do not create generic Media model/table.

==================================================
UX-SCR-017 — KELOLA PENGUMUMAN
==================================================

Implement:

List
Create
Edit
Nonaktifkan / Soft Delete.

Admin scope is ALWAYS:

DUSUN / OWN_DUSUN.

Set server-side:

scope_level = DUSUN
dusun_id = authenticated Dusun
desa_id = parent Desa.

No scope selector.
No Dusun selector.

Fields use actual schema and frozen contract:

- title;
- content;
- tanggal kedaluwarsa.

==================================================
PENGUMUMAN LIFECYCLE AXES
==================================================

List may distinguish:

Aktif
Arsip/Kedaluwarsa

as expiry-derived PUBLIC lifecycle context.

Separately:

Soft Deleted records are absent from Admin normal list.

Do NOT provide:

Archive action
Move to Archive
Restore
Hard Delete.

Expiry determines archive automatically.

Record Nonaktifkan remains Soft Delete.

==================================================
BUSINESS DATE
==================================================

Pengumuman lifecycle calculations use:

Asia/Jakarta.

Do not use uncontrolled machine-local date.

Reuse DEV-03/05 lifecycle semantics rather than introducing a second
interpretation.

==================================================
SOFT DELETE ACTION
==================================================

For exactly:

KontakPelayanan
Umkm
Fasilitas
AgendaKegiatan
Pengumuman

Admin may perform:

Nonaktifkan

on OWN_DUSUN record.

Implementation should call normal Soft Delete semantics.

After success:

- row retained;
- deleted_at populated;
- public projection hides it;
- Admin normal list hides it.

No restore route.

No forceDelete route.

==================================================
SOFT DELETE CONFIRMATION
==================================================

Use a clear confirmation.

Explain conceptually:

"Data akan dinonaktifkan dan tidak lagi tampil di halaman publik."

Do NOT say:

"hapus permanen".

Do NOT label Soft Delete as:

Arsip

especially for Pengumuman.

==================================================
COORDINATE PICKER
==================================================

Implement reusable coordinate input for:

Kontak Pelayanan
UMKM
Fasilitas

using existing Leaflet foundation.

Support:

1. map click;
2. manual latitude input;
3. manual longitude input.

No:

location search
geocoding search
Dusun polygon.

Production tile provider remains unfrozen.

Reuse configurable tile provider approach from DEV-05.

==================================================
COORDINATE RULES
==================================================

Kontak:
optional pair.

UMKM:
optional pair.

Fasilitas:
required pair.

Never silently infer coordinates from typed address.

Do not geocode automatically.

==================================================
MEDIA / FILE UPLOAD SCOPE
==================================================

DEV-06 MUST implement the media behavior necessary for Admin Dusun
forms because media is part of UX-SCR-012–016.

Relevant optional media include:

Profil Dusun banner
Kontak photo
UMKM main photo
Fasilitas photo
Agenda media

Use exact physical schema paths.

Do NOT create new DB columns or media tables.

==================================================
MEDIA STORAGE BOUNDARY
==================================================

Database stores:

storage-relative reference/path.

Never store:

absolute Windows path
absolute hosting path
binary BLOB.

Use Laravel filesystem abstraction.

Prefer a configurable media disk.

For example an environment/config implementation may define:

MEDIA_DISK

with a safe local/default disk.

Do not freeze the final hosting filesystem root.

==================================================
MEDIA PROCESSING PRECHECK
==================================================

Before selecting image-processing implementation:

inspect PHP 8.3 environment for available image extensions such as:

GD
Imagick

and supported formats.

Frozen SRS requires uploaded image processing to include:

- MIME/signature validation;
- allowed image type validation;
- size validation;
- dimension validation;
- resize;
- compression;
- modern web format conversion when supported.

Exact library remains implementation-level.

==================================================
MEDIA PROCESSING DECISION
==================================================

Choose the smallest maintainable implementation compatible with the
actual environment.

If native GD with appropriate format support is sufficient:

a compact application media service using GD is acceptable.

If a third-party image package is genuinely necessary:

document:

DEV06-DEC-xxx
exact package/version
reason
maintenance implication

and do not change frozen Technical R&D.

Do NOT install a large CMS/media library.

==================================================
MEDIA VALIDATION LIMITS
==================================================

Hosting-specific final upload limits remain pre-production dependency.

For development, choose conservative application limits as a DEV06
implementation decision.

Record:

maximum upload bytes
accepted raster formats
maximum dimensions
output dimension strategy
output format strategy.

Do not claim these are frozen product requirements.

SVG should not be accepted for user-uploaded photos unless the frozen
security/media direction is explicitly satisfied.

==================================================
MEDIA REPLACEMENT
==================================================

When replacing a parent single image:

1. process/store the new file safely;
2. update database in a safe operation;
3. only after successful persistence clean the replaced file where
   appropriate.

Failure must not leave parent pointing at an invalid path.

==================================================
SOFT DELETE MEDIA BEHAVIOR
==================================================

IMPORTANT:

When Admin Soft Deletes a parent:

DO NOT delete its media file.

Restore by Super Admin exists later for operational resources.

Soft Deleted row + media must remain retained.

Media cleanup on future permanent hard delete belongs to Super Admin
phase/application lifecycle.

==================================================
AGENDA MEDIA REMOVAL
==================================================

Admin may add/replace/remove Agenda media through the Agenda parent.

When an AgendaMedia child is deliberately removed during editing:

- authorize through parent;
- remove DB child safely;
- clean the corresponding file after successful persistence.

Parent Soft Delete must NOT remove Agenda media.

==================================================
PUBLIC MEDIA REGRESSION
==================================================

After Admin uploads/changes media:

existing public pages should display the storage-relative media
correctly when the parent is publicly eligible.

Optional missing media still uses DEV-05 placeholder.

==================================================
WHATSAPP NUMBER INPUT
==================================================

Exact formatting was not frozen.

Choose ONE conservative implementation format and record it as:

DEV06-DEC-xxx.

The chosen behavior must support the existing public WhatsApp handoff.

Prefer accepting common Indonesian admin input safely while storing or
normalizing a predictable value.

Do NOT change OPEN-002:

OPEN-002 concerns final message template,
not account/contact recovery.

Do not silently freeze a final WhatsApp message template.

==================================================
ADMIN LAYOUT
==================================================

Create/normalize a shared Admin Dusun layout.

Do NOT reuse the public website header as the dashboard shell.

Frozen visual direction:

Warm Natural design family,
but administrative utility density.

Desktop:

sidebar navigation.

Mobile:

admin navigation panel.

Always display:

role/context
current Dusun.

No Dusun selector.

==================================================
VISUAL AUTHORITY
==================================================

There are no High-Fidelity PNGs for UX-SCR-011–017.

This is intentional.

Implement using:

Wireframe Specification
+
Visual Design Specification.

Do NOT create Batch 2.

Do NOT use missing mockups as a blocker.

Visual polish can be refined later without changing frozen behavior.

==================================================
TABLE / MOBILE ROW
==================================================

Desktop management:

table where appropriate.

Mobile:

stacked management row/card.

Do not solve mobile tables by forcing horizontal scroll if actions and
information become difficult to use.

==================================================
SUCCESS FEEDBACK
==================================================

Use reusable safe feedback, e.g.:

"Data berhasil disimpan."

"Data berhasil dinonaktifkan."

Avoid saying:

"Data berhasil dipublikasikan"

for every operation because public eligibility may depend on:

- parent Dusun ACTIVE;
- lifecycle;
- expiry;
- privacy/location prerequisite.

==================================================
AUTHORIZATION — CONTROLLER BOUNDARY
==================================================

Existing DEV-04 policies remain authoritative.

Every management action must authorize server-side.

Do NOT weaken a Policy because the controller query is scoped.

Use both:

OWN_DUSUN scoped retrieval
+
Policy authorization.

Foreign ID manipulation must fail safely.

==================================================
FOREIGN RESOURCE ACCESS
==================================================

For Admin Dusun:

GET/POST/PATCH/DELETE against a foreign Dusun-owned record must not:

- display it;
- mutate it;
- leak sensitive lifecycle state.

Prefer safe:

404

for scoped resource lookup where appropriate,
while Policy tests must still prove denial.

Do not reveal:

"resource belongs to another Dusun".

==================================================
CHILD AUTHORIZATION
==================================================

ProdukUmkm:

authorization through parent Umkm.

AgendaMedia:

authorization through parent AgendaKegiatan.

Do not create independent business permission.

==================================================
NO ADMIN CATEGORY CRUD
==================================================

Do NOT create Admin Dusun routes/controllers for:

Kategori Fasilitas create
Kategori Fasilitas update
Kategori Fasilitas delete.

The Fasilitas form only lists valid available categories for selection.

==================================================
NO ADMIN ACCOUNT MANAGEMENT
==================================================

Do NOT create Admin Dusun UI/routes for:

create admin
edit admin
reset password
logical removal
assign Dusun.

Those belong to Super Admin.

==================================================
NO DUSUN STATUS ACTION
==================================================

Do NOT create:

activate Dusun
deactivate Dusun

route/action for Admin Dusun.

Profile editing is separate from Dusun lifecycle.

==================================================
ROUTE STRUCTURE
==================================================

Use the existing authenticated Admin Dusun prefix/context.

Keep:

/admin-dusun/dashboard

as real Dashboard after replacing placeholder.

Add conventional management routes under:

/admin-dusun/...

Exact route URI is an implementation decision if not frozen.

Use clear route names.

Examples conceptually:

admin-dusun.profile.*
admin-dusun.kontak.*
admin-dusun.umkm.*
admin-dusun.fasilitas.*
admin-dusun.agenda.*
admin-dusun.pengumuman.*

All must use middleware chain:

auth
admin.active
role:ADMIN_DUSUN

Do NOT expose Admin management routes publicly.

==================================================
RESTORE / HARD DELETE ROUTE AUDIT
==================================================

After DEV-06:

Admin Dusun route inventory MUST contain:

0 restore routes
0 force-delete routes
0 hard-delete routes
0 category-management routes
0 account-management routes
0 Dusun-status routes.

==================================================
DATABASE TRANSACTIONS
==================================================

Use transactions for multi-write operations where partial state would
be harmful.

Especially:

UMKM + Produk
Agenda + Agenda Media
media replacement where database consistency requires coordination.

Do not wrap simple read-only requests unnecessarily.

==================================================
CONCURRENCY / DOUBLE SUBMIT
==================================================

UI should disable or mark submitting action.

Backend/database constraints remain final integrity layer.

Do not create duplicate rows through accidental repeated submission
where conventional POST/redirect/GET handling can avoid it.

==================================================
PRG PATTERN
==================================================

After successful writes:

use normal Post/Redirect/Get behavior.

Do not return refresh-sensitive form POST output.

Success flash feedback is appropriate.

==================================================
NO MANUAL ORDERING
==================================================

Do NOT add:

sort_order
priority
featured
drag/drop ordering
move up/down.

Frozen role behavior explicitly excludes Admin manual ordering.

No migration change.

==================================================
MIGRATION FREEZE
==================================================

Expected migration changes:

ZERO.

Do NOT modify the 11 DEV-02 domain migrations.

Do NOT add a new table for:

form state
uploads
draft
approval
audit
category copies
map picker
ordering.

If implementation truly requires a schema change:

STOP affected subfeature and report Change Request.

==================================================
MODEL CHANGES
==================================================

Small model helpers/scopes are permitted.

Do NOT:

- add persisted fields;
- change relationships incorrectly;
- remove SoftDeletes;
- add SoftDeletes to another model;
- loosen all guarded fields globally.

==================================================
PRODUCTION DATA
==================================================

Do NOT create:

actual Admin Dusun accounts
official Dusun content
real WhatsApp numbers
real UMKM/facility/contact data

as part of implementation.

Use synthetic test fixtures only.

Data collection/entry occurs separately.

==================================================
ADMIN DUSUN DEVELOPMENT TESTS
==================================================

Add MariaDB-backed development tests.

These are NOT formal TC execution.

At minimum test the following behavior.

==================================================
DASHBOARD TESTS
==================================================

1. ADMIN_DUSUN accesses real Dashboard.

2. SUPER_ADMIN cannot use Admin Dusun role area as if it were
   ADMIN_DUSUN.

3. Fixed Dusun context displayed.

4. No Dusun selector.

5. Exactly six management navigation areas.

6. INACTIVE parent notice shown.

7. INACTIVE parent does not prevent management access.

==================================================
PROFILE TESTS
==================================================

8. Admin can view own profile form.

9. Admin can update supported own profile fields.

10. Foreign Dusun profile update denied.

11. status_dusun cannot be changed through Admin profile request.

12. client-supplied desa_id/dusun_id cannot change binding.

13. public Halaman Dusun reflects valid update when parent ACTIVE.

==================================================
KONTAK TESTS
==================================================

14. Create own Kontak.

15. Update own Kontak.

16. Foreign Kontak read/update denied.

17. Required name/jabatan/WhatsApp validation.

18. coordinate pair validation.

19. coordinate range validation.

20. Soft Delete own Kontak.

21. Soft Deleted row leaves normal Admin list.

22. Soft Deleted row leaves Public.

23. Admin restore route/action absent.

24. Admin hard-delete route/action absent.

==================================================
UMKM TESTS
==================================================

25. Create own UMKM.

26. Update own UMKM.

27. Multiple product rows persist.

28. Product add/update/remove reconciles transactionally.

29. foreign parent denied.

30. optional coordinate pair accepted.

31. half coordinate rejected.

32. no commerce field/action.

33. Soft Delete hides Admin/Public.

34. no restore/hard delete Admin action.

==================================================
FASILITAS TESTS
==================================================

35. Create own Fasilitas.

36. Existing category may be selected.

37. category from wrong Desa rejected.

38. Admin category management absent/denied.

39. required coordinate pair.

40. invalid coordinate rejected.

41. optional WhatsApp accepted.

42. Soft Delete behavior correct.

==================================================
AGENDA TESTS
==================================================

43. Admin creates Agenda with server-forced DUSUN scope.

44. malicious DESA scope payload cannot create DESA Agenda.

45. malicious foreign dusun_id ignored/rejected.

46. date validation.

47. nullable end semantics.

48. manual override valid values only.

49. effective status remains derived.

50. Agenda media valid roles only.

51. parent/child media authorization.

52. Soft Delete retains Agenda media.

53. no restore/hard delete.

==================================================
PENGUMUMAN TESTS
==================================================

54. Admin creates DUSUN announcement.

55. DESA scope injection denied/ignored safely.

56. foreign Dusun injection denied.

57. expiry boundary uses Asia/Jakarta.

58. Active/Archive label derived.

59. no Archive mutation action.

60. Soft Delete independent from Archive.

61. Soft Deleted record leaves normal list/public archive.

62. no restore/hard delete.

==================================================
MEDIA TESTS
==================================================

63. valid image accepted.

64. invalid MIME/signature rejected.

65. oversized/invalid-dimension image rejected according to DEV06
    implementation decision.

66. stored DB reference is storage-relative.

67. no BLOB.

68. optional media may be absent.

69. replacement keeps parent consistent.

70. failed processing does not persist broken reference.

71. Soft Delete parent retains media.

72. public eligible parent renders processed media.

==================================================
COORDINATE PICKER TESTS
==================================================

73. manual coordinates persist.

74. map-selected coordinates submit same validated fields.

75. no search/geocoder UI.

76. no polygon UI.

77. Admin cannot use coordinate payload to alter ownership.

==================================================
DIRECT PUBLISH TESTS
==================================================

78. Create/update eligible resource becomes public immediately when
    parent ACTIVE.

79. No approval state/route exists.

80. When parent Dusun INACTIVE, Admin write succeeds but public remains
    hidden.

==================================================
SECURITY TESTS
==================================================

81. modified foreign ID cannot update.

82. modified foreign ID cannot Soft Delete.

83. client-supplied dusun_id is not authority.

84. client-supplied scope_level cannot escalate Agenda/Pengumuman.

85. validation failure exposes no SQL/constraint names.

86. upload filename cannot create path traversal.

87. stored user text remains Blade-escaped in management/public output.

==================================================
FORMAL TESTING BOUNDARY
==================================================

Testing Specification v1.1 contains:

108 formal cases.

Execution remains:

108/108 NOT RUN.

DEV-06 development tests may overlap conceptually with:

TC-AD-002–006
TC-AUTH-001
TC-AUTH-003–006
TC-AUTH-010–012
TC-VAL-005–017
TC-DATA-004–011
TC-LIFE
TC-ERR
TC-UI-004

but do NOT mark formal TC cases PASS.

==================================================
REGRESSION REQUIREMENTS
==================================================

All previous DEV tests must remain PASS:

DEV-03 ModelPersistence
DEV-04 Authentication
DEV-04 Authorization
DEV-05 Public Core

Admin writes must be verified against the existing public read-side.

==================================================
VISUAL / RESPONSIVE REVIEW
==================================================

No Batch 2/3 mockups.

Verify functionally:

Desktop:
sidebar/table/forms usable.

Mobile:
navigation panel/stacked rows/forms usable.

Visual polish does not block later human refinement.

But implementation must still respect:

Visual Design Specification
and
Wireframe Specification.

==================================================
ACCESSIBILITY
==================================================

Implement:

- form labels;
- required/optional indication;
- field error association;
- keyboard focus;
- confirmation dialog keyboard usability;
- accessible navigation panel;
- button labels;
- table/card semantics;
- status text not color-only;
- media alt/preview semantics.

No WCAG certification claim.

==================================================
VALIDATION COMMANDS
==================================================

Using PHP 8.3.26:

php -v

php artisan --version

php artisan route:list

php artisan migrate:status

php artisan test

composer validate

vendor/bin/pint --test

npm run build

If media/image code is introduced:

also report available PHP image extension/format support.

==================================================
DEV-06 FINAL ROUTE AUDIT
==================================================

Report:

- total routes;
- Admin Dusun routes;
- Public routes;
- Auth routes;
- Super Admin placeholder route.

Explicitly verify Admin Dusun has:

restore routes = 0
hard-delete routes = 0
category management routes = 0
Admin account management routes = 0
Dusun status action routes = 0.

==================================================
DEV-06 COMPLETION CHECKLIST
==================================================

DEV-06 is complete only when:

[ ] DEV-05 closure normalization PASS.
[ ] Actual Laravel version correctly reported.
[ ] Public canonical empty state preserved.
[ ] UX-SCR-011 implemented.
[ ] UX-SCR-012 implemented.
[ ] UX-SCR-013 implemented.
[ ] UX-SCR-014 implemented.
[ ] UX-SCR-015 implemented.
[ ] UX-SCR-016 implemented.
[ ] UX-SCR-017 implemented.
[ ] Admin dashboard placeholder replaced.
[ ] Fixed OWN_DUSUN context.
[ ] No Dusun selector.
[ ] INACTIVE Admin management remains usable.
[ ] Six management areas only.
[ ] Profile own-only.
[ ] Kontak CRUD own-only.
[ ] UMKM + Produk own-only.
[ ] Fasilitas own-only.
[ ] Agenda fixed DUSUN/OWN_DUSUN.
[ ] Pengumuman fixed DUSUN/OWN_DUSUN.
[ ] Server derives ownership.
[ ] Client-supplied dusun_id is never authority.
[ ] Admin cannot manage category.
[ ] Admin cannot manage accounts.
[ ] Admin cannot change Dusun status.
[ ] Five operational resources support Admin Soft Delete.
[ ] Normal Admin lists exclude Soft Deleted.
[ ] Admin restore UI/routes = 0.
[ ] Admin hard-delete UI/routes = 0.
[ ] Direct publishing works.
[ ] Agenda lifecycle remains derived.
[ ] Pengumuman archive remains derived.
[ ] No Archive mutation.
[ ] Coordinate picker works.
[ ] No geocoding search.
[ ] No polygon.
[ ] Media upload/processing meets SRS direction.
[ ] Database media path storage-relative.
[ ] Parent Soft Delete retains media.
[ ] No new DB table.
[ ] DEV-02 migrations unchanged.
[ ] Existing Policies preserved.
[ ] Public Core regression PASS.
[ ] Authentication regression PASS.
[ ] Authorization regression PASS.
[ ] Model persistence regression PASS.
[ ] DEV-06 tests PASS.
[ ] Composer validate PASS.
[ ] Pint PASS.
[ ] npm build PASS.
[ ] Formal tests remain 108/108 NOT RUN.
[ ] Frozen documents unchanged.
[ ] High-Fidelity PNG unchanged.
[ ] New CR count = 0 if compatible.

==================================================
DEV IMPLEMENTATION DECISIONS
==================================================

Record only necessary implementation decisions as:

DEV06-DEC-001
DEV06-DEC-002
...

Likely categories:

- management route URI convention;
- management pagination size;
- WhatsApp number normalization;
- media disk;
- development image limit;
- image processing implementation;
- generated image dimensions/format;
- coordinate picker presentation.

These are implementation choices.

They do NOT modify frozen product behavior.

==================================================
CHANGE CONTROL
==================================================

Historical:

PDS-CR-001
APPROVED / APPLIED.

New Change Requests target:

0.

If DEV-06 discovers a genuine contradiction between frozen sources:

STOP the affected subfeature.

Report:

- exact source IDs;
- implementation impact;
- proposed Change Request.

Do NOT silently reinterpret the requirement.

==================================================
FINAL REPORT
==================================================

After DEV-06 report:

Phase:
DEV-06 — Admin Dusun Management

Report:

1. DEV-05 closure normalization
   - actual Laravel version
   - empty-state normalization
   - human visual status

2. Environment
   - PHP
   - Laravel
   - MariaDB
   - Node/npm
   - image extension support

3. Admin screen coverage
   - UX-SCR-011
   - UX-SCR-012
   - UX-SCR-013
   - UX-SCR-014
   - UX-SCR-015
   - UX-SCR-016
   - UX-SCR-017

4. Admin route inventory

5. Dashboard
   - fixed Dusun context
   - INACTIVE behavior
   - six management areas

6. Profile management

7. Kontak management

8. UMKM + Produk management

9. Fasilitas management

10. Agenda management

11. Pengumuman management

12. OWN_DUSUN enforcement
    - normal requests
    - malicious foreign IDs
    - ownership payload injection

13. Soft Delete
    - five applicable resources
    - list/public behavior
    - restore/hard delete absence

14. Application validation coverage

15. Coordinate picker

16. Media
    - processing implementation
    - accepted formats
    - size/dimension rules
    - relative storage
    - replacement
    - Soft Delete retention

17. Direct publish behavior

18. Development decisions
    - DEV06-DEC list

19. Automated tests
    - previous regression
    - new DEV-06 tests
    - total methods/assertions

20. Build/code quality
    - Composer
    - Pint
    - Vite

21. Schema integrity
    - migrations changed YES/NO
    - expected NO
    - unexpected tables = 0

22. Security boundary
    - restore routes 0
    - hard-delete routes 0
    - category CRUD routes 0
    - account management routes 0
    - status Dusun routes 0

23. Formal Testing Specification
    - 108/108 NOT RUN

24. Frozen source integrity

25. Change control

26. Blockers

27. Completion
    DEV-06 COMPLETE YES/NO

28. Readiness
    READY FOR DEV-07 — SUPER ADMIN MANAGEMENT YES/NO

STOP after DEV-06.

Do NOT begin DEV-07.
Do NOT implement Super Admin management.
Do NOT create Batch 2/3 mockups.
Do NOT enter production data.
Do NOT execute formal Testing Specification.