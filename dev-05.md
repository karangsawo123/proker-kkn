Kita masuk ke:

DEV-05 — PUBLIC CORE IMPLEMENTATION

Project:
PORTAL INFORMASI DESA BENDUNG

==================================================
CURRENT DEVELOPMENT STATUS
==================================================

DEV-01:
COMPLETE

DEV-02:
COMPLETE

DEV-03:
COMPLETE

DEV-04:
COMPLETE

Current verified implementation:

Laravel:
13.25.0

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

Automated development regression:
34 tests
382 assertions
PASS

Formal Testing Specification:
108/108 NOT RUN

Open Change Requests:
0

==================================================
DEV-05 OBJECTIVE
==================================================

Implement the COMPLETE PUBLIC CORE MVP:

UX-SCR-001 through UX-SCR-009

as actual Laravel/Blade application screens.

Screens:

UX-SCR-001
Homepage

UX-SCR-002
Halaman Dusun

UX-SCR-003
Arsip Pengumuman

UX-SCR-004
Detail UMKM

UX-SCR-005
Detail Fasilitas/Lokasi

UX-SCR-006
Detail Agenda/Kegiatan

UX-SCR-007
Detail Pengumuman

UX-SCR-008
Peta Desa

UX-SCR-009
Peta Dusun

These screens are:

PUBLIC
READ-ONLY
NO LOGIN REQUIRED.

==================================================
NORMATIVE SOURCES
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
Version 1.1

docs/05-rnd/technical-rnd.md

docs/06-specification/SRS.md
Version 1.1

docs/07-testing/testing-specification.md
Version 1.1

Also inspect:

src/app/Models/*
src/app/Policies/*
src/routes/web.php
existing authentication implementation.

==================================================
HIGH-FIDELITY REFERENCES
==================================================

Public Core has approved visual references:

docs/03-ux/mockups/batch-01-public-core/

Exactly:

UX-SCR-001 through UX-SCR-009

High-Fidelity coverage:

9/28.

Use each corresponding PNG for visual implementation reference.

Authority order remains:

Frozen written specifications
>
High-Fidelity PNG.

If PNG conflicts with frozen written specification:

written specification wins.

Do NOT create:

Batch 2
Batch 3
new mockups.

==================================================
DEV-05 SCOPE BOUNDARY
==================================================

DEV-05 implements PUBLIC READ-ONLY presentation and querying.

Do NOT implement:

- Admin Dusun CRUD;
- Super Admin CRUD;
- management dashboard;
- account management;
- password reset management;
- resource forms;
- file upload;
- administrative restore;
- administrative hard delete;
- Dusun activation UI;
- category management UI.

Existing DEV-04 authentication remains intact.

==================================================
PHP ENVIRONMENT
==================================================

Validated PHP:

C:\laragon\bin\php\php-8.3.26-Win32-vs16-x64\php.exe

Use PHP 8.3.x for all Artisan/Composer commands.

Do NOT accidentally use PHP 8.2.

==================================================
PUBLIC ACCESS
==================================================

All UX-SCR-001–009 routes:

must be accessible without authentication.

Do NOT apply:

auth
admin.active
role

middleware to public routes.

Admin authentication routes must continue working unchanged.

==================================================
PUBLIC VISIBILITY PRINCIPLE
==================================================

A public record is visible only when all applicable eligibility
conditions are satisfied.

At minimum:

- operational resource is NOT Soft Deleted;
- parent Dusun is ACTIVE when resource belongs to a Dusun;
- scope rules are satisfied;
- applicable resource has the data required for the presented action.

Do NOT rely only on UI hiding.

Direct URL access to an ineligible public record must also fail safely.

==================================================
INACTIVE DUSUN
==================================================

Dusun with:

status = INACTIVE

must NOT appear:

- on Homepage Dusun choices;
- on public Halaman Dusun;
- in public Peta Desa;
- in public Dusun filters;
- through publicly eligible child data.

Direct public access to an INACTIVE Dusun must result in the
frozen safe non-public behavior.

Prefer conventional:

404 Not Found

if exact response is not otherwise frozen.

Do NOT reveal:

"Dusun exists but is inactive"

to Public User.

==================================================
SOFT DELETED RECORDS
==================================================

For:

KontakPelayanan
Umkm
Fasilitas
AgendaKegiatan
Pengumuman

deleted_at != null:

must NEVER appear publicly.

This includes:

- lists;
- Homepage;
- Halaman Dusun;
- archive;
- map;
- detail page;
- direct URL access.

==================================================
PUBLIC QUERY ARCHITECTURE
==================================================

Implement reusable public-eligibility query scopes or equivalent
compact query logic where it improves consistency.

Examples conceptually:

publiclyVisible()
forPublic()
withinActiveDusun()

Naming is implementation-level.

Do NOT create a large repository architecture.

Do NOT create:

PublicRepository
GenericResourceRepository
CMS query engine.

Keep conventional Laravel/Eloquent architecture.

==================================================
ROOT ROUTE
==================================================

Replace the existing:

DEVELOPMENT FOUNDATION PLACEHOLDER

at:

GET /

with the actual:

UX-SCR-001 Homepage.

The foundation placeholder is no longer needed.

Keep:

/up

health route.

==================================================
PUBLIC ROUTE DESIGN
==================================================

First inspect Sitemap/User Flow for any frozen exact URI.

If exact URI is frozen:

use it.

If not:

choose conventional Indonesian-readable public routes and record them
as DEV05 implementation decisions.

Expected route concepts include:

Homepage

Halaman Dusun

Arsip Pengumuman

Detail UMKM

Detail Fasilitas

Detail Agenda

Detail Pengumuman

Peta Desa

Peta Dusun

Use named routes.

Do NOT expose sequential internal CRUD concepts such as:

/admin/umkm/1

for public routes.

==================================================
ROUTE BINDING / PUBLIC ELIGIBILITY
==================================================

Do NOT assume standard implicit route binding is sufficient.

A route such as:

/umkm/{umkm}

must not resolve a publicly ineligible:

- Soft Deleted UMKM;
- UMKM under INACTIVE Dusun.

Same principle for all four public detail resources.

Use explicit query/controller validation as appropriate.

Do NOT globally modify model binding in a way that breaks Admin/Super
Admin future management of Soft Deleted records.

==================================================
PUBLIC DETAIL TYPES — EXACTLY FOUR
==================================================

Exactly four public detail page types:

1. UMKM
2. Fasilitas/Lokasi
3. Agenda/Kegiatan
4. Pengumuman

Do NOT create:

Kontak Pelayanan detail page

or:

fifth generic Detail page.

Service/contact marker should route to relevant service/contact context
instead of inventing another detail resource.

==================================================
UX-SCR-001 — HOMEPAGE
==================================================

Implement exact frozen structural order:

1. Hero / Identitas Desa
2. Pilihan Dusun
3. Informasi Desa
4. Pengumuman
5. Agenda
6. Peta Desa
7. Kontak Desa
8. Footer

Data must come from database.

No fake production content.

Do NOT hardcode:

official Dusun names
official contact
official village facts

unless they exist in database.

==================================================
HOMEPAGE — HERO
==================================================

Use available Desa identity fields exactly as supported by schema/spec.

Support:

- village identity;
- description;
- logo/banner/media when available;
- honest placeholder/fallback when optional media missing.

Do not fabricate missing content.

==================================================
HOMEPAGE — DUSUN CHOICES
==================================================

Display exactly the currently ACTIVE Dusun records.

Do NOT assume official names from exploratory mockups.

Do NOT show INACTIVE Dusun.

Each active choice routes to:

Halaman Dusun.

==================================================
HOMEPAGE — INFORMASI DESA
==================================================

Implement according to the frozen Homepage content contract.

Do not turn this into a page builder.

No manually configurable arbitrary Homepage blocks.

Homepage remains data-driven.

==================================================
HOMEPAGE — PENGUMUMAN
==================================================

Show appropriate latest/current village/public announcements according
to frozen scope/lifecycle behavior.

Do not show:

Soft Deleted announcements.

Archive remains separate from Soft Delete.

Provide route to:

Arsip Pengumuman

where frozen UI requires it.

If an exact item limit is frozen:

use it.

If no limit is frozen:

choose a small presentation-appropriate limit matching the approved
visual direction and record:

DEV05-DEC-xxx

without turning the number into a product requirement.

==================================================
HOMEPAGE — AGENDA
==================================================

Show appropriate current/upcoming village/public Agenda.

Use existing derived lifecycle helper.

Status vocabulary exactly:

AKAN_DATANG
BERLANGSUNG
SELESAI

Presentation label may use proper Indonesian copy from visual/UI spec.

Do NOT persist status.

Do NOT create new lifecycle state.

==================================================
HOMEPAGE — PETA DESA
==================================================

Implement the public Peta Desa section/link/context according to frozen
screen.

Public map implementation is part of DEV-05.

See MAP IMPLEMENTATION section below.

==================================================
HOMEPAGE — KONTAK DESA
==================================================

Use the village-level contact supported by frozen schema/spec.

Do not invent contact data.

External WhatsApp action only if applicable valid contact exists.

==================================================
UNSUPPORTED HOMEPAGE ELEMENTS
==================================================

Do NOT reintroduce exploratory elements previously rejected:

- unsupported Header CTA;
- unsupported mobile bottom navigation;
- "Laporkan informasi" unsupported action;
- marketplace UI;
- arbitrary Sumberagung example data;
- public login/account;
- page-builder controls.

==================================================
UX-SCR-002 — HALAMAN DUSUN
==================================================

Publicly accessible only for ACTIVE Dusun.

Frozen section order:

1. Banner / Name
2. Quick Navigation
3. Profil Dusun
4. Kepala Dusun
5. Kontak Pelayanan
6. UMKM
7. Fasilitas
8. Agenda
9. Pengumuman
10. Peta Dusun

Use database content.

==================================================
HALAMAN DUSUN — QUICK NAVIGATION
==================================================

Implement accessible in-page navigation.

Mobile may use horizontal-scroll pattern from frozen UI specification.

Sticky behavior is not mandatory unless frozen source requires it.

Links must point to real section IDs.

==================================================
HALAMAN DUSUN — KADUS
==================================================

Kepala Dusun is profile information.

It is NOT:

- a software role;
- an authenticated account type.

Do not tie Kadus display automatically to AdminAccount.

Use frozen Dusun/profile source fields.

==================================================
HALAMAN DUSUN — KONTAK PELAYANAN
==================================================

Display active eligible Kontak Pelayanan.

Fields according to source:

- name;
- role/job text;
- WhatsApp;
- optional photo;
- address/location only where present/applicable.

There is:

NO digital consent field.

Do NOT create one.

Stored publication data is treated according to the frozen offline
permission precondition.

Do NOT infer coordinates from address.

==================================================
HALAMAN DUSUN — UMKM
==================================================

Display eligible UMKM directory.

UMKM is:

DIRECTORY + WHATSAPP

NOT marketplace.

Products are informational.

No:

price
stock
SKU
cart
checkout
transaction
buy button.

==================================================
HALAMAN DUSUN — FASILITAS
==================================================

Display eligible facilities using dynamic facility categories.

No hardcoded category enum.

==================================================
HALAMAN DUSUN — AGENDA
==================================================

Display eligible Dusun-scoped Agenda according to frozen lifecycle.

Use derived effective status.

==================================================
HALAMAN DUSUN — PENGUMUMAN
==================================================

Display eligible Dusun announcements.

Expired public announcement may belong to archive behavior according to
frozen lifecycle.

Do not confuse expiration with Soft Delete.

==================================================
UX-SCR-003 — ARSIP PENGUMUMAN
==================================================

Implement public archive.

Archive is DERIVED from:

tanggal_kedaluwarsa.

Archive remains publicly readable.

Must NOT include:

Soft Deleted Pengumuman.

Must respect:

ACTIVE parent Dusun/public scope eligibility.

Do NOT create:

archive table
archived_at
archive_status
archive action.

==================================================
PENGUMUMAN ACTIVE VS ARCHIVE
==================================================

Use existing business-timezone lifecycle logic.

Business timezone:

Asia/Jakarta.

Ensure deterministic date behavior.

Do NOT use machine-local timezone implicitly.

==================================================
UX-SCR-004 — DETAIL UMKM
==================================================

Display frozen UMKM fields:

- name;
- owner;
- type;
- description;
- products;
- address;
- WhatsApp;
- operating hours;
- optional main photo;
- coordinates/actions when available.

Products:

multiple informational child rows/items/tags.

No commerce behavior.

==================================================
UMKM WITHOUT COORDINATES
==================================================

UMKM coordinates are optional.

If no coordinate pair:

- detail still works;
- directory still works;
- no map marker;
- no Directions action.

Do not manufacture coordinates.

==================================================
UX-SCR-005 — DETAIL FASILITAS
==================================================

Display:

- name;
- dynamic category;
- photo if available;
- description;
- address;
- coordinates;
- optional WhatsApp.

Fasilitas coordinates are required by database schema.

Directions action may be shown when valid.

WhatsApp action only when number exists.

==================================================
UX-SCR-006 — DETAIL AGENDA
==================================================

Display:

- scope/context;
- title/content according to schema;
- date;
- optional end;
- optional time;
- location;
- media;
- effective derived lifecycle status.

If no end:

start date acts as effective end.

Optional Agenda Media must render according to stored records.

Do NOT implement upload management.

==================================================
UX-SCR-007 — DETAIL PENGUMUMAN
==================================================

Display eligible public Pengumuman.

Both:

Aktif
and
Arsip

may have public detail when eligible.

Soft Deleted Pengumuman:

never public.

Clearly preserve:

ARSIP != SOFT DELETE.

==================================================
EMPTY STATE
==================================================

Frozen public empty state:

"Belum ada data"

Use consistently when a section has no eligible data.

Do not hide the entire page or display fake placeholder records merely
to make layouts look full.

==================================================
OPTIONAL MEDIA / PLACEHOLDER
==================================================

For missing optional media:

use the frozen visual placeholder direction.

Do NOT:

- throw broken-image icon;
- fabricate actual village imagery;
- require optional image for page usability.

Media path is storage-relative.

Do NOT implement upload behavior in DEV-05.

==================================================
PUBLIC MAP IMPLEMENTATION
==================================================

Implement Leaflet as frozen map library.

Leaflet may now be added as frontend dependency.

Do NOT confuse:

Leaflet
with
tile provider.

==================================================
TILE PROVIDER BOUNDARY
==================================================

Production tile provider remains unresolved pre-production dependency.

Therefore:

implement tile-layer configuration so provider URL / attribution is
configuration-driven.

Do NOT hardcode a production-provider decision into domain/product
logic.

If a development tile endpoint is used for local implementation:

record it only as:

DEV05 development/default environment choice.

It does NOT freeze production provider.

Do NOT modify Technical R&D to claim provider is finalized.

==================================================
MAP FAILURE FALLBACK
==================================================

If map/tile loading fails:

the public page must remain usable.

Non-map content must continue rendering.

Provide graceful map-unavailable state according to UI direction.

No page-wide crash.

==================================================
PETA DESA — UX-SCR-008
==================================================

Peta Desa must support:

- Dusun filter;
- category filter;
- map;
- eligible markers;
- popup;
- detail/context navigation;
- external Google Maps directions when applicable.

Dusun filter:

ACTIVE Dusun only.

==================================================
PETA DUSUN — UX-SCR-009
==================================================

Peta Dusun is already scoped to the current Dusun.

It must have:

CATEGORY filter.

It must NOT have:

Dusun selector.

==================================================
MAP MARKER SOURCES
==================================================

There is NO generic marker table.

Generate public map markers from domain data.

Sources:

1. Fasilitas
2. UMKM with coordinate pair
3. eligible Kontak Pelayanan/service points with coordinate pair

All must also satisfy public eligibility.

==================================================
MAP TAXONOMY
==================================================

Use frozen taxonomy:

"Semua"
= UI/filter only.

Do NOT persist it.

UMKM marker category:
UMKM

Kontak/service marker context:
Pelayanan

Fasilitas:
dynamic Kategori Fasilitas

Do NOT create:

MapCategory
LocationCategory
MarkerCategory

database/model.

==================================================
MAP FILTERING
==================================================

Filtering may be server-rendered, client-side, or a small progressive-JS
hybrid.

Prefer the simplest approach consistent with frozen UX.

Do NOT build SPA architecture.

Do NOT build API layer solely for the map unless clearly required.

No JSON API requirement exists for MVP.

==================================================
MAP SEARCH — PROHIBITED MVP
==================================================

Do NOT implement:

search field
location search
geocoding search

MAP-011 is FUTURE.

==================================================
DUSUN POLYGON — PROHIBITED MVP
==================================================

Do NOT implement:

Dusun boundary polygon
shape drawing
GeoJSON village boundaries

MAP-012 is FUTURE.

==================================================
MAP POPUP
==================================================

Popup fields according to applicable source:

- Name
- Category
- Photo / placeholder
- Address when applicable
- Detail/context
- Directions

Address is conditional.

Do NOT show an empty fake address field.

==================================================
GOOGLE MAPS DIRECTIONS
==================================================

Directions is:

EXTERNAL browser handoff.

Do NOT implement internal navigation/routing.

Use valid stored coordinates.

No coordinates:
no Directions action.

Build the external URL safely.

Do NOT persist Google Maps data.

==================================================
WHATSAPP
==================================================

WhatsApp is also an external browser handoff.

Use the stored number.

No internal messaging.

Exact frozen template:

if OPEN-002 remains unresolved,
do NOT silently freeze final wording.

Use a minimal/configurable message behavior if required.

Record implementation detail without closing OPEN-002.

==================================================
PUBLIC CONTROLLERS
==================================================

Use focused public controllers.

Possible structure:

HomeController
DusunController
PengumumanArchiveController
UmkmPublicController
FasilitasPublicController
AgendaPublicController
PengumumanPublicController
PetaDesaController
PetaDusunController

Exact naming may vary.

Do NOT create:

one giant PublicController

with every application behavior.

Also do not over-create service classes.

==================================================
VIEW ARCHITECTURE
==================================================

Use Blade.

Create reusable visual partials/components where repeated, such as:

- public header;
- footer;
- resource card;
- status badge;
- empty state;
- map filters;
- media placeholder;
- WhatsApp CTA;
- Directions CTA.

Do not create abstraction for a component used once simply to increase
component count.

==================================================
PUBLIC HEADER
==================================================

Implement according to frozen Wireframe/Visual Design.

Do NOT add unsupported CTA.

No public account/login affordance unless frozen source specifically
requires an Admin entry point, which should not become a primary Public
CTA.

==================================================
PUBLIC FOOTER
==================================================

Implement frozen public footer.

No unsupported:

report information
citizen account
marketplace
new navigation family.

==================================================
VISUAL IMPLEMENTATION
==================================================

Use frozen Warm Natural design system.

Canonical colors only:

Moss Green:
#2E5E3E

Sage Green:
#7A8F6B

Terracotta:
#C46A3A

Warm Beige:
#F1E7D3

Cream:
#FAF7F2

Dark Olive:
#2B2F23

Do NOT introduce a seventh canonical design color.

==================================================
TYPOGRAPHY
==================================================

Heading:
Lora

Body/UI:
Inter

No third font.

Retain existing fallback strategy unless there is a justified lightweight
font-loading implementation.

Do not add random font binaries.

==================================================
RESPONSIVE IMPLEMENTATION
==================================================

Implement both:

Mobile
Desktop

Tablet may derive responsively.

High-Fidelity files show:

desktop left
mobile right

but implementation itself must naturally respond in browser.

Do not recreate a 1536x1024 screenshot canvas in HTML.

==================================================
MOBILE-FIRST CSS
==================================================

Continue DEV-01 direction:

mobile-first CSS.

Do not install Tailwind.

Do not install another CSS framework.

Reuse/extend:

resources/css/app.css

in a maintainable way.

==================================================
ACCESSIBILITY
==================================================

Implement at least:

- semantic landmarks;
- correct heading hierarchy;
- visible focus;
- keyboard-accessible links/buttons;
- form controls/filters labeled;
- state not color-only;
- meaningful image alt or decorative empty alt as appropriate;
- map controls usable where possible;
- alternate textual context outside map for important information;
- touch-usable control sizing.

Do NOT claim WCAG certification.

==================================================
HTML SAFETY
==================================================

User/admin-entered content must be escaped by default.

Use normal Blade escaping.

Do NOT render arbitrary stored text with raw:

{!! !!}

unless the frozen data explicitly represents trusted sanitized HTML,
which should not be assumed.

No public script injection.

==================================================
N+1 / QUERY QUALITY
==================================================

Use eager loading where appropriate.

Public page queries should avoid obvious N+1 behavior for:

Dusun cards
UMKM products
Fasilitas categories
Agenda media
map marker relations.

Do not over-optimize prematurely.

==================================================
PAGINATION
==================================================

Frozen UI states pagination is optional/volume-based.

If an archive/resource collection needs pagination for reasonable
implementation:

use Laravel pagination.

Do NOT force pagination everywhere.

If no exact page size is frozen:

record chosen size as DEV implementation detail.

==================================================
NO PRODUCTION SEED DATA
==================================================

DEV-05 must not create actual village production content merely so the
page looks filled.

No guessed:

- Dusun names;
- Kadus names;
- WhatsApp numbers;
- UMKM;
- facilities;
- announcements.

Use synthetic data only in automated tests.

Runtime empty database should present honest empty states.

==================================================
DEVELOPMENT TESTS — PUBLIC CORE
==================================================

Add focused MariaDB-backed development tests.

These are NOT formal TC execution.

At minimum cover:

==================================================
HOMEPAGE TESTS
==================================================

1. Homepage accessible without login.

2. Correct frozen section order exists.

3. ACTIVE Dusun displayed.

4. INACTIVE Dusun excluded.

5. Soft Deleted resources excluded.

6. Empty-state rendering works.

7. Unsupported exploratory elements absent.

==================================================
DUSUN PAGE TESTS
==================================================

8. ACTIVE Dusun page accessible.

9. INACTIVE Dusun public page unavailable.

10. Child content is scoped to requested Dusun.

11. Foreign Dusun content does not leak.

12. Empty sections render "Belum ada data".

==================================================
UMKM TESTS
==================================================

13. Eligible UMKM detail renders.

14. Soft Deleted UMKM detail unavailable.

15. UMKM under INACTIVE Dusun unavailable.

16. Multiple Produk UMKM display.

17. No commerce UI.

18. No coordinates means no map/directions action.

==================================================
FASILITAS TESTS
==================================================

19. Eligible Fasilitas detail renders.

20. Dynamic category renders.

21. Optional WhatsApp correctly conditional.

22. Soft Deleted/inactive-parent facility unavailable.

==================================================
AGENDA TESTS
==================================================

23. Agenda detail renders derived lifecycle.

24. Nullable end-date semantics correct.

25. Manual override representation correct.

26. Soft Deleted/inactive-parent Agenda unavailable.

==================================================
PENGUMUMAN TESTS
==================================================

27. Active Pengumuman public.

28. Expired eligible Pengumuman appears in Arsip.

29. Archive detail remains public.

30. Soft Deleted Pengumuman absent from active and archive.

31. Inactive-parent Pengumuman not public.

==================================================
MAP TESTS
==================================================

32. Peta Desa accessible public.

33. Peta Desa exposes Dusun + category filters.

34. Peta Dusun exposes category filter only.

35. Peta Dusun contains no Dusun selector.

36. Fasilitas marker eligible.

37. UMKM without coordinates has no marker.

38. UMKM with coordinates marker eligible.

39. eligible service/contact coordinate marker eligible.

40. Soft Deleted/inactive-parent marker excluded.

41. "Semua" is filter-only.

42. No map-search feature.

43. No polygon feature.

44. Google Maps direction only where coordinates exist.

==================================================
PUBLIC DETAIL BOUNDARY TESTS
==================================================

45. Exactly four public detail route families exist.

46. No Kontak detail route.

47. Direct request to non-public resource fails safely.

==================================================
VISUAL/STRUCTURAL DEVELOPMENT CHECKS
==================================================

Add reasonable structural assertions for:

- Warm Natural CSS tokens retained;
- no marketplace copy/action;
- no unsupported bottom nav;
- no unsupported header CTA.

Do not attempt pixel-perfect screenshot testing in DEV-05 unless an
existing tool already supports it cleanly.

Formal Visual QA remains later.

==================================================
FORMAL TESTING SPECIFICATION
==================================================

Testing Specification v1.1:

108 test cases.

Execution must remain:

108/108 NOT RUN.

DEV-05 development tests may conceptually overlap:

TC-PUB-001–010
TC-UI-001–003
TC-VIS-001–005
TC-EXT-001–004

but do NOT mark formal cases PASS.

==================================================
REGRESSION
==================================================

All existing suites must continue passing:

AuthenticationTest
AuthorizationInvariantTest
ModelPersistenceTest
scaffold/unit tests

Public development must NOT break:

DEV-03
DEV-04.

==================================================
AUTHENTICATION REGRESSION
==================================================

After adding Public routes:

verify:

/admin/login
still works.

/admin/logout
still protected appropriately.

/admin-dusun/dashboard
still role-protected.

/super-admin/dashboard
still role-protected.

Public routes must not interfere with auth middleware.

==================================================
MIGRATION FREEZE
==================================================

Expected migration changes:

0.

Do NOT modify the 11 verified DEV-02 migrations.

Do NOT add a table for:

map
archive
media
homepage
navigation.

If public implementation appears to require a schema change:

STOP and report conflict.

Do not silently change PDS.

==================================================
MODEL FOUNDATION
==================================================

Existing 11 models may receive:

small query scopes
public eligibility helpers
presentation-safe helpers

if needed.

Do NOT:

- change relationships incorrectly;
- remove DEV-03 helpers;
- loosen mass assignment globally;
- introduce new persisted attributes.

==================================================
POLICY FOUNDATION
==================================================

Public read routes generally do NOT need authenticated management
Policies.

Do not weaken existing policies just to make public pages work.

Keep management authorization boundaries from DEV-04 unchanged.

==================================================
LEAFLET FRONTEND DEPENDENCY
==================================================

Adding Leaflet dependency is allowed and expected now.

Record:

exact Leaflet version installed.

Do NOT add:

Google Maps JS SDK
Mapbox framework
another competing map library

without an approved technical reason.

Google Maps remains external navigation only.

==================================================
JAVASCRIPT
==================================================

Use progressive JavaScript for:

- map initialization;
- filter interactions where useful;
- small navigation enhancements.

Do NOT build an SPA.

Core textual public content must remain server-rendered and usable
without JS where practically possible.

==================================================
ERROR / FAILURE STATES
==================================================

Handle:

- 404/non-public resource;
- optional media missing;
- empty dataset;
- tile/map failure;
- malformed coordinate not expected due DB constraints but fail safely;
- external action unavailable.

Do not show:

SQL errors
stack trace
filesystem path
internal state reason.

==================================================
DEV05 IMPLEMENTATION DECISIONS
==================================================

For non-product technical choices not frozen, record:

DEV05-DEC-001
etc.

Possible examples:

- public conventional route URI;
- list card limits;
- pagination page size;
- development tile URL;
- marker client-side filtering strategy.

These are NOT Change Requests when they do not alter frozen behavior.

Keep decisions minimal.

==================================================
SOURCE FREEZE
==================================================

Do NOT modify:

frozen docs
High-Fidelity PNG
DEV-02 migrations
Testing Specification statuses.

Expected new Change Requests:

0.

==================================================
VALIDATION COMMANDS
==================================================

Using PHP 8.3:

php -v

php artisan --version

php artisan route:list

php artisan migrate:status

php artisan test

composer validate

vendor/bin/pint --test

npm run build

Also inspect:

- public route inventory;
- absence of fifth public Detail route;
- absence of map search;
- absence of polygon;
- absence of marketplace routes/actions.

==================================================
VISUAL REVIEW OUTPUT
==================================================

Because UX-SCR-001–009 have High-Fidelity references:

after implementation, produce browser screenshots if the development
environment/tooling supports them.

Prefer:

Desktop
+
Mobile

for human implementation review.

Do NOT regenerate ImageGen mockups.

These screenshots are IMPLEMENTATION REVIEW artifacts,
not new design sources.

If screenshot tooling is unavailable:

report that clearly instead of blocking DEV-05.

==================================================
DEV-05 COMPLETION CHECKLIST
==================================================

DEV-05 is complete only when:

[ ] UX-SCR-001 implemented.
[ ] UX-SCR-002 implemented.
[ ] UX-SCR-003 implemented.
[ ] UX-SCR-004 implemented.
[ ] UX-SCR-005 implemented.
[ ] UX-SCR-006 implemented.
[ ] UX-SCR-007 implemented.
[ ] UX-SCR-008 implemented.
[ ] UX-SCR-009 implemented.
[ ] Homepage replaces foundation placeholder.
[ ] All Public routes require no login.
[ ] ACTIVE Dusun visibility correct.
[ ] INACTIVE Dusun hidden.
[ ] Soft Deleted records hidden.
[ ] Four Detail types only.
[ ] No Contact detail.
[ ] UMKM remains non-commerce.
[ ] Pengumuman Archive remains derived.
[ ] Agenda status remains derived.
[ ] Peta Desa has Dusun + category filters.
[ ] Peta Dusun has category only.
[ ] No map search.
[ ] No polygons.
[ ] Marker sources derive from domain tables.
[ ] No generic map table/model.
[ ] Leaflet implemented.
[ ] Tile provider remains configurable/unfrozen.
[ ] Google Maps is external directions only.
[ ] WhatsApp external handoff conditional.
[ ] Empty states work.
[ ] Optional media fallback works.
[ ] Mobile responsive.
[ ] Desktop responsive.
[ ] Warm Natural compliance.
[ ] Lora + Inter preserved.
[ ] No unsupported exploratory UI.
[ ] Existing Auth tests PASS.
[ ] Existing Authorization tests PASS.
[ ] Existing Model persistence tests PASS.
[ ] New Public Core tests PASS.
[ ] npm build PASS.
[ ] Pint PASS.
[ ] Composer validate PASS.
[ ] Migration changes = 0.
[ ] Frozen documents unchanged.
[ ] High-Fidelity PNG unchanged.
[ ] Formal TC = 108/108 NOT RUN.
[ ] New Change Requests = 0 if compatible.

==================================================
FINAL REPORT
==================================================

After DEV-05 report:

1. Phase:
   DEV-05 — Public Core Implementation

2. Environment:
   PHP
   Laravel
   MariaDB
   Node/npm
   Leaflet version

3. Public screen coverage:
   UX-SCR-001 through UX-SCR-009
   individually PASS/implemented status

4. Public routes:
   list canonical route names and URIs

5. Homepage:
   frozen section order
   database-driven content
   active Dusun behavior

6. Halaman Dusun:
   section coverage
   inactive behavior
   child scoping

7. Detail pages:
   UMKM
   Fasilitas
   Agenda
   Pengumuman
   confirmation exactly four

8. Public lifecycle:
   ACTIVE/INACTIVE Dusun
   five Soft Delete resources
   Agenda state
   Pengumuman Active/Arsip

9. UMKM:
   product rendering
   WhatsApp
   non-commerce confirmation

10. Map:
    Leaflet version
    tile configuration strategy
    marker sources
    Peta Desa filters
    Peta Dusun filter
    popup
    Google Maps directions
    map failure fallback
    no search/polygon

11. Media:
    optional display/fallback
    Agenda media
    upload behavior confirmation NOT implemented

12. Responsive/visual:
    Mobile
    Desktop
    Warm Natural
    Lora/Inter
    HF 9/9 implementation-reference coverage

13. Accessibility direction:
    implemented checks

14. Development decisions:
    DEV05-DEC list

15. Automated testing:
    previous regression tests
    Public Core tests
    total tests/assertions

16. Build/code quality:
    composer validate
    Pint
    npm run build

17. Migration/model/auth integrity:
    migration changes
    model drift
    authentication regression
    authorization regression

18. Formal Testing Specification:
    108/108 remain NOT RUN

19. Source integrity:
    frozen docs unchanged
    9 High-Fidelity PNG unchanged

20. Change control:
    new CR count
    open CR count
    historical PDS-CR-001 preserved

21. Blockers

22. Completion:
    DEV-05 COMPLETE YES/NO

23. Readiness:
    READY FOR NEXT DEVELOPMENT PHASE YES/NO

STOP after DEV-05.

Do NOT begin:

Admin Dusun CRUD
Super Admin CRUD
account management UI
production data entry
formal Testing Specification execution.