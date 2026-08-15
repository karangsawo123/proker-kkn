# UI/UX Behavior & Interaction Specification

**Project:** Portal Informasi Desa Bendung  
**Document:** UI/UX Specification  
**Version:** 1.0  
**Status:** FROZEN FOR MVP  
**SRS Source:** SRS v1.0 — FROZEN FOR MVP  
**UX Sources:** Sitemap v1.0 + User Flows v1.0 — FROZEN FOR MVP  
**Language:** Bahasa Indonesia  

## 1. Document Purpose

Dokumen ini menerjemahkan hierarchy Sitemap, behavior User Flows, dan kontrak normatif SRS menjadi specification interface konseptual untuk wireframe, visual design, implementasi Laravel Blade, responsive behavior, dan UI acceptance testing.

Dokumen ini menentukan interface hierarchy, page composition, navigation behavior, conceptual component behavior, responsive behavior, form behavior, presentation validation, loading/empty/error/success states, destructive-action interaction, role-sensitive behavior, serta arah accessibility/usability.

Dokumen ini belum menentukan final visual branding, exact colors, exact typography family, final spacing tokens, pixel-perfect mockup, CSS, Blade component code, JavaScript code, API, database implementation, atau backend implementation.

**Human Review Note:** UI/UX Behavior & Interaction Specification v1.0 telah melalui human review dan ditetapkan FROZEN FOR MVP.

## 2. Source Authority and Boundary

Primary UI/UX working sources:

1. `docs/06-specification/SRS.md` — primary software contract untuk pekerjaan UI/UX.
2. `docs/03-ux/sitemap.md` — primary UX structure.
3. `docs/03-ux/user-flows.md` — primary behavior.

Status SRS sebagai working contract tidak membuatnya mengalahkan authority upstream. Jika terjadi contradiction, precedence source FROZEN adalah:

`Requirements Baseline → PRD → Sitemap / User Flows → Roles & Permissions → ERD/Data Model → Technical R&D → Physical Database Schema → SRS normalization → UI/UX Specification`.

Dengan demikian, UI/UX Specification SHALL NOT override source FROZEN. Physical Database Schema digunakan hanya untuk referensi form/data state yang telah dinormalisasi. Contradiction nyata wajib dicatat sebagai Change Request terhadap source yang tepat, bukan diselesaikan melalui asumsi. Tidak ditemukan contradiction pada finalisasi v1.0 ini.

## 3. UX Principles

- Mobile-first, sederhana, ringan, dan information-first.
- Public-first; Homepage dan Halaman Dusun dapat digunakan tanpa login.
- Cognitive load rendah dengan progressive disclosure.
- Bahasa Indonesia dan terminology konsisten.
- Interaction konsisten dan destructive action selalu jelas.
- Authorization tidak disembunyikan sebagai asumsi UI.
- JavaScript hanya progresif untuk interaksi yang memerlukannya.
- Konten inti tetap berguna pada koneksi sedang/rendah dan ketika peta eksternal gagal.
- Tidak ada fitur baru yang lahir dari keputusan presentasi.

## 4. Information Architecture Lock

Hierarchy Sitemap v1.0 dipertahankan. Tipe public yang tersedia hanya Homepage Desa Bendung, Halaman Dusun, Arsip Pengumuman, empat detail concept, serta dua konteks Peta. Authentication hanya Login Admin. Administrative hierarchy hanya Dashboard Dusun dan Super Admin Dashboard beserta management areas FROZEN.

Dokumen ini tidak membuat PAGE atau DETAIL type baru. Create/edit management view merupakan presentation state di dalam management area, bukan node Sitemap baru.

## 5. Responsive Strategy

| Viewport concept | Navigation | Content/cards | Dashboard | Forms/tables | Map/actions |
| --- | --- | --- | --- | --- | --- |
| MOBILE | Header ringkas; primary navigation mudah dibuka dan ditutup; quick navigation dapat horizontal-scroll. | Satu kolom; informasi utama lebih dahulu. | Navigation memakai openable panel/drawer-style interaction secara konseptual; context Dusun/role tetap terlihat. | Field ditumpuk; management row menjadi card/stacked row. | Filter mudah dijangkau; map memiliki tinggi usable; action utama full-width atau mudah disentuh. |
| TABLET | Navigation dan grid menyesuaikan ruang; dua kolom bila konten mendukung. | Satu atau dua kolom tanpa memaksa keseragaman resource. | Sidebar/navigation boleh collapsible sesuai available space; content area tetap dominan. | Form dapat memakai grouping dua kolom yang tidak memutus urutan baca; table hanya bila tetap terbaca. | Filter dapat sejajar atau membungkus; popup tetap terbaca. |
| DESKTOP | Header/navigation tampil langsung dan ringkas. | Grid multi-kolom sesuai content density. | Sidebar tampil expanded by default dan dapat collapse; context header selalu jelas. | Table dapat digunakan; form memakai lebar baca yang wajar. | Filter dapat berada di atas/samping map; row actions tetap eksplisit. |

Exact pixel breakpoint belum dibekukan. Implementasi dapat memilih breakpoint native CSS/framework pada tahap visual/implementation tanpa mengubah behavior di atas.

## 6. Public Global Layout

Urutan konseptual global adalah site header, primary navigation, main content, dan footer. Navigation tidak menggunakan mega menu. Header memberi akses sederhana ke Homepage, pilihan/konteks Dusun, dan area informasi publik yang tersedia. Login Admin tidak menjadi primary call-to-action publik.

Homepage dan Halaman Dusun tidak memerlukan login. Footer memuat identitas/kontak yang tersedia dan navigasi pendukung tanpa membuat page baru.

## 7. Homepage UX

Hierarchy rekomendasi:

1. Identitas Desa/hero.
2. Pilihan Dusun ACTIVE.
3. Informasi Desa.
4. Pengumuman terbaru.
5. Agenda/Kegiatan terbaru.
6. Peta Desa.
7. Kontak Desa.
8. Footer.

Dusun selector harus terlihat segera dalam landing experience dari QR. Pengumuman, Agenda, dan Peta tetap data-driven; tidak ada page builder atau manual featured ordering.

**UI/UX DECISION `UX-DEC-001` — APPROVED, HUMAN REVIEW:** urutan di atas menjadi composition FROZEN karena mendahulukan entry ke Dusun setelah identitas Desa tanpa mengubah section atau flow.

## 8. Dusun Selection

Hanya Dusun `ACTIVE` tampil. Pilihan menggunakan card/list tappable dengan nama Dusun yang jelas, target interaksi utuh, dan state focus yang terlihat. Nama yang belum final menggunakan placeholder semantik sesuai `OPEN-001`; UI tidak mengarang nama resmi. Dusun `INACTIVE` tidak diberi placeholder publik. Search Dusun tidak tersedia.

## 9. Halaman Dusun UX

Halaman Dusun adalah single-page/scroll dengan urutan: header/banner dan nama Dusun, Navigasi Cepat, Profil, Kepala Dusun, Kontak Pelayanan, UMKM, Fasilitas, Agenda & Kegiatan, Pengumuman, dan Peta Dusun.

Setiap section mempertahankan heading dan ruang konseptualnya. Section tanpa data menampilkan “Belum ada data” atau padanan semantik, bukan dihilangkan dan bukan diisi konten rekaan. Halaman hanya public ketika parent Dusun `ACTIVE`.

## 10. Quick Navigation

Quick navigation menggunakan link/anchor semantik menuju section dalam halaman yang sama. Pada mobile, chips/buttons boleh horizontal-scroll dengan affordance yang tetap jelas. Keyboard focus berpindah secara dapat dipahami dan target section memiliki heading yang dapat dituju.

**UI/UX DECISION `UX-DEC-002` — APPROVED, HUMAN REVIEW:** quick navigation tidak diwajibkan sticky. Indikator section aktif bersifat opsional jika dapat diterapkan tanpa JavaScript/complexity berlebih.

## 11. Public Card Pattern

Card/list menyediakan content scanning, bukan seluruh detail. Pola bersama: media/placeholder bila relevan, title, metadata terpenting, state/status bila berlaku, dan affordance detail/external action yang eligible.

- UMKM: nama, jenis usaha, product summary bila relevan, alamat/context lokasi.
- Fasilitas: nama, kategori, alamat, dan affordance lokasi.
- Agenda: judul, tanggal, effective status, lokasi, media indicator opsional.
- Pengumuman: judul, konteks scope, dan active/archive context.
- Kontak Pelayanan: nama, jabatan/jenis pelayanan, foto opsional, WhatsApp.

Resource tidak dipaksa memiliki visual identik; hierarchy interaction dan terminology yang konsisten adalah kewajiban utamanya.

## 12. Detail View Pattern

Empat detail concept adalah Detail UMKM, Detail Fasilitas/Lokasi, Detail Agenda/Kegiatan, dan Detail Pengumuman. Struktur bersama: title/header, primary information, media opsional, supporting metadata, actions yang memenuhi prerequisite, serta hubungan kembali ke parent/list/map context.

**UI/UX DECISION `UX-DEC-003` — APPROVED, HUMAN REVIEW:** empat detail menggunakan full-content view yang mempertahankan back/context link. Ini adalah presentation pattern dari empat DETAIL FROZEN, bukan PAGE type baru. Kontak Pelayanan tidak memiliki detail type kelima dan tetap menggunakan card/marker context.

## 13. UMKM UX

Card/list menampilkan foto atau placeholder, nama UMKM, jenis usaha, ringkasan produk bila relevan, alamat/context lokasi, dan detail affordance. Detail menampilkan nama, pemilik, jenis, produk dalam list/tag, deskripsi, alamat, jam operasional, satu foto utama, dan WhatsApp.

WhatsApp adalah external action memakai nomor tersimpan. UMKM tanpa koordinat tetap memiliki detail normal tetapi tidak menampilkan marker atau false map/navigation indicator. Tidak ada marketplace, cart, checkout, stock, SKU, payment, ordering, atau galeri multi-foto.

## 14. Fasilitas UX

Card/detail menampilkan foto/placeholder, nama, kategori dinamis, alamat, deskripsi, dan context map/location. Karena koordinat wajib, action arah/map tersedia untuk Fasilitas eligible. WhatsApp hanya tampil bila nomor tersedia; ketika null, CTA tidak ditampilkan dan tidak dibuat disabled action tanpa fungsi.

## 15. Kontak Pelayanan UX

Kontak menampilkan nama, jabatan/jenis pelayanan, foto opsional, dan external WhatsApp action. Location/map context hanya tampil bila coordinate pair valid dan izin publikasi offline telah diperoleh.

Kontak `deleted_at IS NOT NULL` tidak muncul publik. UI tidak menampilkan consent indicator dan tidak menambah consent field/workflow. `ACTIVE/INACTIVE` Kontak direpresentasikan hanya oleh Soft Delete; tidak ada status kedua.

## 16. Agenda & Kegiatan UX

Card/list menampilkan judul, tanggal/rentang, effective status, lokasi, dan optional media indicator. Label status publik/admin hanya “Akan Datang”, “Berlangsung”, dan “Selesai”. Detail menampilkan judul, tanggal/rentang, jam opsional, status, lokasi, deskripsi, poster/dokumentasi bila tersedia.

Effective status mengikuti manual override bila ada; bila tidak, diturunkan dari tanggal. UI tidak membuat status keempat atau persisted calculated status.

## 17. Pengumuman UX

Pengumuman aktif dan Arsip/Expired dibedakan secara visual/contextual. Arsip tetap public dan bukan data Soft Deleted. Konteks Pengumuman pada Homepage/Halaman Dusun menyediakan jalan ke child page Arsip Pengumuman; exact CTA copy adalah keputusan UI/UX.

Pengumuman Soft Deleted tidak muncul pada daftar aktif, Arsip, atau detail public. Istilah “Arsip” tidak dipakai sebagai sinonim Soft Deleted/nonaktif.

## 18. Empty State

Empty state reusable mempertahankan heading, layout, dan navigation. Public copy draft: “Belum ada data.” Admin copy draft: “Belum ada data. Tambahkan data pertama.” Copy tidak menyatakan error dan tidak membuat fake content.

