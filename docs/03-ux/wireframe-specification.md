# Low-Fidelity Wireframe Specification

**Project:** Portal Informasi Desa Bendung  
**Document:** Wireframe Specification  
**Version:** 1.0  
**Status:** FROZEN FOR MVP  
**Primary UX Source:** UI/UX Specification v1.0 — FROZEN FOR MVP  
**Supporting Sources:** Sitemap v1.0; User Flows v1.0; SRS v1.0; Roles & Permissions v1.0  
**Existing Visual References:** Warm Natural — DIRECTION REFERENCE ONLY; Homepage Exploratory High-Fidelity Mockup — UX-SCR-001 ONLY  

## 1. Document Purpose

Dokumen ini menerjemahkan UI/UX Behavior & Interaction Specification v1.0 menjadi layout low-fidelity yang dapat divisualisasikan tanpa mengubah product behavior. Specification menentukan layout structure, content hierarchy, component placement, responsive composition, form/list/map layout, important states, dan interaction annotations untuk seluruh 28 screen/context FROZEN.

**Human Review Note:** Wireframe Specification v1.0 telah melalui human review dan ditetapkan **FROZEN FOR MVP**.

Dokumen ini bukan visual design. Exploratory Homepage mockup tidak menggantikan low-fidelity wireframe `UX-SCR-001`. Seluruh `UX-SCR-001–028` memakai format, notation, responsive annotation, state coverage, dan traceability yang konsisten.

UI/UX Specification v1.0 adalah primary working source untuk layout ini, tetapi tidak mengalahkan authority upstream yang membentuknya. Jika terjadi contradiction, source FROZEN yang lebih upstream menang; Wireframe Specification tidak mengubah source untuk menyesuaikan aset visual atau preference layout. Tidak ditemukan contradiction dalam finalisasi v1.0.

## 2. Wireframe Principles

- Mobile-first dan information-hierarchy-first.
- Sederhana, public-first, readable, touch-friendly, dan lightweight.
- Cognitive load rendah dan interaction yang tidak perlu diminimalkan.
- Admin CRUD konsisten dengan role/context yang selalu jelas.
- Destructive action dibedakan dari save normal.
- Hierarchy dan interaction hanya berasal dari source FROZEN, bukan styling aset eksploratif.

## 3. Device Views

Setiap screen mempunyai **MOBILE WIREFRAME** dan **DESKTOP WIREFRAME**. Tablet diturunkan dari responsive rules: layout mobile berkembang sesuai ruang dan dashboard navigation dapat collapsible. Tidak ada exact pixel breakpoint.

## 4. Wireframe Notation

Wireframe memakai ASCII/textual notation dan placeholder berikut:

`[LOGO]`, `[IMAGE]`, `[MAP]`, `[CARD]`, `[TABLE]`, `[BUTTON]`, `[INPUT]`, `[STATUS]`, `[EMPTY STATE]`, `[ERROR]`, `[LOADING]`, `[DIALOG]`.

Semua diagram grayscale secara konsep, semantic, style-neutral, dan tidak mengandung palette, hex value, font family, exact font size, spacing token, radius, shadow, illustration treatment, atau CSS property.

## 5. Screen Source Lock

Wireframe hanya mencakup `UX-SCR-001–028`: 9 public context, 1 authentication screen, 7 Admin Dusun screen, dan 11 Super Admin screen. Create/edit state berada dalam management screen yang sudah FROZEN dan tidak membentuk PAGE/DETAIL baru. Public Detail tetap tepat empat; Kontak Pelayanan tidak memperoleh Detail kelima.

## 6. Public Header Wireframe

Mobile:

```text
┌──────────────────────────────┐
│ [LOGO] Nama Desa      [MENU] │
└──────────────────────────────┘
```

Desktop:

```text
┌──────────────────────────────────────────────────────────┐
│ [LOGO] Nama Desa        [PRIMARY NAVIGATION]             │
└──────────────────────────────────────────────────────────┘
```

Login Admin bukan primary public CTA. Tidak ada mega menu. Homepage mockup tidak mengunci styling header.

## 7. Homepage Wireframe

`UX-SCR-001` mengikuti `UX-DEC-001`: Hero/Identitas → Pilihan Dusun → Informasi Desa → Pengumuman terbaru → Agenda terbaru → Peta Desa → Kontak Desa → Footer. Mobile satu kolom; desktop memakai content width konseptual, grid bila sesuai, dan map besar tanpa mengambil seluruh page. Diagram normatif terdapat pada catalogue Section 39.

Hierarchy `UX-SCR-001` telah memiliki exploratory high-fidelity Homepage reference dan secara umum telah divalidasi secara visual. Wireframe ini tetap menjadi low-fidelity normative layout reference agar notation, structure, responsive behavior, dan traceability konsisten dengan `UX-SCR-002–028`. Tidak ada token visual dari mockup yang diadopsi.

## 8. Halaman Dusun Wireframe

Urutan tetap: Banner/header, Nama Dusun, Quick Navigation, Profil, Kepala Dusun, Kontak, UMKM, Fasilitas, Agenda, Pengumuman, dan Peta Dusun. Quick navigation horizontal-scroll pada mobile dan horizontal/static pada desktop. Setiap section menyediakan heading, content/list, dan area `[EMPTY STATE]`.

## 9. Public Resource Card Wireframes

| Resource | Mobile card hierarchy | Desktop card/list hierarchy |
| --- | --- | --- |
| Kontak | `[IMAGE?]` → nama/jabatan → `[WHATSAPP]` → location context bila eligible | Compact identity + contact/action; tidak memaksa Detail. |
| UMKM | `[IMAGE?]` → nama/jenis → product summary → alamat → `[DETAIL]` | Card grid/list dengan metadata dan action; coordinates absent tidak memberi map affordance. |
| Fasilitas | `[IMAGE?]` → nama/kategori → alamat → `[DETAIL/ARAH]` | Card/list dengan kategori dan location action; WhatsApp hanya bila tersedia. |
| Agenda | judul → date/status → lokasi → media indicator → `[DETAIL]` | Card/list yang memudahkan scanning tiga effective statuses. |
| Pengumuman | judul → scope/status → `[DETAIL]` | List/card membedakan Aktif dan Arsip tanpa menyebut Soft Delete sebagai Arsip. |

Resource memakai hierarchy yang konsisten tetapi tidak dipaksa menjadi satu generic visual card.

## 10. Public Detail Wireframes

Empat full-content view mengikuti `UX-DEC-003`: `[BACK/CONTEXT]`, `[TITLE]`, `[METADATA]`, `[MEDIA?]`, `[PRIMARY CONTENT]`, `[PRIMARY ACTION]`, dan `[SECONDARY ACTION]`. Kontak Pelayanan tetap card/marker/context dan tidak membentuk Detail kelima.

## 11. Peta Desa Wireframe

Mobile: Title → Dusun Filter → Category Filter → Map → conceptual popup. Desktop: Title → filter row → large map. Kedua filter wajib tersedia. `SEMUA` adalah UI filter option, bukan stored value.

## 12. Peta Dusun Wireframe

Mobile dan desktop: Dusun Context → Category Filter → Map. Tidak ada Dusun selector karena context implicit dari Halaman Dusun.

## 13. Map Popup Wireframe

```text
┌──────────────────────────┐
│ [IMAGE optional]         │
│ Name                     │
│ Category                 │
│ Address (if applicable)  │
│ [DETAIL/CONTEXT] [ARAH?] │
└──────────────────────────┘
```

Directions hanya ketika applicable dan koordinat valid. Marker Pelayanan tidak mendapat separate detail page; alamat pelayanan optional tidak dipresentasikan sebagai required.

## 14. Login Wireframe

Form satu kolom berisi portal/admin identity, Username, Password, Login, generic error, dan instruction reset password. Tidak ada Email, Register, atau Forgot Password self-service.

## 15. Dashboard Shell Wireframe

Desktop:

```text
┌──────────────┬──────────────────────────────────┐
│ SIDEBAR      │ TOPBAR / ROLE / CONTEXT          │
│ expanded     ├──────────────────────────────────┤
│ by default   │ MAIN CONTENT                     │
│ [COLLAPSE]   │                                  │
└──────────────┴──────────────────────────────────┘
```

Mobile:

```text
┌──────────────────────────────┐
│ TOPBAR [MENU] [ACCOUNT]      │
├──────────────────────────────┤
│ ROLE / FIXED OR GLOBAL CONTEXT│
├──────────────────────────────┤
│ MAIN CONTENT                 │
└──────────────────────────────┘
```

Desktop sidebar expanded by default dan dapat collapse; mobile memakai openable panel. Exact dimensions/icons tidak ditetapkan.

## 16. Admin Dusun Dashboard

Menampilkan role Admin Dusun, fixed Dusun context, navigation enam area, dan tanpa Dusun selector. Ketika Dusun INACTIVE, informational notice tampil tanpa activation action.

## 17. Super Admin Dashboard

Menampilkan GLOBAL context dan navigation sepuluh area. Summary block MAY dipakai bila hanya merangkum data yang sudah ada; tidak ada analytics requirement baru.

## 18. Management List Wireframe

Desktop: `[TITLE] [CREATE?]` → `[FILTERS?]` → `[TABLE: Data | Status | Context | Actions]`. Mobile: `[TITLE]` → `[CREATE?]` → `[FILTERS?]` → stacked `[CARD ROW]`.

Pagination MAY digunakan bila volume memerlukan. Pagination vs simple list, page size, dan exact control ditentukan saat implementation/visual refinement. Infinite scroll tidak ditetapkan.

## 19. Admin Dusun Soft Delete List Behavior

Normal list hanya memuat active/non-Soft-Deleted records. Setelah Nonaktifkan, row keluar dari normal list. Tidak ada deleted tab, Soft Deleted filter, recycle bin, restore screen/action, atau hard-delete browsing UI.

## 20. Super Admin Soft Delete List Behavior

Management area yang sama memiliki conceptual status filter `[Aktif | Nonaktif | Semua]`; exact label dapat dirapikan kemudian. Soft Deleted row menyediakan `[RESTORE]` dan `[HARD DELETE]` hanya bila applicable. Istilah Arsip tidak dipakai.

## 21. Create/Edit Form Wireframe

```text
[PAGE TITLE]
[FIELD GROUP]
  Label
  [INPUT]
  Helper / [FIELD ERROR]
[FIELD GROUP]
[CANCEL] [SAVE]
```

Mobile satu kolom. Desktop dapat dua kolom hanya jika reading/focus order tetap jelas. Tidak ada wizard.

## 22. Profil Dusun Form

Admin Dusun dapat mengedit supported OWN_DUSUN profile fields termasuk nama Dusun. Binding Dusun dan status ACTIVE/INACTIVE tidak editable; tidak ada Dusun selector. Super Admin mengelola profile/status pada context screen terpisah yang sesuai.

## 23. Kontak Form

Nama, jabatan, dan WhatsApp required; foto, alamat, latitude, dan longitude optional. Coordinates menggunakan `[MAP PICKER]`, Lat, dan Lng; pair optional harus sama-sama kosong/terisi. Tidak ada consent field.

