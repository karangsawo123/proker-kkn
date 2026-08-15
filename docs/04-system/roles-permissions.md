# Document Information

| Field | Value |
| --- | --- |
| Project | Portal Informasi Desa Bendung |
| Document | Roles & Permissions |
| Version | 1.0 |
| Status | FROZEN FOR MVP |
| Behavior Source | User Flows v1.0 — FROZEN FOR MVP |
| IA Source | Sitemap v1.0 — FROZEN FOR MVP |
| Product Source | PRD v1.0 — FROZEN FOR MVP |
| Requirement Source | Requirements Baseline v1.0 — FROZEN FOR MVP |

Roles & Permissions v1.0 telah melalui human review. Tidak ditemukan `PERMISSION OPEN QUESTION`, `UX CHANGE REQUEST`, `PRD CHANGE REQUEST`, maupun `BASELINE CHANGE REQUEST`.

Perubahan authorization di masa depan yang mengubah behavior produk harus mengikuti Change Request terhadap source FROZEN terkait.

# 1. Document Purpose

Dokumen ini menerjemahkan source FROZEN menjadi model authorization konseptual yang menjelaskan actor/role, resource, scope data, permitted actions, prohibited actions, serta ownership/context boundary. Dokumen ini menjadi input untuk ERD/Data Model, SRS, desain authentication/authorization, dan testing authorization pada tahap berikutnya.

Dokumen ini belum menentukan:

- database table, foreign key, atau schema;
- SQL;
- middleware, JWT, session, atau policy engine;
- framework atau library;
- API route atau contract;
- implementation code.

Jika kebutuhan permission memerlukan behavior baru, hal tersebut dicatat sebagai `PRD / BASELINE CHANGE REQUEST`. Jika memerlukan perubahan Sitemap atau User Flow, hal tersebut dicatat sebagai `UX CHANGE REQUEST`. Permission yang tidak dapat dipastikan harus dicatat sebagai `PERMISSION OPEN QUESTION`, bukan diputuskan diam-diam.

# 2. Roles

MVP hanya menggunakan tiga actor/role software:

1. **Public User** — pengunjung umum tanpa akun.
2. **Admin Dusun** — administrator yang terikat pada satu Dusun.
3. **Super Admin** — administrator dengan scope global.

Kepala Dusun, Operator Desa, Supervisor, Kepala Desa, editor, moderator, atau guest account tidak menjadi role software baru. Seorang personel dapat memegang role Admin Dusun atau Super Admin sesuai keputusan operasional, tetapi jabatan/personel tersebut tidak mengubah model role sistem.

# 3. Permission Notation

## 3.1 Conceptual Actions

| Action | Meaning |
| --- | --- |
| `VIEW_PUBLIC` | Melihat representasi data yang public/visible. |
| `VIEW` | Melihat data dalam konteks administratif yang diizinkan. |
| `CREATE` | Membuat data baru pada resource yang didukung. |
| `UPDATE` | Mengubah data yang sudah ada. |
| `ACTIVATE` | Mengubah state menjadi aktif jika resource mendukungnya. |
| `DEACTIVATE` | Mengubah state menjadi nonaktif jika resource mendukungnya. |
| `SOFT_DELETE` | Menyembunyikan data operasional dari public tetapi mempertahankan data. |
| `RESTORE` | Memulihkan data yang di-Soft Delete. |
| `HARD_DELETE` | Menghapus permanen sesuai batas baseline. |
| `MANAGE` | Kumpulan aksi konseptual yang secara eksplisit didukung untuk resource terkait. |
| `RESET_PASSWORD` | Mereset password akun Admin Dusun. |
| `ASSIGN_DUSUN` | Mengaitkan akun Admin Dusun dengan tepat satu Dusun. |

Dokumen tidak menggunakan permission teknis seperti `DB_SELECT`, `API_POST`, `JWT_REFRESH`, atau `UPLOAD_S3`.

## 3.2 Matrix Marks

- `✓` = diperbolehkan.
- `✗` = tidak diperbolehkan.
- `—` = aksi tidak berlaku independen atau tidak dibutuhkan pada resource tersebut.
- `PUBLIC`, `OWN_DUSUN`, dan `GLOBAL` = scope authorization.

# 4. Access Scope Model

## 4.1 PUBLIC SCOPE

- Hanya data yang public, aktif/visible, dan diizinkan untuk dipublikasikan.
- Public User tidak mengelola data dan tidak mempunyai akun.

## 4.2 OWN_DUSUN

- Admin Dusun hanya mengakses data Dusun yang terikat pada akunnya.
- Admin Dusun tidak dapat memilih atau berpindah ke Dusun lain.
- Satu Dusun dapat mempunyai lebih dari satu Admin Dusun.

## 4.3 GLOBAL

- Super Admin dapat mengelola seluruh enam Dusun.
- Scope mencakup data tingkat Desa dan seluruh data lintas Dusun.

Scope merupakan konsep authorization, bukan desain database, foreign key, tenant model, atau implementasi query.