Create action hanya muncul bagi actor yang memiliki izin. Empty state pada public tidak menawarkan login/write action.

## 19. Peta UX

Peta menggunakan Leaflet.

- **Peta Desa:** filter Dusun, filter kategori, map, marker, dan popup.
- **Peta Dusun:** otomatis scoped ke Dusun yang sedang dibuka, tanpa selector pindah Dusun, dengan filter kategori, marker, dan popup.
- Marker source: UMKM eligible, Fasilitas eligible, dan Pelayanan eligible.
- Taxonomy: `UMKM`, `PELAYANAN`, atau nama kategori fasilitas dinamis.
- `SEMUA` hanya UI filter option, bukan database value.

Tidak ada generic map point, search, boundary polygon, GPS tracking, custom routing, atau universal category.

## 20. Map Mobile Behavior

Control dan target marker touch-friendly. Filter ditempatkan di luar/di atas permukaan map agar mudah dijangkau. Map memiliki tinggi yang cukup untuk pan/zoom dan tidak mengambil seluruh viewport secara permanen. Popup ringkas dan readable. Interaksi touch tidak boleh membuat page scrolling sulit dipulihkan.

**UI/UX DECISION `UX-DEC-004` — APPROVED, HUMAN REVIEW:** pada mobile, filter ditampilkan sebagai control group yang dapat wrap/collapse sebelum map; control tidak bergantung pada hover.

## 21. Map Popup

Popup minimal menampilkan nama dan kategori. Foto hanya tampil bila tersedia; alamat hanya tampil bila tersedia/applicable; detail/context action mengikuti marker resource; direction action hanya tampil bila applicable dan koordinat valid. Description panjang tidak dimuat. Popup bukan pengganti Detail UMKM atau Detail Fasilitas; marker Pelayanan mengarah ke card/context Kontak tanpa membuat detail baru atau memaksa alamat pelayanan optional menjadi wajib.

## 22. External Action UX

WhatsApp dan Google Maps diberi label/icon yang dapat dikenali sebagai tujuan eksternal dan hanya tampil ketika prerequisite ada. Handoff membuka external destination; behavior setelah berpindah berada di luar portal. Tidak ada modal intermediary wajib.

Exact template pesan Kontak Pelayanan tetap `OPEN-002`; dokumen ini tidak membuat settings/runtime configuration untuk template tersebut.

## 23. Login UX

Satu Login Admin digunakan Admin Dusun dan Super Admin. Field hanya username dan password, dengan submit, feedback validation, generic invalid-credential error, dan status loading yang mencegah double submit. Tidak ada email input, public registration, forgot-password self-service, atau recovery Super Admin baru.

Instruction draft boleh berbunyi “Hubungi Super Admin untuk reset password.” Exact copy dapat direvisi saat visual/content review.

## 24. Admin Global Layout

Kedua role dapat memakai shared dashboard shell: header/topbar, role/context indicator, navigation, content area, dan account/logout action. Navigation hanya menampilkan area yang actor dapat akses. Admin Dusun tidak pernah diberi selector Dusun lain.

**UI/UX DECISION `UX-DEC-005` — APPROVED, HUMAN REVIEW:** desktop sidebar tampil expanded by default dan dapat collapse; tablet sidebar/navigation boleh collapsible sesuai available space; mobile memakai openable panel/drawer-style interaction secara konseptual. Exact width, pixel, dan icon tidak ditetapkan.

## 25. Admin Dusun Context

Context header selalu menampilkan role Admin Dusun dan nama Dusun terikat. Context ID/binding akun ke Dusun tetap fixed dan tidak ada Dusun selector. Fixed account context tidak membuat supported profile data menjadi read-only: Admin Dusun tetap dapat mengedit nama/profil OWN_DUSUN. Ketika Dusun `INACTIVE`, dashboard tetap usable dan menampilkan informational notice semantik: “Dusun sedang nonaktif pada portal publik.” Notice tidak menyertakan toggle activation.

## 26. Super Admin Context

Super Admin memakai context GLOBAL. Management lintas Dusun dapat menyediakan filter/select Dusun sebagai navigasi/filter, bukan perubahan permission. Data tingkat Desa dan per-Dusun harus dibedakan secara eksplisit melalui scope label/context field.

## 27. Dashboard Navigation

Admin Dusun: Profil Dusun, Kontak Pelayanan, UMKM, Fasilitas, Agenda & Kegiatan, dan Pengumuman.

Super Admin: Identitas/Profil Desa, Dusun, Kontak Pelayanan, UMKM, Fasilitas, Kategori Fasilitas, Agenda & Kegiatan, Pengumuman, Data/Peta, dan Admin Dusun.

Tidak ada management area tambahan.

## 28. Management List Pattern

Setiap CRUD area memiliki page title, primary create action bila actor berhak, scope/filter bila applicable, list/table/cards, item actions, dan empty state. Management list MAY menggunakan pagination bila volume data membutuhkannya. Pilihan pagination versus simple list, page size, dan bentuk control ditentukan saat implementation/visual refinement berdasarkan volume data; dokumen ini tidak menetapkan page size.

Desktop dapat memakai table. Mobile memakai stacked rows/cards; horizontal overflow hanya jika informasi dan action tetap usable.

**UI/UX DECISION `UX-DEC-006` — APPROVED, HUMAN REVIEW:** desktop menggunakan table untuk data terstruktur; mobile mengubah row menjadi card/stack. Resource card publik tidak harus dipakai ulang sebagai admin row.

## 29. Create/Edit Form Pattern

Form MVP menggunakan single-form CRUD, clear labels, required/optional marker, helper text, inline validation, submit, cancel/back, dan success feedback. Multi-step wizard tidak digunakan. Pada navigation away dengan perubahan belum tersimpan, warning dapat direkomendasikan bila dapat diterapkan tanpa mengganggu normal CRUD.

Submit masuk loading state dan mencegah double submit. Nilai input yang aman dipertahankan ketika validation gagal.

## 30. Required/Optional Presentation

Required field diberi label/indicator konsisten; optional field diberi keterangan “Opsional” dan tidak diberi error hanya karena kosong. Optional media, koordinat UMKM, WhatsApp Fasilitas, tanggal selesai/jam Agenda, serta lokasi Kontak Pelayanan tetap optional. Fasilitas tetap membutuhkan coordinate pair.

## 31. Validation UX

Seluruh 17 `SRS-VAL` rules mendapat presentation di dekat field terkait. Bila beberapa error terjadi, form menampilkan summary yang dapat difokuskan dan link/focus ke field bila feasible. Pesan ringkas menjelaskan tindakan koreksi dan tidak mengekspos constraint name, SQL, query, path, stack trace, atau implementation detail.

| Validation group | UI behavior | SRS source |
| --- | --- | --- |
| Role/scope/status | Pilihan dibatasi pada value sah; conditional context wajib dijelaskan. | `SRS-VAL-001–004`, `013`, `017` |
| Coordinate pair/range | Pair optional harus sama-sama kosong/terisi; range latitude/longitude dijelaskan dekat input. | `SRS-VAL-005–012` |
| Agenda date/status/media | End date tidak sebelum start; override hanya tiga state; media role hanya poster/dokumentasi. | `SRS-VAL-014–016` |

## 32. Coordinate Input UX

Admin dapat memilih titik pada map atau memasukkan latitude dan longitude manual. Fasilitas mewajibkan pair; UMKM dan Kontak Pelayanan membolehkan pair kosong. Untuk pair optional, pengisian hanya satu nilai menghasilkan inline error dan tidak dapat disimpan.

Tidak ada address geocoding/search requirement. Map click dan manual input menyunting field parent resource yang sama.

## 33. Media Upload UX

Behavior mencakup select/upload, preview, replace, remove untuk media optional, validation error, dan processing/loading feedback bila diperlukan. UI tidak mengekspos filesystem path. Placeholder digunakan ketika media absent.

Agenda repeatable media dikelola dalam parent Agenda form/context dengan role Poster Awal atau Dokumentasi. Tidak ada generic Media Library atau resource admin Media independen.

## 34. Soft Delete UX

Action Admin Dusun menggunakan “Nonaktifkan” atau semantic setara, bukan “Hapus Permanen”. Confirmation menjelaskan bahwa data tidak tampil public, tetap tersimpan, dan Admin Dusun tidak dapat restore. Tidak ada tombol restore bagi Admin Dusun.

Normal management list Admin Dusun hanya menampilkan operational records yang aktif/non-Soft-Deleted. Setelah Nonaktifkan berhasil, record keluar dari normal list. Admin Dusun tidak mempunyai Soft Deleted filter, restore list, restore action, hard-delete action, atau browsing UI untuk record Soft Deleted.

## 35. Super Admin Restore UX

Super Admin dapat membedakan active dan Soft Deleted/nonaktif. Soft Deleted operational records dapat ditemukan melalui status filter pada management area resource yang sama. Restore tersedia hanya untuk lima operational resource yang applicable. Data hasil restore dihitung ulang eligibility-nya berdasarkan parent Dusun, privacy, dan lifecycle axis lain; feedback tidak menjamin langsung public.

**UI/UX DECISION `UX-DEC-007` — APPROVED, HUMAN REVIEW:** Soft Deleted operational records tersedia untuk Super Admin melalui status filter pada management area resource yang sama. Normal list Admin Dusun mengecualikan record tersebut. Tidak dibuat separate archive page dan istilah Arsip tidak digunakan untuk Soft Deleted record.

## 36. Hard Delete UX

Hard Delete hanya untuk Super Admin dan applicable non-Dusun operational/data resource sesuai SRS/authorization. Ini tidak mengubah Admin Account logical removal menjadi generic Hard Delete; account tetap memakai Logical Removal. Dusun tidak mempunyai Hard Delete. Kategori Fasilitas hanya dapat di-hard-delete bila applicable dan relational dependency mengizinkan; Produk UMKM dan media mengikuti parent. Action diberi destructive styling/wording, permanent consequence, dan stronger confirmation. Jika FK `RESTRICT` memblokir, tidak ada data terhapus dan UI menampilkan error actionable tanpa nama constraint/database.

## 37. Dusun Active/Inactive UX

Super Admin dapat mengubah status Dusun. Confirmation untuk `INACTIVE` menjelaskan bahwa Dusun/child disembunyikan dari publik, data tetap tersimpan, dan Admin Dusun tetap dapat mengelola. Reactivation menjelaskan bahwa Soft Deleted children tidak otomatis direstore. Label “Delete Dusun” tidak digunakan.

## 38. Admin Account Management UX

Super Admin dapat list, create, assign tepat satu Dusun, reset password, dan logically remove Admin Dusun. Removed account tidak dapat login dan username tetap reserved. UI tidak menawarkan Restore Account, Reactivate Account, Reuse Username, merge identity, atau recovery baru. Akun pengganti memakai username berbeda.

## 39. Password Reset UX

Reset password Admin Dusun hanya dilakukan Super Admin. Confirmation sesuai tingkat risiko ditampilkan sebelum perubahan credential. Success feedback menyatakan credential telah berubah tanpa mengekspos password lama/hash. Tidak ada email reset, WhatsApp automation, atau self-service reset.

## 40. Direct Publish UX

Data valid yang dibuat/diubah Admin Dusun langsung berlaku sesuai lifecycle, parent eligibility, dan privacy precondition. Tidak tersedia Submit for Approval, Request Review, Approve, atau approval queue.

## 41. Success Feedback

Feedback reusable mencakup data created, saved, Soft Delete complete, restore complete, hard delete complete, status changed, dan password reset. Copy aman menggunakan “Data berhasil disimpan,” bukan selalu “dipublikasikan.”

**UI/UX DECISION `UX-DEC-008` — APPROVED, HUMAN REVIEW:** hasil non-destructive memakai inline banner/toast non-blocking secara konseptual; destructive result memakai feedback dekat context tujuan. Exact visual ditetapkan visual design.

## 42. Error UX

