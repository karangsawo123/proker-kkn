# 1. Document Information

| Field | Value |
| --- | --- |
| Project | Portal Informasi Desa Bendung |
| Document | Sitemap / Information Architecture |
| Version | 1.0 |
| Status | FROZEN FOR MVP |
| Product Source | PRD v1.0 — FROZEN FOR MVP |
| Requirement Source | Requirements Baseline v1.0 — FROZEN FOR MVP |

Sitemap v1.0 telah melalui human review. Tidak ditemukan Baseline Change Request maupun PRD Change Request. Jika pada masa berikutnya perubahan IA membutuhkan perubahan kemampuan produk, perubahan tersebut harus terlebih dahulu mengikuti Change Request terhadap PRD dan/atau Requirements Baseline sesuai sumber yang terdampak.

# 2. Document Purpose

Dokumen ini menerjemahkan PRD v1.0 menjadi struktur informasi Portal Informasi Desa Bendung. Sitemap menjelaskan halaman, bagian di dalam halaman, detail view, hubungan parent-child, kondisi visibilitas, serta pemisahan akses publik dan administratif.

Sitemap ini belum menentukan:

- desain atau layout UI;
- URL/path final;
- detailed user flow;
- database, schema, atau API;
- framework, provider, library, hosting, deployment, atau keputusan teknologi lain.

PRD v1.0 menjadi sumber utama struktur produk. Jika sitemap berbeda dengan requirement yang telah dibekukan, Requirements Baseline v1.0 dan PRD v1.0 tetap menjadi sumber yang lebih tinggi sesuai urutan kewenangannya. Perbedaan scope tidak boleh diselesaikan diam-diam melalui sitemap; perubahan kemampuan produk harus melalui Change Request terhadap PRD dan/atau Requirements Baseline terlebih dahulu.

# 3. Information Architecture Principles

1. **Mobile-first.** Struktur informasi memprioritaskan penggunaan dari smartphone setelah pengguna membuka portal melalui QR.
2. **Simple public access.** Informasi publik dapat diakses tanpa akun atau login warga.
3. **Homepage as primary entry point.** Homepage Desa Bendung menjadi titik masuk utama dari QR dan pintu menuju informasi Desa serta Dusun aktif.
4. **Data-driven homepage.** Pilihan Dusun, Peta Desa, Agenda/Kegiatan terbaru, dan Pengumuman terbaru berasal dari data aktif pada modul sumber, bukan page builder.
5. **Single-page Dusun.** Setiap Halaman Dusun menggunakan konsep single page/scroll; modul di dalamnya tetap berupa section, bukan halaman terpisah.
6. **Detail only when supported.** Detail view digunakan untuk item yang memang memerlukan rincian, tanpa memecah semua modul menjadi halaman baru.
7. **Limited page proliferation.** Struktur mempertahankan konteks informasi dan tidak membuat halaman tambahan tanpa kebutuhan produk.
8. **Role-based administration.** Dashboard dibedakan berdasarkan role; Admin Dusun hanya berada pada satu konteks Dusun, sedangkan Super Admin mempunyai konteks global.
9. **Empty state remains visible.** Section yang datanya kosong tetap tersedia dengan empty state sesuai requirement PRD.

Referensi: PRD Bagian 8, 10–12, 20–23; `FR-001`, `FR-004`–`FR-009`, `ROLE-001`–`ROLE-004`, `ROLE-008`, `NFR-001`.

# 4. Sitemap Legend

| Label | Meaning |
| --- | --- |
| `[PAGE]` | Halaman utama yang mempunyai konteks atau navigasi sendiri. |
| `[SECTION]` | Bagian di dalam suatu PAGE, bukan halaman terpisah. |
| `[DETAIL]` | Tampilan rincian untuk satu item tertentu. |
| `[CONDITIONAL]` | Hanya muncul atau dapat diakses pada kondisi tertentu. |
| `[ROLE: PUBLIC]` | Dapat diakses pengunjung umum tanpa login. |
| `[ROLE: ADMIN DUSUN]` | Hanya dapat diakses Admin Dusun dalam konteks Dusunnya. |
| `[ROLE: SUPER ADMIN]` | Hanya dapat diakses Super Admin dalam konteks global. |
| `[SHARED ADMIN]` | Digunakan kedua role admin, dengan isi dan akses yang dibatasi role. |

Label tidak menentukan URL, komponen, layout, modal, drawer, tab, atau pola presentasi UI final.

# 5. Top-Level Product Sitemap

