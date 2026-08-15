Kita masuk ke:

DEV-04 — AUTHENTICATION & AUTHORIZATION

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

Current verified foundation:

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

Frozen relationships:
13/13

Operational SoftDelete models:
5/5

Formal Testing Specification:
108/108 NOT RUN

Open Change Requests:
0

Project is:

READY FOR DEV-04 — AUTHENTICATION & AUTHORIZATION

==================================================
PHP ENVIRONMENT — IMPORTANT
==================================================

Validated PHP executable:

C:\laragon\bin\php\php-8.3.26-Win32-vs16-x64\php.exe

Windows default PATH may still resolve to PHP 8.2.12.

ALL DEV-04 PHP / ARTISAN / COMPOSER COMMANDS
must execute under PHP 8.3.x.

Before work record:

- actual PHP executable;
- PHP version.

Do NOT weaken runtime/composer requirements for PHP 8.2.

==================================================
PRIMARY FROZEN SOURCES
==================================================

Read before implementation:

docs/04-system/roles-permissions.md
FROZEN FOR MVP

docs/04-system/erd-data-model.md
FROZEN FOR MVP

docs/04-system/physical-database-schema.md
Version 1.1
FROZEN FOR MVP

docs/06-specification/SRS.md
Version 1.1
FROZEN FOR MVP

docs/03-ux/ui-ux-specification.md
Version 1.0
FROZEN FOR MVP

docs/03-ux/wireframe-specification.md
Version 1.0
FROZEN FOR MVP

docs/03-ux/visual-design-specification.md
Version 1.0
FROZEN FOR MVP

docs/07-testing/testing-specification.md
Version 1.1
FROZEN FOR MVP

Also inspect:

- DEV-03 AdminAccount model;
- all 11 model relationships;
- config/auth.php;
- bootstrap/app.php;
- routes/web.php.

==================================================
DEV-04 OBJECTIVE
==================================================

Implement the complete MVP foundation for:

AUTHENTICATION
+
SERVER-SIDE AUTHORIZATION

Specifically:

- shared Admin login;
- username/password authentication;
- AdminAccount as authenticatable persistence;
- session-based browser authentication;
- logically removed account rejection;
- session security;
- logout;
- login throttling;
- authenticated-route protection;
- role distinction;
- OWN_DUSUN authorization;
- GLOBAL Super Admin authorization;
- Policies/Gates;
- all 12 frozen Authorization Invariants;
- focused development tests.

DEV-04 should create a stable security boundary
before CRUD and product feature development begins.

==================================================
NOT DEV-04 SCOPE
==================================================

Do NOT implement full:

- Admin Dusun dashboard;
- Super Admin dashboard;
- resource CRUD;
- village public pages;
- Homepage;
- map;
- media upload;
- account-management UI;
- password-reset management UI;
- Dusun management UI;
- Agenda/Pengumuman CRUD UI.

Minimal temporary authenticated landing placeholders are allowed
only when required to complete authentication flow.

They are NOT final product dashboard implementations.

==================================================
ACTORS — EXACTLY THREE
==================================================

Frozen actors:

1. PUBLIC USER
2. ADMIN DUSUN
3. SUPER ADMIN

Only ADMIN DUSUN and SUPER ADMIN authenticate.

PUBLIC USER:

- no account;
- no login;
- no registration.

Do NOT create:

Editor
Moderator
Citizen
Kepala Dusun software role
Developer role
Approval role

or another software role.

==================================================
AUTHENTICATION PERSISTENCE
==================================================

Authentication source:

admin_accounts

NOT:

users

Do NOT recreate:

App\Models\User

Do NOT create:

users table.

AdminAccount is the sole authenticated application model for MVP.

==================================================
ADMINACCOUNT AUTHENTICATABLE MODEL
==================================================

Convert/normalize the existing:

App\Models\AdminAccount

so it can participate in Laravel browser authentication.

Use Laravel's standard Eloquent Authenticatable foundation,
while preserving all DEV-03 behavior:

- table mapping;
- relationships;
- guarded defaults;
- casts;
- removed_at;
- no SoftDeletes.

Do NOT lose the existing Dusun relationship.

Do NOT add a User model.

==================================================
PASSWORD COLUMN
==================================================

Read the actual frozen migration/schema.

Do NOT assume the password column name.

If physical schema uses:

password

standard authentication mapping may be used.

If physical schema uses another name such as:

password_hash

configure AdminAccount's authentication password mapping correctly.