| Error category | Presentation | Correctability |
| --- | --- | --- |
| Validation | Field error + summary bila jamak; nilai aman dipertahankan. | User-correctable |
| Authentication | Generic credential error; tidak membocorkan username/account state. | User-correctable/external reset |
| Authorization | Access denied/non-public response konsisten; tidak menampilkan data terlarang. | Bukan diperbaiki dengan manipulasi UI |
| Unavailable/non-public | Informasi netral dan navigation kembali; jangan ungkap Soft Delete/private state. | Contextual |
| Upload | Error jenis/ukuran/processing yang dapat dipahami; parent tetap utuh. | User-correctable atau system |
| External dependency | Konten non-peta tetap tersedia; peta/action menunjukkan unavailable secara ringkas. | System/external |
| FK restriction | Jelaskan dependency yang harus ditangani tanpa nama constraint. | User-correctable oleh Super Admin |
| Server error | Generic retry/later message; tanpa stack trace/secret/query/path. | System |

## 43. Loading UX

Form submit, upload, map loading, dan destructive operation memberi feedback minimal yang terlihat serta menonaktifkan repeated trigger selama request aktif. Skeleton tidak diwajibkan untuk seluruh section. Kegagalan peta tidak menahan render konten direktori.

## 44. Destructive Confirmation Levels

| Level | Action | Confirmation behavior |
| --- | --- | --- |
| LOW | Normal save/create/edit | Tidak memerlukan destructive confirmation. |
| MEDIUM | Soft Delete, status Dusun, password reset | Confirmation menjelaskan akibat spesifik. |
| HIGH | Hard Delete | Stronger confirmation, permanent wording, target identity jelas. |

Normal CRUD tidak diberi friction berlebihan.

## 45. Accessibility Direction

Interface menggunakan semantic HTML, keyboard operability, visible focus, label form, heading hierarchy konsisten, visual distinction memadai, alternative text untuk informative image, usable touch target, serta error/status yang tidak hanya mengandalkan warna. Dynamic focus setelah error/dialog dikelola secara dapat dipahami.

Dokumen ini tidak mengklaim WCAG AA certified atau certification level lain sebelum ada verification.

## 46. Language, Content, and Visual Design Boundary

Terminology baku: Desa, Dusun, Kontak Pelayanan, UMKM, Fasilitas, Agenda & Kegiatan, Pengumuman, Arsip Pengumuman, Admin Dusun, dan Super Admin. “Arsip”, “Soft Deleted”, dan “Nonaktif” hanya digunakan pada axis yang tepat.

### Visual Design Direction — Non-Final

Visual design berikutnya boleh mengeksplorasi hierarchy, readability, tone Desa, image treatment, icon/label clarity, dan responsive density. Dokumen ini tidak menetapkan brand colors, font family, shadow, radius, spacing scale, exact pixels, illustrations, atau icon library.

`VD-DEC-001` — Exact colors, typography, image tone, dan branding direction berstatus **DEFERRED TO VISUAL DESIGN**. Ini bukan UI/UX behavior question dan tidak memblokir freeze specification interaction.

## 47. Conceptual UI Component Inventory

| ID | Component | Context/behavior |
| --- | --- | --- |
| UI-CMP-001 | Site Header | Identitas dan public navigation ringkas. |
| UI-CMP-002 | Primary Navigation | Akses public sederhana tanpa mega menu. |
| UI-CMP-003 | Hero/Identity Block | Identitas Desa atau Dusun dan media opsional. |
| UI-CMP-004 | Dusun Card | Pilihan Dusun ACTIVE yang tappable. |
| UI-CMP-005 | Quick Navigation | Anchor menuju section Halaman Dusun. |
| UI-CMP-006 | Content Section | Heading, content/list, dan empty state. |
| UI-CMP-007 | Resource Card/List Item | Ringkasan UMKM/Fasilitas/Agenda/Pengumuman/Kontak. |
| UI-CMP-008 | Detail Header | Title, scope/context, dan back navigation. |
| UI-CMP-009 | Status Badge | Agenda, Pengumuman, Dusun, operational data, atau account state. |
| UI-CMP-010 | Empty State | Empty information tanpa fake content. |
| UI-CMP-011 | Map Canvas | Leaflet map yang progressively enhanced. |
| UI-CMP-012 | Map Filter | Dusun/category control sesuai map context. |
| UI-CMP-013 | Marker Popup | Ringkasan dan action marker. |
| UI-CMP-014 | External CTA | WhatsApp/Google Maps dengan prerequisite. |
| UI-CMP-015 | Media/Placeholder | Media opsional atau semantic placeholder. |
| UI-CMP-016 | Archive Link/List | Akses dan list Arsip Pengumuman. |
| UI-CMP-017 | Site Footer | Identitas/kontak/navigation pendukung. |
| UI-CMP-018 | Login Form | Username/password dan generic feedback. |
| UI-CMP-019 | Dashboard Shell | Topbar/navigation/content/account action. |
| UI-CMP-020 | Dashboard Navigation | Menu role-sensitive. |
| UI-CMP-021 | Context Header | Role, Desa/Dusun, dan status context. |
| UI-CMP-022 | Management List/Table | Daftar, filter, context, dan actions. |
| UI-CMP-023 | Mobile Management Row | Stacked representation dari table row. |
| UI-CMP-024 | Resource Form | Grouped fields dan submit/cancel. |
| UI-CMP-025 | Field Error/Summary | Inline error dan multi-error summary. |
| UI-CMP-026 | Confirmation Dialog | Medium/high-risk confirmation. |
| UI-CMP-027 | Feedback Banner/Toast | Success/error status tanpa overclaim publikasi. |
| UI-CMP-028 | Loading/Submit State | Busy state dan double-submit prevention. |
| UI-CMP-029 | Coordinate Picker | Map click plus latitude/longitude input. |
| UI-CMP-030 | Media Upload | Select, preview, replace, remove, processing. |
| UI-CMP-031 | Scope/Dusun Filter | Super Admin context filter; bukan permission selector. |
| UI-CMP-032 | Account Management Row | Assignment, reset, logical removal, reserved state. |

**Conceptual component count:** 32. Inventory ini bukan code component architecture.

## 48. Page / Screen Specifications

Setiap specification berikut memetakan tepat satu PAGE, DETAIL, atau map context FROZEN. Form create/edit adalah state internal management area, bukan screen type baru.

### Screen: UX-SCR-001 — Homepage Desa Bendung

| Item | Specification |
| --- | --- |
| Purpose | Landing satu QR utama dan akses informasi Desa/Dusun. |
| Actors | Public; admin dapat melihat sebagai pengunjung. |
| Entry Points | QR utama, direct public navigation. |
| Primary Content | Hero/Identitas Desa, Pilihan Dusun ACTIVE, informasi Desa, Pengumuman terbaru, Agenda terbaru, Peta Desa, Kontak Desa, footer. |
| Primary Actions | Memilih Dusun; membaca informasi; membuka detail eligible. |
| Secondary Actions | Membuka Arsip, memakai filter Peta, external handoff bila tersedia. |
| States | Normal, section empty, partial external/map unavailable. |
| Empty State | Setiap section kosong tetap hadir dengan “Belum ada data.” |
| Error State | Konten non-peta tetap tersedia saat provider peta gagal; no private state disclosure. |
| Responsive Behavior | Mobile satu kolom dan Dusun mudah ditemukan; grid/section berkembang pada tablet/desktop. |
| Authorization Notes | Public no-login; hanya projection eligible; tanpa page builder. |
| SRS Traceability | `SRS-FR-001–005`, `SRS-AUTH-002`, `SRS-AUTH-009`, `SRS-NFR-001–003`, `006–010`, `013`. |
| User Flow Traceability | `UF-PUB-001–002`, `UF-PUB-010`; `AC-UF-PUB-001–002`, `010`. |

### Screen: UX-SCR-002 — Halaman Dusun

| Item | Specification |
| --- | --- |
| Purpose | Single-page public information untuk satu Dusun ACTIVE. |
| Actors | Public. |
| Entry Points | Pilihan Dusun Homepage, direct eligible link, back context dari detail/map. |
| Primary Content | Banner/nama, quick navigation, Profil, Kepala Dusun, Kontak, UMKM, Fasilitas, Agenda, Pengumuman, Peta Dusun. |
| Primary Actions | Navigasi anchor dan membuka resource/detail/action eligible. |
| Secondary Actions | Arsip Pengumuman, Peta filter kategori, external action. |
| States | Parent ACTIVE, section empty, resource-level status. |
| Empty State | Tiap section kosong tetap ada; navigation section lain tetap berfungsi. |
| Error State | Parent INACTIVE/non-public menghasilkan response publik konsisten tanpa mengungkap data. |
| Responsive Behavior | Quick nav horizontal-scroll mobile; section satu kolom lalu grid yang sesuai. |
| Authorization Notes | Tidak public ketika Dusun INACTIVE; child mengikuti parent dan own lifecycle/privacy. |
| SRS Traceability | `SRS-FR-006–013`, `014–021`, `025–040`, `SRS-STATE-001–004`, `007–010`. |
| User Flow Traceability | `UF-PUB-001`, `003–010`; acceptance criteria terkait. |

### Screen: UX-SCR-003 — Arsip Pengumuman

| Item | Specification |
| --- | --- |
| Purpose | Menampilkan Pengumuman expired yang tetap public pada scope Desa/Dusun asal. |
| Actors | Public. |
| Entry Points | Link Arsip dari context Pengumuman Homepage/Halaman Dusun. |
| Primary Content | Context scope, daftar Pengumuman expired, status Arsip, access ke Detail Pengumuman. |
| Primary Actions | Membuka Detail Pengumuman. |
| Secondary Actions | Kembali ke context Pengumuman aktif asal. |
| States | Archive list populated/empty; parent Dusun eligibility. |
| Empty State | “Belum ada Pengumuman dalam arsip.” atau semantik setara. |
| Error State | Soft Deleted atau parent INACTIVE tidak diekspos. |
| Responsive Behavior | List satu kolom mobile; layout lebih padat pada desktop. |
| Authorization Notes | Arsip public, bukan Soft Delete; tidak ada write action. |
| SRS Traceability | `SRS-FR-031–034`, `SRS-AUTH-002`, `008`, `SRS-STATE-007–008`. |
| User Flow Traceability | `UF-PUB-009–010`; `AC-UF-PUB-009–010`. |

### Screen: UX-SCR-004 — Detail UMKM

| Item | Specification |
| --- | --- |
| Purpose | Membaca data lengkap UMKM eligible dan action eksternal. |
| Actors | Public. |
| Entry Points | Card UMKM atau marker/konteks Peta. |
| Primary Content | Nama, pemilik, jenis, produk, deskripsi, alamat, jam, satu foto/placeholder. |
| Primary Actions | WhatsApp menggunakan nomor tersimpan. |
| Secondary Actions | Kembali ke list/map; context lokasi hanya bila koordinat valid. |
| States | With/without photo; with/without coordinates. |
| Empty State | Optional field absent tidak membuat page kosong; produk kosong ditangani tanpa fake tag. |
| Error State | Non-eligible resource tidak public; external failure tidak menghapus data detail. |
| Responsive Behavior | Media/content/action ditumpuk mobile; metadata dapat dikelompokkan desktop. |
| Authorization Notes | Public projection; parent ACTIVE dan UMKM tidak Soft Deleted. |
| SRS Traceability | `SRS-FR-014–017`, `SRS-DATA-008–010`, `SRS-EXT-004`, `SRS-SEC-007–009`. |
| User Flow Traceability | `UF-PUB-006`; `AC-UF-PUB-006`. |

### Screen: UX-SCR-005 — Detail Fasilitas/Lokasi