# 5. High-Level Role Matrix

| Capability | Public User | Admin Dusun | Super Admin |
| --- | --- | --- | --- |
| Akses website public | ✓ `PUBLIC` | ✓ sebagai pengunjung | ✓ sebagai pengunjung |
| Login dashboard | ✗ | ✓ `OWN_DUSUN` | ✓ `GLOBAL` |
| Kelola Identitas/Profil Desa | ✗ | ✗ | ✓ `GLOBAL` |
| Kelola Profil Dusun | ✗ | ✓ `OWN_DUSUN` | ✓ `GLOBAL` |
| Kelola Kontak Pelayanan | ✗ | ✓ `OWN_DUSUN` | ✓ `GLOBAL` |
| Kelola UMKM | ✗ | ✓ `OWN_DUSUN` | ✓ `GLOBAL` |
| Kelola Fasilitas | ✗ | ✓ `OWN_DUSUN` | ✓ `GLOBAL` |
| Kelola Kategori Fasilitas | ✗ | Gunakan kategori tersedia; tidak mengelola | ✓ `GLOBAL` |
| Kelola Agenda/Kegiatan Dusun | ✗ | ✓ `OWN_DUSUN` | ✓ `GLOBAL` |
| Kelola Agenda/Kegiatan Desa | ✗ | ✗ | ✓ `GLOBAL` |
| Kelola Pengumuman Dusun | ✗ | ✓ `OWN_DUSUN` | ✓ `GLOBAL` |
| Kelola Pengumuman Desa | ✗ | ✗ | ✓ `GLOBAL` |
| Kelola lokasi/Peta | Lihat data public | ✓ melalui parent resource `OWN_DUSUN` | ✓ melalui parent resource `GLOBAL` |
| Kelola Admin Dusun | ✗ | ✗ | ✓ `GLOBAL` |
| Reset password Admin Dusun | ✗ | ✗ | ✓ `RESET_PASSWORD` |
| Ubah status entitas Dusun ACTIVE/INACTIVE | ✗ | ✗ | ✓ `GLOBAL` |
| Soft Delete data operasional | ✗ | ✓ `OWN_DUSUN` | ✓ `GLOBAL` |
| Restore data Soft Deleted | ✗ | ✗ | ✓ `GLOBAL` |
| Hard delete data selain Dusun | ✗ | ✗ | ✓ `GLOBAL` |
| Hard delete entitas Dusun | ✗ | ✗ | ✗ |

# 6. Resource Permission Matrix

Matrix ini mencakup **14 resource konseptual**. Singkatan actor: `PUB` = Public User, `AD` = Admin Dusun, `SA` = Super Admin.