```text
Portal Informasi Desa Bendung
├── A. Public Website [ROLE: PUBLIC]
│   ├── Homepage Desa Bendung [PAGE]
│   │   ├── Identitas Desa [SECTION]
│   │   ├── Pilihan Dusun Aktif [SECTION] [CONDITIONAL: hanya Dusun ACTIVE]
│   │   ├── Pengumuman Desa Terbaru [SECTION]
│   │   │   ├── Detail Pengumuman [DETAIL] [CONDITIONAL]
│   │   │   └── Arsip Pengumuman Desa [PAGE] [ROLE: PUBLIC] [child page; bukan navigasi utama]
│   │   ├── Agenda/Kegiatan Desa Terbaru [SECTION]
│   │   │   └── Detail Agenda/Kegiatan [DETAIL]
│   │   ├── Peta Desa [SECTION]
│   │   │   ├── Detail UMKM [DETAIL] [CONDITIONAL: marker/data terkait tersedia]
│   │   │   └── Detail Fasilitas/Lokasi [DETAIL] [CONDITIONAL: marker/data terkait tersedia]
│   │   └── Kontak Desa [SECTION]
│   └── Halaman Dusun [PAGE] [CONDITIONAL: Dusun ACTIVE]
│       ├── Header/Banner + Nama Dusun [SECTION]
│       ├── Navigasi Cepat [SECTION]
│       ├── Profil Dusun [SECTION]
│       ├── Kepala Dusun [SECTION]
│       ├── Kontak Pelayanan [SECTION]
│       ├── UMKM [SECTION]
│       │   └── Detail UMKM [DETAIL]
│       ├── Fasilitas [SECTION]
│       │   └── Detail Fasilitas/Lokasi [DETAIL]
│       ├── Agenda & Kegiatan [SECTION]
│       │   └── Detail Agenda/Kegiatan [DETAIL]
│       ├── Pengumuman [SECTION]
│       │   ├── Detail Pengumuman [DETAIL] [CONDITIONAL]
│       │   └── Arsip Pengumuman Dusun [PAGE] [ROLE: PUBLIC] [child page; bukan navigasi utama]
│       └── Peta Dusun [SECTION]
├── B. Admin / Authentication
│   └── Login Admin [PAGE] [SHARED ADMIN]
└── C. Administrative Dashboard
    ├── Dashboard Dusun [PAGE] [ROLE: ADMIN DUSUN]
    │   ├── Kelola Profil Dusun [PAGE]
    │   ├── Kelola Kontak Pelayanan [PAGE]
    │   ├── Kelola UMKM [PAGE]
    │   ├── Kelola Fasilitas [PAGE]
    │   ├── Kelola Agenda & Kegiatan [PAGE]
    │   └── Kelola Pengumuman [PAGE]
    └── Super Admin Dashboard [PAGE] [ROLE: SUPER ADMIN]
        ├── Kelola Identitas / Profil Desa [PAGE]
        ├── Kelola Dusun [PAGE]
        ├── Kelola Kontak Pelayanan [PAGE]
        ├── Kelola UMKM [PAGE]
        ├── Kelola Fasilitas [PAGE]
        ├── Kelola Kategori Fasilitas [PAGE]
        ├── Kelola Agenda & Kegiatan [PAGE]
        ├── Kelola Pengumuman [PAGE]
        ├── Kelola Data / Peta [PAGE] [map-centric; data berasal dari modul sumber]
        └── Kelola Admin Dusun [PAGE]
```

Tree menunjukkan tipe node dan hubungan konseptual, bukan URL, menu final, atau urutan interaksi pengguna.

# 6. Public Website Sitemap

## 6.1 Homepage Desa Bendung

**Klasifikasi:** `[PAGE] [ROLE: PUBLIC]`

Homepage adalah entry point utama portal dan satu-satunya top-level public page untuk konteks Desa. Isinya:

| Child Node | Type | Source / Visibility |
| --- | --- | --- |
| Identitas Desa | `[SECTION]` | Nama Desa, logo, banner/foto, profil singkat, alamat kantor, nomor kontak, email bila tersedia, Kepala Desa, dan jam pelayanan. |
| Pilihan Dusun | `[SECTION] [CONDITIONAL]` | Data-driven; hanya Dusun berstatus `ACTIVE` yang ditampilkan. |
| Pengumuman terbaru | `[SECTION]` | Data-driven dari Pengumuman Desa aktif. Empty state berlaku bila tidak ada data aktif. |
| Agenda/Kegiatan terbaru | `[SECTION]` | Data-driven dari Agenda/Kegiatan tingkat Desa. Empty state berlaku bila tidak ada data. |
| Peta Desa | `[SECTION]` | Data-driven dari lokasi aktif pada seluruh Dusun aktif. |
| Kontak Desa | `[SECTION]` | Menggunakan data kontak kantor Desa yang dikelola pada identitas Desa. |

Homepage tidak mempunyai page builder. Sitemap juga tidak menetapkan algoritma ordering, featured order, atau pengurutan manual.

## 6.2 Halaman Dusun

**Klasifikasi:** `[PAGE] [ROLE: PUBLIC] [CONDITIONAL: Dusun ACTIVE]`

Halaman Dusun adalah satu page dengan konsep single page/scroll. Keenam struktur Dusun menggunakan tipe page yang sama; sitemap tidak membuat enam jenis halaman yang berbeda.

Child section:

1. `[SECTION]` Header/banner + Nama Dusun.
2. `[SECTION]` Navigasi cepat.
3. `[SECTION]` Profil Dusun.
4. `[SECTION]` Kepala Dusun.
5. `[SECTION]` Kontak Pelayanan.
6. `[SECTION]` UMKM.
7. `[SECTION]` Fasilitas.
8. `[SECTION]` Agenda & Kegiatan.
9. `[SECTION]` Pengumuman.
10. `[SECTION]` Peta Dusun.

Aturan IA:

- section tetap berada di dalam Halaman Dusun dan tidak dipecah menjadi page terpisah;
- section tanpa data tetap ada dengan empty state sesuai requirement PRD;
- Peta Dusun menggunakan sumber data lokasi yang sama secara konseptual dengan Peta Desa dan otomatis terfilter pada Dusun terkait;
- Dusun `INACTIVE` tidak menampilkan konten publik normal dan tidak tersedia pada Pilihan Dusun;
- desain atau redaksi tampilan ketika alamat langsung menuju Dusun `INACTIVE` belum ditentukan pada sitemap.

## 6.3 Confirmed Top-Level Public Page Count

Jumlah tipe top-level `[PAGE]` publik pada MVP: **2**.

1. Homepage Desa Bendung.
2. Halaman Dusun.

Detail view tidak dihitung sebagai top-level public PAGE. Arsip Pengumuman adalah child `[PAGE]` di bawah konteks Pengumuman dan bukan top-level page atau item navigasi utama. Dengan demikian, jumlah seluruh tipe public `[PAGE]`, termasuk child page Arsip Pengumuman, adalah **3**.

# 7. Public Detail Views

Sitemap menetapkan empat tipe detail view. Seluruhnya menggunakan label berikut:

> **DETAIL VIEW — presentation pattern ditentukan pada UI/UX.**

Label tersebut berarti sitemap tidak memutuskan apakah detail ditampilkan sebagai halaman penuh, modal, drawer, atau pola UI lain.

## 7.1 Detail UMKM

**Klasifikasi:** `[DETAIL] [ROLE: PUBLIC]`

- **Parent/context:** Section UMKM pada Halaman Dusun atau marker UMKM pada Peta Desa/Peta Dusun.
- **Informasi utama:** nama UMKM, pemilik, jenis usaha, produk dalam list/tags, deskripsi, alamat, WhatsApp, jam operasional, satu foto utama bila tersedia, dan informasi lokasi bila koordinat tersedia.
- **Hubungan kembali:** kembali ke Section UMKM atau konteks Peta asal.
- **Boundary:** bukan katalog transaksi, pemesanan, pembayaran, atau galeri multi-foto.

## 7.2 Detail Agenda/Kegiatan

**Klasifikasi:** `[DETAIL] [ROLE: PUBLIC]`

- **Parent/context:** Agenda/Kegiatan terbaru pada Homepage atau Section Agenda & Kegiatan pada Halaman Dusun.
- **Informasi utama:** judul, deskripsi singkat, tanggal mulai, tanggal selesai bila ada, jam bila ada, lokasi, status lifecycle, poster/foto awal bila ada, dan dokumentasi bila tersedia.
- **Hubungan kembali:** kembali ke konteks Agenda/Kegiatan Desa atau Dusun asal.

## 7.3 Detail Fasilitas/Lokasi

**Klasifikasi:** `[DETAIL] [ROLE: PUBLIC] [CONDITIONAL: data terkait tersedia]`

- **Parent/context:** Section Fasilitas atau marker pada Peta Desa/Peta Dusun melalui aksi menuju informasi detail.
- **Informasi utama:** nama, kategori, deskripsi, alamat, foto/placeholder, koordinat/peta, serta nomor kontak dan tombol WhatsApp bila nomor tersedia.
- **Hubungan kembali:** kembali ke Section Fasilitas atau konteks Peta asal.
- **Boundary:** arah eksternal membuka Google Maps; portal tidak membuat routing internal.

### 7.3.1 Marker Pelayanan

Marker dapat berasal dari Kontak Pelayanan atau titik pelayanan masyarakat yang relevan dan telah memperoleh izin publikasi. Aksi detail pada marker tersebut mengarah secara konseptual ke informasi Kontak Pelayanan atau konteks pelayanan terkait pada Dusun asal.

Hubungan ini tidak membentuk tipe public `[DETAIL]` baru. Presentation pattern ditentukan pada tahap UI/UX; sitemap tidak menentukan URL, anchor, modal, drawer, atau pola tampilan final. Referensi: `MAP-003`, `MAP-006`, `MAP-010`, `PRIV-001`.

## 7.4 Detail Pengumuman

**Klasifikasi:** `[DETAIL] [ROLE: PUBLIC] [CONDITIONAL: isi lengkap memerlukan tampilan rincian]`