| Item | Specification |
| --- | --- |
| Purpose | Membaca Fasilitas dan mengakses lokasi/arah. |
| Actors | Public. |
| Entry Points | Card Fasilitas atau marker Peta. |
| Primary Content | Nama, kategori, deskripsi, alamat, foto/placeholder, map/location. |
| Primary Actions | Arah ke Google Maps dengan koordinat valid. |
| Secondary Actions | WhatsApp hanya bila nomor tersedia; kembali ke list/map. |
| States | With/without photo; with/without WhatsApp. |
| Empty State | Optional media/contact tidak menghasilkan disabled CTA. |
| Error State | External provider failure tidak menghilangkan informasi Fasilitas. |
| Responsive Behavior | Location/action mudah disentuh mobile; content/media dapat berdampingan desktop. |
| Authorization Notes | Public projection; parent ACTIVE dan Fasilitas tidak Soft Deleted. |
| SRS Traceability | `SRS-FR-018–024`, `SRS-DATA-008–009`, `SRS-EXT-003–004`. |
| User Flow Traceability | `UF-PUB-007`; `AC-UF-PUB-007`. |

### Screen: UX-SCR-006 — Detail Agenda/Kegiatan

| Item | Specification |
| --- | --- |
| Purpose | Menjelaskan Agenda/Kegiatan Desa atau Dusun. |
| Actors | Public. |
| Entry Points | Agenda terbaru Homepage atau section Agenda Halaman Dusun. |
| Primary Content | Judul, deskripsi, date/range, jam opsional, lokasi, effective status, media opsional. |
| Primary Actions | Membaca detail/media yang tersedia. |
| Secondary Actions | Kembali ke context Agenda asal. |
| States | Akan Datang, Berlangsung, Selesai; media absent/present. |
| Empty State | Optional time/end/media absent tidak menampilkan placeholder value palsu. |
| Error State | Non-eligible/Soft Deleted/parent INACTIVE tidak public. |
| Responsive Behavior | Date/status terkelompok; media mengalir satu kolom mobile. |
| Authorization Notes | Effective status berasal dari override atau tanggal; bukan approval. |
| SRS Traceability | `SRS-FR-025–030`, `SRS-VAL-013–016`, `SRS-STATE-009–010`. |
| User Flow Traceability | `UF-PUB-008`; `AC-UF-PUB-008`. |

### Screen: UX-SCR-007 — Detail Pengumuman

| Item | Specification |
| --- | --- |
| Purpose | Membaca isi Pengumuman aktif atau expired dalam context asal. |
| Actors | Public. |
| Entry Points | Daftar Pengumuman aktif atau Arsip. |
| Primary Content | Judul, isi, scope Desa/Dusun, active/archive context. |
| Primary Actions | Membaca isi. |
| Secondary Actions | Kembali ke daftar aktif atau Arsip asal. |
| States | ACTIVE atau EXPIRED_ARCHIVE; Soft Deleted tidak public. |
| Empty State | Tidak applicable untuk valid detail; missing resource memakai non-public response. |
| Error State | Tidak membocorkan Soft Delete/private lifecycle. |
| Responsive Behavior | Lebar baca nyaman; metadata sebelum isi pada mobile/desktop. |
| Authorization Notes | Archive bukan delete; parent Dusun ACTIVE bila scope Dusun. |
| SRS Traceability | `SRS-FR-031–034`, `SRS-STATE-007–008`, `SRS-AUTH-008`. |
| User Flow Traceability | `UF-PUB-009`; `AC-UF-PUB-009`. |

### Screen: UX-SCR-008 — Peta Desa Context

| Item | Specification |
| --- | --- |
| Purpose | Menemukan lokasi eligible lintas Dusun ACTIVE. |
| Actors | Public. |
| Entry Points | Section Peta pada Homepage. |
| Primary Content | Filter Dusun, filter kategori, Leaflet map, eligible markers, popup. |
| Primary Actions | Filter; select marker; buka detail/context atau Google Maps. |
| Secondary Actions | Reset ke `SEMUA` sebagai UI option. |
| States | Loading, populated, no marker after filter, provider unavailable. |
| Empty State | “Tidak ada lokasi untuk filter ini” tanpa fake marker. |
| Error State | Peta unavailable message; content directory lain tetap tersedia. |
| Responsive Behavior | Touch-friendly; filter accessible; height usable; popup ringkas. |
| Authorization Notes | Hanya parent ACTIVE, non-Soft-Deleted, valid pair, dan privacy-eligible marker. |
| SRS Traceability | `SRS-FR-035–040`, `SRS-EXT-001–003`, `SRS-ERR-006`. |
| User Flow Traceability | `UF-PUB-004`; `AC-UF-PUB-004`. |

### Screen: UX-SCR-009 — Peta Dusun Context

| Item | Specification |
| --- | --- |
| Purpose | Menemukan lokasi eligible dalam Dusun yang sedang dibuka. |
| Actors | Public. |
| Entry Points | Section Peta Dusun pada Halaman Dusun ACTIVE. |
| Primary Content | Leaflet map, filter kategori, markers, popup; context Dusun tetap jelas. |
| Primary Actions | Filter kategori; select marker; detail/context/Google Maps. |
| Secondary Actions | Reset category ke `SEMUA`. |
| States | Auto-scoped, loading, empty-filter result, provider unavailable. |
| Empty State | Tidak ada marker eligible pada Dusun/filter. |
| Error State | Sama dengan Peta Desa tanpa menghilangkan content non-map. |
| Responsive Behavior | Sama dengan map mobile behavior; tanpa selector Dusun. |
| Authorization Notes | Tidak dapat berpindah Dusun melalui control map; parent harus ACTIVE. |
| SRS Traceability | `SRS-FR-035–040`, `SRS-AUTH-002`, `SRS-SEC-019`. |
| User Flow Traceability | `UF-PUB-004`; `AC-UF-PUB-004`. |

### Screen: UX-SCR-010 — Login Admin

| Item | Specification |
| --- | --- |
| Purpose | Shared authentication Admin Dusun dan Super Admin. |
| Actors | Admin Dusun, Super Admin. |
| Entry Points | Direct Login Admin navigation. |
| Primary Content | Username, password, submit, generic feedback. |
| Primary Actions | Login. |
| Secondary Actions | Instruction menghubungi Super Admin untuk reset Admin Dusun. |
| States | Idle, validation error, submitting, invalid credential, rate-limited, success redirect. |
| Empty State | Tidak applicable. |
| Error State | Generic; tidak mengungkap username atau logically removed state. |
| Responsive Behavior | Form single-column dan usable mobile/desktop. |
| Authorization Notes | Tidak ada public registration, email login, atau self-service recovery. |
| SRS Traceability | `SRS-FR-041–044`, `SRS-SEC-001–006`, `015`, `018`. |
| User Flow Traceability | `UF-AD-001`, `UF-SA-001`; `AC-UF-AD-001`, `AC-UF-SA-001`. |

### Screen: UX-SCR-011 — Dashboard Dusun

| Item | Specification |
| --- | --- |
| Purpose | Entry management untuk satu OWN_DUSUN. |
| Actors | Admin Dusun. |
| Entry Points | Successful Admin Dusun login. |
| Primary Content | Role/Dusun context, navigation enam area, status notice bila INACTIVE. |
| Primary Actions | Membuka management area OWN_DUSUN. |
| Secondary Actions | Logout; melihat context publik bila link disediakan tanpa privilege change. |
| States | Parent ACTIVE atau INACTIVE; data summary available/empty. |
| Empty State | Ringkasan kosong tidak menghalangi navigation. |
| Error State | Cross-scope access denied tanpa menampilkan resource. |
| Responsive Behavior | Mobile openable panel; tablet collapsible as space requires; desktop sidebar expanded by default dan dapat collapse. |
| Authorization Notes | Tidak ada Dusun selector/toggle status; dashboard tetap usable saat INACTIVE. |
| SRS Traceability | `SRS-FR-042`, `045–047`, `SRS-AUTH-001`, `006`, `012`, `SRS-SEC-016`. |
| User Flow Traceability | `UF-AD-001–006`; acceptance criteria Admin Dusun. |

### Screen: UX-SCR-012 — Admin Dusun / Kelola Profil Dusun

| Item | Specification |
| --- | --- |
| Purpose | Melihat dan mengedit profil Dusun sendiri. |
| Actors | Admin Dusun. |
| Entry Points | Dashboard Dusun navigation. |
| Primary Content | Profil form untuk supported OWN_DUSUN fields, termasuk nama Dusun; account context ID/binding Dusun tetap fixed. |
| Primary Actions | Simpan perubahan nama/profil Dusun sendiri. |
| Secondary Actions | Cancel/back. |
| States | View/edit, validation, saving, success; parent ACTIVE/INACTIVE notice. |
| Empty State | Required profile tidak diganti fake content. |
| Error State | Validation/server/authorization feedback. |
| Responsive Behavior | Single-form stacked mobile; grouped desktop. |
| Authorization Notes | Dapat mengedit supported Profil Dusun OWN_DUSUN, termasuk nama; tidak dapat mengubah status ACTIVE/INACTIVE, account binding, atau profil Dusun lain. |
| SRS Traceability | `SRS-FR-007`, `045–047`, `SRS-AUTH-001`, `011–012`. |
| User Flow Traceability | `UF-AD-003`, `005–006`; `AC-UF-AD-003`, `005–006`. |

### Screen: UX-SCR-013 — Admin Dusun / Kelola Kontak Pelayanan

| Item | Specification |
| --- | --- |
| Purpose | CRUD dan Nonaktif Kontak OWN_DUSUN. |
| Actors | Admin Dusun. |
| Entry Points | Dashboard navigation. |
| Primary Content | Management list, status, form fields, media, optional coordinate picker. |
| Primary Actions | Create, edit, Nonaktifkan. |
| Secondary Actions | Cancel/back dan location context bila coordinate pair valid. |
| States | Normal list hanya record aktif; setelah Nonaktifkan, record keluar dari normal list; tidak ada Soft Deleted filter/restore list/restore/hard-delete browsing UI. |
| Empty State | Admin empty state dengan create action. |
| Error State | Coordinate pair, required WhatsApp, media, authorization errors. |
| Responsive Behavior | Table-to-card; form stacked; coordinate picker touch-friendly. |
| Authorization Notes | OWN_DUSUN; no restore/hard delete/consent workflow. |
| SRS Traceability | `SRS-FR-010–013`, `045–047`, `SRS-DATA-001–004`, `SRS-VAL-005–007`. |
| User Flow Traceability | `UF-AD-002–004`, `006`; related AC. |

### Screen: UX-SCR-014 — Admin Dusun / Kelola UMKM

| Item | Specification |
| --- | --- |
| Purpose | CRUD UMKM beserta produk, foto tunggal, dan lokasi optional OWN_DUSUN. |
| Actors | Admin Dusun. |
| Entry Points | Dashboard navigation. |
| Primary Content | List, UMKM form, child product list/tag editor, media, coordinate picker. |
| Primary Actions | Create, edit, Nonaktifkan. |
| Secondary Actions | Add/remove product row dalam parent form. |
| States | Normal list hanya record aktif; setelah Nonaktifkan, record keluar dari normal list; tidak ada Soft Deleted browsing/restore/hard-delete UI; media/coordinates tetap optional. |
| Empty State | Create first UMKM; produk optional tidak membuat marketplace placeholder. |
| Error State | Pair/range/media/required-field errors. |
| Responsive Behavior | Table-to-card; form field groups stacked mobile. |
| Authorization Notes | OWN_DUSUN; Produk/media/location mengikuti parent; no restore/hard delete. |
| SRS Traceability | `SRS-FR-014–017`, `045–047`, `SRS-DATA-008–012`, `SRS-VAL-008–010`. |
| User Flow Traceability | `UF-AD-002–004`, `006`; related AC. |

### Screen: UX-SCR-015 — Admin Dusun / Kelola Fasilitas

| Item | Specification |
| --- | --- |
| Purpose | CRUD Fasilitas OWN_DUSUN dengan kategori tersedia dan koordinat wajib. |
| Actors | Admin Dusun. |
| Entry Points | Dashboard navigation. |
| Primary Content | List, form, category selection, coordinate picker, media/WhatsApp optional. |
| Primary Actions | Create, edit, Nonaktifkan. |
| Secondary Actions | Mengatur location context melalui coordinate picker. |
| States | Normal list hanya record aktif; setelah Nonaktifkan, record keluar dari normal list; tidak ada Soft Deleted browsing/restore/hard-delete UI; validation/loading/success. |
| Empty State | Create first Fasilitas. |
| Error State | Required coordinate/range/category/media errors. |
| Responsive Behavior | Table-to-card; map input usable mobile. |
| Authorization Notes | OWN_DUSUN; category read/select only; no category management/restore/hard delete. |
| SRS Traceability | `SRS-FR-018–024`, `045–047`, `SRS-VAL-011–012`. |
| User Flow Traceability | `UF-AD-002–004`, `006`; related AC. |