| Resource | VIEW / VIEW_PUBLIC | CREATE | UPDATE | ACTIVATE / DEACTIVATE | SOFT_DELETE | RESTORE | HARD_DELETE |
| --- | --- | --- | --- | --- | --- | --- | --- |
| Desa / Identitas Desa | `PUB` public; `SA` GLOBAL | — | `SA` GLOBAL | — | — | — | — |
| Dusun | `PUB` ACTIVE; `AD` OWN; `SA` GLOBAL | ✗ MVP | `SA` GLOBAL | `SA` GLOBAL | — | — Bukan Soft Delete; pengaktifan kembali menggunakan `ACTIVATE` | ✗ semua role |
| Profil Dusun | `PUB` ACTIVE; `AD` OWN; `SA` GLOBAL | — | `AD` OWN; `SA` GLOBAL | — | — | — | — sebagai operasi independen; hard delete entitas Dusun dilarang |
| Kontak Pelayanan | `PUB` public; `AD` OWN; `SA` GLOBAL | `AD` OWN; `SA` GLOBAL | `AD` OWN; `SA` GLOBAL | — Nonaktif dikelola melalui `SOFT_DELETE`; pemulihan melalui `RESTORE` oleh `SA` | `AD` OWN; `SA` GLOBAL | `SA` GLOBAL | `SA` GLOBAL |
| UMKM | `PUB` public; `AD` OWN; `SA` GLOBAL | `AD` OWN; `SA` GLOBAL | `AD` OWN; `SA` GLOBAL | — Nonaktif dikelola melalui `SOFT_DELETE`; pemulihan melalui `RESTORE` oleh `SA` | `AD` OWN; `SA` GLOBAL | `SA` GLOBAL | `SA` GLOBAL |
| Produk UMKM | `PUB` melalui UMKM; `AD` OWN; `SA` GLOBAL | Mengikuti parent UMKM | Mengikuti parent UMKM | — | — sebagai operasi independen | — mengikuti parent | — mengikuti parent; tidak dibuat permission produk independen |
| Fasilitas | `PUB` public; `AD` OWN; `SA` GLOBAL | `AD` OWN; `SA` GLOBAL | `AD` OWN; `SA` GLOBAL | — Nonaktif dikelola melalui `SOFT_DELETE`; pemulihan melalui `RESTORE` oleh `SA` | `AD` OWN; `SA` GLOBAL | `SA` GLOBAL | `SA` GLOBAL |
| Kategori Fasilitas | `PUB` melalui Fasilitas; `AD` VIEW kategori tersedia; `SA` GLOBAL | `SA` GLOBAL | `SA` GLOBAL | — tidak ditetapkan khusus | — tidak ditetapkan khusus | — tidak ditetapkan khusus | `SA` GLOBAL berdasarkan aturan umum data selain Dusun; tanpa cascade semantics |
| Agenda & Kegiatan | `PUB` public; `AD` OWN Dusun; `SA` GLOBAL | `AD` OWN Dusun; `SA` GLOBAL | `AD` OWN Dusun; `SA` GLOBAL | — Lifecycle/status dikelola sebagai bagian `UPDATE` item; manual override mengikuti `FR-015` | `AD` OWN Dusun; `SA` GLOBAL | `SA` GLOBAL | `SA` GLOBAL |
| Pengumuman | `PUB` active/archive; `AD` OWN Dusun; `SA` GLOBAL | `AD` OWN Dusun; `SA` GLOBAL | `AD` OWN Dusun; `SA` GLOBAL | — Active/archive ditentukan oleh expiry; bukan permission `ACTIVATE`/`DEACTIVATE` | `AD` OWN Dusun; `SA` GLOBAL | `SA` GLOBAL | `SA` GLOBAL |
| Arsip Pengumuman | `PUB` public; `AD` OWN; `SA` GLOBAL | — derived dari expiry | — melalui parent Pengumuman | — derived dari expiry | ✗ sebagai arsip | ✗ sebagai arsip | ✗ sebagai arsip; operasi pada record mengikuti Pengumuman |
| Lokasi / Koordinat | `PUB` lokasi authorized; `AD` OWN; `SA` GLOBAL | Mengikuti parent resource | `AD` OWN; `SA` GLOBAL melalui parent | — | — independen | — independen | — independen; mengikuti parent |
| Media | `PUB` media public; `AD` OWN; `SA` GLOBAL | Mengikuti parent resource | Mengikuti parent resource | — | Mengikuti parent bila applicable | `SA` melalui parent bila applicable | Mengikuti parent; tidak ada resource admin media independen |
| Admin Dusun Account | ✗ `PUB`; tidak dikelola `AD`; `SA` GLOBAL | `SA` GLOBAL | `SA` `MANAGE`/`ASSIGN_DUSUN` | — tidak ditetapkan | — | — | Penghapusan akun oleh `SA` didukung; persistence semantics tidak ditentukan |

Catatan matrix:

- Hard delete umum hanya dapat dilakukan Super Admin terhadap data selain entitas Dusun (`SEC-009`).
- Matrix tidak menciptakan cascade deletion, storage behavior, atau entity model.
- Produk UMKM, Lokasi/Koordinat, dan Media mengikuti parent resource dan tidak menjadi resource bisnis/admin independen.
- Penghapusan akun Admin Dusun adalah kemampuan `ROLE-009`; dokumen tidak mengklasifikasikan implementasinya sebagai soft/hard delete.

# 7. Public User Permissions

Public User boleh melihat website public, Homepage, Dusun `ACTIVE`, Kontak Pelayanan, UMKM, Fasilitas, Agenda/Kegiatan, Pengumuman aktif, Arsip Pengumuman, Peta, filter, marker, dan detail yang public. Public User juga boleh melakukan handoff ke WhatsApp dan Google Maps dari aksi yang didukung.

Public User tidak boleh login sebagai warga, mempunyai akun Public User, melakukan write/admin action, mengakses dashboard/data internal, atau melihat data Soft Deleted.

# 8. Admin Dusun Permissions

Admin Dusun mempunyai scope **OWN_DUSUN ONLY**.

Admin Dusun dapat login, melihat Dashboard Dusunnya, melihat/memperbarui Profil Dusun, melakukan `CREATE`/`VIEW`/`UPDATE` terhadap Kontak Pelayanan, UMKM, Fasilitas, Agenda/Kegiatan, dan Pengumuman Dusunnya, mengelola lokasi melalui parent resource, serta melakukan `SOFT_DELETE` / Nonaktif pada data operasional Dusunnya. Perubahan langsung berlaku tanpa approval Super Admin.

Admin Dusun tidak dapat mengakses Dusun lain, mengelola data tingkat Desa, mengubah status entitas Dusun, menambah Dusun, mengelola akun Admin, mereset password Admin lain, melakukan `RESTORE`, melakukan `HARD_DELETE`, atau mengatur manual ordering.

# 9. Admin Dusun — Dusun Inactive

Jika entitas Dusun berstatus `INACTIVE`, Admin Dusun tetap dapat login, melihat Dashboard Dusunnya, dan mengelola data dalam scope `OWN_DUSUN`. Admin Dusun tetap tidak dapat mengaktifkan kembali Dusun; hanya Super Admin yang dapat mengubah status entitas Dusun.