- **Parent/context:** Pengumuman terbaru atau Arsip Pengumuman pada konteks Desa/Dusun.
- **Informasi utama:** isi Pengumuman sesuai data yang tersedia, cakupan Desa/Dusun, serta status aktif atau arsip berdasarkan tanggal kedaluwarsa.
- **Hubungan kembali:** kembali ke daftar Pengumuman aktif atau Arsip Pengumuman pada konteks asal.
- **Boundary:** detail ini tidak mengubah Pengumuman kedaluwarsa menjadi data Soft Deleted.

Jumlah tipe public `[DETAIL]` yang didefinisikan: **4**.

# 8. Pengumuman and Public Archive IA

## 8.1 Active Announcement

- Pengumuman Desa aktif muncul pada Section Pengumuman terbaru di Homepage.
- Pengumuman Dusun aktif muncul pada Section Pengumuman di Halaman Dusun terkait.
- Jika tidak ada Pengumuman aktif, section tetap tersedia dengan empty state.

## 8.2 Public Announcement Archive Page

**Klasifikasi:** `[PAGE] [ROLE: PUBLIC]`

- Setelah tanggal kedaluwarsa, Pengumuman keluar dari daftar aktif dan tetap dapat dilihat publik dalam **Arsip Pengumuman**.
- Arsip Pengumuman adalah child page mandiri di bawah konteks Pengumuman Desa atau Pengumuman Dusun asal.
- Child page tidak menjadi item navigasi utama.
- Arsip Pengumuman dapat diakses dari konteks Pengumuman pada parent page. Bentuk akses dan exact CTA/link copy ditentukan pada tahap UI/UX.
- Satu tipe Arsip Pengumuman digunakan secara konseptual dengan scope Desa atau Dusun sesuai parent/context asal.
- Pengumuman dalam arsip dapat menggunakan Detail Pengumuman yang sama secara konseptual.
- Jika belum ada Pengumuman kedaluwarsa pada konteks terkait, empty state tetap berlaku.
- Arsip Pengumuman bukan tempat data operasional yang dinonaktifkan atau di-Soft Delete.

# 9. Peta Desa and Peta Dusun IA

## 9.1 Peta Desa

**Klasifikasi:** `[SECTION]` di dalam Homepage Desa Bendung.

- konteks seluruh Dusun `ACTIVE`;
- data/titik aktif dari sumber lokasi terkait;
- filter Dusun;
- filter kategori;
- marker;
- popup marker berisi nama, kategori, foto/placeholder, alamat, aksi menuju detail terkait, dan tombol arah;
- Detail UMKM atau Detail Fasilitas/Lokasi sesuai jenis data marker;
- untuk marker pelayanan yang diizinkan, aksi detail mengarah secara konseptual ke informasi Kontak Pelayanan atau konteks pelayanan terkait pada Dusun asal tanpa membuat tipe detail view baru;
- tombol arah membuka Google Maps sebagai tujuan navigasi eksternal.

## 9.2 Peta Dusun

**Klasifikasi:** `[SECTION]` di dalam Halaman Dusun.

- menggunakan sumber data lokasi yang sama secara konseptual dengan Peta Desa;
- otomatis terfilter pada Dusun `ACTIVE` yang sedang dibuka;
- mendukung kategori, marker, popup, detail, dan arah sesuai requirement;
- tidak menampilkan data/titik Dusun `INACTIVE` pada area publik.

Sitemap tidak menentukan provider peta, struktur penyimpanan lokasi, implementasi filter, atau komponen teknis terpisah. Portal tidak membuat route/navigation engine internal.

# 10. Authentication Sitemap

## 10.1 Login Admin

**Klasifikasi:** `[PAGE] [SHARED ADMIN]`

- digunakan oleh Admin Dusun dan Super Admin;
- menggunakan username dan password;
- akses setelah autentikasi mengikuti role dan scope yang telah ditetapkan;
- bukan halaman login warga.

Area authentication MVP tidak mencakup:

- registrasi publik;
- registrasi Admin Dusun mandiri;
- forgot password melalui email atau WhatsApp;
- self-service reset password Admin Dusun;
- halaman recovery Super Admin yang belum diputuskan.

Reset password Admin Dusun berada pada area Kelola Admin Dusun milik Super Admin. Mekanisme recovery akun Super Admin tetap `OPEN — NON-BLOCKING` (`OPEN-010`) dan tidak membentuk node sitemap baru.

# 11. Admin Dusun Sitemap

## 11.1 Dashboard Dusun

**Klasifikasi:** `[PAGE] [ROLE: ADMIN DUSUN]`

Admin Dusun langsung masuk ke dashboard dalam konteks satu Dusun yang terikat pada akunnya. Tidak ada selector atau navigasi untuk berpindah ke Dusun lain.

## 11.2 Management Areas