### Screen: UX-SCR-016 — Admin Dusun / Kelola Agenda & Kegiatan

| Item | Specification |
| --- | --- |
| Purpose | CRUD Agenda scope DUSUN dengan lifecycle dan media parent. |
| Actors | Admin Dusun. |
| Entry Points | Dashboard navigation. |
| Primary Content | List/status; form date/time/location/override; repeatable media. |
| Primary Actions | Create, edit, Nonaktifkan. |
| Secondary Actions | Add/replace/remove Agenda media. |
| States | Normal list hanya Agenda aktif/non-Soft-Deleted dengan tiga effective states + optional override; setelah Nonaktifkan record keluar dari list; tidak ada Soft Deleted browsing/restore/hard-delete UI. |
| Empty State | Create first Agenda. |
| Error State | Date order, override/media role, upload errors. |
| Responsive Behavior | Dates grouped but stacked mobile; media list responsive. |
| Authorization Notes | Scope fixed OWN_DUSUN; tidak dapat membuat scope Desa; no restore/hard delete. |
| SRS Traceability | `SRS-FR-025–030`, `045–047`, `SRS-VAL-013–016`, `SRS-STATE-009–010`. |
| User Flow Traceability | `UF-AD-002–004`, `006`; related AC. |

### Screen: UX-SCR-017 — Admin Dusun / Kelola Pengumuman

| Item | Specification |
| --- | --- |
| Purpose | CRUD Pengumuman scope DUSUN dan membedakan expiry dari Soft Delete. |
| Actors | Admin Dusun. |
| Entry Points | Dashboard navigation. |
| Primary Content | List dengan ACTIVE/EXPIRED context; form judul/isi/expiry. |
| Primary Actions | Create, edit, Nonaktifkan. |
| Secondary Actions | Filter/view lifecycle context bila tersedia. |
| States | Normal list hanya non-Soft-Deleted record dengan ACTIVE/EXPIRED_ARCHIVE context; setelah Nonaktifkan record keluar dari normal list; tidak ada Soft Deleted browsing/restore/hard-delete UI. |
| Empty State | Create first Pengumuman. |
| Error State | Scope/required/date/server/authorization errors. |
| Responsive Behavior | Table-to-card; content form single-column mobile. |
| Authorization Notes | Scope OWN_DUSUN; archive bukan delete; no restore/hard delete. |
| SRS Traceability | `SRS-FR-031–034`, `045–047`, `SRS-VAL-017`, `SRS-STATE-007–008`. |
| User Flow Traceability | `UF-AD-002–004`, `006`; related AC. |

### Screen: UX-SCR-018 — Super Admin Dashboard

| Item | Specification |
| --- | --- |
| Purpose | Entry GLOBAL untuk data Desa, lintas Dusun, lifecycle, dan account management. |
| Actors | Super Admin. |
| Entry Points | Successful Super Admin login. |
| Primary Content | Global context, navigation sepuluh management areas, optional summaries. |
| Primary Actions | Membuka management area GLOBAL. |
| Secondary Actions | Filter/context navigation dan logout. |
| States | Normal, partial empty summaries, system error. |
| Empty State | Tidak menghilangkan management navigation. |
| Error State | Generic server error tanpa implementation details. |
| Responsive Behavior | Mobile openable panel; tablet collapsible as space requires; desktop sidebar expanded by default dan dapat collapse. |
| Authorization Notes | GLOBAL, tidak terikat satu Dusun. |
| SRS Traceability | `SRS-FR-042`, `048–054`, `SRS-AUTH-003–005`, `011`. |
| User Flow Traceability | `UF-SA-001–009`; all Super Admin AC. |

### Screen: UX-SCR-019 — Super Admin / Kelola Identitas dan Profil Desa

| Item | Specification |
| --- | --- |
| Purpose | Mengelola source data Homepage tingkat Desa. |
| Actors | Super Admin. |
| Entry Points | Super Admin navigation. |
| Primary Content | Identitas Desa form dan optional logo/banner preview. |
| Primary Actions | Save. |
| Secondary Actions | Replace/remove optional media; cancel. |
| States | Edit, validation, upload/loading, success. |
| Empty State | Optional media memakai placeholder; required data tidak direka. |
| Error State | Field/media/server errors. |
| Responsive Behavior | Form stacked mobile; grouped desktop. |
| Authorization Notes | GLOBAL; bukan page builder. |
| SRS Traceability | `SRS-FR-001`, `003–004`, `048`, `SRS-AUTH-009`, `011`. |
| User Flow Traceability | `UF-SA-002`, `009`; `AC-UF-SA-002`, `009`. |

### Screen: UX-SCR-020 — Super Admin / Kelola Dusun

| Item | Specification |
| --- | --- |
| Purpose | Melihat/edit enam Dusun awal dan mengubah ACTIVE/INACTIVE. |
| Actors | Super Admin. |
| Entry Points | Super Admin navigation. |
| Primary Content | Dusun list, profile context, status, status action. |
| Primary Actions | Edit nama/profil; activate/deactivate. |
| Secondary Actions | Filter status/context. |
| States | ACTIVE, INACTIVE, saving/status change. |
| Empty State | Tidak menyediakan Add Dusun. |
| Error State | Validation/server error; no hard-delete path. |
| Responsive Behavior | Table-to-card; status/action explicit. |
| Authorization Notes | GLOBAL; no create Dusun MVP; no hard delete. |
| SRS Traceability | `SRS-FR-002`, `009`, `049`, `SRS-AUTH-004`, `006`, `011`, `SRS-STATE-001–002`. |
| User Flow Traceability | `UF-SA-002`, `005–006`; related AC. |

### Screen: UX-SCR-021 — Super Admin / Kelola Kontak Pelayanan

| Item | Specification |
| --- | --- |
| Purpose | GLOBAL management Kontak lintas Dusun dan lifecycle operations. |
| Actors | Super Admin. |
| Entry Points | Super Admin navigation. |
| Primary Content | Dusun filter/context, active/Soft Deleted list, form/location/media. |
| Primary Actions | Create, edit, Soft Delete, restore, applicable hard delete. |
| Secondary Actions | Filter Dusun/status. |
| States | Active/Soft Deleted; privacy/coordinate eligibility; loading/errors. |
| Empty State | Context-specific create state. |
| Error State | Validation, FK restriction, upload, authorization/server. |
| Responsive Behavior | Shared responsive management pattern. |
| Authorization Notes | GLOBAL; no consent workflow; restore does not guarantee public visibility. |
| SRS Traceability | `SRS-FR-010–013`, `048`, `050`, relevant `SRS-DATA/VAL/SEC`. |
| User Flow Traceability | `UF-SA-002–004`; related AC. |

### Screen: UX-SCR-022 — Super Admin / Kelola UMKM

| Item | Specification |
| --- | --- |
| Purpose | GLOBAL management UMKM/products/media/location lintas Dusun. |
| Actors | Super Admin. |
| Entry Points | Super Admin navigation. |
| Primary Content | Dusun/status filter, list, full UMKM form and child products. |
| Primary Actions | Create, edit, Soft Delete, restore, applicable hard delete. |
| Secondary Actions | Context/filter, media/product maintenance. |
| States | Active/Soft Deleted; optional coordinate/media variants. |
| Empty State | Context-specific create state. |
| Error State | Validation/FK/media/server errors. |
| Responsive Behavior | Shared responsive management pattern. |
| Authorization Notes | GLOBAL; child products/media follow parent. |
| SRS Traceability | `SRS-FR-014–017`, `048`, `050`, relevant `SRS-DATA/VAL/SEC`. |
| User Flow Traceability | `UF-SA-002–004`; related AC. |

### Screen: UX-SCR-023 — Super Admin / Kelola Fasilitas

| Item | Specification |
| --- | --- |
| Purpose | GLOBAL management Fasilitas lintas Dusun. |
| Actors | Super Admin. |
| Entry Points | Super Admin navigation. |
| Primary Content | Dusun/category/status filters, list, form, coordinate/media. |
| Primary Actions | Create, edit, Soft Delete, restore, applicable hard delete. |
| Secondary Actions | Filter dan preview location. |
| States | Active/Soft Deleted; WhatsApp/media optional. |
| Empty State | Context-specific create state. |
| Error State | Coordinate/category/FK/media/server errors. |
| Responsive Behavior | Shared responsive management pattern. |
| Authorization Notes | GLOBAL; category selected from managed vocabulary. |
| SRS Traceability | `SRS-FR-018–024`, `048`, `050`, relevant `SRS-DATA/VAL/SEC`. |
| User Flow Traceability | `UF-SA-002–004`; related AC. |

### Screen: UX-SCR-024 — Super Admin / Kelola Kategori Fasilitas

| Item | Specification |
| --- | --- |
| Purpose | Manage vocabulary kategori fasilitas dinamis. |
| Actors | Super Admin. |
| Entry Points | Super Admin navigation. |
| Primary Content | Category list dan nama kategori form. |
| Primary Actions | Create, edit, applicable hard delete. |
| Secondary Actions | None required beyond navigation. |
| States | List populated/empty, validation/saving/deleting. |
| Empty State | Create first category. |
| Error State | Duplicate within Desa atau FK restriction dijelaskan tanpa constraint name. |
| Responsive Behavior | Simple table-to-card/list and compact form. |
| Authorization Notes | GLOBAL only; Admin Dusun hanya memilih kategori. |
| SRS Traceability | `SRS-FR-022–024`, `048`, `SRS-DATA-006–007`, `SRS-ERR-007`. |
| User Flow Traceability | `UF-SA-002`, `004`; relevant AC. |

### Screen: UX-SCR-025 — Super Admin / Kelola Agenda & Kegiatan

| Item | Specification |
| --- | --- |
| Purpose | Manage Agenda scope Desa dan lintas Dusun. |
| Actors | Super Admin. |
| Entry Points | Super Admin navigation. |
| Primary Content | Scope/Dusun/status filters, list, dates/override/media form. |
| Primary Actions | Create, edit, Soft Delete, restore, applicable hard delete. |
| Secondary Actions | Media management dan context filter. |
| States | DESA/DUSUN; three effective statuses; Soft Deleted independent. |
| Empty State | Context-specific create state. |
| Error State | Scope/date/override/media/FK/server errors. |
| Responsive Behavior | Shared responsive management; dates/media remain understandable. |
| Authorization Notes | GLOBAL; scope pair rule enforced; restore recalculates eligibility. |
| SRS Traceability | `SRS-FR-025–030`, `048`, `050`, `SRS-VAL-013–016`, `SRS-STATE-009–010`. |
| User Flow Traceability | `UF-SA-002–004`; relevant AC. |

### Screen: UX-SCR-026 — Super Admin / Kelola Pengumuman

| Item | Specification |
| --- | --- |
| Purpose | Manage Pengumuman Desa/lintas Dusun dan separate lifecycle axes. |
| Actors | Super Admin. |
| Entry Points | Super Admin navigation. |
| Primary Content | Scope/Dusun/active-archive/Soft Deleted context, list, form. |
| Primary Actions | Create, edit, Soft Delete, restore, applicable hard delete. |
| Secondary Actions | Filter lifecycle/context. |
| States | ACTIVE, EXPIRED_ARCHIVE, SOFT_DELETED independently. |
| Empty State | Context-specific create state. |
| Error State | Scope/FK/server/validation errors. |
| Responsive Behavior | Shared responsive management. |
| Authorization Notes | GLOBAL; archive action is not exposed because derived from expiry. |
| SRS Traceability | `SRS-FR-031–034`, `048`, `050`, `SRS-VAL-017`, `SRS-STATE-007–008`. |
| User Flow Traceability | `UF-SA-002–004`, `009`; relevant AC. |