# 10. Super Admin Permissions

Super Admin mempunyai scope **GLOBAL** dan full management atas Identitas Desa, seluruh Dusun/Profil Dusun, Kontak Pelayanan, UMKM, Fasilitas, Kategori Fasilitas, Agenda/Kegiatan Desa dan Dusun, Pengumuman Desa dan Dusun, data lokasi/Peta melalui parent resource, serta akun Admin Dusun.

Super Admin dapat menggunakan `VIEW`, `CREATE`, `UPDATE`, `ACTIVATE`, `DEACTIVATE`, `SOFT_DELETE`, dan `RESTORE` sesuai applicability resource.

`HARD_DELETE` hanya dapat dilakukan Super Admin terhadap data selain entitas Dusun. Entitas Dusun dapat di-rename/update dan diubah status `ACTIVE`/`INACTIVE`, tetapi tidak dapat di-hard-delete melalui UI. `CREATE` Dusun baru adalah `FUTURE` dan bukan permission aktif MVP.

# 11. Admin Account Permissions

Super Admin dapat `CREATE`, `MANAGE`, menghapus, `ASSIGN_DUSUN`, dan `RESET_PASSWORD` akun Admin Dusun. Satu Dusun dapat mempunyai lebih dari satu Admin Dusun.

Admin Dusun tidak dapat membuat Admin, mengelola Admin lain, atau mereset password sendiri melalui self-service. Recovery akun Super Admin sendiri tetap `OPEN-010 — NON-BLOCKING`; tidak ada permission atau flow recovery baru.

# 12. Delete Semantics

## 12.1 Soft Delete / Nonaktif

- Data tidak tampil pada website public.
- Data tetap tersimpan.
- Admin Dusun dapat melakukan Soft Delete pada data operasional `OWN_DUSUN`.
- Super Admin dapat melakukan Soft Delete dan `RESTORE` dalam scope `GLOBAL`.
- Dokumen tidak menentukan tab, filter, atau internal dashboard visibility untuk record Soft Deleted.

## 12.2 Arsip Pengumuman

- Bukan delete dan berasal dari expiry/tanggal kedaluwarsa.
- Tetap public sebagai child PAGE Arsip Pengumuman.
- Tidak menjadi generic archive untuk data Soft Deleted.

## 12.3 Hard Delete

- Bersifat permanen.
- Hanya Super Admin dan hanya untuk data selain entitas Dusun.
- Tidak tersedia untuk entitas Dusun melalui UI.

# 13. Pengumuman Permissions

## 13.1 Pengumuman Dusun

- Admin Dusun dapat mengelola Pengumuman hanya dalam scope `OWN_DUSUN`.
- Super Admin dapat mengelola Pengumuman seluruh Dusun dalam scope `GLOBAL`.

## 13.2 Pengumuman Desa

- Admin Dusun tidak dapat mengelola Pengumuman tingkat Desa.
- Super Admin dapat mengelola Pengumuman tingkat Desa.

## 13.3 Arsip Pengumuman

Arsip Pengumuman bukan permission delete. Expiry mengubah visibility Pengumuman dari daftar aktif ke Arsip Pengumuman yang tetap public. Pengumuman yang di-Soft Delete tidak masuk ke Arsip Pengumuman public.

# 14. Agenda & Kegiatan Permissions

## 14.1 Agenda/Kegiatan Dusun

- Admin Dusun dapat mengelola Agenda/Kegiatan dalam scope `OWN_DUSUN`.
- Super Admin dapat mengelola Agenda/Kegiatan seluruh Dusun dalam scope `GLOBAL`.

## 14.2 Agenda/Kegiatan Desa

- Admin Dusun tidak dapat mengelola Agenda/Kegiatan tingkat Desa.
- Super Admin dapat mengelola Agenda/Kegiatan tingkat Desa.

Admin yang mempunyai hak pengelolaan atas item terkait dapat melakukan manual status override pada lifecycle `Akan Datang`, `Berlangsung`, dan `Selesai`. Ini bukan approval role atau approval gate baru.

# 15. Facility Category Permissions

- Public User hanya melihat hasil kategorisasi pada Fasilitas public bila relevan.
- Admin Dusun dapat menggunakan kategori yang tersedia, tetapi tidak dapat `CREATE` atau `UPDATE` Kategori Fasilitas.
- Super Admin dapat `CREATE` dan `UPDATE` Kategori Fasilitas dalam scope `GLOBAL`.
- Aturan umum `SEC-009` membatasi hard delete data selain Dusun kepada Super Admin. Dokumen ini tidak menentukan cascade deletion atau dampak relasional penghapusan kategori.

Interpretasi ini tidak memerlukan `PERMISSION OPEN QUESTION` karena kewenangan hard delete umum telah ditetapkan oleh baseline, sedangkan detail implementasi dan dampak relasional sengaja tidak diputuskan di dokumen ini.

# 16. Map / Location Permissions

Peta bukan resource bisnis atau sumber data independen. Permission Lokasi/Koordinat selalu mengikuti parent resource:

- Fasilitas: koordinat merupakan bagian dari Fasilitas.
- UMKM: koordinat opsional merupakan bagian dari UMKM.
- Titik pelayanan yang diizinkan: lokasi terkait Kontak Pelayanan atau konteks pelayanan.

Admin Dusun dapat mengelola lokasi parent resource dalam scope `OWN_DUSUN`. Super Admin dapat mengelolanya dalam scope `GLOBAL`. Public User hanya dapat melihat lokasi yang public, aktif, dan telah diizinkan untuk dipublikasikan.

Admin yang berwenang dapat menentukan koordinat melalui klik pada Peta atau input latitude/longitude. Dokumen ini tidak membuat `map_points` CRUD generik dan tidak menentukan lokasi editor, form, modal, drawer, API, atau penyimpanan.

# 17. Privacy Boundary

Consent bukan role permission digital. Sebelum memasukkan nomor personal, foto personal, rumah pribadi, atau lokasi privat melalui `CREATE`/`UPDATE`, admin bertanggung jawab memastikan izin publikasi sudah diperoleh secara administratif/offline. Jika izin belum diperoleh, data privat tersebut tidak dimasukkan ke sistem.

MVP tidak memiliki permission `APPROVE_CONSENT`, `REQUEST_CONSENT`, atau `UPLOAD_CONSENT`, dan tidak mempunyai consent checkbox, approval flow, proof upload, maupun consent request page.

# 18. Media Permissions

Media mengikuti permission dan scope parent resource:

- Foto UMKM mengikuti UMKM.
- Foto Fasilitas mengikuti Fasilitas.
- Poster atau dokumentasi kegiatan mengikuti Agenda/Kegiatan.
- Media lain yang didukung mengikuti resource tempat media tersebut digunakan.

Tidak ada role Media Administrator atau area pengelolaan Media independen. Storage architecture tidak ditentukan.

# 19. Direct Publishing

`CREATE` atau `UPDATE` oleh Admin Dusun pada data `OWN_DUSUN` langsung berlaku sesuai visibility/status resource tanpa persetujuan Super Admin. MVP tidak mempunyai permission `APPROVE_CONTENT`.

Super Admin tetap dapat mengelola data karena scope `GLOBAL`, tetapi bukan approval gate untuk publikasi Admin Dusun.

# 20. Prohibited Actions Matrix

| Role | Aksi yang eksplisit dilarang pada MVP |
| --- | --- |
| Public User | Semua write/admin actions; login sebagai warga; akses dashboard atau data internal; melihat data Soft Deleted |
| Admin Dusun | Mengakses Dusun lain; mengelola data tingkat Desa; membuat/mengelola akun Admin; reset password Admin lain; mengubah status entitas Dusun; menambah Dusun; `RESTORE`; `HARD_DELETE`; manual ordering |
| Super Admin | `HARD_DELETE` entitas Dusun; `CREATE` Dusun baru sebagai permission aktif MVP |

Larangan ini merupakan guardrail terhadap privilege creep pada tahap desain dan implementasi berikutnya.

# 21. Resource Ownership / Context Rules

1. Setiap akun Admin Dusun terikat pada tepat satu konteks Dusun; satu Dusun dapat mempunyai lebih dari satu Admin Dusun.
2. Data Dusun mempunyai konteks Dusun dan hanya dapat dikelola Admin Dusun yang terikat pada konteks tersebut atau Super Admin.
3. Data tingkat Desa mempunyai konteks Desa dan hanya dikelola Super Admin.
4. Super Admin tidak dibatasi per Dusun dan menggunakan scope `GLOBAL`.
5. Public visibility tidak sama dengan ownership dan tidak memberikan write permission.
6. Status `INACTIVE` entitas Dusun mengubah public visibility, tetapi tidak memindahkan ownership dan tidak mencabut akses Admin Dusun ke dashboard.
7. Lokasi/Koordinat dan Media mewarisi ownership serta scope parent resource.

Aturan ini konseptual dan tidak menetapkan foreign key, tabel, schema, atau model penyimpanan.

# 22. Authorization Invariants

ID berikut menormalisasi source FROZEN untuk kebutuhan authorization; ID ini bukan requirement produk baru.

| ID | Invariant |
| --- | --- |
| AUTH-INV-001 | Admin Dusun tidak pernah dapat mengelola resource milik Dusun lain. |
| AUTH-INV-002 | Public User tidak pernah mempunyai write permission, akun, atau akses dashboard. |
| AUTH-INV-003 | Hanya Super Admin dapat melakukan `RESTORE`. |
| AUTH-INV-004 | `HARD_DELETE` entitas Dusun tidak tersedia. |
| AUTH-INV-005 | `HARD_DELETE` data selain entitas Dusun hanya dapat dilakukan Super Admin. |
| AUTH-INV-006 | Admin Dusun tetap dapat login dan mengakses dashboard ketika Dusunnya `INACTIVE`. |
| AUTH-INV-007 | Data Soft Deleted tidak pernah tampil pada website public. |
| AUTH-INV-008 | Arsip Pengumuman tetap public dan bukan Soft Delete. |
| AUTH-INV-009 | Homepage data-driven tidak menciptakan permission page builder. |
| AUTH-INV-010 | Permission Lokasi/Koordinat dan Media selalu mengikuti parent resource. |
| AUTH-INV-011 | Data tingkat Desa, Kategori Fasilitas, dan status entitas Dusun hanya dikelola Super Admin. |
| AUTH-INV-012 | Publikasi perubahan Admin Dusun tidak memerlukan approval Super Admin. |