## 24. UMKM Form

Identity, owner, type, description, address, WhatsApp, operational hours, optional main photo, optional coordinate pair, dan repeatable product rows. Tidak ada commerce controls.

## 25. Fasilitas Form

Category selector, name, description, address, required coordinate picker, optional photo, dan optional WhatsApp. Admin Dusun tidak dapat manage category dari form ini.

## 26. Agenda Form

Admin Dusun tidak mendapat scope/Dusun selector. Read-only context dapat menunjukkan `Scope: Dusun` dan OWN_DUSUN. Fields: title, description, start date, optional end date/time, location, optional manual override, dan media.

Super Admin mendapat selector DESA/DUSUN; Dusun selector hanya tampil bila DUSUN.

## 27. Pengumuman Form

Admin Dusun memakai fixed DUSUN/OWN_DUSUN context tanpa scope/Dusun selector. Super Admin memilih DESA/DUSUN dan memilih Dusun hanya bila DUSUN. Fields: title, content, expiry. Tidak ada Archive action/control.

## 28. Admin Account Form

Super Admin membuat Admin Dusun melalui Username, initial Password, dan assignment tepat satu Dusun. Role fixed `ADMIN_DUSUN`; tidak ada role selector, create Super Admin UI, account restore, atau username recycling. Removed username tetap reserved.

## 29. Reset Password Wireframe

```text
┌──────────────────────────┐
│ Reset Password           │
│ Target Admin: [CONTEXT]  │
│ New Password [INPUT]     │
│ [CANCEL] [RESET]         │
└──────────────────────────┘
```

Existing password/hash tidak ditampilkan. Tidak ada email reset.

## 30. Dusun Status Action Wireframe

Super Admin list row: `Dusun Name | [STATUS] | [Activate/Nonaktifkan]`. Confirmation menjelaskan public visibility, retained child, retained Admin access, dan no auto-restore. Tidak ada Delete atau Add Dusun.

## 31. Soft Delete Confirmation

Medium-risk dialog: “Nonaktifkan data?” dan pesan bahwa data tidak tampil public tetapi tetap tersimpan. Versi Admin Dusun tidak menyebut restore action yang tidak dimilikinya. Exact copy tetap content refinement.

## 32. Hard Delete Confirmation

High-risk dialog menunjukkan target identity, permanent warning, dan explicit destructive CTA. Super Admin only; no hard delete Dusun. Admin Account logical removal bukan generic hard delete.

## 33. Restore Wireframe

Super Admin menemukan Soft Deleted row melalui status filter dan memilih `[RESTORE]`. Confirmation ringan/medium dapat dipakai. Feedback tidak menjamin public visibility karena parent/privacy/lifecycle lain tetap berlaku.

## 34. Status Badge Wireframes

| Axis | Conceptual labels |
| --- | --- |
| Dusun | Aktif; Nonaktif |
| Operational | Aktif; Nonaktif |
| Agenda | Akan Datang; Berlangsung; Selesai |
| Pengumuman | Aktif; Arsip |
| Account | Aktif; Logically Removed/Nonaktif Akun (copy dapat dirapikan) |

Badge tidak hanya mengandalkan warna dan tidak mencampur lifecycle axes.

## 35. Empty State Wireframes

Public: `[EMPTY ILLUSTRATION optional] Belum ada data.` Admin: `Belum ada data. [TAMBAH DATA]` hanya bila actor berhak. Super Admin filtered Soft Delete list: `Tidak ada data dengan status ini.`

## 36. Error State Wireframes

Field validation ditempatkan dekat field dan summary bila jamak. Auth error generic; authorization denied tidak mengekspos data; upload/map/server/FK error memberi message actionable tanpa SQL, constraint name, path, stack trace, atau secret.

## 37. Loading State Wireframes

Gunakan `[Saving...]`, `[Uploading...]`, atau `[Loading Map...]` dekat trigger/context. Repeated action disabled selama processing. Skeleton tidak diwajibkan di semua section.

## 38. Responsive Annotations

Setiap screen catalogue menjelaskan transformasi mobile dan desktop. Focus/reading order mengikuti urutan visual yang sama; action tetap touch-friendly; tablet tidak menjadi screen unik.

## 39. Screen Specification Catalogue

Format setiap screen: Source, Existing Visual Reference, Mobile, Desktop, Interaction Notes, State Variants, Responsive Notes, Accessibility Notes, dan SRS/User Flow Traceability. Existing Visual Reference bersifat informational dan tidak dapat mengubah frozen UX behavior.

## Wireframe: UX-SCR-001 — Homepage Desa Bendung

### Source

UI/UX Specification `UX-SCR-001`, Sections 6–7; `UX-DEC-001`.

### Existing Visual Reference

`homepage-exploratory-mockup.png` tersedia sebagai exploratory high-fidelity reference untuk `UX-SCR-001` saja. Reference tidak menggantikan wireframe ini, tidak berlaku ke `UX-SCR-002–028`, dan tidak membekukan styling.

### Mobile

```text
┌──────────────────────────┐
│ [PUBLIC HEADER]          │
├──────────────────────────┤
│ HERO / IDENTITAS DESA    │
│ [IMAGE?] [PRIMARY INFO]  │
├──────────────────────────┤
│ PILIHAN DUSUN            │
│ [DUSUN CARD]             │
│ [DUSUN CARD]             │
├──────────────────────────┤
│ INFORMASI DESA           │
├──────────────────────────┤
│ PENGUMUMAN TERBARU       │
│ [CARD] [ARCHIVE LINK]    │
├──────────────────────────┤
│ AGENDA TERBARU           │
│ [CARD]                   │
├──────────────────────────┤
│ PETA DESA [FILTERS]      │
│ [MAP]                    │
├──────────────────────────┤
│ KONTAK DESA              │
├──────────────────────────┤
│ [FOOTER]                 │
└──────────────────────────┘
```

### Desktop

```text
┌────────────────────────────────────────────────────────┐
│ [PUBLIC HEADER + NAV]                                  │
├────────────────────────────────────────────────────────┤
│ HERO / IDENTITAS DESA                    [IMAGE?]       │
├────────────────────────────────────────────────────────┤
│ PILIHAN DUSUN  [CARD] [CARD] [CARD] ...                │
├────────────────────────────────────────────────────────┤
│ INFORMASI DESA                                         │
├───────────────────────────┬────────────────────────────┤
│ PENGUMUMAN TERBARU        │ AGENDA TERBARU             │
│ [LIST/CARDS] [ARSIP]      │ [LIST/CARDS]               │
├───────────────────────────┴────────────────────────────┤
│ PETA DESA [DUSUN FILTER] [CATEGORY FILTER]             │
│ [LARGE MAP]                                            │
├────────────────────────────────────────────────────────┤
│ KONTAK DESA                                            │
├────────────────────────────────────────────────────────┤
│ [FOOTER]                                               │
└────────────────────────────────────────────────────────┘
```

### Interaction Notes

Dusun card menuju Halaman Dusun ACTIVE. Cards/detail/archive/map/external actions mengikuti eligibility. Urutan section tidak berubah.

### State Variants

Section-level `[EMPTY STATE]`; `[LOADING MAP]`; map unavailable tanpa menghilangkan content lain; Dusun INACTIVE tidak muncul.

### Responsive Notes

Mobile stacked; desktop grid/two-column hanya pada Pengumuman/Agenda dan Dusun cards. Map tetap content-bound.

### Accessibility Notes

Satu H1; section headings berurutan; Dusun card memiliki accessible link; map memiliki label/context; navigation keyboard-operable.

### SRS/User Flow Traceability

`SRS-FR-001–005`, `SRS-NFR-001–003`, `006–010`, `013`; `UF-PUB-001–002`, `010`; `AC-UF-PUB-001–002`, `010`.

## Wireframe: UX-SCR-002 — Halaman Dusun

### Source

UI/UX Specification `UX-SCR-002`, Sections 8–10; `UX-DEC-002`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
┌──────────────────────────┐
│ [PUBLIC HEADER]          │
│ [BANNER?] NAMA DUSUN     │
├──────────────────────────┤
│ QUICK NAV → horizontal   │
├──────────────────────────┤
│ PROFIL DUSUN             │
├──────────────────────────┤
│ KEPALA DUSUN             │
├──────────────────────────┤
│ KONTAK [CARDS/EMPTY]     │
├──────────────────────────┤
│ UMKM [CARDS/EMPTY]       │
├──────────────────────────┤
│ FASILITAS [CARDS/EMPTY]  │
├──────────────────────────┤
│ AGENDA [CARDS/EMPTY]     │
├──────────────────────────┤
│ PENGUMUMAN [LIST/ARSIP]  │
├──────────────────────────┤
│ PETA DUSUN [CATEGORY]    │
│ [MAP]                    │
├──────────────────────────┤
│ [FOOTER]                 │
└──────────────────────────┘
```

### Desktop

```text
┌────────────────────────────────────────────────────────┐
│ [PUBLIC HEADER + NAV]                                  │
│ [BANNER?] NAMA DUSUN                                   │
├────────────────────────────────────────────────────────┤
│ QUICK NAV: Profil | Kontak | UMKM | ... | Peta         │
├────────────────────────────────────────────────────────┤
│ PROFIL DUSUN                  │ KEPALA DUSUN            │
├───────────────────────────────┴────────────────────────┤
│ KONTAK [CARD GRID / EMPTY]                             │
│ UMKM [CARD GRID / EMPTY]                               │
│ FASILITAS [CARD GRID / EMPTY]                          │
│ AGENDA [CARD GRID / EMPTY]                             │
│ PENGUMUMAN [LIST / ARSIP LINK / EMPTY]                 │
│ PETA DUSUN [CATEGORY FILTER] [LARGE MAP]               │
├────────────────────────────────────────────────────────┤
│ [FOOTER]                                               │
└────────────────────────────────────────────────────────┘
```

### Interaction Notes

Quick nav hanya anchor dalam page. Resource action membuka empat Detail/context/external handoff yang sudah ada. Peta Dusun tidak memiliki Dusun selector.

### State Variants

Setiap section mempertahankan `[EMPTY STATE]`; parent INACTIVE menghasilkan non-public response; map dependency dapat unavailable.

### Responsive Notes

Quick nav scroll horizontal mobile dan static/wrap desktop. Cards berubah dari stack ke grid tanpa mengubah urutan section.

### Accessibility Notes

H1 nama Dusun; quick links semantic; target anchor focusable; section headings dan empty messages dapat dibaca screen reader.

### SRS/User Flow Traceability

`SRS-FR-006–040`, relevant state/privacy rules; `UF-PUB-001`, `003–010`; corresponding acceptance criteria.

## Wireframe: UX-SCR-003 — Arsip Pengumuman

### Source

UI/UX Specification `UX-SCR-003`, Sections 16–18.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
┌──────────────────────────┐
│ [HEADER] [BACK CONTEXT]  │
│ ARSIP PENGUMUMAN         │
│ Scope: Desa/Dusun        │
├──────────────────────────┤
│ [ARCHIVE ITEM]           │
│ [ARCHIVE ITEM]           │
│ atau [EMPTY STATE]       │
├──────────────────────────┤
│ [FOOTER]                 │
└──────────────────────────┘
```