### Screen: UX-SCR-027 — Super Admin / Kelola Data dan Peta

| Item | Specification |
| --- | --- |
| Purpose | Map-centric view atas location data dari resource sumber. |
| Actors | Super Admin. |
| Entry Points | Super Admin navigation. |
| Primary Content | Global Dusun/category filters, map, markers, source/context links. |
| Primary Actions | Filter, inspect marker, navigate ke parent management context. |
| Secondary Actions | External Google Maps bila applicable. |
| States | Loading, populated, filtered empty, provider unavailable. |
| Empty State | No eligible/source location for current filter. |
| Error State | Provider failure tidak mengubah source records. |
| Responsive Behavior | Filter-first mobile and usable map; desktop expanded map. |
| Authorization Notes | Bukan generic map-points CRUD; edits terjadi melalui parent resource. |
| SRS Traceability | `SRS-FR-035–040`, `048`, `SRS-AUTH-010–011`, `SRS-EXT-001–003`. |
| User Flow Traceability | `UF-SA-002`, `009`; related AC. |

### Screen: UX-SCR-028 — Super Admin / Kelola Admin Dusun

| Item | Specification |
| --- | --- |
| Purpose | Create/manage/assign/reset/logically remove Admin Dusun. |
| Actors | Super Admin. |
| Entry Points | Super Admin navigation. |
| Primary Content | Account list, Dusun assignment, active/removed state, account form/actions. |
| Primary Actions | Create, edit assignment where allowed, reset password, remove account. |
| Secondary Actions | Filter Dusun/account state. |
| States | ACTIVE atau LOGICALLY_REMOVED; resetting/removing/success/error. |
| Empty State | Create first Admin Dusun; no self-registration. |
| Error State | Username reserved/duplicate, role-scope validation, server error. |
| Responsive Behavior | Account row stacks with action menu/labels remaining explicit. |
| Authorization Notes | No restore/reactivate/reuse username; removed account cannot login. |
| SRS Traceability | `SRS-FR-051–054`, `SRS-VAL-002–004`, `SRS-SEC-002–005`, `018`. |
| User Flow Traceability | `UF-SA-007–008`; `AC-UF-SA-007–008`. |

**Screen/page specification count:** 28. Seluruh child sections Sitemap tercakup dalam composition screen induknya.

## 49. Public Screen Coverage

| Frozen public node/context | Specification | Coverage |
| --- | --- | --- |
| Homepage Desa Bendung | `UX-SCR-001` | COVERED |
| Halaman Dusun | `UX-SCR-002` | COVERED |
| Arsip Pengumuman | `UX-SCR-003` | COVERED |
| Detail UMKM | `UX-SCR-004` | COVERED |
| Detail Fasilitas/Lokasi | `UX-SCR-005` | COVERED |
| Detail Agenda/Kegiatan | `UX-SCR-006` | COVERED |
| Detail Pengumuman | `UX-SCR-007` | COVERED |
| Peta Desa context | `UX-SCR-008` | COVERED |
| Peta Dusun context | `UX-SCR-009` | COVERED |

Kontak Pelayanan tetap card/marker context dan tidak membentuk detail kelima.

## 50. Admin Screen Coverage

| Frozen administrative node | Specification | Coverage |
| --- | --- | --- |
| Login Admin | `UX-SCR-010` | COVERED |
| Dashboard Dusun | `UX-SCR-011` | COVERED |
| Admin Dusun — Profil Dusun | `UX-SCR-012` | COVERED |
| Admin Dusun — Kontak Pelayanan | `UX-SCR-013` | COVERED |
| Admin Dusun — UMKM | `UX-SCR-014` | COVERED |
| Admin Dusun — Fasilitas | `UX-SCR-015` | COVERED |
| Admin Dusun — Agenda & Kegiatan | `UX-SCR-016` | COVERED |
| Admin Dusun — Pengumuman | `UX-SCR-017` | COVERED |
| Super Admin Dashboard | `UX-SCR-018` | COVERED |
| Super Admin — Identitas/Profil Desa | `UX-SCR-019` | COVERED |
| Super Admin — Dusun | `UX-SCR-020` | COVERED |
| Super Admin — Kontak Pelayanan | `UX-SCR-021` | COVERED |
| Super Admin — UMKM | `UX-SCR-022` | COVERED |
| Super Admin — Fasilitas | `UX-SCR-023` | COVERED |
| Super Admin — Kategori Fasilitas | `UX-SCR-024` | COVERED |
| Super Admin — Agenda & Kegiatan | `UX-SCR-025` | COVERED |
| Super Admin — Pengumuman | `UX-SCR-026` | COVERED |
| Super Admin — Data/Peta | `UX-SCR-027` | COVERED |
| Super Admin — Admin Dusun | `UX-SCR-028` | COVERED |

Shared management patterns tidak membuat fake route/detail. Semua create/edit behavior berada dalam context node management yang sudah ada.

## 51. UI State Matrix

| ID | Axis/state | Public representation | Admin Dusun representation/actions | Super Admin representation/actions |
| --- | --- | --- | --- | --- |
| UX-STATE-001 | Dusun `ACTIVE` | Dusun, eligible child, dan marker dapat tampil. | Dashboard OWN_DUSUN normal. | Badge ACTIVE; dapat ubah ke INACTIVE. |
| UX-STATE-002 | Dusun `INACTIVE` | Dusun/child/marker tidak tampil. | Dashboard tetap usable dengan notice; tidak ada toggle. | Badge INACTIVE; dapat reactivate. |
| UX-STATE-003 | Dusun reactivation | Eligible child aktif dapat kembali tampil. | Tidak mengubah permission. | Confirmation menjelaskan Soft Deleted child tidak auto-restore. |
| UX-STATE-004 | Dusun deletion | Tidak applicable. | Tidak ada action. | Tidak ada hard delete; tidak ada Add Dusun MVP. |
| UX-STATE-005 | Operational `ACTIVE` | Tampil bila parent/privacy/lifecycle lain eligible. | Edit dan Nonaktifkan OWN_DUSUN. | Edit, Soft Delete, applicable hard delete GLOBAL. |
| UX-STATE-006 | Operational `SOFT_DELETED` | Tidak tampil. | Keluar dari normal management list; tidak ada filter/list/restore/hard-delete UI. | Ditemukan melalui status filter pada management area yang sama; restore dan applicable hard delete. |
| UX-STATE-007 | Operational restore | Eligibility dihitung ulang, tidak otomatis public. | Tidak tersedia. | Restore dengan confirmation/feedback aman. |
| UX-STATE-008 | Operational hard delete | Tidak applicable public. | Tidak tersedia. | Permanent; hanya non-Dusun applicable dan dependency harus mengizinkan. |
| UX-STATE-009 | Kontak Pelayanan lifecycle | `deleted_at IS NULL` + parent/privacy prerequisite; tidak ada status terpisah. | “Nonaktifkan” mengisi Soft Delete secara konseptual. | Restore mengaktifkan axis Soft Delete; no consent UI. |
| UX-STATE-010 | Admin account `ACTIVE` | Tidak public. | Login eligible dengan credential valid. | Dapat manage/reset/logically remove. |
| UX-STATE-011 | Admin account `LOGICALLY_REMOVED` | Tidak public. | Tidak dapat login. | Row/identity ditandai removed; tetap retained. |
| UX-STATE-012 | Removed username | Tidak public. | Tidak applicable. | Username terlihat reserved dan ditolak untuk akun baru. |
| UX-STATE-013 | Account restore/reuse | Tidak public. | Tidak tersedia. | Tidak ada restore/reactivate/reuse/merge/recovery action baru. |
| UX-STATE-014 | Pengumuman `ACTIVE` | Tampil pada daftar aktif/detail bila eligible. | Status derived terlihat; edit/Nonaktifkan OWN. | Manage GLOBAL. |
| UX-STATE-015 | Pengumuman `EXPIRED_ARCHIVE` | Tampil di Arsip/detail bila eligible. | Ditandai Arsip/Expired, bukan deleted. | Ditandai Arsip/Expired, bukan restore target karena expiry. |
| UX-STATE-016 | Pengumuman `SOFT_DELETED` | Tidak tampil di active maupun Arsip. | Keluar dari normal list; tidak ada browsing/restore. | Status filter Soft Deleted; dapat restore/hard delete applicable. |
| UX-STATE-017 | Pengumuman scope Dusun parent INACTIVE | Tidak tampil meski active/archive. | Tetap dapat dikelola OWN_DUSUN. | Tetap dapat dikelola GLOBAL. |
| UX-STATE-018 | Agenda `AKAN_DATANG` | Badge “Akan Datang”. | Effective state dan optional override terlihat. | Sama dalam GLOBAL context. |
| UX-STATE-019 | Agenda `BERLANGSUNG` | Badge “Berlangsung”. | Effective state dan optional override terlihat. | Sama dalam GLOBAL context. |
| UX-STATE-020 | Agenda `SELESAI` | Badge “Selesai”. | Effective state dan optional documentation. | Sama dalam GLOBAL context. |
| UX-STATE-021 | Agenda manual override | Menampilkan effective state dari override. | Dapat set/clear tiga value pada authorized parent. | Dapat set/clear GLOBAL. |
| UX-STATE-022 | Agenda `SOFT_DELETED` | Tidak tampil. | Keluar dari normal list; tidak ada browsing/restore/hard delete. | Status filter Soft Deleted; restore/hard delete applicable. |
| UX-STATE-023 | Agenda parent Dusun INACTIVE | Tidak tampil untuk scope Dusun. | Tetap dapat dikelola OWN_DUSUN. | Tetap dapat dikelola GLOBAL. |
| UX-STATE-024 | Agenda calculated state | Derived dari tanggal bila override null; hanya tiga label. | Tidak ada persisted calculated field/index UI. | Tidak ada status keempat atau calculated-status storage UI. |

**UI state rule count:** 24.

## 52. Role × UI Action Matrix

| UI Action | Public | Admin Dusun | Super Admin |
| --- | --- | --- | --- |
| View public eligible data | Ya, tanpa login | Ya sebagai pengunjung | Ya sebagai pengunjung |
| View dashboard/internal data | Tidak | `OWN_DUSUN` | `GLOBAL` |
| Create | Tidak | Resource operasional `OWN_DUSUN` | Applicable resource `GLOBAL` |
| Edit | Tidak | Profil/resource `OWN_DUSUN` | Applicable resource `GLOBAL` |
| Soft Delete / Nonaktifkan operational data | Tidak | `OWN_DUSUN` | `GLOBAL` |
| Restore Soft Deleted data | Tidak | Tidak | Ya, applicable operational data |
| Hard Delete | Tidak | Tidak | Applicable non-Dusun operational/data resource saja; bukan Admin Account logical removal, bukan Dusun; kategori hanya bila dependency mengizinkan |
| Manage categories | Tidak | Pilih kategori tersedia saja | Create/update/applicable hard delete |
| Toggle Dusun ACTIVE/INACTIVE | Tidak | Tidak | Ya |
| Create/add Dusun baru | Tidak | Tidak | Tidak pada MVP |
| Manage Admin Dusun accounts | Tidak | Tidak | Ya |
| Reset Admin Dusun password | Tidak | Tidak | Ya |
| Restore/reactivate removed account | Tidak | Tidak | Tidak |
| External WhatsApp | Ya bila prerequisite tersedia | Hanya melalui public context/preview yang eligible | Hanya melalui public context/preview yang eligible |
| External directions | Ya bila prerequisite tersedia | Melalui eligible public/map context | Melalui eligible public/map context |

Runtime authorization tetap Laravel Policies/Gates dengan `OWN_DUSUN`/`GLOBAL`; visibility control client tidak menjadi authority.

Admin Dusun Account selalu menggunakan Logical Removal melalui account management; child Produk UMKM/media mengikuti lifecycle dan hard-delete behavior parent, bukan action mandiri.

## 53. Form Inventory

`Required`/`Optional` mengikuti SRS dan Physical Schema FROZEN. Audit/lifecycle identifiers dan storage path tidak ditampilkan sebagai editable business fields.