Do NOT rename a frozen database column simply to match Laravel
convention.

Do NOT add another redundant password column.

==================================================
PASSWORD HASHING
==================================================

Passwords must remain stored as secure Laravel hashes.

Use Laravel hashing facilities.

Do NOT:

- store plaintext password;
- log plaintext password;
- include password in session;
- expose hash to Blade;
- expose hash through serialization.

Hide the password/hash attribute on AdminAccount where appropriate.

Exact hashing algorithm remains Laravel configuration direction;
do not freeze a new algorithm unnecessarily.

==================================================
REMEMBER ME — NOT MVP
==================================================

Do NOT implement:

Remember Me

unless a frozen source explicitly requires it.

The physical schema does not authorize adding a `remember_token`
column merely for framework convention.

Authentication must work without persistent remember-me tokens.

Do NOT modify the migration to add `remember_token`.

==================================================
AUTH CONFIGURATION
==================================================

Configure Laravel authentication so the browser session guard uses:

AdminAccount

through an Eloquent provider.

Preferred conceptual direction:

guard:
web / session

provider:
admin_accounts / Eloquent / AdminAccount

Exact config names may follow Laravel conventions.

Do NOT configure the product around:

App\Models\User.

Do NOT create an API/token guard.

==================================================
NO AUTH PACKAGE
==================================================

Do NOT install:

- Breeze
- Fortify
- Jetstream
- Sanctum
- Passport
- Socialite
- Spatie Permission
- Filament auth
- another auth package

for DEV-04.

Use Laravel built-in browser/session authentication.

==================================================
LOGIN SCREEN
==================================================

Implement the frozen shared screen:

UX-SCR-010
Login Admin

This login serves both:

ADMIN DUSUN
and
SUPER ADMIN.

Do NOT make two separate login pages.

Inputs:

Username
Password

No:

Email
Registration
Remember Me
Forgot Password
Citizen Login

unless frozen source states otherwise.

==================================================
LOGIN VISUAL
==================================================

Login UI follows:

Wireframe Specification v1.0
+
Visual Design Specification v1.0

Use Warm Natural foundation:

Moss Green
#2E5E3E

Sage Green
#7A8F6B

Terracotta
#C46A3A

Warm Beige
#F1E7D3

Cream
#FAF7F2

Dark Olive
#2B2F23

Heading:
Lora stack

Body/UI:
Inter stack

Do not create a third font.

Do not redesign the product visual system.

==================================================
LOGIN ROUTES
==================================================

Implement only authentication routes needed by frozen UX.

Use exact URI from frozen Sitemap/UI specification if specified.

If no exact URI is frozen, use a conventional shared admin login URI
and record it as an implementation detail.

Expected route concepts:

GET:
shared Admin login form

POST:
shared Admin login authentication

POST:
logout

Use named routes where appropriate.

Do NOT create:

/register
/forgot-password
/reset-password
/email/verify

or equivalents.

==================================================
LOGIN VALIDATION
==================================================

Validate minimally at the HTTP/application boundary:

username:
required
string

password:
required
string

Use frozen validation requirements if they are more specific.

Do not invent email validation.

Do not reveal whether a username exists.

==================================================
LOGIN CREDENTIAL LOGIC
==================================================

Authentication must use:

username
+
password

and must additionally require:

removed_at IS NULL

for successful login.

IMPORTANT:

A Dusun being INACTIVE must NOT prevent an ACTIVE Admin Dusun account
from logging in.

Frozen behavior:

Admin Dusun of INACTIVE Dusun:
may still login
and manage own Dusun data.

Therefore DO NOT add:

dusun.status = ACTIVE

as a login condition.

==================================================
LOGICALLY REMOVED ACCOUNT
==================================================

AdminAccount with:

removed_at IS NOT NULL

must:

- fail new login;
- not gain authenticated application access;
- remain retained in database.

Use generic invalid-login response.

Do NOT reveal:

"this account has been removed"

during login.

That would allow account-state enumeration.

==================================================
EXISTING SESSION AFTER REMOVAL
==================================================

IMPORTANT SECURITY CASE:

If an Admin Dusun account is already authenticated
and is later logically removed by Super Admin,
its old browser session must not continue providing protected access.

Implement a lightweight authenticated-account validity middleware
or equivalent server-side protection.

For every protected admin request:

if authenticated AdminAccount has:

removed_at IS NOT NULL

then:

- terminate/logout authentication;
- invalidate session as appropriate;
- deny protected access;
- redirect to shared login or appropriate unauthenticated outcome.