### Desktop

```text
┌──────────────────────────────────────────────┐
│ [HEADER + NAV] [BACK CONTEXT]                │
│ ARSIP PENGUMUMAN — Scope                     │
├──────────────────────────────────────────────┤
│ [ARCHIVE LIST / CARDS]                       │
│ [ITEM] [ITEM] [ITEM]                         │
│ atau [EMPTY STATE]                           │
├──────────────────────────────────────────────┤
│ [FOOTER]                                     │
└──────────────────────────────────────────────┘
```

### Interaction Notes

Item menuju Detail Pengumuman dan back link kembali ke active announcement context. Tidak ada generic Soft Delete archive.

### State Variants

Populated/empty archive; parent Dusun ACTIVE required; Soft Deleted tidak tampil.

### Responsive Notes

Mobile stacked; desktop list/grid yang mempertahankan reading order.

### Accessibility Notes

Status Arsip berupa teks, bukan warna saja; back context jelas; item title menjadi link semantic.

### SRS/User Flow Traceability

`SRS-FR-031–034`, `SRS-STATE-007–008`; `UF-PUB-009–010`; `AC-UF-PUB-009–010`.

## Wireframe: UX-SCR-004 — Detail UMKM

### Source

UI/UX Specification `UX-SCR-004`; `UX-DEC-003`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[HEADER]
[BACK / UMKM CONTEXT]
[IMAGE optional]
NAMA UMKM
Pemilik | Jenis | Jam
[PRODUCT TAGS/LIST]
[DESCRIPTION]
[ADDRESS]
[WHATSAPP]
[LOCATION CONTEXT if coordinates]
[FOOTER]
```

### Desktop

```text
┌──────────────────────────────────────────────┐
│ [HEADER] [BACK / CONTEXT]                    │
├───────────────────┬──────────────────────────┤
│ [IMAGE optional]  │ NAMA UMKM                │
│                   │ Metadata / Products      │
│                   │ [WHATSAPP] [LOCATION?]   │
├───────────────────┴──────────────────────────┤
│ DESCRIPTION / ADDRESS                        │
└──────────────────────────────────────────────┘
```

### Interaction Notes

WhatsApp memakai stored number. Location affordance hanya jika coordinate pair valid. Tidak ada commerce action.

### State Variants

With/without photo; with/without coordinates; products present/empty; non-eligible resource non-public.

### Responsive Notes

Mobile media/content stacked; desktop optional two-column header lalu full-width content.

### Accessibility Notes

Alt text informative image; actions memiliki label; products dibaca sebagai list; no false disabled map action.

### SRS/User Flow Traceability

`SRS-FR-014–017`, `SRS-DATA-008–010`; `UF-PUB-006`; `AC-UF-PUB-006`.

## Wireframe: UX-SCR-005 — Detail Fasilitas/Lokasi

### Source

UI/UX Specification `UX-SCR-005`; `UX-DEC-003`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[HEADER] [BACK / CONTEXT]
[IMAGE optional]
NAMA FASILITAS [CATEGORY]
[DESCRIPTION]
[ADDRESS]
[MAP / LOCATION]
[DIRECTIONS] [WHATSAPP if available]
```

### Desktop

```text
┌──────────────────────────────────────────────┐
│ [HEADER] [BACK / CONTEXT]                    │
├─────────────────────┬────────────────────────┤
│ [IMAGE optional]    │ NAME / CATEGORY        │
│ DESCRIPTION         │ ADDRESS                │
│                     │ [DIRECTIONS] [WA?]     │
├─────────────────────┴────────────────────────┤
│ [MAP / LOCATION]                             │
└──────────────────────────────────────────────┘
```

### Interaction Notes

Directions selalu berdasarkan valid required coordinates. WhatsApp absent berarti action tidak dirender.

### State Variants

With/without photo/WhatsApp; external provider unavailable; parent/Soft Delete eligibility.

### Responsive Notes

Map/action full-width mobile; desktop content and metadata dapat dua kolom.

### Accessibility Notes

Category/status text; map has accessible label/context; external actions identified.

### SRS/User Flow Traceability

`SRS-FR-018–024`, `SRS-EXT-003–004`; `UF-PUB-007`; `AC-UF-PUB-007`.

## Wireframe: UX-SCR-006 — Detail Agenda/Kegiatan

### Source

UI/UX Specification `UX-SCR-006`; `UX-DEC-003`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[HEADER] [BACK / CONTEXT]
JUDUL [STATUS]
Tanggal/range | Jam optional
Lokasi
[POSTER optional]
[DESCRIPTION]
[DOCUMENTATION optional]
```

### Desktop

```text
┌──────────────────────────────────────────────┐
│ [HEADER] [BACK / CONTEXT]                    │
│ JUDUL [STATUS]                               │
├─────────────────────┬────────────────────────┤
│ [POSTER optional]   │ DATE / TIME / LOCATION │
│                     │ DESCRIPTION            │
├─────────────────────┴────────────────────────┤
│ [DOCUMENTATION optional]                     │
└──────────────────────────────────────────────┘
```

### Interaction Notes

Effective status hanya Akan Datang/Berlangsung/Selesai; media dibaca melalui parent Agenda.

### State Variants

Three statuses; optional end/time/media; parent/Soft Delete guards.

### Responsive Notes

Mobile chronological metadata first; desktop optional media/content split.

### Accessibility Notes

Status text non-color-only; dates semantic; media alternatives; heading hierarchy retained.

### SRS/User Flow Traceability

`SRS-FR-025–030`, `SRS-STATE-009–010`; `UF-PUB-008`; `AC-UF-PUB-008`.

## Wireframe: UX-SCR-007 — Detail Pengumuman

### Source

UI/UX Specification `UX-SCR-007`; `UX-DEC-003`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[HEADER] [BACK TO ACTIVE/ARCHIVE]
JUDUL [AKTIF / ARSIP]
Scope: Desa/Dusun
[ANNOUNCEMENT CONTENT]
```

### Desktop

```text
┌──────────────────────────────────────────────┐
│ [HEADER + NAV] [BACK TO CONTEXT]             │
│ JUDUL                          [STATUS]       │
│ Scope                                         │
├──────────────────────────────────────────────┤
│ ANNOUNCEMENT CONTENT                         │
└──────────────────────────────────────────────┘
```

### Interaction Notes

Back link mempertahankan active/archive origin. Tidak ada archive toggle atau Soft Delete disclosure public.

### State Variants

ACTIVE atau EXPIRED_ARCHIVE; missing/non-public response untuk Soft Deleted/parent inactive.

### Responsive Notes

Single readable content column pada kedua viewport; desktop memakai conceptual readable width.

### Accessibility Notes

Status dan scope textual; content headings semantic; back link keyboard accessible.

### SRS/User Flow Traceability

`SRS-FR-031–034`, `SRS-STATE-007–008`; `UF-PUB-009`; `AC-UF-PUB-009`.

## Wireframe: UX-SCR-008 — Peta Desa Context

### Source

UI/UX Specification `UX-SCR-008`; `UX-DEC-004`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[HEADER]
PETA DESA
[DUSUN FILTER]
[CATEGORY FILTER]
[LOADING/ERROR?]
┌──────────────────────────┐
│          [MAP]           │
│       [POPUP overlay]    │
└──────────────────────────┘
```

### Desktop

```text
┌──────────────────────────────────────────────┐
│ [HEADER + NAV]                               │
│ PETA DESA [DUSUN FILTER] [CATEGORY FILTER]   │
├──────────────────────────────────────────────┤
│                                              │
│               [LARGE MAP]                    │
│               [POPUP]                        │
│                                              │
└──────────────────────────────────────────────┘
```

### Interaction Notes

Filters memperbarui eligible markers. Popup menuju source detail/context atau external directions bila applicable.

### State Variants

Loading; populated; filtered empty; provider unavailable. Marker only valid/eligible source.

### Responsive Notes

Filters sebelum map mobile; satu filter row atau wrapping desktop. Touch map tidak mengunci page scroll secara buruk.

### Accessibility Notes

Filters labeled; keyboard-operable alternatives/context links; status/loading announced; popup focus managed.

### SRS/User Flow Traceability

`SRS-FR-035–040`, `SRS-EXT-001–003`; `UF-PUB-004`; `AC-UF-PUB-004`.

## Wireframe: UX-SCR-009 — Peta Dusun Context

### Source

UI/UX Specification `UX-SCR-009`; `UX-DEC-004`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[HEADER]
PETA DUSUN
[FIXED DUSUN CONTEXT]
[CATEGORY FILTER]
┌──────────────────────────┐
│          [MAP]           │
│       [POPUP overlay]    │
└──────────────────────────┘
```

### Desktop

```text
┌──────────────────────────────────────────────┐
│ [HEADER + NAV]                               │
│ PETA DUSUN | FIXED CONTEXT | [CATEGORY]      │
├──────────────────────────────────────────────┤
│               [LARGE MAP]                    │
│               [POPUP]                        │
└──────────────────────────────────────────────┘
```

### Interaction Notes

Scope berasal dari Halaman Dusun; tidak ada Dusun selector. Category filter dan marker behavior sama dengan taxonomy source.

### State Variants

Loading; populated; empty filter; provider unavailable; parent ACTIVE required.

### Responsive Notes

Category filter sebelum map mobile dan inline/wrap desktop; context selalu terlihat.

### Accessibility Notes

Fixed Dusun context announced; filter labeled; popup focus/context link accessible.

### SRS/User Flow Traceability

`SRS-FR-035–040`, `SRS-SEC-019`; `UF-PUB-004`; `AC-UF-PUB-004`.

## Wireframe: UX-SCR-010 — Login Admin

### Source

UI/UX Specification `UX-SCR-010`, Section 23.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
┌──────────────────────────┐
│ [PORTAL / ADMIN IDENTITY]│
│ LOGIN ADMIN              │
│ Username [INPUT]         │
│ Password [INPUT]         │
│ [FIELD/GENERIC ERROR]    │
│ [LOGIN] [LOADING?]       │
│ Hubungi Super Admin ...  │
└──────────────────────────┘
```

### Desktop

```text
        ┌────────────────────────────┐
        │ [PORTAL / ADMIN IDENTITY]  │
        │ LOGIN ADMIN                │
        │ Username [INPUT]           │
        │ Password [INPUT]           │
        │ [GENERIC ERROR]            │
        │ [LOGIN]                    │
        │ Reset instruction          │
        └────────────────────────────┘