| ID | Form | Field groups and required/optional | Conditional behavior | Validation source |
| --- | --- | --- | --- | --- |
| UX-FORM-001 | Login | Username required; password required. | Generic credential feedback; no email/registration/forgot password. | `SRS-FR-041–044`, `SRS-SEC-001–006`, `SRS-ERR-001` |
| UX-FORM-002 | Identitas Desa | Nama Desa, deskripsi, alamat kantor, nomor kontak, nama Kepala Desa, jam pelayanan required; logo/banner/email optional. | Media preview/replace/remove; only Super Admin. | `SRS-FR-001`, `SRS-DATA-009–012`, Physical `desas` |
| UX-FORM-003 | Profil Dusun | Nama Dusun, deskripsi, nama Kepala Dusun, jumlah RT/RW required; banner optional. | Admin Dusun dapat mengedit supported fields, termasuk nama, dalam OWN_DUSUN. Context ID/account binding tetap fixed; tidak ada Dusun selector; status ACTIVE/INACTIVE hanya Super Admin. | `SRS-FR-007`, `045–049`, `SRS-AUTH-001`, `006`, `011–012`, Physical `dusuns` |
| UX-FORM-004 | Kontak Pelayanan | Nama, jabatan/jenis, WhatsApp required; foto, alamat, latitude/longitude optional. | Optional coordinates must be both empty/present; privacy verified offline, no consent field. | `SRS-FR-010–013`, `SRS-VAL-005–007`, Physical `kontak_pelayanans` |
| UX-FORM-005 | UMKM | Nama UMKM, pemilik, jenis, deskripsi, alamat, WhatsApp, jam required; foto utama and coordinates optional. | Coordinate pair atomic; maximum one main photo. | `SRS-FR-014–017`, `SRS-VAL-008–010`, Physical `umkms` |
| UX-FORM-006 | Produk UMKM | Nama produk required per repeatable child row. | Add/remove child within parent UMKM; no commerce fields. | `SRS-FR-016`, `SRS-AUTH-010`, Physical `produk_umkms` |
| UX-FORM-007 | Fasilitas | Kategori, nama, deskripsi, alamat, latitude/longitude required; foto/WhatsApp optional. | Admin Dusun selects existing category; coordinates always a valid pair. | `SRS-FR-018–024`, `SRS-VAL-011–012`, Physical `fasilitas` |
| UX-FORM-008 | Kategori Fasilitas | Nama kategori required. | Super Admin only; unique within Desa; no universal/map category field. | `SRS-FR-022–024`, `SRS-DATA-007`, Physical `kategori_fasilitas` |
| UX-FORM-009 | Agenda/Kegiatan | Judul, deskripsi, tanggal mulai, dan lokasi required; end date, time, override, serta repeatable media optional. Scope/context bukan pilihan bagi Admin Dusun. | Admin Dusun: scope fixed `DUSUN`, OWN_DUSUN implicit, tanpa scope/Dusun selector. Super Admin: pilih `DESA`/`DUSUN`; Dusun selector hanya ketika `DUSUN`. Hanya tiga override; media role poster/documentation. | `SRS-FR-025–030`, `SRS-VAL-013–016`, Physical Agenda tables |
| UX-FORM-010 | Pengumuman | Judul, isi, dan tanggal kedaluwarsa required. Scope/context bukan pilihan bagi Admin Dusun. | Admin Dusun: scope fixed `DUSUN`, OWN_DUSUN implicit, tanpa scope/Dusun selector. Super Admin: pilih `DESA`/`DUSUN`; Dusun selector hanya ketika `DUSUN`. Tidak ada archive control. | `SRS-FR-031–034`, `SRS-VAL-017`, Physical `pengumumans` |
| UX-FORM-011 | Admin Dusun Account | Username, initial password saat create, dan assignment tepat satu Dusun required. | Role adalah fixed system/context value `ADMIN_DUSUN`, bukan user-selectable control. Tidak ada UI create Super Admin. Username global unique termasuk removed; manage/ASSIGN_DUSUN tetap tersedia, tetapi removed account tidak dapat reactivate. | `SRS-FR-051–054`, `SRS-VAL-002–004`, `SRS-SEC-003` |
| UX-FORM-012 | Reset Password | Target account context and new credential required; existing password/hash never shown. | Active Admin Dusun target; confirmation appropriate; no email/WhatsApp automation. | `SRS-FR-052`, `SRS-SEC-002`, `005`, `014` |
| UX-FORM-013 | Dusun Status Action | Target Dusun and proposed ACTIVE/INACTIVE transition; no new business field. | Super Admin only; confirmation changes message by direction; reactivation does not restore child. | `SRS-FR-049`, `SRS-AUTH-006`, `011`, `SRS-STATE-001–004` |

**Form count:** 13. Tidak ada field atau form baru di luar source FROZEN.

## 54. SRS Traceability

Seluruh 161 normative SRS IDs dinilai. Requirement dengan direct UI impact dipetakan ke screen, component, form, state, feedback, dan interaction. Requirement tanpa direct visual control tetap dicatat sebagai implementation/security/operational boundary agar UI tidak menciptakan behavior yang bertentangan.

| SRS range | Count | UI/UX coverage | Status |
| --- | ---: | --- | --- |
| `SRS-FR-001–054` | 54 | Sections 6–43; `UX-SCR-001–028`; forms/actions/lifecycle. | 54/54 COVERED |
| `SRS-AUTH-001–012` | 12 | Role-sensitive navigation/actions; Section 52; screen authorization notes. | 12/12 COVERED |
| `SRS-DATA-001–012` | 12 | Lifecycle, forms, coordinate/media presentation; non-UI DB rules retained as boundaries. | 12/12 COVERED |
| `SRS-VAL-001–017` | 17 | Section 31; `UX-FORM-001–013`; field/summary error behavior. | 17/17 COVERED |
| `SRS-STATE-001–010` | 10 | `UX-STATE-001–024` grouped by the five independent axes. | 10/10 COVERED |
| `SRS-EXT-001–006` | 6 | Leaflet, external CTA, provider failure, media/browser handoff boundaries. | 6/6 COVERED |
| `SRS-ERR-001–008` | 8 | Sections 18, 42–43; screen error states. | 8/8 COVERED |
| `SRS-SEC-001–019` | 19 | Login, role scope, privacy, destructive control, no-sensitive-detail boundaries. | 19/19 COVERED |
| `SRS-NFR-001–017` | 17 | Mobile-first, Blade/progressive JS constraints, accessibility, compatibility; optimizer/storage-only rules classified no-direct-control. | 17/17 COVERED |
| `SRS-OPS-001–006` | 6 | Empty-data/operational admin usability covered; backup/handover/training items retained as no-new-screen boundaries. | 6/6 COVERED |
| **Total** | **161** | **Direct UI impact or explicit no-direct-UI boundary classified** | **161/161 — 100%** |

**SRS UI-impact requirement coverage:** 100% of normative IDs assessed and covered. Classification tidak mengubah source behavior.

## 55. User Flow Traceability

| Flow / Acceptance Criterion | Screen(s) | Interaction and state | Status |
| --- | --- | --- | --- |
| `UF-PUB-001` / `AC-UF-PUB-001` | `UX-SCR-001–002` | QR → Homepage → ACTIVE Dusun; INACTIVE tidak ditawarkan. | COVERED |
| `UF-PUB-002` / `AC-UF-PUB-002` | `UX-SCR-001` | Read data-driven Desa sections tanpa login. | COVERED |
| `UF-PUB-003` / `AC-UF-PUB-003` | `UX-SCR-002` | Quick anchor menuju section; empty section retained. | COVERED |
| `UF-PUB-004` / `AC-UF-PUB-004` | `UX-SCR-008–009`, `004–005` | Desa filters Dusun/category; Dusun auto-scope; marker/detail/Maps. | COVERED |
| `UF-PUB-005` / `AC-UF-PUB-005` | `UX-SCR-002` | Eligible Kontak → external WhatsApp; hidden if Soft Deleted/parent inactive. | COVERED |
| `UF-PUB-006` / `AC-UF-PUB-006` | `UX-SCR-002`, `004`, `008–009` | UMKM list/detail/product/WhatsApp; marker conditional coordinates. | COVERED |
| `UF-PUB-007` / `AC-UF-PUB-007` | `UX-SCR-002`, `005`, `008–009` | Fasilitas detail/category/directions; WhatsApp conditional. | COVERED |
| `UF-PUB-008` / `AC-UF-PUB-008` | `UX-SCR-001–002`, `006` | Agenda detail with optional time/media and effective state. | COVERED |
| `UF-PUB-009` / `AC-UF-PUB-009` | `UX-SCR-001–003`, `007` | Active vs archive by expiry; Soft Delete/parent guards. | COVERED |
| `UF-PUB-010` / `AC-UF-PUB-010` | `UX-SCR-001–003`, `008–009` | Reusable empty state; navigation remains usable. | COVERED |
| `UF-AD-001` / `AC-UF-AD-001` | `UX-SCR-010–011` | Valid active account → OWN_DUSUN dashboard; generic rejection otherwise. | COVERED |
| `UF-AD-002` / `AC-UF-AD-002` | `UX-SCR-013–017` | Create valid data → direct eligibility without approval. | COVERED |
| `UF-AD-003` / `AC-UF-AD-003` | `UX-SCR-012–017` | Edit OWN_DUSUN; cross-scope unavailable. | COVERED |
| `UF-AD-004` / `AC-UF-AD-004` | `UX-SCR-013–017` | Confirm Nonaktif → record keluar dari normal Admin list dan tidak public; no Soft Deleted browsing/restore/hard-delete UI. | COVERED |
| `UF-AD-005` / `AC-UF-AD-005` | `UX-SCR-012` | Save valid own profile; no status/other Dusun access. | COVERED |
| `UF-AD-006` / `AC-UF-AD-006` | `UX-SCR-010–017` | Parent INACTIVE notice; dashboard remains available, public hidden. | COVERED |
| `UF-SA-001` / `AC-UF-SA-001` | `UX-SCR-010`, `018` | Valid Super Admin → GLOBAL dashboard. | COVERED |
| `UF-SA-002` / `AC-UF-SA-002` | `UX-SCR-018–027` | Context/filter and valid GLOBAL management. | COVERED |
| `UF-SA-003` / `AC-UF-SA-003` | `UX-SCR-021–023`, `025–026` | Status filter pada management area yang sama → temukan Soft Deleted → restore → eligibility recalculated. | COVERED |
| `UF-SA-004` / `AC-UF-SA-004` | `UX-SCR-021–026` | Strong confirmation; non-Dusun permanent delete or actionable restriction. | COVERED |
| `UF-SA-005` / `AC-UF-SA-005` | `UX-SCR-020` | ACTIVE → INACTIVE; public hidden, admin retained. | COVERED |
| `UF-SA-006` / `AC-UF-SA-006` | `UX-SCR-020` | INACTIVE → ACTIVE; non-Soft-Deleted eligible child reconsidered. | COVERED |
| `UF-SA-007` / `AC-UF-SA-007` | `UX-SCR-028` | Create/assign account; active/removed username duplicates rejected. | COVERED |
| `UF-SA-008` / `AC-UF-SA-008` | `UX-SCR-028`, `010` | Reset credential; no self-service recovery. | COVERED |
| `UF-SA-009` / `AC-UF-SA-009` | `UX-SCR-019–020`, `025–027` | Update Homepage source data; no page builder. | COVERED |

**User Flow coverage:** 25/25.  
**SRS Acceptance Criteria coverage:** 25/25.

## 56. Sitemap Traceability

| Sitemap area | Frozen node count represented | UX specification |
| --- | ---: | --- |
| Public PAGE/DETAIL/map contexts | 9 | `UX-SCR-001–009` |
| Authentication | 1 | `UX-SCR-010` |
| Admin Dusun dashboard + management areas | 7 | `UX-SCR-011–017` |
| Super Admin dashboard + management areas | 11 | `UX-SCR-018–028` |
| **Total screen/context specifications** | **28** | **28/28 COVERED** |

Homepage and Halaman Dusun child sections, active/archive child context, marker popup, and management operations are additionally specified in Sections 6–48. **Sitemap coverage: 100%. No new PAGE/DETAIL.**