Do NOT rely only on login-time removed_at filtering.

==================================================
SESSION SECURITY
==================================================

After successful authentication:

regenerate the session identifier.

On logout:

- logout authenticated account;
- invalidate current session;
- regenerate CSRF token.

Keep:

SESSION_DRIVER=file

from DEV-01.

Do NOT create a sessions database table.

==================================================
CSRF
==================================================

Authentication POST/logout routes belong to normal Laravel web/session
flow and must retain CSRF protection.

Do NOT disable CSRF for convenience.

==================================================
LOGIN ERROR RESPONSE
==================================================

Invalid cases must use a generic response.

Examples of cases producing the same public-facing authentication
failure:

- unknown username;
- incorrect password;
- logically removed account.

Do not expose:

- account existence;
- role;
- removed state;
- hash details.

==================================================
LOGIN THROTTLING
==================================================

Frozen security/testing direction requires rate limiting.

First inspect SRS/Testing Specification for any exact numeric
login-rate policy.

IF an exact value is frozen:

use it.

IF no exact numeric limit is frozen:

implement a conservative Laravel rate limit as an implementation-level
security choice and record it in DEV-04 report as a DEV implementation
decision, NOT a new product requirement.

Recommended direction if no exact value exists:

5 failed attempts per minute

using a key derived from:

normalized username
+
request IP

without exposing the raw combination unnecessarily.

On successful authentication:

clear/reset the relevant limiter state.

Do NOT implement persistent account lockout.

Do NOT add lockout columns.

==================================================
NO LOCKOUT DOMAIN STATE
==================================================

Do NOT add:

failed_login_count
locked_at
lockout_until

to admin_accounts.

Frozen schema does not include them.

Rate limiting is transient application/cache behavior.

==================================================
ROLE VALUES
==================================================

Use exact frozen persistence role values:

ADMIN_DUSUN
SUPER_ADMIN

No third role.

Small constants/helper predicates may be introduced on AdminAccount if
useful, for example conceptually:

isAdminDusun()
isSuperAdmin()
isRemoved()

Do not create a roles table.

Do not create a permissions table.

==================================================
POST-LOGIN DESTINATION
==================================================

After successful login:

ADMIN_DUSUN
→ Admin Dusun dashboard destination

SUPER_ADMIN
→ Super Admin dashboard destination

Use exact frozen route destination if already specified.

If those dashboards are not implemented yet:

create only minimal DEVELOPMENT AUTH PLACEHOLDER destinations with
correct role protection.

Clearly label them in source/view as temporary development placeholders.

Do NOT build the real dashboard in DEV-04.

==================================================
AUTHENTICATED USER REDIRECTION
==================================================

An already authenticated account that opens the shared login screen
should be redirected to its proper role destination.

Do not show login again unless the session/account is no longer valid.

==================================================
ROUTE SECURITY
==================================================

Use Laravel authentication middleware for protected admin areas.

Additionally enforce:

- active/non-removed authenticated account;
- correct role when a route area is role-specific.

UI hiding is NOT sufficient.

Direct URL access must be rejected server-side.

==================================================
ROLE-AREA MIDDLEWARE
==================================================

A small role middleware is acceptable for separating:

ADMIN_DUSUN dashboard area
from
SUPER_ADMIN dashboard area.

It must use exact role values.

Do NOT use role middleware as a substitute for resource Policies.

Resource actions must still be protected using Policies/Gates.

==================================================
AUTHORIZATION STRATEGY
==================================================

Implement server-side authorization using:

Laravel Policies
and/or Gates

consistent with the frozen Technical R&D.

Prefer Policies around domain models/resources.

Do NOT create a custom permission framework.

Do NOT install Spatie Permission.

Do NOT rely solely on Blade `@can`.

Server-side authorization is authoritative.

==================================================
NO GLOBAL SUPER ADMIN BYPASS
==================================================

Do NOT implement a blanket:

Gate::before(...)
→ always true for SUPER_ADMIN

because frozen authorization includes explicit exceptions.

Example:

Super Admin cannot hard-delete Dusun.

Account lifecycle also has restricted operations.

Therefore Super Admin authorization must remain explicit enough that
frozen exceptions are preserved.

==================================================
POLICY INVENTORY
==================================================

Mechanically derive required Policies from:

roles-permissions.md
+
the 11 domain models.

Expected model-policy families should cover the applicable resources:

Desa
Dusun
AdminAccount
KontakPelayanan
Umkm
ProdukUmkm
KategoriFasilitas
Fasilitas
AgendaKegiatan
AgendaMedia
Pengumuman

Target:

all authorization-bearing domain resources covered.

Do NOT create policies for nonexistent:

MapPoint
GenericMedia
Role
Permission
Archive

resources.

==================================================
FROZEN ACTION VOCABULARY
==================================================

Authorization logic must preserve frozen conceptual actions such as:

VIEW_PUBLIC
VIEW
CREATE
UPDATE
ACTIVATE
DEACTIVATE
SOFT_DELETE
RESTORE
HARD_DELETE
MANAGE
RESET_PASSWORD
ASSIGN_DUSUN

Map these sensibly to Laravel policy abilities.

Standard Laravel method names may include:

viewAny
view
create
update
delete
restore
forceDelete

Custom abilities may be used where needed:

activate
deactivate
resetPassword
assignDusun
removeAccount

or equivalent clear naming.

Do not collapse conceptually distinct actions if it would lose a
frozen permission boundary.

==================================================
ADMIN DUSUN SCOPE
==================================================

Admin Dusun:

scope = OWN_DUSUN

Exactly one Dusun.

For resources owned by Dusun:

Admin may only access/mutate records whose ownership resolves to:

authenticated AdminAccount.dusun_id

Direct request with foreign ID must fail authorization.

Do NOT trust:

- hidden fields;
- URL origin;
- selected UI;
- submitted dusun_id.

Authorization must derive scope server-side from authenticated account
and actual persisted resource ownership.

==================================================
ADMIN DUSUN — NO DUSUN SELECTOR SEMANTICS
==================================================

Authorization foundation must never require an Admin Dusun to choose its
current Dusun.

Authenticated Admin Dusun context comes from:

admin_accounts.dusun_id

Do NOT build a session-selected tenant mechanism.

Do NOT implement "switch Dusun".

==================================================
ADMIN DUSUN — INACTIVE PARENT
==================================================

Admin Dusun remains allowed to login/manage permitted OWN_DUSUN data
when its bound Dusun is INACTIVE.

Do NOT reject authorization solely because:

dusuns.status_dusun = INACTIVE.

Public visibility is separate and will be handled later.

==================================================
SUPER ADMIN SCOPE
==================================================

Super Admin:

scope = GLOBAL

May manage global/Dusun resources according to frozen
Roles/Permissions.

But explicit frozen restrictions remain.

Do NOT assume:

SUPER_ADMIN = everything always allowed.

==================================================
DESA POLICY
==================================================

Implement according to Roles/Permissions.

Global Desa identity management belongs to Super Admin.

Admin Dusun must not gain village-global management.

Public viewing is not an authenticated management permission.

==================================================
DUSUN POLICY
==================================================

Preserve distinction between:

Admin Dusun editing permitted OWN_DUSUN profile fields

versus:

Super Admin controlling Dusun lifecycle status.

Admin Dusun:

may update allowed own profile fields
but may NOT:

- activate Dusun;
- deactivate Dusun;
- hard-delete Dusun;
- switch target Dusun.

Super Admin:

may manage Dusun according to frozen permissions,
including ACTIVE/INACTIVE lifecycle.

Hard delete Dusun:

DENIED for everyone.

==================================================
OPERATIONAL RESOURCE POLICIES
==================================================

For:

KontakPelayanan
Umkm
Fasilitas
AgendaKegiatan
Pengumuman

Admin Dusun:

- create in OWN_DUSUN when authorized;
- view/manage OWN_DUSUN;
- update OWN_DUSUN;
- soft delete OWN_DUSUN;
- NO restore;
- NO hard delete.

Super Admin:

GLOBAL access according to frozen roles;
may restore/hard-delete applicable operational records.

Do not expose these actions through controllers yet.

Policies should be ready for later phases.

==================================================
SOFT DELETE AUTHORIZATION
==================================================

Laravel policy semantics may map:

delete
→ operational Soft Delete

restore
→ RESTORE

forceDelete
→ HARD_DELETE

for the five SoftDelete resources.

Admin Dusun:

delete own:
allowed where frozen

restore:
false

forceDelete:
false

Super Admin:

restore:
allowed where applicable

forceDelete:
allowed where applicable and not blocked by FK/state.

Database restrictions remain authoritative too.

==================================================
PRODUCT UMKM POLICY
==================================================

ProdukUmkm is a child resource.

It inherits ownership from:

Umkm
→ Dusun.

Do NOT give products an independent business scope.