```

### Interaction Notes

Submit mencegah double action; valid credential mengarah sesuai role. Tidak ada Email/Register/Forgot Password self-service.

### State Variants

Idle; field error; submitting; generic invalid credential; rate-limited; success redirect.

### Responsive Notes

Single-column pada kedua viewport; desktop centered/content-width conceptual.

### Accessibility Notes

Visible labels; predictable focus order; error announced dan tidak mengungkap account existence; password control accessible.

### SRS/User Flow Traceability

`SRS-FR-041–044`, `SRS-SEC-001–006`, `015`, `018`; `UF-AD-001`, `UF-SA-001`; corresponding AC.

## Wireframe: UX-SCR-011 — Dashboard Dusun

### Source

UI/UX Specification `UX-SCR-011`; `UX-DEC-005`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR] [MENU] [ACCOUNT]
ADMIN DUSUN
[FIXED DUSUN CONTEXT]
[INACTIVE NOTICE if applicable]
[MAIN / NAV CARDS]
 Profil | Kontak | UMKM
 Fasilitas | Agenda | Pengumuman
```

### Desktop

```text
┌──────────────┬────────────────────────────────┐
│ SIDEBAR      │ TOPBAR / ADMIN DUSUN           │
│ [6 NAV]      │ FIXED DUSUN CONTEXT            │
│ [COLLAPSE]   ├────────────────────────────────┤
│              │ [INACTIVE NOTICE?]             │
│              │ MAIN / OPTIONAL SUMMARY        │
└──────────────┴────────────────────────────────┘
```

### Interaction Notes

Menu hanya enam management areas. Tidak ada Dusun selector atau activation action.

### State Variants

Dusun ACTIVE; Dusun INACTIVE with informational notice; summary empty/error.

### Responsive Notes

Mobile openable nav; desktop expanded sidebar default, collapsible.

### Accessibility Notes

Role/context dibaca sebelum main content; notice tidak hanya warna; nav landmarks/focus order jelas.

### SRS/User Flow Traceability

`SRS-FR-042`, `045–047`, `SRS-AUTH-001`, `006`, `012`; `UF-AD-001–006`; Admin AC.

## Wireframe: UX-SCR-012 — Admin Dusun / Kelola Profil Dusun

### Source

UI/UX Specification `UX-SCR-012`; `UX-FORM-003`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / MENU]
PROFIL DUSUN
[FIXED ACCOUNT/DUSUN CONTEXT]
Nama Dusun [INPUT]
Deskripsi [TEXTAREA]
Kepala Dusun [INPUT]
Jumlah RT [INPUT]
Jumlah RW [INPUT]
Banner optional [UPLOAD]
[ERROR SUMMARY?]
[CANCEL] [SAVE]
```

### Desktop

```text
┌──────────────┬────────────────────────────────┐
│ SIDEBAR      │ PROFIL DUSUN | FIXED CONTEXT   │
│              ├────────────────────────────────┤
│              │ [NAME] [KEPALA DUSUN]          │
│              │ [RT]   [RW]                    │
│              │ [DESCRIPTION full width]       │
│              │ [BANNER UPLOAD optional]       │
│              │ [CANCEL] [SAVE]                │
└──────────────┴────────────────────────────────┘
```

### Interaction Notes

Supported own profile termasuk nama dapat diedit. Context binding dan status Dusun tidak menjadi control.

### State Variants

Edit; validation; saving; success; parent INACTIVE notice.

### Responsive Notes

Single-column mobile; related compact fields may pair desktop while focus order remains logical.

### Accessibility Notes

All inputs labeled; required/optional indicated; error near field and summary; save state announced.

### SRS/User Flow Traceability

`SRS-FR-007`, `045–049`, `SRS-AUTH-001`, `006`, `011–012`; `UF-AD-003`, `005–006`; corresponding AC.

## Wireframe: UX-SCR-013 — Admin Dusun / Kelola Kontak Pelayanan

### Source

UI/UX Specification `UX-SCR-013`; `UX-FORM-004`; `UX-DEC-006–007`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / FIXED CONTEXT]
KONTAK PELAYANAN [TAMBAH]
[ACTIVE CARD ROW]
 Name | Jabatan | [EDIT] [NONAKTIFKAN]
[ACTIVE CARD ROW]
atau [EMPTY STATE]

[FORM STATE]
Nama* | Jabatan* | WhatsApp*
Foto? | Alamat?
[MAP PICKER?] Lat? Lng?
[CANCEL] [SAVE]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ KONTAK PELAYANAN      [TAMBAH]    │
│              │ [ACTIVE-ONLY TABLE]                │
│              │ Name | Jabatan | Actions           │
│              │ [EMPTY STATE]                      │
│              ├────────────────────────────────────┤
│              │ [FORM GROUPS + MAP PICKER?]        │
│              │ [CANCEL] [SAVE]                    │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Normal list excludes Soft Deleted. Nonaktifkan removes row after success. No deleted filter/restore/hard delete/consent field.

### State Variants

Active list/empty; create/edit; validation; upload; saving; confirmation; success.

### Responsive Notes

Table → cards; form/map stacked mobile and grouped desktop.

### Accessibility Notes

Row actions labeled with target; coordinate pair errors adjacent; confirmation traps/restores focus appropriately.

### SRS/User Flow Traceability

`SRS-FR-010–013`, `045–047`, `SRS-VAL-005–007`; `UF-AD-002–004`, `006`; related AC.

## Wireframe: UX-SCR-014 — Admin Dusun / Kelola UMKM

### Source

UI/UX Specification `UX-SCR-014`; `UX-FORM-005–006`; `UX-DEC-006–007`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / FIXED CONTEXT]
UMKM [TAMBAH]
[ACTIVE CARD ROW: Data | Status | Actions]
atau [EMPTY STATE]

[FORM]
Identity* | Owner* | Type*
Description* | Address* | WhatsApp* | Hours*
Main Photo? [UPLOAD]
Coordinates? [MAP PICKER] Lat? Lng?
Products: [ROW] [ADD PRODUCT]
[CANCEL] [SAVE]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ UMKM                  [TAMBAH]     │
│              │ [ACTIVE-ONLY TABLE]                │
│              │ Data | Status | Actions            │
│              ├────────────────────────────────────┤
│              │ [IDENTITY / CONTACT GROUPS]        │
│              │ [MEDIA?] [COORDINATE PICKER?]      │
│              │ [REPEATABLE PRODUCT ROWS]          │
│              │ [CANCEL] [SAVE]                    │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Products dikelola dalam parent form. Tidak ada commerce control. Nonaktifkan removes row from normal list.

### State Variants

Active/empty; with/without media/coordinates/products; validation/upload/saving/confirmation.

### Responsive Notes

Table → cards; long form grouped without wizard; product rows stack mobile.

### Accessibility Notes

Repeatable rows have labels/remove target; coordinate errors grouped; upload status announced.

### SRS/User Flow Traceability

`SRS-FR-014–017`, `045–047`, `SRS-VAL-008–010`; `UF-AD-002–004`, `006`; related AC.

## Wireframe: UX-SCR-015 — Admin Dusun / Kelola Fasilitas

### Source

UI/UX Specification `UX-SCR-015`; `UX-FORM-007`; `UX-DEC-006–007`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / FIXED CONTEXT]
FASILITAS [TAMBAH]
[ACTIVE CARD ROW] atau [EMPTY]

[FORM]
Category* [SELECT existing]
Name* | Description* | Address*
[REQUIRED MAP PICKER]
Latitude* | Longitude*
Photo? | WhatsApp?
[CANCEL] [SAVE]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ FASILITAS             [TAMBAH]    │
│              │ [ACTIVE-ONLY TABLE]                │
│              │ Data | Category | Status | Actions │
│              ├────────────────────────────────────┤
│              │ [DETAIL FIELDS] [OPTIONAL MEDIA]   │
│              │ [REQUIRED COORDINATE PICKER]       │
│              │ [CANCEL] [SAVE]                    │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Admin selects existing category only. Required coordinates must validate. Soft Deleted browsing absent.

### State Variants

Active/empty; with/without optional photo/WhatsApp; validation/upload/map/saving/confirmation.

### Responsive Notes

Table → cards; picker full-width mobile; desktop groups fields without changing order.

### Accessibility Notes

Category label; map/manual inputs keyboard usable; required pair errors explicit; action target names included.

### SRS/User Flow Traceability

`SRS-FR-018–024`, `045–047`, `SRS-VAL-011–012`; `UF-AD-002–004`, `006`; related AC.

## Wireframe: UX-SCR-016 — Admin Dusun / Kelola Agenda & Kegiatan

### Source

UI/UX Specification `UX-SCR-016`; `UX-FORM-009`; `UX-DEC-006–007`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / FIXED DUSUN]
AGENDA & KEGIATAN [TAMBAH]
[ACTIVE CARD ROW: Date | Status | Actions]

[FORM]
Scope: DUSUN [READ ONLY]
Dusun: OWN_DUSUN [READ ONLY]
Title* | Description*
Start* | End? | Time? | Location*
Manual Override? [3 VALUES]
Media? [REPEATABLE]
[CANCEL] [SAVE]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ AGENDA & KEGIATAN     [TAMBAH]    │
│              │ [ACTIVE-ONLY TABLE]                │
│              │ Date | Title | Status | Actions    │
│              ├────────────────────────────────────┤
│              │ FIXED SCOPE / OWN_DUSUN CONTEXT    │
│              │ [DETAIL + DATE/TIME GROUPS]        │
│              │ [OVERRIDE?] [MEDIA?]               │
│              │ [CANCEL] [SAVE]                    │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Tidak ada scope/Dusun selector. Override optional hanya tiga values. Nonaktifkan removes row; no Soft Deleted browser.

### State Variants

Three effective states; override null/set; optional end/time/media; validation/upload/saving/confirmation.

### Responsive Notes

Date groups stack mobile; desktop may align related dates. Media remains parent context.

### Accessibility Notes

Read-only context not styled as input; dates labeled; status textual; repeatable media controls accessible.

### SRS/User Flow Traceability

`SRS-FR-025–030`, `045–047`, `SRS-VAL-013–016`, `SRS-STATE-009–010`; `UF-AD-002–004`, `006`; related AC.

## Wireframe: UX-SCR-017 — Admin Dusun / Kelola Pengumuman

### Source

UI/UX Specification `UX-SCR-017`; `UX-FORM-010`; `UX-DEC-006–007`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / FIXED DUSUN]
PENGUMUMAN [TAMBAH]
[ACTIVE/NON-DELETED CARD ROW]
 Title | Aktif/Arsip | [EDIT] [NONAKTIFKAN]

[FORM]
Scope: DUSUN [READ ONLY]
Dusun: OWN_DUSUN [READ ONLY]
Title* | Content* | Expiry*
[CANCEL] [SAVE]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ PENGUMUMAN            [TAMBAH]    │
│              │ [NON-SOFT-DELETED TABLE]           │
│              │ Title | Aktif/Arsip | Actions      │
│              ├────────────────────────────────────┤
│              │ FIXED DUSUN CONTEXT                │
│              │ [TITLE] [EXPIRY] [CONTENT]         │
│              │ [CANCEL] [SAVE]                    │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Tidak ada scope/Dusun selector atau Archive control. Expiry derives archive. Nonaktifkan removes row from normal list.

### State Variants

ACTIVE/EXPIRED_ARCHIVE in normal non-deleted list; validation/saving/confirmation; Soft Deleted excluded.

### Responsive Notes

Table → cards; content textarea full width; context remains visible.

### Accessibility Notes

Aktif/Arsip text non-color-only; read-only context clear; error near expiry/content.

### SRS/User Flow Traceability

`SRS-FR-031–034`, `045–047`, `SRS-VAL-017`, `SRS-STATE-007–008`; `UF-AD-002–004`, `006`; related AC.

## Wireframe: UX-SCR-018 — Super Admin Dashboard

### Source

UI/UX Specification `UX-SCR-018`; `UX-DEC-005`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR] [MENU] [ACCOUNT]
SUPER ADMIN
[GLOBAL CONTEXT]
[10 MANAGEMENT NAV ITEMS]
[OPTIONAL SUMMARY / EMPTY]
```