| Management Area | IA Structure | Supported Management Scope |
| --- | --- | --- |
| Kelola Profil Dusun | `[PAGE]` dengan context data satu Dusun | Lihat dan edit profil Dusun sendiri. |
| Kelola Kontak Pelayanan | `[PAGE]` dengan daftar dan item management view | List, create, edit, Nonaktif / Soft Delete pada Dusun sendiri. |
| Kelola UMKM | `[PAGE]` dengan daftar dan item management view | List, create, edit, Nonaktif / Soft Delete pada Dusun sendiri. |
| Kelola Fasilitas | `[PAGE]` dengan daftar dan item management view | List, create, edit, Nonaktif / Soft Delete pada Dusun sendiri. |
| Kelola Agenda & Kegiatan | `[PAGE]` dengan daftar dan item management view | List, create, edit, Nonaktif / Soft Delete pada Dusun sendiri. |
| Kelola Pengumuman | `[PAGE]` dengan daftar dan item management view | List, create, edit, Nonaktif / Soft Delete pada Dusun sendiri; Pengumuman kedaluwarsa tetap dibedakan sebagai Arsip Pengumuman. |

Create/edit item merupakan management view konseptual. Presentasinya sebagai page, modal, drawer, atau pola lain ditentukan pada tahap UI/UX; sitemap tidak menentukan workflow form.

## 11.3 Admin Dusun Boundaries

Admin Dusun:

- hanya mengakses dan mengelola data Dusunnya sendiri;
- tidak mempunyai selector untuk Dusun lain;
- tidak mengelola akun admin;
- tidak melakukan hard delete;
- tidak melakukan restore;
- tidak mengatur ordering manual;
- dapat melakukan Nonaktif / Soft Delete terhadap data operasional Dusunnya;
- tetap dapat login dan memperbarui data ketika entitas Dusunnya `INACTIVE`.

Jumlah area pengelolaan Admin Dusun: **6**.

# 12. Super Admin Sitemap

## 12.1 Super Admin Dashboard

**Klasifikasi:** `[PAGE] [ROLE: SUPER ADMIN]`

Super Admin mempunyai konteks global untuk seluruh enam Dusun dan data tingkat Desa. Area lintas Dusun dapat menggunakan konteks/filter Dusun secara konseptual, tetapi sitemap tidak menentukan desain selector atau pola navigasinya.

## 12.2 Management Areas

| Management Area | IA Structure | Supported Management Scope |
| --- | --- | --- |
| Identitas / Profil Desa | `[PAGE]` | Mengelola identitas Desa yang tampil pada Homepage. |
| Dusun | `[PAGE]` | Melihat Dusun, mengedit nama/profil, mengaktifkan, dan menonaktifkan. Tidak ada hard delete entitas Dusun. |
| Kontak Pelayanan | `[PAGE] [SHARED ADMIN]` | Mengelola data lintas seluruh Dusun; konteks Dusun tetap terlihat secara konseptual. |
| UMKM | `[PAGE] [SHARED ADMIN]` | Mengelola data lintas seluruh Dusun. |
| Fasilitas | `[PAGE] [SHARED ADMIN]` | Mengelola data lintas seluruh Dusun. |
| Kategori Fasilitas | `[PAGE]` | Menambah dan mengubah kategori fasilitas. |
| Agenda & Kegiatan | `[PAGE] [SHARED ADMIN]` | Mengelola data tingkat Desa dan lintas Dusun. |
| Pengumuman | `[PAGE] [SHARED ADMIN]` | Mengelola Pengumuman tingkat Desa dan lintas Dusun; Arsip Pengumuman tetap dibedakan dari Soft Delete. |
| Data / Peta | `[PAGE]` | Map-centric administrative view untuk melihat dan mengelola konteks Peta terhadap data lokasi yang berasal dari modul sumber, seperti Fasilitas, UMKM, dan titik pelayanan yang diizinkan. |
| Admin Dusun | `[PAGE]` | Membuat/menghapus akun Admin Dusun dan mereset password Admin Dusun. |

## 12.3 Management Operation Boundaries

Node **Data / Peta** bukan database titik peta independen, source data bisnis baru, generic map point storage, atau duplikasi data Fasilitas, UMKM, dan Kontak Pelayanan. Data lokasi tetap berasal dari modul sumber yang sudah ada; area ini menyediakan konteks administratif Peta atas data tersebut (`MAP-001`–`MAP-004`, `ROLE-008`).

Sitemap belum menentukan apakah pengelolaan lokasi dibuka dari area Peta, dari management area modul sumber, atau melalui presentation pattern UI tertentu. Keputusan tersebut ditetapkan pada User Flow, UI/UX, atau SRS bila diperlukan.

- Untuk entitas Dusun: edit nama/profil dan aktifkan/nonaktifkan; tidak ada hard delete melalui UI.
- Penambahan Dusun baru adalah `FUTURE` dan tidak menjadi fitur aktif pada sitemap MVP.
- Untuk data selain entitas Dusun: manage, aktifkan/nonaktifkan, Soft Delete, restore, dan hard delete permanen sesuai baseline.
- Sitemap tidak menentukan confirmation modal, mekanisme backup, audit log, atau implementasi operasi.

Jumlah area pengelolaan Super Admin: **10**.

# 13. Homepage Management in Admin

Homepage tidak mempunyai node page builder. Super Admin mengelola Homepage melalui sumber data berikut:

| Homepage Output | Administrative Source |
| --- | --- |
| Identitas Desa | Area Identitas / Profil Desa. |
| Pilihan Dusun | Data Dusun yang berstatus `ACTIVE`. |
| Peta Desa | Data lokasi aktif dari Dusun aktif. |
| Agenda/Kegiatan terbaru | Data Agenda/Kegiatan tingkat Desa. |
| Pengumuman terbaru | Data Pengumuman tingkat Desa yang aktif. |

Struktur ini tidak memberikan pengeditan manual atas hasil data-driven dan tidak menambahkan manual ordering.

# 14. Soft Delete / Nonaktif IA

Soft Delete adalah state dan data-management behavior di area admin, bukan halaman publik.

- Data operasional aktif dapat tampil di area publik sesuai scope dan status terkait.
- Data operasional `Nonaktif / Soft Deleted` disembunyikan dari publik tetapi tetap tersimpan.
- Admin Dusun hanya dapat melakukan Nonaktif / Soft Delete pada data Dusunnya sendiri.
- Super Admin dapat melakukan restore.
- Hard delete hanya tersedia bagi Super Admin untuk data selain entitas Dusun.
- Entitas Dusun tidak mempunyai hard delete melalui UI.

Jika management area perlu membedakan **Data Aktif** dan **Data Nonaktif / Soft Deleted**, perbedaan tersebut adalah klasifikasi konseptual. Sitemap tidak menetapkan tab, filter, atau komponen UI final.

Tidak ada node admin bernama “Arsip” generik. Istilah **Arsip Pengumuman** hanya digunakan untuk Pengumuman kedaluwarsa yang tetap public.

# 15. Role Access Summary

Tabel ini merupakan ringkasan high-level, bukan Roles & Permissions Matrix lengkap.

| Sitemap Area | Public | Admin Dusun | Super Admin |
| --- | --- | --- | --- |
| Homepage publik | ✓ | ✓ dapat melihat | ✓ dapat melihat |
| Halaman Dusun `ACTIVE` | ✓ | ✓ dapat melihat | ✓ dapat melihat |
| Login Admin | ✗ | ✓ | ✓ |
| Dashboard Dusun | ✗ | hanya dashboard Dusun sendiri | ✗ sebagai role Admin Dusun |
| Super Admin Dashboard | ✗ | ✗ | ✓ |
| Kelola Profil Dusun | ✗ | hanya Dusun sendiri | seluruh Dusun |
| Kelola Kontak Pelayanan | ✗ | hanya Dusun sendiri | seluruh Dusun |
| Kelola UMKM | ✗ | hanya Dusun sendiri | seluruh Dusun |
| Kelola Fasilitas | ✗ | hanya Dusun sendiri | seluruh Dusun |
| Kelola Agenda & Kegiatan | ✗ | hanya Dusun sendiri | Desa dan seluruh Dusun |
| Kelola Pengumuman | ✗ | hanya Dusun sendiri | Desa dan seluruh Dusun |
| Kelola Identitas / Profil Desa | ✗ | ✗ | ✓ |
| Kelola Kategori Fasilitas | ✗ | ✗ | ✓ |
| Kelola Data / Peta global | ✗ | hanya data dalam modul Dusunnya sesuai scope | ✓ |
| Kelola Admin Dusun | ✗ | ✗ | ✓ |
| Restore data Soft Deleted | ✗ | ✗ | ✓ |

# 16. Conditional States

| Condition | IA Impact on Visibility / Navigation |
| --- | --- |
| Dusun `ACTIVE` | Tampil dalam Pilihan Dusun; Halaman Dusun menampilkan konten normal; data/titik aktif dapat tampil pada Peta Desa. |
| Dusun `INACTIVE` | Tidak tampil dalam Pilihan Dusun atau Peta Desa publik; alamat langsung tidak menampilkan konten publik normal; Admin Dusun tetap dapat mengakses dashboard Dusunnya. |
| Data section kosong | Section tetap tersedia dan menampilkan empty state sesuai requirement PRD. |
| UMKM tanpa koordinat | Tetap tampil pada direktori/Section UMKM, tetapi tidak menjadi marker sampai koordinat tersedia. |
| Marker pelayanan yang diizinkan | Dapat tampil dari data Kontak Pelayanan/titik pelayanan yang relevan; aksi detail mengarah ke informasi atau konteks pelayanan pada Dusun asal tanpa tipe detail view baru. |
| Fasilitas dengan nomor kontak | Detail dapat menampilkan tombol WhatsApp. |
| Fasilitas tanpa nomor kontak | Tetap tampil; tombol WhatsApp tidak ditampilkan. |
| Pengumuman aktif | Tampil pada daftar aktif di konteks Desa atau Dusun terkait. |
| Pengumuman kedaluwarsa | Keluar dari daftar aktif dan tetap public dalam Arsip Pengumuman. |
| Agenda `Akan Datang` | Tetap berada dalam modul Agenda/Kegiatan dengan status sesuai tanggal. |
| Agenda `Berlangsung` | Tetap berada dalam modul Agenda/Kegiatan dengan status sesuai tanggal/rentang. |
| Agenda `Selesai` | Tetap berada dalam modul Agenda/Kegiatan dengan status selesai dan dapat mempunyai dokumentasi bila tersedia. |
| Data operasional `Soft Deleted` | Tidak tampil public; tetap tersimpan untuk pengelolaan admin dan restore oleh Super Admin. |