## 57. Acceptance Criteria Traceability

Section 55 maps each of the 25 frozen User Flows one-to-one with its corresponding `AC-UF-*`, screen, interaction, and state. Outcomes are retained verbatim in meaning: public eligibility, OWN_DUSUN/GLOBAL boundaries, lifecycle effects, external handoffs, and direct publish behavior tidak berubah.

**Acceptance Criteria result:** 25/25 COVERED; 0 modified acceptance outcomes.

## 58. UI/UX Decision Log

| ID | Presentational decision | Rationale/boundary | Status |
| --- | --- | --- | --- |
| UX-DEC-001 | Homepage baseline order menempatkan Pilihan Dusun segera setelah identity/hero. | Mendukung QR landing dan public-first; tidak mengubah section. | APPROVED — HUMAN REVIEW |
| UX-DEC-002 | Quick navigation horizontal-scroll mobile; sticky/active indicator tidak mandatory. | Menjaga mobile usability tanpa JS complexity wajib. | APPROVED — HUMAN REVIEW |
| UX-DEC-003 | Empat detail concept menggunakan full-content view dengan back context. | Presentation pattern saja; tidak membuat detail/page type baru. | APPROVED — HUMAN REVIEW |
| UX-DEC-004 | Map filter diletakkan sebelum/di luar canvas dan dapat wrap/collapse mobile. | Touch access dan scrolling lebih aman. | APPROVED — HUMAN REVIEW |
| UX-DEC-005 | Desktop sidebar expanded by default dan dapat collapse; tablet dapat collapsible; mobile memakai openable panel. | Interaction pattern tanpa exact width/pixel/icon. | APPROVED — HUMAN REVIEW |
| UX-DEC-006 | Management desktop table; mobile stacked row/card. | Readability/action access lintas viewport. | APPROVED — HUMAN REVIEW |
| UX-DEC-007 | Super Admin menemukan Soft Deleted melalui status filter pada management area sama; normal Admin Dusun list mengecualikannya. | Mendukung restore tanpa separate page atau confusion dengan Arsip. | APPROVED — HUMAN REVIEW |
| UX-DEC-008 | Non-destructive feedback non-blocking; destructive result dekat context. | Feedback jelas tanpa overclaim public visibility. | APPROVED — HUMAN REVIEW |

**UX Decision count:** 8. Seluruh keputusan berstatus APPROVED — HUMAN REVIEW dan tidak mengubah product behavior.

## 59. UI/UX Open Questions and Visual Design Deferred Decision

Tidak ada unresolved UI/UX behavior question. Desktop dashboard navigation telah diputus pada `UX-DEC-005`; branding tidak diklasifikasikan sebagai behavior question.

| ID | Deferred decision | Classification | Effect |
| --- | --- | --- | --- |
| VD-DEC-001 | Exact colors, typography, image tone, dan branding direction. | DEFERRED TO VISUAL DESIGN | Tidak memengaruhi hierarchy, interaction, responsive behavior, atau freeze UI/UX Specification. |

**UI/UX Open Questions:** 0.  
**Blocking UX Questions:** 0.  
**Visual Design Deferred Decisions:** 1.

## 60. Upstream Open Boundary

| Upstream ID | UI/UX treatment |
| --- | --- |
| `OPEN-001` | Gunakan placeholder/semantic Dusun labels; jangan mengarang nama resmi. |
| `OPEN-002` | WhatsApp handoff tetap ada; exact template copy tidak dibekukan dan tidak menjadi settings feature. |
| `OPEN-004` | Identitas pemegang Super Admin tidak mengubah screen/role. |
| `OPEN-005` | Calon Admin tidak mengubah account management behavior. |
| `OPEN-006` | Supervisor pasca-KKN tetap proses operasional, bukan actor/UI baru. |
| `OPEN-007` | Hosting/domain ownership tidak membuat screen baru. |
| `OPEN-008` | Physical QR board design di luar website visual design. |
| `OPEN-009` | Approved technical baseline dipakai; provider detail tetap qualification eksternal. |
| `OPEN-010` | Tidak ada Super Admin recovery UI/flow. |
| `OPEN-011` | Dataset kosong memakai honest empty state; tidak membuat dummy public fact. |

Tidak ada upstream OPEN yang diselesaikan dalam dokumen ini.

## 61. Future Exclusion

Tidak dibuat UI, navigation, form, atau control untuk: add new Dusun, per-Dusun QR, UMKM multi-photo gallery, map search, Dusun boundary polygon, atau small Dusun QR boards. Seluruhnya tetap FUTURE/outside MVP.

## 62. Technical UX Constraint

- Konten inti dirender Laravel Blade.
- JavaScript bersifat progressive dan hanya untuk peta/interaksi yang memerlukan.
- Peta menggunakan Leaflet dan provider yang lolos qualification.
- UI mobile-first dan tidak mengasumsikan SPA, realtime websocket, drag/drop page builder, massive client state, atau mobile native API.
- External handoff menggunakan browser destination; tidak ada API contract/internal messaging/routing baru.

## 63. Change Request Summary

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
| **Seluruh Change Request** | **0** |

## 64. Review Checklist

- [x] CHK-001 — Semua source FROZEN dibaca.
- [x] CHK-002 — Sitemap tidak berubah.
- [x] CHK-003 — User Flow tidak berubah.
- [x] CHK-004 — SRS behavior tidak berubah.
- [x] CHK-005 — Hanya tiga actor.
- [x] CHK-006 — Mobile-first specified.
- [x] CHK-007 — Homepage specified.
- [x] CHK-008 — Halaman Dusun specified.
- [x] CHK-009 — Public details specified.
- [x] CHK-010 — Peta Desa specified.
- [x] CHK-011 — Peta Dusun scoped correctly.
- [x] CHK-012 — Login specified.
- [x] CHK-013 — Admin Dusun navigation specified.
- [x] CHK-014 — Super Admin navigation specified.
- [x] CHK-015 — Admin OWN_DUSUN context clear.
- [x] CHK-016 — Forms specified.
- [x] CHK-017 — Required/optional fields preserved.
- [x] CHK-018 — Validation UX specified.
- [x] CHK-019 — Empty states specified.
- [x] CHK-020 — Error states specified.
- [x] CHK-021 — Loading states specified.
- [x] CHK-022 — Success feedback specified.
- [x] CHK-023 — Soft Delete UX specified.
- [x] CHK-024 — Restore UX only Super Admin.
- [x] CHK-025 — Hard Delete UX only Super Admin.
- [x] CHK-026 — No hard delete Dusun.
- [x] CHK-027 — Account logical removal UX specified.
- [x] CHK-028 — Removed username reuse not offered.
- [x] CHK-029 — Direct publish without approval.
- [x] CHK-030 — Agenda status UI specified.
- [x] CHK-031 — Announcement archive UI specified.
- [x] CHK-032 — Privacy remains offline.
- [x] CHK-033 — External handoffs specified.
- [x] CHK-034 — Accessibility direction specified.
- [x] CHK-035 — Responsive behavior specified.
- [x] CHK-036 — Component inventory available.
- [x] CHK-037 — Screen inventory complete.
- [x] CHK-038 — State matrix complete.
- [x] CHK-039 — Role-action matrix complete.
- [x] CHK-040 — Form inventory complete.
- [x] CHK-041 — 25/25 User Flows covered.
- [x] CHK-042 — 25/25 Acceptance Criteria covered.
- [x] CHK-043 — Sitemap 100% covered.
- [x] CHK-044 — SRS UI-impact requirements covered.
- [x] CHK-045 — FUTURE excluded.
- [x] CHK-046 — No visual mockup.
- [x] CHK-047 — No code.
- [x] CHK-048 — Upstream source unchanged.
- [x] CHK-049 — UI/UX Specification telah melalui human review.
- [x] CHK-050 — Source authority tidak menempatkan SRS di atas Requirements Baseline.
- [x] CHK-051 — Admin Dusun dapat update supported Profil Dusun fields OWN_DUSUN.
- [x] CHK-052 — Hanya status Dusun ACTIVE/INACTIVE yang eksklusif ke Super Admin.
- [x] CHK-053 — Admin Dusun normal list tidak menampilkan Soft Deleted records.
- [x] CHK-054 — Super Admin dapat menemukan Soft Deleted records melalui status filter.
- [x] CHK-055 — Soft Deleted tidak disebut Arsip.
- [x] CHK-056 — Desktop dashboard sidebar expanded by default dan collapsible.
- [x] CHK-057 — Visual branding direferensikan sebagai deferred Visual Design decision.
- [x] CHK-058 — Agenda Admin Dusun tidak mempunyai scope/Dusun selector.
- [x] CHK-059 — Pengumuman Admin Dusun tidak mempunyai scope/Dusun selector.
- [x] CHK-060 — Admin Dusun Account form tidak mempunyai role selector.
- [x] CHK-061 — Marker Pelayanan tidak memaksa optional alamat.
- [x] CHK-062 — Tidak ada fifth public Detail.
- [x] CHK-063 — UI/UX Specification Version 1.0 — FROZEN FOR MVP.

**Checklist result:** 63/63 PASS.

## 65. Final Validation

| No. | Validation | Result |
| ---: | --- | --- |
| 1 | Version | PASS — 1.0 |
| 2 | Status | PASS — FROZEN FOR MVP |
| 3 | Screen/context specifications | PASS — 28 |
| 4 | Conceptual components | PASS — 32 |
| 5 | Forms | PASS — 13 |
| 6 | UI state rules | PASS — 24 |
| 7 | UX Decisions | PASS — 8, all approved by human review |
| 8 | UI/UX Open Questions | PASS — 0 |
| 9 | Blocking UX Questions | PASS — 0 |
| 10 | Branding deferred to Visual Design | PASS — 1 deferred decision |
| 11 | Sitemap coverage | PASS — 28/28, 100% |
| 12 | User Flow coverage | PASS — 25/25 |
| 13 | Acceptance Criteria coverage | PASS — 25/25 |
| 14 | SRS UI-impact coverage | PASS — 161/161, 100% |
| 15 | Admin Dusun has no Dusun selector | PASS |
| 16 | Admin Dusun can update supported own profile fields | PASS — includes nama Dusun |
| 17 | Admin Dusun cannot toggle Dusun state | PASS |
| 18 | Admin normal management list excludes Soft Deleted | PASS |
| 19 | Super Admin can filter Soft Deleted for restore | PASS — same management area |
| 20 | Account logical removal remains separate | PASS |
| 21 | No account restore/reactivate/reuse | PASS |
| 22 | No Super Admin role creation UI | PASS |
| 23 | Peta Dusun has no Dusun selector | PASS |
| 24 | Marker Pelayanan has no Detail page | PASS |
| 25 | Optional service address remains optional | PASS |
| 26 | Announcement Archive is not Soft Delete | PASS |
| 27 | Agenda has exactly three effective statuses | PASS |
| 28 | Direct publishing remains | PASS |
| 29 | Privacy remains offline | PASS |
| 30 | FUTURE remains excluded | PASS |
| 31 | All nine Change Request categories | PASS — 0 |
| 32 | No wireframe | PASS |
| 33 | No mockup | PASS |
| 34 | No final design system | PASS |
| 35 | No CSS/Blade/JavaScript | PASS |
| 36 | No Testing Specification | PASS |
| 37 | No API or implementation code | PASS |

**Final validation result:** 37/37 PASS.

**Document metrics:** 28 screen/context specifications, 32 conceptual UI components, 13 forms, 24 UI state rules, 8 approved UX Decisions, 0 UI/UX Open Questions, 0 Blocking UX Questions, 1 Visual Design Deferred Decision, and 63/63 checklist items.

**Conclusion:** UI/UX Behavior & Interaction Specification v1.0 telah melalui human review, seluruh clarification dan final validation lulus, dan dokumen ditetapkan **FROZEN FOR MVP**. Dokumen siap menjadi source untuk Wireframe, Visual Design, dan Testing Specification. Finalisasi berhenti sebelum seluruh downstream artifact tersebut.