### Desktop

```text
┌──────────────┬────────────────────────────────┐
│ SIDEBAR      │ TOPBAR / SUPER ADMIN           │
│ [10 NAV]     │ GLOBAL CONTEXT                 │
│ [COLLAPSE]   ├────────────────────────────────┤
│              │ [OPTIONAL SUMMARY BLOCKS]      │
│              │ [MANAGEMENT ENTRY CONTENT]     │
└──────────────┴────────────────────────────────┘
```

### Interaction Notes

Sepuluh area FROZEN. Summary hanya informasi existing, bukan analytics capability.

### State Variants

Normal; summary empty; server error; navigation/loading state.

### Responsive Notes

Mobile openable nav; desktop expanded sidebar default dan collapsible.

### Accessibility Notes

GLOBAL context announced; navigation landmarks; summary headings semantic; collapse/open control labeled.

### SRS/User Flow Traceability

`SRS-FR-042`, `048–054`, relevant authorization; `UF-SA-001–009`; Super Admin AC.

## Wireframe: UX-SCR-019 — Super Admin / Kelola Identitas dan Profil Desa

### Source

UI/UX Specification `UX-SCR-019`; `UX-FORM-002`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / GLOBAL]
IDENTITAS DESA
Nama* | Deskripsi*
Alamat Kantor* | Nomor Kontak*
Email optional
Nama Kepala Desa* | Jam Pelayanan*
Logo? [UPLOAD] | Banner? [UPLOAD]
[ERROR SUMMARY?]
[CANCEL] [SAVE]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ IDENTITAS / PROFIL DESA            │
│              │ [IDENTITY / CONTACT GROUPS]        │
│              │ [DESCRIPTION full width]           │
│              │ [LOGO?] [BANNER?]                  │
│              │ [CANCEL] [SAVE]                    │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Save updates data-driven Homepage. Media optional and no page-builder control.

### State Variants

Edit; optional media absent/present; validation/upload/saving/success/error.

### Responsive Notes

Single-column mobile; related fields may group desktop; long text stays full width.

### Accessibility Notes

Labels/required markers; media alt/preview controls; errors positioned and summarized.

### SRS/User Flow Traceability

`SRS-FR-001`, `003–004`, `048`, `SRS-AUTH-009`, `011`; `UF-SA-002`, `009`; corresponding AC.

## Wireframe: UX-SCR-020 — Super Admin / Kelola Dusun

### Source

UI/UX Specification `UX-SCR-020`; `UX-FORM-003`, `UX-FORM-013`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / GLOBAL]
DUSUN
[STATUS FILTER?]
[DUSUN CARD]
 Name | [ACTIVE/INACTIVE]
 [EDIT PROFILE] [ACTIVATE/NONAKTIFKAN]
[DUSUN CARD] ...
[NO ADD / NO DELETE]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ DUSUN [STATUS FILTER?]             │
│              │ [TABLE]                            │
│              │ Name | Status | Profile | Actions  │
│              │ [EDIT] [ACTIVATE/NONAKTIFKAN]      │
│              │ NO ADD / NO DELETE                 │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Profile edit uses supported fields. Status action opens impact confirmation. No new Dusun/hard delete.

### State Variants

ACTIVE; INACTIVE; editing; status confirmation; saving/success/error. Reactivation does not restore child.

### Responsive Notes

Table → cards; status/action remains adjacent to target context.

### Accessibility Notes

Status text; action names include Dusun; dialog focus managed and consequence text associated.

### SRS/User Flow Traceability

`SRS-FR-002`, `009`, `049`, `SRS-STATE-001–004`; `UF-SA-002`, `005–006`; corresponding AC.

## Wireframe: UX-SCR-021 — Super Admin / Kelola Kontak Pelayanan

### Source

UI/UX Specification `UX-SCR-021`; `UX-FORM-004`; `UX-DEC-006–007`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / GLOBAL]
KONTAK PELAYANAN [TAMBAH]
[DUSUN FILTER] [STATUS FILTER]
[CARD ROW]
 Name | Dusun | [STATUS]
 [EDIT] [NONAKTIFKAN/RESTORE] [HARD DELETE?]
[FORM / MAP PICKER state]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ KONTAK                 [TAMBAH]   │
│              │ [DUSUN] [STATUS: A/N/SEMUA]       │
│              │ [TABLE] Data|Dusun|Status|Actions  │
│              ├────────────────────────────────────┤
│              │ [FORM GROUPS + MAP PICKER?]        │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Status filter locates Soft Deleted in same area. Restore/hard delete only applicable; no consent UI; no separate archive.

### State Variants

Active/Soft Deleted/filter-empty; create/edit; validation/upload/map/loading; restore/hard-delete confirmations.

### Responsive Notes

Filters stack mobile and row/wrap desktop; table → cards; form responsive.

### Accessibility Notes

Filter labels/status text; row action targets; dialogs manage focus; optional address/coordinates clearly marked.

### SRS/User Flow Traceability

`SRS-FR-010–013`, `048`, `050`, relevant DATA/VAL/SEC; `UF-SA-002–004`; related AC.

## Wireframe: UX-SCR-022 — Super Admin / Kelola UMKM

### Source

UI/UX Specification `UX-SCR-022`; `UX-FORM-005–006`; `UX-DEC-006–007`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / GLOBAL]
UMKM [TAMBAH]
[DUSUN FILTER] [STATUS FILTER]
[CARD ROW: Data | Dusun | Status | Actions]
[FORM: identity/contact/media?/coordinates?/products]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ UMKM                    [TAMBAH]   │
│              │ [DUSUN] [STATUS]                  │
│              │ [TABLE] Data|Dusun|Status|Actions  │
│              ├────────────────────────────────────┤
│              │ [FORM GROUPS] [MAP?] [PRODUCTS]    │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Soft Deleted accessible through filter for restore/applicable hard delete. Products/media follow parent; no commerce.

### State Variants

Active/Soft Deleted/filter-empty; optional media/coordinates/products; validation/upload/confirmations.

### Responsive Notes

Filters/forms stack mobile; desktop table and grouped form; product rows wrap/stack.

### Accessibility Notes

Filter and repeatable-row labels; errors grouped; destructive action identifies UMKM target.

### SRS/User Flow Traceability

`SRS-FR-014–017`, `048`, `050`, relevant DATA/VAL/SEC; `UF-SA-002–004`; related AC.

## Wireframe: UX-SCR-023 — Super Admin / Kelola Fasilitas

### Source

UI/UX Specification `UX-SCR-023`; `UX-FORM-007`; `UX-DEC-006–007`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / GLOBAL]
FASILITAS [TAMBAH]
[DUSUN] [CATEGORY] [STATUS FILTER]
[CARD ROW: Data | Context | Status | Actions]
[FORM + REQUIRED MAP PICKER]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ FASILITAS              [TAMBAH]   │
│              │ [DUSUN][CATEGORY][STATUS]          │
│              │ [TABLE] Data|Context|Status|Actions│
│              ├────────────────────────────────────┤
│              │ [FORM] [REQUIRED MAP PICKER]       │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Restore/hard delete only applicable. Category selected from vocabulary; required coordinates maintained.

### State Variants

Active/Soft Deleted/filter-empty; optional photo/WhatsApp; validation/map/upload/FK restriction.

### Responsive Notes

Filters stack/wrap; table → cards; map full-width within form on both viewports.

### Accessibility Notes

All filters/coordinate fields labeled; action target/state explicit; FK error actionable.

### SRS/User Flow Traceability

`SRS-FR-018–024`, `048`, `050`, relevant DATA/VAL/SEC; `UF-SA-002–004`; related AC.

## Wireframe: UX-SCR-024 — Super Admin / Kelola Kategori Fasilitas

### Source

UI/UX Specification `UX-SCR-024`; `UX-FORM-008`; `UX-DEC-006`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / GLOBAL]
KATEGORI FASILITAS [TAMBAH]
[CATEGORY CARD ROW]
 Name | [EDIT] [HARD DELETE if allowed]
atau [EMPTY STATE]
[FORM: Nama Kategori*]
[CANCEL] [SAVE]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ KATEGORI FASILITAS     [TAMBAH]   │
│              │ [TABLE] Name | Actions             │
│              │ [EMPTY STATE]                      │
│              ├────────────────────────────────────┤
│              │ Nama Kategori* [INPUT]             │
│              │ [CANCEL] [SAVE]                    │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Hard delete hanya bila applicable/dependency mengizinkan. Tidak ada Soft Delete, universal category, atau Admin Dusun category management.

### State Variants

Populated/empty; create/edit; duplicate validation; FK restriction; saving/deleting.

### Responsive Notes

Simple list → cards; compact form remains one logical group.

### Accessibility Notes

Name label; duplicate/FK errors plain language; destructive confirmation target clear.

### SRS/User Flow Traceability

`SRS-FR-022–024`, `048`, `SRS-DATA-006–007`, `SRS-ERR-007`; `UF-SA-002`, `004`; related AC.

## Wireframe: UX-SCR-025 — Super Admin / Kelola Agenda & Kegiatan

### Source

UI/UX Specification `UX-SCR-025`; `UX-FORM-009`; `UX-DEC-006–007`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / GLOBAL]
AGENDA & KEGIATAN [TAMBAH]
[SCOPE] [DUSUN?]
[AGENDA STATUS] [RECORD STATUS]
[CARD ROW: Title | Scope | Agenda Status | Record Status | Actions]

[FORM]
Scope* [DESA | DUSUN]
Dusun* [SELECT only if DUSUN]
Title* | Description* | Start* | End? | Time? | Location*
Override? | Media?
[CANCEL] [SAVE]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ AGENDA                 [TAMBAH]   │
│              │ [SCOPE][DUSUN?]                    │
│              │ [AGENDA STATUS][RECORD STATUS]     │
│              │ [TABLE] Title|Scope|Agenda Status  │
│              │         |Record Status|Actions     │
│              ├────────────────────────────────────┤
│              │ [SCOPE + CONDITIONAL DUSUN]        │
│              │ [DETAIL/DATE/MEDIA GROUPS]         │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

DESA hides/not-applicable Dusun selector; DUSUN requires one. `AGENDA STATUS` dan `RECORD STATUS` adalah dua axis terpisah. Agenda Status dapat memfilter Semua, Akan Datang, Berlangsung, atau Selesai. Record Status menyediakan Aktif, Nonaktif / Soft Deleted, atau Semua untuk konteks restore Super Admin. `Selesai` tidak berarti `Nonaktif` atau `Soft Deleted`.