# 23. Role × User Flow Traceability

Seluruh **25 User Flow** FROZEN terpetakan berikut ini.

| Flow ID | Actor | Required Permission / Scope |
| --- | --- | --- |
| UF-PUB-001 | Public User | `VIEW_PUBLIC`; Homepage, pilihan Dusun `ACTIVE`, dan Halaman Dusun |
| UF-PUB-002 | Public User | `VIEW_PUBLIC`; informasi tingkat Desa pada Homepage |
| UF-PUB-003 | Public User | `VIEW_PUBLIC`; section dalam Halaman Dusun `ACTIVE` |
| UF-PUB-004 | Public User | `VIEW_PUBLIC`; Peta/filter/marker/detail dan handoff Google Maps |
| UF-PUB-005 | Public User | `VIEW_PUBLIC`; Kontak Pelayanan dan handoff WhatsApp |
| UF-PUB-006 | Public User | `VIEW_PUBLIC`; UMKM/detail, WhatsApp, dan konteks lokasi bila tersedia |
| UF-PUB-007 | Public User | `VIEW_PUBLIC`; Fasilitas/detail, WhatsApp bila tersedia, dan arah eksternal |
| UF-PUB-008 | Public User | `VIEW_PUBLIC`; Agenda/Kegiatan dan detail public |
| UF-PUB-009 | Public User | `VIEW_PUBLIC`; Pengumuman aktif, Arsip Pengumuman, dan Detail Pengumuman |
| UF-PUB-010 | Public User | `VIEW_PUBLIC`; empty state tanpa write action |
| UF-AD-001 | Admin Dusun | Login admin; role Admin Dusun; scope `OWN_DUSUN` |
| UF-AD-002 | Admin Dusun | `CREATE`/`VIEW` dalam `OWN_DUSUN`; direct publish tanpa approval |
| UF-AD-003 | Admin Dusun | `VIEW`/`UPDATE` dalam `OWN_DUSUN`; direct publish tanpa approval |
| UF-AD-004 | Admin Dusun | `SOFT_DELETE` dalam `OWN_DUSUN`; tanpa `RESTORE`/`HARD_DELETE` |
| UF-AD-005 | Admin Dusun | `VIEW`/`UPDATE` Profil Dusun dalam `OWN_DUSUN` |
| UF-AD-006 | Admin Dusun | Login, `VIEW`, dan management `OWN_DUSUN` tetap berlaku saat Dusun `INACTIVE` |
| UF-SA-001 | Super Admin | Login admin; role Super Admin; scope `GLOBAL` |
| UF-SA-002 | Super Admin | `MANAGE` data lintas Dusun dalam scope `GLOBAL` |
| UF-SA-003 | Super Admin | `VIEW` data Soft Deleted dan `RESTORE` dalam scope `GLOBAL` |
| UF-SA-004 | Super Admin | `HARD_DELETE` data selain entitas Dusun dalam scope `GLOBAL` |
| UF-SA-005 | Super Admin | `VIEW`/`UPDATE`/`DEACTIVATE` entitas Dusun dalam scope `GLOBAL` |
| UF-SA-006 | Super Admin | `VIEW`/`UPDATE`/`ACTIVATE` entitas Dusun dalam scope `GLOBAL` |
| UF-SA-007 | Super Admin | `CREATE`/`MANAGE`/hapus akun dan `ASSIGN_DUSUN` |
| UF-SA-008 | Super Admin | `VIEW`/`MANAGE` akun dan `RESET_PASSWORD` Admin Dusun |
| UF-SA-009 | Super Admin | `UPDATE` Identitas Desa dan `MANAGE` sumber data Homepage; tanpa page builder |

# 24. Role × Sitemap Traceability

Tabel ini merangkum access pada node Sitemap v1.0 dan tidak menciptakan PAGE atau DETAIL baru.