Policy should derive authorization through the parent UMKM.

No commerce actions.

==================================================
AGENDA MEDIA POLICY
==================================================

AgendaMedia follows its parent:

AgendaKegiatan.

No independent permission/business scope.

Authorization should delegate/derive from Agenda ownership and
permission.

==================================================
CATEGORY POLICY
==================================================

KategoriFasilitas management:

SUPER ADMIN only.

Admin Dusun:

cannot manage facility categories.

Do not infer category ownership from current Dusun.

==================================================
AGENDA POLICY
==================================================

Admin Dusun may manage only:

DUSUN-scoped Agenda
whose dusun_id equals authenticated OWN_DUSUN.

Admin Dusun must NOT create/manage:

DESA-scoped Agenda.

Super Admin may manage:

DESA
and
DUSUN

according to frozen global scope.

Authorization and future validation remain separate responsibilities.

==================================================
PENGUMUMAN POLICY
==================================================

Same scope boundary:

Admin Dusun:
DUSUN + OWN_DUSUN only.

Super Admin:
DESA or DUSUN globally.

Archive status does NOT change permission category.

Soft Deleted lifecycle remains separate.

==================================================
ADMIN ACCOUNT POLICY
==================================================

Admin Dusun account management is:

SUPER ADMIN only.

No Admin Dusun may manage software accounts.

Target account resource is frozen as Admin Dusun account management.

Do NOT create Super Admin account creation capability.

==================================================
ADMIN ACCOUNT ACTIVE VS REMOVED
==================================================

For target Admin Dusun account:

ACTIVE account may be eligible for actions such as:

- manage/assign Dusun;
- reset password;
- logical removal;

according to frozen permissions.

LOGICALLY REMOVED account is retained read-only.

For logically removed target:

DENY mutation abilities including:

- update/reassign;
- reset password;
- remove again;
- restore;
- reactivate;
- username reuse/merge behavior.

No restore authorization should exist.

==================================================
RESET PASSWORD AUTHORIZATION
==================================================

Implement the POLICY/ABILITY boundary for:

RESET_PASSWORD

Super Admin only
against applicable ACTIVE Admin Dusun account.

Do NOT implement the actual Reset Password form/controller in DEV-04
unless absolutely needed for an authorization test.

The management feature belongs to later Super Admin development.

==================================================
ASSIGN DUSUN AUTHORIZATION
==================================================

Implement authorization ability:

ASSIGN_DUSUN

Super Admin only
for applicable ACTIVE Admin Dusun account.

This does not mean changing assignment is implemented in DEV-04.

Only the server-side permission contract is established.

==================================================
LOGICAL REMOVAL AUTHORIZATION
==================================================

Implement policy ability for logical removal if needed.

Only Super Admin can logically remove an applicable ACTIVE Admin Dusun
account.

No hard-delete Admin account action.

No restore action.

==================================================
PUBLIC USER AUTHORIZATION
==================================================

Public User is unauthenticated.

Do NOT force public resource views through admin authorization Policies
in a way that requires an account.

Public visibility logic belongs to public feature implementation.

DEV-04 policies primarily govern authenticated management operations.

==================================================
12 AUTHORIZATION INVARIANTS
==================================================

Mechanically map and implement:

AUTH-INV-001
through
AUTH-INV-012

from frozen Roles/Permissions/SRS.

Target:

12/12.

Do NOT merely claim coverage.

Create focused automated development tests proving each invariant.

==================================================
AUTH-INV TEST PRINCIPLE
==================================================

For scope/security cases test both:

1. normal policy decision;

and where technically meaningful:

2. direct HTTP/protected route behavior.

A foreign record must remain denied even if:

- URL is manually modified;
- ID is submitted directly;
- UI restriction is bypassed.

==================================================
ROUTE MODEL BINDING SAFETY
==================================================

Do NOT assume route model binding itself provides authorization.

Future controllers must authorize the resolved resource.

For DEV-04 tests, explicitly prove:

foreign resource + authenticated Admin Dusun
→ denied.

==================================================
POLICY REGISTRATION
==================================================

Use deterministic Laravel policy registration/discovery.

Standard policy naming/discovery is acceptable if tests prove the
correct policy resolves.

Explicit registration is also acceptable.

Do not create redundant custom authorization registries.

==================================================
MASS ASSIGNMENT
==================================================

Keep DEV-03 conservative model guarding.

Do NOT loosen models to:

$guarded = []

for authentication implementation.

Login needs querying, not broad mass assignment.