### State Variants

DESA/DUSUN; Agenda Status Semua/Akan Datang/Berlangsung/Selesai; Record Status Aktif/Nonaktif atau Soft Deleted/Semua; override null/set; media/date validation; restore/delete. Agenda lifecycle dan operational record lifecycle tetap ditampilkan sebagai state berbeda bila keduanya relevan.

### Responsive Notes

Filters and dates stack mobile; desktop groups related controls while preserving focus order.

### Accessibility Notes

Conditional Dusun control announced on scope change; three states textual; media controls labeled.

### SRS/User Flow Traceability

`SRS-FR-025–030`, `048`, `050`, `SRS-VAL-013–016`, state rules; `UF-SA-002–004`; related AC.

## Wireframe: UX-SCR-026 — Super Admin / Kelola Pengumuman

### Source

UI/UX Specification `UX-SCR-026`; `UX-FORM-010`; `UX-DEC-006–007`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / GLOBAL]
PENGUMUMAN [TAMBAH]
[SCOPE] [DUSUN?]
[ANNOUNCEMENT LIFECYCLE] [RECORD STATUS]
[CARD ROW]
 Title | Scope | Announcement Lifecycle | Record Status | Actions
[FORM: Scope* | Dusun conditional | Title* | Content* | Expiry*]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ PENGUMUMAN             [TAMBAH]   │
│              │ [SCOPE][DUSUN?]                    │
│              │ [ANNOUNCEMENT LIFECYCLE]           │
│              │ [RECORD STATUS]                    │
│              │ [TABLE] Title|Scope|Announcement   │
│              │         Lifecycle|Record Status    │
│              │         |Actions                   │
│              ├────────────────────────────────────┤
│              │ [SCOPE + CONDITIONAL DUSUN]        │
│              │ [TITLE] [EXPIRY] [CONTENT]         │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

`ANNOUNCEMENT LIFECYCLE` dan `RECORD STATUS` adalah dua axis terpisah. Announcement Lifecycle dapat memfilter Aktif, Arsip, atau Semua dan tetap diturunkan dari expiry. Record Status menyediakan Aktif, Nonaktif / Soft Deleted, atau Semua untuk konteks restore Super Admin. Tidak ada Archive action, Restore from Archive, atau Move to Archive; restore hanya berlaku terhadap record Soft Deleted.

### State Variants

DESA/DUSUN; Announcement Lifecycle Aktif/Arsip/Semua; Record Status Aktif/Nonaktif atau Soft Deleted/Semua; validation/restore/delete. `Arsip` tidak berarti `Soft Deleted`.

### Responsive Notes

Filters stack mobile; desktop row/wrap; long content full width.

### Accessibility Notes

Two lifecycle axes named explicitly; conditional Dusun selector announced; errors close to expiry/content.

### SRS/User Flow Traceability

`SRS-FR-031–034`, `048`, `050`, `SRS-VAL-017`, state rules; `UF-SA-002–004`, `009`; related AC.

## Wireframe: UX-SCR-027 — Super Admin / Kelola Data dan Peta

### Source

UI/UX Specification `UX-SCR-027`; `UX-DEC-004`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / GLOBAL]
DATA / PETA
[DUSUN FILTER]
[CATEGORY FILTER]
[MAP]
[POPUP → PARENT MANAGEMENT CONTEXT]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ DATA / PETA                        │
│              │ [DUSUN][CATEGORY]                  │
│              ├────────────────────────────────────┤
│              │            [LARGE MAP]             │
│              │              [POPUP]               │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Map-centric view menginspeksi location data dari resource sumber. Popup menyediakan source/context link menuju parent management context bila pengelolaan diperlukan. Data/Peta bukan recycle bin, Soft Deleted browser, restore management screen, atau independent CRUD source. Tidak ada Soft Deleted status filter, Active/Nonaktif record selector, Restore action, atau Hard Delete action pada screen ini.

### State Variants

Loading; populated; filtered empty; provider unavailable.

### Responsive Notes

Filter-before-map mobile; desktop filter row/wrap and expanded map.

### Accessibility Notes

Filter labels; popup focus; parent context link; map unavailable message and non-map source navigation retained.

### SRS/User Flow Traceability

`SRS-FR-035–040`, `048`, `SRS-AUTH-010–011`; `UF-SA-002`, `009`; related AC.

## Wireframe: UX-SCR-028 — Super Admin / Kelola Admin Dusun

### Source

UI/UX Specification `UX-SCR-028`; `UX-FORM-011–012`; `UX-DEC-006`.

### Existing Visual Reference

Tidak ada pre-existing mockup yang diperlakukan sebagai normative source.

### Mobile

```text
[TOPBAR / GLOBAL]
ADMIN DUSUN [TAMBAH]
[DUSUN FILTER] [ACCOUNT STATE]
[ACTIVE ACCOUNT CARD]
 Username | Dusun | [ACTIVE]
 [MANAGE/ASSIGN] [RESET PASSWORD] [REMOVE]
[LOGICALLY REMOVED ACCOUNT CARD]
 Username | Historical Dusun/context | [REMOVED] | [READ ONLY]

[CREATE FORM]
Username* | Initial Password* | Dusun Assignment*
Role: ADMIN_DUSUN [FIXED CONTEXT, no control]
[CANCEL] [SAVE]
```

### Desktop

```text
┌──────────────┬────────────────────────────────────┐
│ SIDEBAR      │ ADMIN DUSUN            [TAMBAH]   │
│              │ [DUSUN][ACCOUNT STATE]             │
│              │ [TABLE: ACTIVE]                    │
│              │ User|Dusun|ACTIVE|Manage/Reset/    │
│              │ Remove                             │
│              │ [TABLE: LOGICALLY REMOVED]         │
│              │ User|Historical Context|REMOVED|   │
│              │ READ ONLY                          │
│              ├────────────────────────────────────┤
│              │ Username* | Initial Password*      │
│              │ Dusun Assignment*                  │
│              │ Role fixed ADMIN_DUSUN (no select) │
│              │ [CANCEL] [SAVE]                    │
└──────────────┴────────────────────────────────────┘
```

### Interaction Notes

Reset uses conceptual dialog. Remove is Logical Removal. ACTIVE row dapat menyediakan manage/assignment, reset password, dan logical removal sesuai permission. LOGICALLY_REMOVED row adalah retained identity/read-only historical state: tidak menyediakan Reset Password, Remove Again, Restore, Reactivate, Reassign Dusun, Username Reuse, atau Merge Identity. Username tetap reserved. Ini bukan account audit/history system baru. Tidak ada Super Admin account creation.

### State Variants

ACTIVE dengan mutation actions sesuai permission; LOGICALLY_REMOVED sebagai retained read-only identity; duplicate/reserved username; reset/removal confirmations untuk ACTIVE account; success/error.

### Responsive Notes

Table → account cards; action labels remain explicit; create form stacks mobile.

### Accessibility Notes

Account state textual; actions include username target; password label/instruction accessible; dialog focus managed.

### SRS/User Flow Traceability

`SRS-FR-051–054`, `SRS-VAL-002–004`, `SRS-SEC-002–005`, `018`; `UF-SA-007–008`; `AC-UF-SA-007–008`.

## 40. Component Placement Matrix

| Component | Screens | Notes |
| --- | --- | --- |
| `UI-CMP-001` Site Header | `UX-SCR-001–010` as applicable | Public identity; auth uses compact identity. |
| `UI-CMP-002` Primary Navigation | `UX-SCR-001–009` | Simple public navigation; no mega menu. |
| `UI-CMP-003` Hero/Identity Block | `UX-SCR-001–002` | Desa/Dusun identity and optional media. |
| `UI-CMP-004` Dusun Card | `UX-SCR-001` | ACTIVE Dusun selection. |
| `UI-CMP-005` Quick Navigation | `UX-SCR-002` | Section anchors; mobile horizontal-scroll. |
| `UI-CMP-006` Content Section | `UX-SCR-001–003` | Heading, content/list, empty region. |
| `UI-CMP-007` Resource Card/List Item | `UX-SCR-001–003`, `011–028` where listed | Public scan item or management record. |
| `UI-CMP-008` Detail Header | `UX-SCR-004–007` | Back/context, title, scope/status. |
| `UI-CMP-009` Status Badge | `UX-SCR-003`, `006–007`, `011`, `013–018`, `020–026`, `028` | Textual lifecycle state; Data/Peta excluded. |
| `UI-CMP-010` Empty State | `UX-SCR-001–003`, `008–009`, `011–028` | Public/admin/filter-empty variants. |
| `UI-CMP-011` Map Canvas | `UX-SCR-001–002`, `005`, `008–009`, `013–015`, `021–023`, `027` | Public map or coordinate context. |
| `UI-CMP-012` Map Filter | `UX-SCR-001–002`, `008–009`, `027` | Desa Dusun/category; Dusun category-only. |
| `UI-CMP-013` Marker Popup | `UX-SCR-001–002`, `008–009`, `027` | Optional image/address and action. |
| `UI-CMP-014` External CTA | `UX-SCR-001–002`, `004–005`, `008–009` | WhatsApp/Google Maps prerequisites. |
| `UI-CMP-015` Media/Placeholder | `UX-SCR-001–006`, `012–016`, `019`, `021–023`, `025` | Optional media/placeholder. |
| `UI-CMP-016` Archive Link/List | `UX-SCR-001–003`, `007`, `017`, `026` | Public archive/admin derived context. |
| `UI-CMP-017` Site Footer | `UX-SCR-001–009` | Public supporting navigation/contact. |
| `UI-CMP-018` Login Form | `UX-SCR-010` | Username/password only. |
| `UI-CMP-019` Dashboard Shell | `UX-SCR-011–028` | Role-sensitive shell. |
| `UI-CMP-020` Dashboard Navigation | `UX-SCR-011–028` | Six/ten areas by role. |
| `UI-CMP-021` Context Header | `UX-SCR-011–028` | Fixed OWN_DUSUN or GLOBAL. |
| `UI-CMP-022` Management List/Table | `UX-SCR-013–017`, `020–026`, `028` | Desktop table and filters/actions; Data/Peta remains map-centric. |
| `UI-CMP-023` Mobile Management Row | `UX-SCR-013–017`, `020–026`, `028` | Stacked mobile equivalent; Data/Peta remains map-centric. |
| `UI-CMP-024` Resource Form | `UX-SCR-012–017`, `019–026`, `028` | Single-form CRUD in frozen context. |
| `UI-CMP-025` Field Error/Summary | `UX-SCR-010`, `012–017`, `019–026`, `028` | Inline and summary. |
| `UI-CMP-026` Confirmation Dialog | `UX-SCR-013–017`, `020–026`, `028` | Destructive/status/reset/restore. |
| `UI-CMP-027` Feedback Banner/Toast | `UX-SCR-010–028` | Safe save/action feedback. |
| `UI-CMP-028` Loading/Submit State | `UX-SCR-008–010`, `012–017`, `019–028` | Map/form/upload/destructive busy. |
| `UI-CMP-029` Coordinate Picker | `UX-SCR-013–015`, `021–023` | Map + manual pair in parent form. |
| `UI-CMP-030` Media Upload | `UX-SCR-012–016`, `019`, `021–023`, `025` | Select/preview/replace/remove. |
| `UI-CMP-031` Scope/Dusun Filter | `UX-SCR-018`, `021–023`, `025–026`, `028` | Super Admin resource/account filter; Data/Peta uses `UI-CMP-012`. |
| `UI-CMP-032` Account Management Row | `UX-SCR-028` | ACTIVE mutations and LOGICALLY_REMOVED read-only retained identity. |