| Sitemap Area | Public User | Admin Dusun | Super Admin |
| --- | --- | --- | --- |
| Homepage Desa Bendung dan section public | `VIEW_PUBLIC` | `VIEW_PUBLIC` | `VIEW_PUBLIC` |
| Halaman Dusun `ACTIVE` dan section public | `VIEW_PUBLIC` | `VIEW_PUBLIC` | `VIEW_PUBLIC` |
| Public Detail Views | `VIEW_PUBLIC` | `VIEW_PUBLIC` | `VIEW_PUBLIC` |
| Arsip Pengumuman public | `VIEW_PUBLIC` | `VIEW_PUBLIC` | `VIEW_PUBLIC` |
| Peta Desa / Peta Dusun public | `VIEW_PUBLIC` | `VIEW_PUBLIC` | `VIEW_PUBLIC` |
| Login Admin | ✗ sebagai warga | ✓ | ✓ |
| Dashboard Dusun | ✗ | `VIEW` `OWN_DUSUN` | ✗ sebagai role Admin Dusun |
| Kelola Profil Dusun | ✗ | `VIEW`/`UPDATE` `OWN_DUSUN` | `MANAGE` `GLOBAL` |
| Kelola Kontak Pelayanan | ✗ | `MANAGE` `OWN_DUSUN`, tanpa restore/hard delete | `MANAGE` `GLOBAL` |
| Kelola UMKM | ✗ | `MANAGE` `OWN_DUSUN`, tanpa restore/hard delete | `MANAGE` `GLOBAL` |
| Kelola Fasilitas | ✗ | `MANAGE` `OWN_DUSUN`, tanpa restore/hard delete | `MANAGE` `GLOBAL` |
| Kelola Agenda & Kegiatan | ✗ | Dusun sendiri | Desa dan seluruh Dusun |
| Kelola Pengumuman | ✗ | Dusun sendiri | Desa dan seluruh Dusun |
| Super Admin Dashboard | ✗ | ✗ | `VIEW`/`MANAGE` `GLOBAL` |
| Kelola Identitas / Profil Desa | ✗ | ✗ | `VIEW`/`UPDATE` `GLOBAL` |
| Kelola Dusun | ✗ | ✗ | `VIEW`/`UPDATE`/`ACTIVATE`/`DEACTIVATE`; tanpa `CREATE` MVP atau `HARD_DELETE` |
| Kelola Kategori Fasilitas | ✗ | menggunakan kategori tersedia | `CREATE`/`UPDATE` `GLOBAL` |
| Kelola Data / Peta | menggunakan Peta public | lokasi parent resource `OWN_DUSUN` | konteks map-centric dan parent resource `GLOBAL` |
| Kelola Admin Dusun | ✗ | ✗ | `CREATE`/`MANAGE`/hapus/`ASSIGN_DUSUN`/`RESET_PASSWORD` |

Istilah `MANAGE` pada tabel ini selalu dibatasi oleh scope role, applicability resource, Prohibited Actions Matrix, Resource Permission Matrix, dan Delete Semantics. `MANAGE` tidak mengesampingkan larangan yang telah ditetapkan.

# 25. Requirement Traceability

| Permission Area | Baseline Requirement IDs | PRD / User Flow Reference |
| --- | --- | --- |
| Public read-only dan tanpa akun | `ROLE-001`, `FR-001` | PRD §10, §23; `UF-PUB-001`–`UF-PUB-010` |
| Multi-admin dan scope Admin Dusun | `ROLE-002`–`ROLE-004`, `SEC-003` | PRD §20, §23; `UF-AD-001`–`UF-AD-006` |
| Larangan kelola akun oleh Admin Dusun | `ROLE-005` | PRD §20, §23; `UF-AD-001` |
| Soft Delete Admin Dusun dan tanpa hard delete | `ROLE-006`, `SEC-009` | PRD §20, §26; `UF-AD-004` |
| Tanpa manual ordering | `ROLE-007` | PRD §20; seluruh management flow |
| Direct publishing | `FR-019` | PRD §20; `UF-AD-002`, `UF-AD-003`, `UF-AD-005` |
| Super Admin full management GLOBAL | `ROLE-008`, `SEC-009` | PRD §21, §26; `UF-SA-002`–`UF-SA-004`, `UF-SA-009` |
| Akun dan reset password Admin Dusun | `ROLE-009`, `SEC-008` | PRD §21, §23; `UF-SA-007`, `UF-SA-008` |
| Status dan lifecycle Dusun | `ROLE-010`, `FR-022`, `SEC-007` | PRD §21–§22; `UF-AD-006`, `UF-SA-005`, `UF-SA-006` |
| Kategori Fasilitas dan data tingkat Desa | `ROLE-011`, `DATA-013` | PRD §21; `UF-SA-002`, `UF-SA-009` |
| Homepage data-driven authorization | `ROLE-008` | PRD §11, §21; `UF-SA-009` |
| Pengumuman aktif dan Arsip public | `FR-018`, `DATA-016` | PRD §17; `UF-PUB-009` |
| Agenda/Kegiatan Desa dan Dusun | `FR-014`, `FR-015`, `FR-016`, `DATA-014`, `DATA-015`, `DATA-017`, `MEDIA-007` | PRD §16, §20–§21; `UF-PUB-008`, `UF-AD-002`–`UF-AD-003`, `UF-SA-002` |
| Peta, marker, lokasi, dan external navigation | `MAP-001`–`MAP-009`, `MAP-010` | PRD §18; `UF-PUB-004`, `UF-PUB-006`, `UF-PUB-007`, `UF-AD-002`–`UF-AD-003`, `UF-SA-002` |
| Privacy sebagai precondition offline | `PRIV-001` | PRD §25; conditional privacy pada User Flows |