==================================================
MIGRATION FREEZE
==================================================

DEV-02 migrations are verified.

Expected migration changes in DEV-04:

ZERO.

Do NOT add:

remember_token
login_attempts
locked_at
sessions table
roles table
permissions table
tokens table

or another auth persistence table.

If authentication cannot be implemented without schema change:

STOP and report exact conflict.

Do not silently modify PDS.

==================================================
LOGIN / AUTH CONTROLLER
==================================================

A small dedicated authentication controller is appropriate.

Keep it narrow.

Responsibilities may include:

- show login;
- authenticate;
- logout.

Do NOT place unrelated account CRUD in it.

==================================================
FORM REQUEST CHOICE
==================================================

A focused Login Request may be created if it simplifies:

- login validation;
- rate limiting;
- authentication.

Keep it auth-specific.

Do NOT start implementing all application Form Requests.

==================================================
PASSWORD RESET BOUNDARY
==================================================

There is NO:

self-service forgot password.

There is NO:

email password reset.

There is NO:

password-reset token table.

Frozen Super Admin RESET_PASSWORD management is a future authenticated
management action, not a public recovery workflow.

OPEN-010 Super Admin recovery remains unresolved/non-blocking.

Do not invent a recovery mechanism.

==================================================
TEST DATA
==================================================

Use synthetic accounts only.

At minimum test fixtures for:

- ACTIVE ADMIN_DUSUN of ACTIVE Dusun;
- ACTIVE ADMIN_DUSUN of INACTIVE Dusun;
- ADMIN_DUSUN with removed_at;
- SUPER_ADMIN;
- invalid username;
- wrong password;
- multiple Dusun records for cross-scope testing.

No real production credential.

No official administrator account.

==================================================
PASSWORD TEST FIXTURES
==================================================

Generate test hashes with Laravel Hash facilities.

Do not put plaintext credentials into:

- committed production config;
- docs;
- logs.

Synthetic test passwords in test source are acceptable only as obvious
test fixtures.

==================================================
AUTHENTICATION DEVELOPMENT TESTS
==================================================

Create focused automated tests.

At minimum verify:

1. Shared login page GET succeeds.

2. Login uses username, not email.

3. Valid ADMIN_DUSUN login succeeds.

4. Valid SUPER_ADMIN login succeeds.

5. Wrong password fails.

6. Unknown username fails with same generic response.

7. Removed Admin account fails login.

8. Admin of INACTIVE Dusun can login.

9. Successful login regenerates/establishes correct authenticated
   session safely.

10. Authenticated role redirects to correct destination.

11. Authenticated user opening login redirects appropriately.

12. Logout clears authentication.

13. Protected admin route rejects unauthenticated request.

14. Removed account with previously valid session loses protected
    access on subsequent request.

15. CSRF/web middleware remains active.

16. Rate limiting triggers after configured threshold.

17. Successful login clears limiter where implemented.

18. No registration route.

19. No forgot-password route.

20. No remember-me persistence.

==================================================
AUTHORIZATION DEVELOPMENT TESTS
==================================================

At minimum test:

- all 12 Authorization Invariants;
- Admin own vs foreign Dusun resource;
- Super Admin global access;
- Admin cannot manage categories;
- Admin cannot manage accounts;
- Admin cannot restore;
- Admin cannot hard delete;
- everyone cannot hard-delete Dusun;
- Admin may manage own data while Dusun INACTIVE;
- ProdukUmkm follows parent;
- AgendaMedia follows parent;
- Admin Agenda DESA denied;
- Admin Pengumuman DESA denied;
- removed target Admin account is read-only;
- resetPassword target eligibility;
- assignDusun target eligibility.

==================================================
NO FORMAL TC EXECUTION YET
==================================================

Testing Specification v1.1 contains:

108 formal test cases.

They remain:

108/108 NOT RUN.

Development tests may overlap conceptually with:

TC-AD-001
TC-AUTH-001–012
TC-LIFE-004
TC-ERR-001–002
security cases

but DO NOT edit formal status.

Report:

DEV-04 development test PASS/FAIL

separately from formal TC execution.

==================================================
DATABASE TEST ENVIRONMENT
==================================================

Use MariaDB for database-dependent auth/policy tests.

Do NOT silently switch to SQLite when testing:

- AdminAccount;
- role/scope constraints;
- ownership;
- removed_at;
- relationships.

Use confirmed local test DB such as:

portal_desa_bendung_test

on safe MariaDB instance.