**Component placement coverage:** 32/32.

## 41. Form Placement Matrix

| Form | Screen placement | Coverage notes |
| --- | --- | --- |
| `UX-FORM-001` Login | `UX-SCR-010` | Username/password only. |
| `UX-FORM-002` Identitas Desa | `UX-SCR-019` | Required identity/contact; optional email/media. |
| `UX-FORM-003` Profil Dusun | `UX-SCR-012`, `020` | Own profile including name; status separate. |
| `UX-FORM-004` Kontak Pelayanan | `UX-SCR-013`, `021` | Optional photo/address/coordinate pair. |
| `UX-FORM-005` UMKM | `UX-SCR-014`, `022` | Optional main media/coordinates. |
| `UX-FORM-006` Produk UMKM | `UX-SCR-014`, `022` | Repeatable rows; no commerce. |
| `UX-FORM-007` Fasilitas | `UX-SCR-015`, `023` | Required coordinates; optional photo/WhatsApp. |
| `UX-FORM-008` Kategori Fasilitas | `UX-SCR-024` | Super Admin only. |
| `UX-FORM-009` Agenda/Kegiatan | `UX-SCR-016`, `025` | Admin implicit; Super conditional scope. |
| `UX-FORM-010` Pengumuman | `UX-SCR-017`, `026` | Admin implicit; no archive control. |
| `UX-FORM-011` Admin Dusun Account | `UX-SCR-028` | Role fixed; no Super Admin creation. |
| `UX-FORM-012` Reset Password | `UX-SCR-028` | Dialog; no existing password/email reset. |
| `UX-FORM-013` Dusun Status Action | `UX-SCR-020` | Super Admin only; no delete/add. |

**Form placement coverage:** 13/13.

## 42. UI State Coverage

| State rule | Wireframe/state annotation | Coverage |
| --- | --- | --- |
| `UX-STATE-001` Dusun ACTIVE | `UX-SCR-001–002`, `011`, `020` | COVERED |
| `UX-STATE-002` Dusun INACTIVE | Public hidden; `011` notice; `020` action | COVERED |
| `UX-STATE-003` Reactivation | `020` confirmation/no auto-restore | COVERED |
| `UX-STATE-004` No Dusun deletion | `020` no Add/Delete | COVERED |
| `UX-STATE-005` Operational ACTIVE | Public/Admin/Super active rows | COVERED |
| `UX-STATE-006` Operational SOFT_DELETED | Admin excluded; Super status filter only in resource management `021–023`, `025–026`, never `027` | COVERED |
| `UX-STATE-007` Operational restore | `021–023`, `025–026` restore/feedback | COVERED |
| `UX-STATE-008` Operational hard delete | High-risk/applicability | COVERED |
| `UX-STATE-009` Contact lifecycle | `002`, `013`, `021`; no second status | COVERED |
| `UX-STATE-010` Account ACTIVE | Login eligible; `028` active row | COVERED |
| `UX-STATE-011` LOGICALLY_REMOVED | Login rejected; `028` retained read-only row without mutation actions | COVERED |
| `UX-STATE-012` Reserved username | `028` reserved error | COVERED |
| `UX-STATE-013` No account restore/reuse | `028` action boundary | COVERED |
| `UX-STATE-014` Announcement ACTIVE | `001–002`, `007`, `017`, `026` | COVERED |
| `UX-STATE-015` EXPIRED_ARCHIVE | `003`, `007`, `017`, `026`; public lifecycle axis | COVERED |
| `UX-STATE-016` Announcement SOFT_DELETED | Public absent; Admin excluded; Super record-status filter in `026` | COVERED |
| `UX-STATE-017` Announcement parent inactive | Public absent; manage retained | COVERED |
| `UX-STATE-018` Agenda AKAN_DATANG | Agenda cards/detail/lists; agenda lifecycle axis | COVERED |
| `UX-STATE-019` Agenda BERLANGSUNG | Agenda cards/detail/lists; agenda lifecycle axis | COVERED |
| `UX-STATE-020` Agenda SELESAI | Agenda cards/detail/lists; distinct from record Soft Delete | COVERED |
| `UX-STATE-021` Manual override | `016`, `025` optional control | COVERED |
| `UX-STATE-022` Agenda SOFT_DELETED | Admin excluded; Super record-status filter/restore in `025`; distinct from SELESAI | COVERED |
| `UX-STATE-023` Agenda parent inactive | Public absent; manage retained | COVERED |
| `UX-STATE-024` Calculated state | Three labels; no persisted field UI | COVERED |

**UI state coverage:** 24/24.

## 43. UX Decision Coverage

| Approved decision | Wireframe application | Coverage |
| --- | --- | --- |
| `UX-DEC-001` | Homepage order in `UX-SCR-001`. | COVERED |
| `UX-DEC-002` | Quick nav horizontal-scroll mobile. | COVERED |
| `UX-DEC-003` | Four full-content Details. | COVERED |
| `UX-DEC-004` | Map filters before/outside canvas mobile. | COVERED |
| `UX-DEC-005` | Desktop expanded/collapsible sidebar; mobile panel. | COVERED |
| `UX-DEC-006` | Desktop table; mobile stacked rows. | COVERED |
| `UX-DEC-007` | Admin normal list excludes Soft Deleted; Super status filter exists in source management `021–023`, `025–026`, not Data/Peta `027`. | COVERED |
| `UX-DEC-008` | Safe feedback placement. | COVERED |

**UX Decision coverage:** 8/8. Existing assets tidak menciptakan UX-DEC baru.

## 44. Visual Design Deferred Decision

**VISUAL DESIGN DEFERRED DECISION — DEFERRED TO VISUAL DESIGN.** Source ID `VD-DEC-001` dipertahankan karena berasal dari UI/UX Specification v1.0 yang FROZEN, bukan diciptakan oleh Wireframe Specification. `warm-natural-direction.png` diakui sebagai **EXISTING VISUAL DIRECTION REFERENCE — NON-FINAL — NON-FROZEN** untuk tahap Visual Design berikutnya, bukan APPROVED/FINAL/FROZEN design system.

Wireframe ini tidak menyalin palette/hex, font choice, icon styling, radius, shadow, spacing system, decorative treatment, atau photography direction dari asset. Seluruh diagram tetap grayscale, semantic, dan layout-focused.

## 45. Accessibility Annotations

- Public pages memiliki satu H1 dan hierarchy konsisten.
- Form labels terlihat; required/optional dan error tidak hanya mengandalkan warna.
- Focus order mengikuti reading order; conditional field insertion diumumkan.
- Dialog memindahkan, menahan, lalu mengembalikan focus secara konseptual.
- Touch actions usable dan tidak bergantung pada hover.
- Loading, success, status, dan error disampaikan textual.
- Map menyediakan labeled filters, popup focus, dan non-map fallback context.

Tidak ada accessibility certification claim.

## 46. Traceability

### Coverage Summary

| Contract | Target | Result |
| --- | ---: | --- |
| Sitemap/UI screen contexts | 28 | 28/28 COVERED |
| Mobile layouts | 28 | 28/28 COVERED |
| Desktop layouts | 28 | 28/28 COVERED |
| User Flows | 25 | 25/25 COVERED |
| SRS Acceptance Criteria | 25 | 25/25 COVERED |
| Conceptual UI Components | 32 | 32/32 MAPPED |
| Forms | 13 | 13/13 MAPPED |
| UI State Rules | 24 | 24/24 MAPPED |
| Approved UX Decisions | 8 | 8/8 COVERED |
| Homepage exploratory visual | 1 | ACKNOWLEDGED — NON-NORMATIVE |
| Warm Natural direction | 1 | ACKNOWLEDGED — DEFERRED TO VISUAL DESIGN |

### User Flow and Acceptance Criteria Mapping

| User Flow / Acceptance Criterion | Wireframe screen(s) | Layout/interaction coverage | Status |
| --- | --- | --- | --- |
| `UF-PUB-001` / `AC-UF-PUB-001` | `UX-SCR-001–002` | QR landing, ACTIVE Dusun cards, Halaman Dusun. | COVERED |
| `UF-PUB-002` / `AC-UF-PUB-002` | `UX-SCR-001` | Public information hierarchy without login. | COVERED |
| `UF-PUB-003` / `AC-UF-PUB-003` | `UX-SCR-002` | Quick anchors and retained empty sections. | COVERED |
| `UF-PUB-004` / `AC-UF-PUB-004` | `UX-SCR-008–009`, `004–005` | Correct filters, markers, popup, context/Maps. | COVERED |
| `UF-PUB-005` / `AC-UF-PUB-005` | `UX-SCR-002` | Eligible Kontak card → WhatsApp. | COVERED |
| `UF-PUB-006` / `AC-UF-PUB-006` | `UX-SCR-002`, `004`, `008–009` | UMKM detail/products/WhatsApp/location condition. | COVERED |
| `UF-PUB-007` / `AC-UF-PUB-007` | `UX-SCR-002`, `005`, `008–009` | Fasilitas detail/category/directions/optional WA. | COVERED |
| `UF-PUB-008` / `AC-UF-PUB-008` | `UX-SCR-001–002`, `006` | Agenda date/time/media/effective status. | COVERED |
| `UF-PUB-009` / `AC-UF-PUB-009` | `UX-SCR-001–003`, `007` | Active/archive navigation and Detail. | COVERED |
| `UF-PUB-010` / `AC-UF-PUB-010` | `UX-SCR-001–003`, `008–009` | Empty state and continued navigation. | COVERED |
| `UF-AD-001` / `AC-UF-AD-001` | `UX-SCR-010–011` | Login → fixed OWN_DUSUN dashboard. | COVERED |
| `UF-AD-002` / `AC-UF-AD-002` | `UX-SCR-013–017` | Create/save/direct eligibility without approval. | COVERED |
| `UF-AD-003` / `AC-UF-AD-003` | `UX-SCR-012–017` | Edit OWN_DUSUN forms and feedback. | COVERED |
| `UF-AD-004` / `AC-UF-AD-004` | `UX-SCR-013–017` | Confirm Nonaktif; row leaves normal list. | COVERED |
| `UF-AD-005` / `AC-UF-AD-005` | `UX-SCR-012` | Own profile including name; no status/other context. | COVERED |
| `UF-AD-006` / `AC-UF-AD-006` | `UX-SCR-011–017` | INACTIVE notice with dashboard retained. | COVERED |
| `UF-SA-001` / `AC-UF-SA-001` | `UX-SCR-010`, `018` | Login → GLOBAL dashboard. | COVERED |
| `UF-SA-002` / `AC-UF-SA-002` | `UX-SCR-018–027` | Global filters/context and management. | COVERED |
| `UF-SA-003` / `AC-UF-SA-003` | `UX-SCR-021–023`, `025–026` | Status filter → Soft Deleted row → Restore. | COVERED |
| `UF-SA-004` / `AC-UF-SA-004` | `UX-SCR-021–026` | Applicable hard-delete confirmation/FK error. | COVERED |
| `UF-SA-005` / `AC-UF-SA-005` | `UX-SCR-020` | ACTIVE → INACTIVE impact confirmation. | COVERED |
| `UF-SA-006` / `AC-UF-SA-006` | `UX-SCR-020` | INACTIVE → ACTIVE; no child auto-restore. | COVERED |
| `UF-SA-007` / `AC-UF-SA-007` | `UX-SCR-028` | Create/assign fixed ADMIN_DUSUN; reserved username. | COVERED |
| `UF-SA-008` / `AC-UF-SA-008` | `UX-SCR-028`, `010` | Reset password dialog; no self-service. | COVERED |
| `UF-SA-009` / `AC-UF-SA-009` | `UX-SCR-019–020`, `025–027` | Homepage source management without page builder. | COVERED |