Tabel tidak membentuk detailed state machine atau menetapkan komponen tampilan.

# 17. Future IA Considerations

Seluruh item berikut berlabel **FUTURE — NOT IN MVP NAVIGATION** dan tidak menjadi node aktif pada tree MVP:

| Requirement ID | Future IA Consideration | Status |
| --- | --- | --- |
| `DATA-004` | Penambahan Dusun baru di luar enam Dusun awal | `FUTURE — NOT IN MVP NAVIGATION` |
| `FR-020` | QR khusus per Dusun yang langsung membuka Halaman Dusun | `FUTURE — NOT IN MVP NAVIGATION` |
| `MEDIA-004` | Galeri multi-foto untuk satu UMKM | `FUTURE — NOT IN MVP NAVIGATION` |
| `MAP-011` | Pencarian lokasi berdasarkan nama | `FUTURE — NOT IN MVP NAVIGATION` |
| `MAP-012` | Garis atau bidang batas wilayah Dusun | `FUTURE — NOT IN MVP NAVIGATION` |
| `OPS-002` | Papan QR kecil per Dusun | `FUTURE — NOT IN MVP NAVIGATION` |

# 18. Open Non-Blocking Decisions and IA Impact

Keputusan berikut tetap `OPEN — NON-BLOCKING`. Tidak satu pun membentuk PAGE, SECTION, DETAIL, role, atau workflow baru pada sitemap.

| Open ID | IA Impact |
| --- | --- |
| `OPEN-001` | Nama resmi Dusun memengaruhi label; placeholder A–F tetap dapat digunakan. |
| `OPEN-002` | Redaksi final template WhatsApp memengaruhi copy, bukan hierarchy. |
| `OPEN-004` | Identitas pemegang Super Admin tidak mengubah role atau dashboard. |
| `OPEN-005` | Calon Admin Dusun tidak mengubah struktur dashboard. |
| `OPEN-006` | Supervisor operasional pasca-KKN tidak menambah role produk. |
| `OPEN-007` | Hosting/domain dan handover tidak menentukan URL atau hierarchy pada tahap sitemap. |
| `OPEN-008` | Konten/desain papan QR tidak mengubah destination MVP, yaitu Homepage. |
| `OPEN-009` | Pemilihan teknologi tidak diputuskan dalam sitemap. |
| `OPEN-010` | Recovery Super Admin tidak dibuat sebagai halaman baru. |
| `OPEN-011` | Dataset aktual memengaruhi isi dan empty state, bukan struktur modul. |

## 18.1 IA Open Question Summary

Jumlah `IA OPEN QUESTION`: **0**.

Tipe container Arsip Pengumuman telah ditetapkan melalui human IA decision sebagai child `[PAGE]` public di bawah konteks Pengumuman. Keputusan tersebut tidak memerlukan Baseline/PRD Change Request karena tidak mengubah kemampuan produk yang telah dibekukan.

# 19. Sitemap Traceability