Verify environment safety before destructive reset.

==================================================
TEMPORARY DASHBOARD PLACEHOLDERS
==================================================

If role redirect requires dashboard route targets before the real
dashboard phase:

create only minimal placeholders such as conceptually:

Admin Dusun Dashboard
DEVELOPMENT PLACEHOLDER

Super Admin Dashboard
DEVELOPMENT PLACEHOLDER

They must:

- be protected;
- be role-correct;
- contain no CRUD;
- contain no fabricated business data;
- be easy to replace.

Do NOT count them as UX-SCR-011 / UX-SCR-018 completed implementations.

==================================================
ROOT PUBLIC FOUNDATION
==================================================

Do not unnecessarily replace the current `/` foundation placeholder
with Homepage during DEV-04.

Public implementation comes later.

==================================================
VISUAL SCOPE
==================================================

Only Login Admin requires actual user-facing visual implementation in
DEV-04.

Use:

Wireframe + Visual Design Specification.

No high-fidelity mockup exists for UX-SCR-010,
which is intentional.

Do NOT treat missing PNG as a blocker.

==================================================
SECURITY REVIEW
==================================================

Check:

- generic credential errors;
- no account enumeration;
- no password leakage;
- CSRF retained;
- session regeneration;
- session invalidation on logout;
- removed-session denial;
- login throttling;
- unauthorized direct access denied;
- no role escalation through payload;
- no cross-Dusun access through ID manipulation.

==================================================
NO ROLE FROM REQUEST
==================================================

Never trust submitted:

role

to determine authenticated role.

Role comes from persisted:

admin_accounts.role.

Never trust submitted:

dusun_id

to determine Admin Dusun scope.

OWN_DUSUN comes from:

authenticated admin_accounts.dusun_id.

==================================================
NO SESSION TENANT OVERRIDE
==================================================

Do NOT store a mutable current_dusun selection in session for
ADMIN_DUSUN.

Its scope is permanently bound by persistence.

SUPER_ADMIN filters later may choose Dusun for viewing/management,
but this is not an authentication tenant switch.

==================================================
EXCEPTION / FAILURE BEHAVIOR
==================================================

Authentication and authorization failure must not expose:

- SQL;
- stack trace;
- password hash;
- internal role-scope constraint details;
- private record existence.

Use normal safe Laravel failure responses.

==================================================
CODE STRUCTURE
==================================================

Expected DEV-04 changes may include:

app/Models/AdminAccount.php
config/auth.php
app/Http/Controllers/Auth/*
app/Http/Requests/Auth/*
app/Http/Middleware/*
app/Policies/*
app/Providers/*
bootstrap/app.php
routes/web.php
resources/views/auth/*
tests/Feature/Auth/*
tests/Feature/Authorization/*

Only create what is genuinely required.

Do not build excessive architecture.

==================================================
NO REPOSITORY / PERMISSION ENGINE
==================================================

Do not create:

AuthRepository
PermissionRepository
RoleService framework
ACL engine
RBAC database abstraction

Eloquent + Laravel Auth + Policies/Gates are sufficient.

==================================================
DEV IMPLEMENTATION DECISIONS
==================================================

If DEV-04 must choose a non-product implementation detail not frozen,
record it in final report as:

DEV04-DEC-xxx

Examples:

- exact login throttle numeric value if source does not specify it;
- exact conventional login URI if source only specifies the screen;
- exact temporary dashboard placeholder URI.

Such decisions:

- do not alter product behavior;
- do not modify frozen specs;
- are not automatically Change Requests.

Target:
minimum necessary.

==================================================
SOURCE FREEZE
==================================================

Do NOT modify any FROZEN documentation.

Do NOT modify High-Fidelity PNG files.

Do NOT modify DEV-02 migrations.

Expected new Change Requests:

0.

==================================================
VALIDATION COMMANDS
==================================================

Using PHP 8.3:

php -v

php artisan --version

php artisan about

php artisan route:list

php artisan migrate:status

php artisan test

composer validate

vendor/bin/pint --test

If frontend/login CSS changed:

npm run build

Also inspect route list for absence of:

register
forgot-password
reset-password
email verification

and other unsupported auth routes.

==================================================
AUTH CONFIG AUDIT
==================================================

Verify after implementation:

- auth guard points to correct provider;
- provider points to AdminAccount;
- no provider references App\Models\User;
- no authentication table other than admin_accounts;
- no password broker dependency creates a table;
- no remember_token dependency;
- file sessions remain configured.

==================================================
AUTHORIZATION MATRIX AUDIT
==================================================

Produce a mechanical matrix internally/final report showing:

Policy/resource
×
ADMIN_DUSUN OWN_DUSUN
×
ADMIN_DUSUN FOREIGN
×
SUPER_ADMIN

for relevant actions.

Compare directly to frozen Roles/Permissions.

Target:

Authorization Invariant:
12/12

Roles/Permissions contradictions:
0.

==================================================
DEV-04 COMPLETION CHECKLIST
==================================================

DEV-04 is complete only when:

[ ] PHP 8.3.x confirmed.
[ ] AdminAccount is Laravel-authenticatable.
[ ] Existing relationships/casts preserved.
[ ] No User model.
[ ] No new auth database table.
[ ] No migration changed.
[ ] Shared Admin login exists.
[ ] Login uses username/password.
[ ] No email login requirement.
[ ] No registration.
[ ] No remember-me.
[ ] No forgot-password/self-service reset.
[ ] Removed account cannot login.
[ ] Inactive-Dusun Admin can login.
[ ] Successful login regenerates session.
[ ] Logout invalidates session and regenerates CSRF token.
[ ] Existing session of removed account loses protected access.
[ ] Login errors are generic.
[ ] Login rate limiting works.
[ ] Protected routes require authentication.
[ ] Role-specific area protection works.
[ ] Policies/Gates implemented.
[ ] 12/12 Authorization Invariants development-tested.
[ ] OWN_DUSUN tested server-side.
[ ] Foreign direct-ID access denied.
[ ] Admin cannot restore.
[ ] Admin cannot hard delete.
[ ] Dusun hard delete denied for everyone.
[ ] Category management Super Admin only.
[ ] Account management Super Admin only.
[ ] Child permission inheritance works.
[ ] Removed Admin account target read-only.
[ ] No global Super Admin bypass violates exceptions.
[ ] No CRUD business feature implemented.
[ ] No actual dashboards implemented beyond placeholders if needed.
[ ] Formal Testing Specification remains 108/108 NOT RUN.
[ ] Frozen docs unchanged.
[ ] High-Fidelity PNG unchanged.
[ ] New CR count = 0 if compatible.
[ ] Development tests PASS.

==================================================
FINAL REPORT
==================================================

After DEV-04 report:

1. Phase:
   DEV-04 — Authentication & Authorization

2. Environment:
   - PHP executable/version
   - Laravel version
   - MariaDB test database/version if used

3. Authentication model:
   - AdminAccount authenticatable status
   - password column mapping
   - removed_at behavior
   - User model status

4. Auth config:
   - guard
   - provider
   - session driver
   - remember-me status
   - unsupported auth provider/table count

5. Auth routes:
   - login GET
   - login POST
   - logout POST
   - temporary role destinations if any
   - unsupported routes count

6. Authentication behavior:
   - ADMIN_DUSUN login
   - SUPER_ADMIN login
   - invalid credential handling
   - removed account
   - INACTIVE-Dusun Admin
   - session regeneration
   - logout
   - stale removed-account session
   - rate limiter

7. Login UI:
   - UX-SCR-010 implementation status
   - Wireframe compliance
   - Warm Natural compliance

8. Policy inventory:
   - policy count
   - model/resource coverage

9. Authorization:
   - 12/12 Authorization Invariant development coverage
   - OWN_DUSUN isolation
   - GLOBAL scope
   - Dusun hard-delete boundary
   - restore/hard-delete boundary
   - category boundary
   - account boundary
   - child inheritance

10. DEV implementation decisions:
    - DEV04-DEC count/list

11. Development tests:
    - total tests
    - assertions
    - PASS/FAIL
    - MariaDB usage

12. Existing regression:
    - DEV-03 tests still PASS
    - migrations unchanged
    - route audit

13. Formal testing:
    - 108/108 remain NOT RUN

14. Source integrity:
    - frozen docs unchanged
    - High-Fidelity PNG unchanged
    - DEV-02 migration checksum unchanged

15. Change control:
    - new CR count
    - open CR count
    - historical PDS-CR-001 preserved

16. Blockers

17. Completion:
    DEV-04 COMPLETE YES/NO

18. Readiness:
    READY FOR NEXT DEVELOPMENT PHASE YES/NO

STOP after DEV-04.

Do NOT automatically implement:
resource CRUD,
public pages,
Admin Dusun dashboard,
Super Admin dashboard,
map,
media upload,
or Batch 2/3 mockups.