**Sitemap coverage:** 28/28.  
**User Flow coverage:** 25/25.  
**Acceptance Criteria coverage:** 25/25.

## 47. Wireframe Decision Log

| ID | Layout-level decision | Reason/boundary | Status |
| --- | --- | --- | --- |
| `WF-DEC-001` | Public desktop content memakai bounded reading/content area secara konseptual, tanpa exact width. | Menjaga readability; bukan spacing/token decision. | APPROVED — HUMAN REVIEW |
| `WF-DEC-002` | Primary create action dekat title; row actions dekat target record. | Memperjelas action ownership lintas viewport. | APPROVED — HUMAN REVIEW |
| `WF-DEC-003` | Form action order konseptual Cancel lalu Save; destructive action bukan primary save. | Konsistensi dan pencegahan destructive confusion. | APPROVED — HUMAN REVIEW |

**Wireframe Decisions:** 3. Tidak ada keputusan visual-brand.

## 48. Wireframe Open Questions

Tidak ditemukan layout ambiguity yang memblokir drawing. Responsive composition, form/list/map placement, action hierarchy, dan relevant states telah ditentukan.

**Wireframe Open Questions:** 0.  
**Blocking Wireframe Questions:** 0.  
Branding tidak dibuka kembali dan Warm Natural tetap deferred ke Visual Design.

## 49. Existing Asset Boundary Validation

| Asset/boundary | Validation result |
| --- | --- |
| Homepage mockup acknowledged | PASS — exploratory reference for `UX-SCR-001` only. |
| Homepage mockup replaces wireframe | PASS — No; Mobile/Desktop low-fidelity exists. |
| Homepage mockup affects `UX-SCR-002–028` | PASS — No. |
| Homepage mockup creates behavior/PAGE/DETAIL | PASS — No. |
| Visual tokens copied from Homepage mockup | PASS — No. |
| Warm Natural acknowledged | PASS — direction reference recorded. |
| Warm Natural status | PASS — non-final, non-FROZEN, deferred. |
| Colors/fonts/icon/radius/shadow/spacing copied | PASS — No. |
| Reference-only Change Request | PASS — 0. |

Jika visual reference berbeda dari source FROZEN, source FROZEN menang dan asset tidak menjadi alasan mengubah source.

## 50. Change Request Summary

| Change Request category | Count |
| --- | ---: |
| Baseline Change Request | 0 |
| PRD Change Request | 0 |
| Sitemap Change Request | 0 |
| User Flow Change Request | 0 |
| Roles/Permissions Change Request | 0 |
| ERD Change Request | 0 |
| Technical Baseline Change Request | 0 |
| Physical Schema Change Request | 0 |
| SRS Change Request | 0 |
| UI/UX Specification Change Request | 0 |
| **Seluruh Change Request** | **0** |

## 51. Review Checklist

- [x] CHK-001 — All FROZEN sources read.
- [x] CHK-002 — UI/UX Specification v1.0 used as primary UX source.
- [x] CHK-003 — Existing Warm Natural asset acknowledged as non-final reference.
- [x] CHK-004 — Existing Homepage high-fidelity mockup acknowledged as exploratory.
- [x] CHK-005 — Homepage mockup does not replace `UX-SCR-001` wireframe.
- [x] CHK-006 — No Warm Natural colors/fonts/styles copied into normative wireframe.
- [x] CHK-007 — Visual branding remains deferred.
- [x] CHK-008 — 28 screens wireframed.
- [x] CHK-009 — Mobile wireframe available for all 28 screens.
- [x] CHK-010 — Desktop wireframe available for all 28 screens.
- [x] CHK-011 — Homepage hierarchy retained.
- [x] CHK-012 — Homepage exploratory visual validation noted informationally.
- [x] CHK-013 — Peta Desa filters correct.
- [x] CHK-014 — Peta Dusun has no Dusun selector.
- [x] CHK-015 — Only four public Detail types.
- [x] CHK-016 — Contact has no fifth Detail.
- [x] CHK-017 — Login has username/password only.
- [x] CHK-018 — Admin Dusun has no Dusun selector.
- [x] CHK-019 — Admin Dusun can edit own profile fields.
- [x] CHK-020 — Admin cannot toggle Dusun status.
- [x] CHK-021 — Admin normal lists exclude Soft Deleted.
- [x] CHK-022 — Super Admin can filter Soft Deleted.
- [x] CHK-023 — Restore only Super Admin.
- [x] CHK-024 — Hard Delete only applicable Super Admin.
- [x] CHK-025 — No hard delete Dusun.
- [x] CHK-026 — Admin account role fixed.
- [x] CHK-027 — No account restore/reuse.
- [x] CHK-028 — Agenda Admin scope implicit.
- [x] CHK-029 — Pengumuman Admin scope implicit.
- [x] CHK-030 — Forms preserve required/optional.
- [x] CHK-031 — Empty states covered.
- [x] CHK-032 — Error states covered.
- [x] CHK-033 — Loading states covered.
- [x] CHK-034 — Confirmation hierarchy covered.
- [x] CHK-035 — 32/32 components mapped.
- [x] CHK-036 — 13/13 forms mapped.
- [x] CHK-037 — 24/24 UI states mapped.
- [x] CHK-038 — 8/8 UX decisions retained.
- [x] CHK-039 — 28/28 Sitemap coverage.
- [x] CHK-040 — 25/25 User Flow coverage.
- [x] CHK-041 — 25/25 Acceptance Criteria coverage.
- [x] CHK-042 — Branding remains deferred.
- [x] CHK-043 — No final colors/fonts.
- [x] CHK-044 — No CSS/code.
- [x] CHK-045 — No downstream visual artifact created.
- [x] CHK-046 — Wireframe Specification telah lolos human review.
- [x] CHK-047 — Data/Peta tidak menjadi Soft Deleted browser.
- [x] CHK-048 — `UX-SCR-027` hanya memakai Dusun/category map filters.
- [x] CHK-049 — Restore tetap melalui parent resource management area.
- [x] CHK-050 — Agenda lifecycle dan record Soft Delete axis terpisah.
- [x] CHK-051 — Pengumuman archive dan record Soft Delete axis terpisah.
- [x] CHK-052 — Logically Removed account adalah retained read-only identity.
- [x] CHK-053 — Removed account tidak mempunyai reset/reassign/remove/restore action.
- [x] CHK-054 — Tidak ada unsupported Visual Design Decision ID yang diinvent.
- [x] CHK-055 — Tiga WF Decisions approved human review.
- [x] CHK-056 — Wireframe Specification ditetapkan v1.0 FROZEN FOR MVP.

**Checklist result:** 56/56 PASS.

## 52. Final Validation

| No. | Validation | Result |
| ---: | --- | --- |
| 1 | Version | PASS — 1.0 |
| 2 | Status | PASS — FROZEN FOR MVP |
| 3 | Screens | PASS — 28/28 |
| 4 | Mobile layouts | PASS — 28/28 |
| 5 | Desktop layouts | PASS — 28/28 |
| 6 | Components | PASS — 32/32 |
| 7 | Forms | PASS — 13/13 |
| 8 | UI states | PASS — 24/24 |
| 9 | UX Decisions | PASS — 8/8 |
| 10 | WF Decisions | PASS — 3, all APPROVED — HUMAN REVIEW |
| 11 | WF Open Questions | PASS — 0 |
| 12 | Blocking WF Questions | PASS — 0 |
| 13 | Sitemap | PASS — 28/28 |
| 14 | User Flows | PASS — 25/25 |
| 15 | Acceptance Criteria | PASS — 25/25 |
| 16 | Data/Peta Soft Deleted status filter | PASS — absent |
| 17 | Data/Peta Restore/Hard Delete | PASS — absent |
| 18 | Agenda effective status versus record Soft Delete status | PASS — separate axes |
| 19 | Announcement Archive versus record Soft Delete status | PASS — separate axes |
| 20 | Removed account presentation | PASS — read-only retained identity |
| 21 | Restore/reactivate/reassign after account removal | PASS — absent |
| 22 | Account role selector | PASS — absent; ADMIN_DUSUN fixed |
| 23 | Peta Dusun Dusun selector | PASS — absent |
| 24 | Fifth public Detail | PASS — absent |
| 25 | Admin normal list Soft Deleted | PASS — excluded |
| 26 | Super Admin resource management Soft Deleted access | PASS — available in applicable source screens |
| 27 | Warm Natural | PASS — non-final, non-FROZEN reference |
| 28 | Homepage mockup | PASS — exploratory, non-normative reference |
| 29 | Branding | PASS — deferred |
| 30 | Image/Figma wireframe artifact | PASS — none created |
| 31 | Visual Design artifact | PASS — none created |
| 32 | CSS/code artifact | PASS — none created |
| 33 | All ten Change Request categories | PASS — 0 |

**Final validation result:** 33/33 PASS.

**Document metrics:** 28 screen wireframes, 28 Mobile layouts, 28 Desktop layouts, 32/32 components, 13/13 forms, 24/24 UI states, 8/8 approved UX Decisions, 3 approved Wireframe Decisions, 0 Wireframe Open Questions, 0 Blocking Wireframe Questions, and 56/56 checklist items.

**Conclusion:** Wireframe Specification v1.0 telah melalui human review, lengkap pada tingkat low-fidelity layout, responsive composition, state, dan traceability, serta ditetapkan **FROZEN FOR MVP**. Dokumen siap menjadi source untuk actual low-fidelity wireframe drawing dan tahap Visual Design. Warm Natural dapat digunakan sebagai starting point eksplorasi Visual Design, tetapi tetap memerlukan human review dan tidak otomatis menjadi approved/final design direction.