| Sitemap Node / Area | PRD Section | Baseline Requirement IDs |
| --- | --- | --- |
| Public Website | 2, 8, 10 | `BR-003`–`BR-007`, `FR-001`, `NFR-001`–`NFR-003`, `ROLE-001` |
| Homepage Desa Bendung | 9, 11 | `FR-002`–`FR-004`, `FR-021`, `DATA-001`–`DATA-003` |
| Pilihan Dusun aktif | 11, 22 | `FR-004`, `FR-022`, `DATA-003` |
| Halaman Dusun single page/scroll | 9, 12, 22 | `FR-005`–`FR-007`, `FR-009`, `FR-022`, `DATA-005` |
| Kontak Pelayanan | 13 | `FR-010`, `DATA-006`–`DATA-008`, `PRIV-001` |
| UMKM dan Detail UMKM | 12, 14 | `FR-006`, `FR-011`, `FR-012`, `DATA-009`, `MAP-009`, `MEDIA-003` |
| Fasilitas dan Detail Fasilitas/Lokasi | 15, 18 | `FR-013`, `DATA-010`–`DATA-013`, `MAP-006`, `MAP-008`, `MEDIA-001`, `MEDIA-002` |
| Marker pelayanan dan hubungan detail konseptual | 13, 18, 25 | `MAP-003`, `MAP-006`, `MAP-010`, `PRIV-001` |
| Agenda & Kegiatan dan detail | 12, 16 | `FR-006`, `FR-014`–`FR-016`, `DATA-014`, `DATA-015`, `DATA-017`, `MEDIA-007` |
| Pengumuman aktif | 17 | `FR-008`, `FR-017`, `FR-018`, `DATA-016` |
| Arsip Pengumuman public child PAGE | 17 | `FR-018`, `DATA-016` |
| Peta Desa | 11, 18 | `FR-004`, `MAP-001`–`MAP-010`, `FR-022`, `PRIV-001` |
| Peta Dusun | 12, 18 | `MAP-001`–`MAP-010`, `FR-022`, `PRIV-001` |
| QR entry ke Homepage | 19 | `BR-003`, `OPS-001` |
| Login Admin | 20, 23 | `SEC-001`–`SEC-003`, `SEC-008`, `ROLE-004`, `ROLE-008` |
| Dashboard Dusun | 20, 22, 23 | `ROLE-002`–`ROLE-007`, `FR-019`, `SEC-003`, `SEC-008`, `SEC-009` |
| Super Admin Dashboard | 21–23 | `ROLE-008`–`ROLE-011`, `SEC-007`–`SEC-009` |
| Kelola Data / Peta map-centric | 18, 21 | `MAP-001`–`MAP-004`, `ROLE-008` |
| Homepage management via source data | 11, 21 | `FR-004`, `ROLE-008`, `ROLE-011` |
| Soft Delete / Nonaktif | 17, 20, 21, 26 | `ROLE-006`, `ROLE-008`, `SEC-007`, `SEC-009`, `FR-018` |
| Media/image visibility | 14–16, 18, 24 | `MEDIA-001`–`MEDIA-007` |
| Future IA Considerations | 29 | `DATA-004`, `FR-020`, `MEDIA-004`, `MAP-011`, `MAP-012`, `OPS-002` |

Traceability berfokus pada node utama dan tidak memetakan setiap tombol atau aksi UI.

# 20. IA Decisions vs UI Decisions

## 20.1 IA DECIDED

- Homepage Desa Bendung adalah entry point utama.
- Homepage menggunakan section data-driven dari modul sumber aktif.
- Halaman Dusun adalah single page/scroll.
- Public Website, Authentication, dan Administrative Dashboard terpisah secara konseptual.
- Detail UMKM, Agenda/Kegiatan, Fasilitas/Lokasi, dan Pengumuman tersedia sesuai kebutuhan yang didukung/conditional.
- Admin Dusun hanya berada pada konteks satu Dusun.
- Super Admin mempunyai konteks global.
- Arsip Pengumuman adalah child PAGE public di bawah konteks Pengumuman, dapat diakses dari konteks Pengumuman pada parent page, bukan navigasi utama, dan tetap berbeda dari Soft Delete.
- Kelola Data / Peta adalah view administratif map-centric atas data lokasi dari modul sumber, bukan sumber data bisnis independen.
- Marker pelayanan yang diizinkan mempunyai hubungan konseptual ke informasi Kontak Pelayanan atau konteks pelayanan terkait tanpa menambah tipe detail view.
- FUTURE tidak menjadi navigasi aktif MVP.

## 20.2 NOT DECIDED AT SITEMAP STAGE

- visual layout;
- navbar style;
- bottom navigation;
- tabs;
- drawer;
- modal;
- cards;
- exact URLs atau slug;
- component names;
- warna;
- typography;
- spacing;
- desktop layout;
- bentuk selector/filter UI;
- pola presentasi detail view;
- exact CTA/link copy;
- framework atau teknologi lain.

# 21. Sitemap Review Checklist

- [x] Source PRD v1.0 digunakan.
- [x] Requirements Baseline tidak diubah.
- [x] Tidak ada feature baru.
- [x] Public sitemap lengkap.
- [x] Homepage data-driven.
- [x] Halaman Dusun tetap single page/scroll.
- [x] Detail view tidak berlebihan.
- [x] Peta sesuai PRD.
- [x] Arsip Pengumuman tetap publik.
- [x] Soft Delete tidak dicampur dengan Arsip Pengumuman.
- [x] Admin Dusun terkunci satu Dusun.
- [x] Admin Dusun tidak mendapat hard delete/restore/admin management.
- [x] Super Admin global.
- [x] Tidak ada manual ordering.
- [x] Tidak ada page builder.
- [x] FUTURE tidak masuk navigation MVP.
- [x] Tidak ada tech decision.
- [x] Tidak ada detailed User Flow.
- [x] Tidak ada ERD/schema/API/UI/code.
- [x] Traceability tersedia.
- [x] Sitemap siap direview manusia.
- [x] Node Kelola Data / Peta tidak menjadi source data independen.
- [x] Marker pelayanan memiliki hubungan detail konseptual yang jelas.
- [x] Exact CTA/copy tidak dikunci pada tahap Sitemap.
- [x] Sitemap ditetapkan sebagai Version 1.0 — FROZEN FOR MVP.

Seluruh item checklist telah diverifikasi melalui final review. Sitemap ditetapkan sebagai `Version 1.0 — FROZEN FOR MVP`.