# 26. Open Non-Blocking and Change Request Summary

Seluruh keputusan OPEN dari source FROZEN tetap `OPEN — NON-BLOCKING`. Dokumen ini tidak menjawab atau menutupnya. Yang langsung relevan dengan authorization adalah:

| Open ID | Dampak pada permission MVP |
| --- | --- |
| `OPEN-010` | Recovery akun Super Admin belum ditetapkan; tidak dibuat permission atau flow recovery. |

OPEN operasional lain tidak mengubah role, scope, atau permission matrix MVP.

- **PERMISSION OPEN QUESTION:** 0
- **UX CHANGE REQUEST:** 0
- **PRD CHANGE REQUEST:** 0
- **BASELINE CHANGE REQUEST:** 0

# 27. Future Permissions

Semua item berikut tidak mempunyai permission aktif pada MVP:

| Requirement ID | Future capability | Permission status |
| --- | --- | --- |
| `DATA-004` | Penambahan Dusun baru | `FUTURE`; `CREATE_DUSUN` tidak aktif pada MVP |
| `FR-020` | QR khusus per Dusun | `FUTURE`; tidak mengubah permission MVP |
| `MEDIA-004` | Galeri multi-foto UMKM | `FUTURE`; tidak mengubah permission MVP |
| `MAP-011` | Pencarian lokasi | `FUTURE`; tidak mengubah permission MVP |
| `MAP-012` | Batas wilayah Dusun | `FUTURE`; tidak mengubah permission MVP |
| `OPS-002` | Papan QR kecil per Dusun | `FUTURE`; tidak mengubah permission MVP |

# 28. Roles & Permissions Review Checklist

- [x] Hanya tiga role digunakan.
- [x] Public tidak mempunyai write access.
- [x] Admin Dusun scoped ke satu Dusun.
- [x] Admin Dusun tidak dapat mengakses Dusun lain.
- [x] Admin Dusun tidak mengelola data tingkat Desa.
- [x] Admin Dusun tidak mengelola akun Admin.
- [x] Admin Dusun tidak restore.
- [x] Admin Dusun tidak hard delete.
- [x] Admin Dusun tidak mengubah status Dusun.
- [x] Admin Dusun tetap dapat login saat Dusun inactive.
- [x] Super Admin global.
- [x] Super Admin full management sesuai baseline.
- [x] Super Admin dapat restore.
- [x] Hard delete hanya Super Admin dan bukan Dusun.
- [x] Tidak ada hard delete Dusun.
- [x] Penambahan Dusun tetap FUTURE.
- [x] Kategori Fasilitas hanya dikelola Super Admin.
- [x] Agenda Desa hanya Super Admin.
- [x] Pengumuman Desa hanya Super Admin.
- [x] Arsip Pengumuman bukan Soft Delete.
- [x] Direct publish tanpa approval.
- [x] Tidak ada manual ordering.
- [x] Location mengikuti parent resource.
- [x] Media mengikuti parent resource.
- [x] Consent tetap offline.
- [x] Tidak ada role/permission baru tanpa source.
- [x] Tidak ada database/API/framework decision.
- [x] Semua 25 User Flow ter-cover.
- [x] Traceability tersedia.
- [x] Roles & Permissions telah melalui human review.
- [x] PRD section traceability telah diverifikasi terhadap PRD v1.0.
- [x] Agenda/Kegiatan tidak menggunakan DATA-013.
- [x] Agenda/Pengumuman lifecycle tidak disalahartikan sebagai ACTIVATE/DEACTIVATE permission.
- [x] Roles & Permissions ditetapkan Version 1.0 — FROZEN FOR MVP.

# 29. Final Validation

Validasi editorial, terminology, dan traceability menghasilkan:

- Version `1.0` dan status `FROZEN FOR MVP` telah ditetapkan setelah human review.
- Source FROZEN tidak diubah.
- Tiga role tetap digunakan tanpa privilege baru.
- Public User read-only; Admin Dusun `OWN_DUSUN`; Super Admin `GLOBAL`.
- Delete semantics, lifecycle Dusun, direct publishing, Arsip Pengumuman, privacy offline, serta parent-resource scope untuk lokasi/media konsisten.
- Lifecycle Agenda dan expiry Pengumuman tidak digunakan sebagai permission `ACTIVATE`/`DEACTIVATE`.
- Referensi PRD telah dikoreksi dan `DATA-013` hanya digunakan untuk Kategori Fasilitas.
- Seluruh 25 User Flow terpetakan.
- Tidak ada ERD, schema, API, technology, atau implementation decision.
- Tidak ada feature baru, permission open question, maupun change request.
- Roles & Permissions siap menjadi source authorization konseptual untuk ERD / Data Model.
