# 1. Document Information

| Field | Value |
| --- | --- |
| Project | Portal Informasi Desa Bendung |
| Document | Product Requirements Document (PRD) |
| Version | 1.0 |
| Status | FROZEN FOR MVP |
| Product Baseline | Requirements Baseline v1.0 — FROZEN FOR MVP |
| Primary Source | `docs/01-requirements/requirements-baseline.md` |

PRD ini merupakan turunan dari Requirements Baseline v1.0. PRD v1.0 telah melalui human review dan tidak ditemukan Baseline Change Request. Jika terjadi perbedaan antara PRD dan Requirements Baseline, Requirements Baseline v1.0 menjadi sumber yang lebih tinggi sampai terdapat Change Request resmi. Setiap perubahan scope produk pada masa mendatang harus terlebih dahulu melalui Change Request terhadap Requirements Baseline.

Dokumen ini menjelaskan kebutuhan pada level produk. Dokumen ini tidak menetapkan sitemap, detailed user flow, roles-permissions matrix terpisah, ERD, schema database, SQL, API specification, SRS, technical architecture, wireframe, desain UI, test plan, atau source code.

Konvensi prioritas yang digunakan:

- `MUST` merupakan representasi requirement `CONFIRMED` yang masuk MVP;
- `OPTIONAL` tetap bersifat opsional dan tidak boleh diperlakukan sebagai syarat wajib MVP;
- `FUTURE` berada di luar MVP dan hanya mencakup enhancement yang telah dibekukan dalam baseline.

# 2. Executive Summary

Portal Informasi Desa Bendung adalah website informasi publik untuk Desa Bendung dan enam Dusun. Produk ini direncanakan dalam konteks program KKN untuk membantu warga dan pengunjung memperoleh informasi desa/dusun, menemukan fasilitas dan UMKM, melihat agenda serta pengumuman, membuka lokasi penting pada peta, dan menghubungi Kontak Pelayanan melalui WhatsApp.

Pengalaman masuk utama menghubungkan artefak fisik dan produk digital: satu papan utama di Balai Desa memuat satu QR utama yang membuka homepage Desa Bendung. Dari homepage, pengguna dapat memilih Dusun aktif atau langsung mengakses informasi desa, peta, agenda terbaru, dan pengumuman aktif. Pengalaman publik tidak memerlukan akun dan diprioritaskan untuk smartphone serta koneksi internet yang tidak selalu cepat.

Informasi dikelola melalui dua cakupan administratif. Admin Dusun mengelola data Dusunnya sendiri dan perubahan yang dibuat langsung dipublikasikan tanpa approval Super Admin. Super Admin mempunyai pengelolaan penuh atas seluruh enam Dusun, data tingkat Desa, homepage, semua modul informasi, data Peta, kategori fasilitas, dan akun Admin Dusun. Keberlanjutan pengelolaan setelah masa KKN didukung melalui pelatihan, handover, serta penyelesaian keputusan operasional non-blocking pada tahap pre-launch atau serah terima.

# 3. Background & Problem Statement

## 3.1 Problem

Kebutuhan utama yang dicatat baseline adalah kemudahan menemukan petunjuk lokasi penting serta Kontak Pelayanan warga. Informasi fasilitas, UMKM, kegiatan, pengumuman, dan identitas Dusun perlu tersedia melalui satu titik akses yang mudah dibuka oleh warga maupun pengunjung. Tanpa titik akses bersama, informasi yang dibutuhkan berpotensi tersebar atau tidak mudah ditemukan pada saat diperlukan.

Konteks penggunaan utama dimulai dari papan fisik di Balai Desa. Pengguna perlu dapat memindai QR dari smartphone, mencapai homepage, memilih salah satu Dusun, lalu menemukan informasi atau lokasi tanpa login. Produk juga harus mendukung pembaruan konten setelah KKN; informasi yang tidak dapat dipelihara oleh Admin Dusun dan Pemerintah Desa akan cepat kehilangan manfaatnya.

Pernyataan masalah ini diturunkan dari baseline dan tidak dimaksudkan sebagai klaim bahwa studi pengguna formal, survei kuantitatif, atau pengukuran perilaku telah dilakukan.

## 3.2 Product Response

Produk merespons kebutuhan tersebut dengan:

- portal informasi publik berbahasa Indonesia dan mobile-first;
- satu homepage Desa Bendung sebagai titik akses utama;
- pilihan enam Dusun dengan hanya Dusun aktif yang tampil kepada publik;
- halaman utama untuk setiap Dusun dengan informasi dan navigasi cepat;
- direktori Kontak Pelayanan, UMKM, dan Fasilitas;
- satu modul Agenda & Kegiatan serta satu modul Pengumuman;
- Peta Desa dan Peta Dusun dari sumber lokasi yang konsisten;
- tombol eksternal ke WhatsApp dan Google Maps;
- dashboard terisolasi untuk Admin Dusun dan pengelolaan global untuk Super Admin;
- mekanisme Nonaktif / Soft Delete agar data operasional dapat dipulihkan.

Referensi baseline: `BR-001`–`BR-004`, `FR-001`, `FR-005`–`FR-007`, `ROLE-003`–`ROLE-010`, `OPS-001`, `OPS-005`–`OPS-008`.

# 4. Product Vision

Portal informasi yang ringan dan mudah digunakan dari smartphone untuk membantu warga serta pengunjung menemukan informasi, lokasi penting, dan Kontak Pelayanan Desa Bendung, sekaligus tetap dapat dikelola oleh perangkat desa setelah KKN.

Visi ini menempatkan kemudahan akses publik, akurasi informasi lokasi, kontak yang dapat digunakan, dan keberlanjutan pengelolaan sebagai pusat produk. Portal tetap bersifat informasional pada MVP dan tidak berkembang menjadi sistem pelayanan atau transaksi online.

Referensi baseline: `BR-001`, `BR-002`, `BR-004`, `NFR-001`, `NFR-003`, `NFR-004`.

# 5. Product Goals

## 5.1 Primary Goals

1. Menyediakan satu titik akses publik untuk identitas Desa/Dusun, Kontak Pelayanan, UMKM, Fasilitas, Agenda & Kegiatan, Pengumuman, dan peta lokasi penting (`BR-001`).
2. Membantu pengguna menemukan petunjuk jalan atau lokasi penting dan menemukan Kontak Pelayanan yang relevan (`BR-002`).
3. Memungkinkan warga dan pengunjung memindai QR, memilih Dusun, menemukan fasilitas/UMKM, melihat kegiatan, dan menghubungi layanan dengan mudah (`BR-004`).

## 5.2 Supporting Goals

1. Menghubungkan papan utama, QR, homepage, dan pilihan Dusun dalam satu pengalaman produk yang konsisten (`BR-003`).
2. Membantu perangkat desa menyampaikan serta memperbarui informasi melalui pembagian pengelolaan Admin Dusun dan Super Admin (`BR-004`, `ROLE-003`, `ROLE-008`).
3. Menjaga produk ringan, dapat dirawat, dan berkelanjutan setelah handover (`NFR-003`, `NFR-004`, `OPS-005`–`OPS-008`).

## 5.3 Critical Product Capabilities

Tiga kemampuan berikut merupakan kemampuan kritis yang tidak boleh gagal:

1. **Scan QR dan navigasi antar-Dusun.** Pengguna dapat membuka homepage melalui QR dan menavigasi informasi Dusun dengan pengalaman mobile-first serta responsif (`BR-005`, `BR-003`, `NFR-001`).
2. **Peta fasilitas/UMKM dan arah Google Maps.** Pengguna dapat menemukan lokasi yang akurat pada peta dan membuka arah melalui Google Maps sebagai layanan eksternal (`BR-006`, `MAP-002`, `MAP-006`, `MAP-007`).
3. **Kontak Pelayanan melalui WhatsApp.** Pengguna dapat menemukan Kontak Pelayanan dan membuka WhatsApp melalui tombol yang tersedia (`BR-007`, `DATA-007`, `FR-010`).

# 6. Non-Goals

Fitur berikut secara eksplisit tidak dibuat pada MVP:

- pengajuan surat online;
- formulir atau proses pengaduan warga online;
- pendaftaran atau proses pelayanan warga online;
- akun atau login warga;
- chat internal dengan perangkat desa;
- transaksi atau e-commerce UMKM;
- pemesanan dan pembayaran online;
- GPS tracking;
- navigasi atau custom routing buatan portal;
- forum warga;
- notifikasi aplikasi;
- halaman khusus “Tentang Desa” pada MVP.

Non-goal tidak otomatis menjadi rencana pengembangan. Hanya item pada Bagian 29 yang berstatus `FUTURE`. Direktori produk UMKM, tombol WhatsApp eksternal, dan tombol arah ke Google Maps tetap masuk scope karena tidak mengubah portal menjadi marketplace, aplikasi chat, atau sistem routing.

Referensi baseline: `FR-011`, `FR-012`, `FR-021`, `MAP-007`, Bagian 26 Requirements Baseline.

# 7. Target Users & Personas

Persona pada PRD ini berbasis peran produk, bukan profil demografis fiktif.

## 7.1 Public User / Pengunjung

**Cakupan:** warga Desa Bendung dan pengunjung dari luar desa.

**Goals:** menemukan informasi Desa/Dusun, lokasi fasilitas atau UMKM, kegiatan, pengumuman, dan Kontak Pelayanan.

**Needs:** akses tanpa akun, pengalaman smartphone yang ringan, navigasi jelas, informasi lokasi yang dapat ditindaklanjuti, serta tombol WhatsApp dan Google Maps.

**Typical Actions:** memindai QR, membuka homepage, memilih Dusun aktif, melihat detail informasi, menggunakan filter peta, membuka arah Google Maps, dan membuka chat WhatsApp.

**Access Level:** hanya area publik; tidak mempunyai akun atau kemampuan mengelola data.

Referensi baseline: `ROLE-001`, `FR-001`, `BR-003`–`BR-007`.

## 7.2 Admin Dusun

**Cakupan:** pengelola untuk satu Dusun tertentu; satu Dusun dapat mempunyai lebih dari satu Admin Dusun.

**Goals:** menjaga profil dan informasi operasional Dusunnya tetap relevan.

**Needs:** dashboard yang langsung berada pada konteks Dusunnya, kemampuan membuat/melihat/mengubah data, publikasi langsung, serta Nonaktifkan / Soft Delete.

**Typical Actions:** login dengan username/password; mengelola profil, Kontak Pelayanan, UMKM, Fasilitas, Agenda/Kegiatan, dan Pengumuman Dusunnya; menonaktifkan data yang tidak lagi publik.

**Access Level:** hanya data Dusunnya sendiri. Admin Dusun tidak dapat mengakses Dusun lain, membuat akun Admin lain, melakukan hard delete, atau mengatur urutan tampil manual. Data yang di-Soft Delete dapat dipulihkan, tetapi baseline hanya memberikan kewenangan restore secara eksplisit kepada Super Admin.

Referensi baseline: `ROLE-002`–`ROLE-007`, `FR-019`, `SEC-003`, `SEC-008`, `SEC-009`.

## 7.3 Super Admin

**Cakupan:** pengelola global seluruh enam Dusun dan data tingkat Desa.

**Goals:** menjaga konsistensi informasi tingkat Desa, mengelola seluruh modul, mengelola status Dusun, serta mendukung operasional Admin Dusun.

**Needs:** pengelolaan penuh atas identitas Desa, homepage, profil semua Dusun, Kontak Pelayanan, UMKM, Fasilitas, Agenda & Kegiatan, Pengumuman, kategori fasilitas, data Peta, dan akun Admin Dusun.

**Typical Actions:** melihat, membuat, mengubah, mengaktifkan/menonaktifkan, melakukan Soft Delete, melakukan restore, mereset password Admin Dusun, serta melakukan hard delete permanen terhadap data selain entitas Dusun.

**Access Level:** global pada seluruh modul dan Dusun. Super Admin dapat mengubah nama/profil/status Dusun, tetapi tidak dapat melakukan hard delete entitas Dusun melalui UI.

Referensi baseline: `ROLE-008`–`ROLE-011`, `SEC-007`–`SEC-009`, `FR-004`, `FR-022`.

# 8. Product Principles

1. **Mobile-first.** Pengalaman utama dirancang untuk smartphone setelah pengguna memindai QR (`NFR-001`).
2. **Simple public access.** Informasi publik tersedia tanpa akun warga dan menggunakan Bahasa Indonesia (`FR-001`, `NFR-002`).
3. **Fast and lightweight.** Produk harus ringan dan cepat dimuat pada koneksi yang tidak selalu cepat, tanpa menetapkan angka performa yang belum disepakati (`NFR-003`).
4. **Data-driven homepage.** Bagian dinamis homepage berasal dari modul sumber aktif, bukan page builder atau pengeditan manual atas hasil tampilannya (`FR-004`).
5. **Consistent location source.** Peta Desa dan Peta Dusun menampilkan data lokasi dari sumber konseptual yang konsisten (`MAP-001`, `MAP-002`).
6. **Maintainable after KKN.** Produk harus stabil, mudah dikembangkan, mudah dirawat, dan dapat diserahterimakan (`NFR-004`, `OPS-005`–`OPS-008`).
7. **Privacy-conscious publication.** Data privat hanya dimasukkan setelah izin administratif/offline diperoleh (`PRIV-001`).
8. **No unnecessary complexity.** MVP tetap sebagai portal informasi dan tidak memasukkan pelayanan, transaksi, page builder, manual ordering, routing internal, atau workflow consent digital yang tidak dibutuhkan baseline.

# 9. MVP Scope Overview

Semua area pada tabel berikut memiliki status baseline `CONFIRMED` dan diterjemahkan pada level prioritas PRD sebagai `MUST`. Data tertentu di dalam area tetap `OPTIONAL` sebagaimana dirinci pada Bagian 28.

| Product Area | MVP Status | Ringkasan | Requirement IDs |
| --- | --- | --- | --- |
| Homepage Desa | `MUST` | Identitas Desa dan bagian data-driven dari modul aktif | `FR-002`–`FR-004`, `DATA-001`–`DATA-003` |
| Profil Desa | `MUST` | Profil singkat pada homepage tanpa halaman Tentang Desa khusus | `FR-021`, `DATA-001`, `DATA-002` |
| Pilihan Dusun | `MUST` | Struktur enam Dusun; hanya Dusun aktif tampil publik | `DATA-003`, `FR-022` |
| Halaman Dusun | `MUST` | Single page/scroll dengan modul inti dan detail tertentu | `FR-005`–`FR-007`, `DATA-005` |
| Kontak Pelayanan | `MUST` | Direktori kontak aktif dengan WhatsApp | `DATA-006`–`DATA-008`, `FR-010` |
| UMKM | `MUST` | Direktori informasi usaha dan produk, bukan marketplace | `FR-011`, `FR-012`, `DATA-009` |
| Fasilitas | `MUST` | Direktori fasilitas, kategori dinamis, koordinat wajib | `DATA-010`–`DATA-013`, `FR-013`, `MAP-008` |
| Agenda & Kegiatan | `MUST` | Satu modul tingkat Dusun/Desa dengan lifecycle tiga status | `FR-014`–`FR-016`, `DATA-014`, `DATA-015`, `DATA-017`, `MEDIA-007` |
| Pengumuman | `MUST` | Pengumuman Desa/Dusun, kedaluwarsa, dan Arsip Pengumuman publik | `FR-008`, `FR-017`, `FR-018`, `DATA-016` |
| Peta Desa/Dusun | `MUST` | Marker aktif, filter, popup, detail, dan arah Google Maps | `MAP-001`–`MAP-010` |
| QR Entry Point | `MUST` | Satu papan dan satu QR utama menuju homepage | `BR-003`, `OPS-001` |
| Admin Dusun Dashboard | `MUST` | Pengelolaan satu Dusun, publikasi langsung, dan Soft Delete | `ROLE-002`–`ROLE-007`, `FR-019`, `SEC-008`, `SEC-009` |
| Super Admin Dashboard | `MUST` | Pengelolaan global, akun admin, restore, dan hard delete terbatas | `ROLE-008`–`ROLE-011`, `SEC-007`, `SEC-009` |
| Authentication | `MUST` | Login admin username/password dan pembatasan akses berbasis peran | `SEC-001`–`SEC-003`, `SEC-008` |
| Media/Image Handling | `MUST` | Media opsional, placeholder, resize, kompresi, dan format web modern | `MEDIA-001`–`MEDIA-003`, `MEDIA-005`–`MEDIA-007` |

Jumlah area produk MVP yang terdokumentasi pada tabel ini: **15**.

# 10. Public Website Product Requirements

- Public User dapat mengakses seluruh area publik tanpa login atau akun warga (`FR-001`, `ROLE-001`).
- Pengalaman utama dimulai dari QR dan berlanjut ke homepage serta pilihan Dusun/informasi (`BR-003`, `BR-005`, `OPS-001`).
- Website menggunakan Bahasa Indonesia dan pendekatan mobile-first serta responsif (`NFR-001`, `NFR-002`).
- Homepage menyediakan identitas Desa, pilihan Dusun aktif, Peta Desa, kontak kantor, Agenda/Kegiatan Desa, serta Pengumuman Desa (`FR-002`–`FR-004`).
- Pengguna dapat memilih Dusun aktif dan mengakses informasi dalam halaman Dusun (`FR-005`–`FR-007`, `FR-022`).
- Jika suatu bagian belum memiliki data, bagian tetap tersedia dengan empty state “Belum ada data” (`FR-009`).
- Website harus ringan dan cepat dimuat pada kondisi koneksi yang tidak selalu cepat, tanpa target angka performa pada tahap PRD (`NFR-003`).

PRD tidak menentukan layout, komponen visual, URL final, atau pola interaksi rinci.

# 11. Homepage Desa Product Requirements

Homepage merupakan titik akses utama dan bersifat data-driven. Super Admin mengelola identitas Desa dan data pada modul sumber, bukan menyusun ulang hasil tampilannya melalui page builder.

## 11.1 Directly Managed Village Identity

Super Admin mengelola langsung:

- Nama Desa;
- logo;
- banner/foto;
- deskripsi singkat;
- alamat kantor Desa;
- nomor kontak Desa;
- email jika tersedia (`OPTIONAL`);
- nama Kepala Desa;
- jam pelayanan kantor Desa.

Referensi baseline: `DATA-001`, `DATA-002`, `FR-004`, `ROLE-008`.

## 11.2 Data-Driven Sections

- **Pilihan Dusun** mengambil hanya Dusun berstatus aktif (`FR-004`, `FR-022`).
- **Peta Desa** mengambil lokasi, Fasilitas, UMKM, dan data peta aktif dari Dusun aktif (`FR-004`, `MAP-002`).
- **Agenda terbaru** mengambil Agenda/Kegiatan Desa dari modul Agenda (`FR-003`, `FR-004`, `FR-016`).
- **Pengumuman terbaru** mengambil Pengumuman Desa aktif dari modul Pengumuman (`FR-003`, `FR-004`, `FR-017`, `FR-018`).

Tidak ada page builder pada MVP. Algoritma urutan rinci untuk daftar data-driven belum ditetapkan pada baseline dan tidak diputuskan oleh PRD ini.

# 12. Halaman Dusun Product Requirements

- Setiap Dusun aktif mempunyai satu halaman utama dengan model single page/scroll (`FR-006`).
- Bagian atas menampilkan foto/banner jika tersedia, nama Dusun, dan navigasi cepat (`FR-007`, `MEDIA-001`).
- Halaman mencakup profil/identitas Dusun, nama Kepala Dusun, Kontak Pelayanan, UMKM, Fasilitas, Agenda & Kegiatan, Pengumuman, dan Peta Dusun (`FR-005`).
- Profil Dusun mendukung nama, foto/banner, deskripsi singkat, Kepala Dusun, jumlah RT, dan jumlah RW (`DATA-005`).
- Detail tertentu, seperti rincian UMKM atau Agenda/Kegiatan, dapat dibuka dalam detail view (`FR-006`).
- Bagian yang belum mempunyai data menggunakan empty state dan tidak menyebabkan seluruh menu disembunyikan (`FR-009`).
- Jika Dusun tidak aktif, halaman publiknya tidak digunakan seperti normal dan URL langsung tidak menampilkan konten publik normal (`FR-022`).

PRD tidak menetapkan URL final, struktur navigasi rinci, atau desain tampilan halaman Dusun tidak aktif.

# 13. Kontak Pelayanan

- Jenis dan jabatan Kontak Pelayanan bersifat fleksibel sesuai orang yang tersedia dan bersedia pada masing-masing Dusun (`DATA-006`, `OPTIONAL`).
- Data inti mencakup nama, jabatan, nomor WhatsApp, dan status aktif/tidak aktif (`DATA-007`).
- Setiap Kontak Pelayanan yang dipublikasikan wajib mempunyai nomor WhatsApp (`DATA-007`).
- Foto kontak bersifat opsional (`DATA-008`).
- Tombol WhatsApp membuka chat dengan template pesan awal yang menunjukkan bahwa kontak diperoleh dari Portal Desa Bendung (`FR-010`).
- Kepala Dusun tidak otomatis menjadi Kontak Pelayanan; keikutsertaannya ditentukan sesuai kondisi masing-masing Dusun.
- Publikasi nomor dan foto mengikuti izin administratif/offline (`PRIV-001`).

`OPEN-002 — Redaksi final template pesan WhatsApp` tetap **NON-BLOCKING**. Keputusan untuk menggunakan template sudah final; hanya redaksi akhirnya yang belum ditetapkan.

# 14. UMKM

- Modul UMKM merupakan direktori informasi dan kontak WhatsApp, bukan marketplace, pemesanan, transaksi, atau pembayaran (`FR-011`).
- Informasi yang didukung mencakup nama UMKM, nama pemilik, jenis usaha, beberapa produk dalam list/tags, deskripsi, alamat, nomor WhatsApp, jam operasional, foto, dan lokasi peta jika tersedia (`DATA-009`, `FR-012`).
- Produk dapat berjumlah lebih dari satu tanpa membentuk katalog transaksi (`FR-012`).
- Foto bersifat opsional. Pada MVP, satu foto utama didukung jika tersedia (`MEDIA-001`, `MEDIA-003`).
- Koordinat bersifat opsional. UMKM tanpa koordinat tetap tampil dalam direktori tetapi tidak tampil sebagai marker sampai koordinat tersedia (`MAP-009`).
- Galeri beberapa foto untuk satu UMKM berada di luar MVP dan berstatus `FUTURE` (`MEDIA-004`).
- Data pemilik, alamat, WhatsApp, foto personal, atau lokasi privat hanya dimasukkan setelah izin administratif/offline diperoleh (`PRIV-001`).

# 15. Fasilitas

- Jenis dan keberadaan Fasilitas mengikuti kondisi nyata pada masing-masing Dusun; tidak ada daftar fasilitas yang wajib sama untuk seluruh Dusun (`DATA-010`, `OPTIONAL`).
- Kategori Fasilitas bersifat dinamis dan dapat ditambah atau diubah oleh Super Admin (`DATA-013`, `ROLE-011`).
- Data inti mencakup nama, kategori, deskripsi, alamat, dan koordinat/peta (`DATA-011`).
- Setiap Fasilitas wajib mempunyai koordinat dan terhubung ke peta (`MAP-008`).
- Foto bersifat opsional dan menggunakan placeholder jika tidak tersedia (`MEDIA-001`, `MEDIA-002`).
- Nomor kontak bersifat opsional (`DATA-012`).
- Jika nomor kontak tersedia, MVP menampilkan tombol WhatsApp saja. Jika nomor tidak tersedia, tombol tidak ditampilkan (`FR-013`).

# 16. Agenda & Kegiatan

Agenda dan dokumentasi kegiatan menggunakan satu modul yang sama (`FR-014`). Modul mencakup Agenda/Kegiatan tingkat Dusun dan tingkat Desa (`FR-016`).

Informasi produk yang didukung:

- judul;
- deskripsi singkat;
- tanggal mulai/tanggal kegiatan;
- tanggal selesai yang bersifat opsional untuk kegiatan multi-hari;
- jam yang bersifat opsional;
- lokasi;
- foto/poster awal yang bersifat opsional;
- dokumentasi setelah kegiatan yang bersifat opsional.

Referensi baseline: `DATA-014`, `DATA-015`, `DATA-017`, `MEDIA-007`.

Lifecycle otomatis hanya menggunakan tiga status:

1. `Akan Datang` ketika tanggal sekarang sebelum tanggal mulai.
2. `Berlangsung` ketika tanggal sekarang berada pada tanggal atau rentang kegiatan.
3. `Selesai` ketika tanggal sekarang setelah tanggal selesai.

Jika tanggal selesai kosong, tanggal mulai diperlakukan sebagai tanggal selesai untuk menghitung status. Untuk kegiatan satu hari, status pada hari kegiatan adalah `Berlangsung` dan setelah hari kegiatan menjadi `Selesai`. Admin dengan kewenangan pengelolaan terkait dapat melakukan override manual bila diperlukan (`FR-015`). Tidak ada status tambahan pada MVP.

# 17. Pengumuman

- Modul Pengumuman wajib tersedia, tetapi setiap Dusun tidak wajib mempunyai pengumuman aktif setiap saat (`FR-008`).
- Pengumuman Desa dan Pengumuman Dusun dibedakan berdasarkan cakupannya (`FR-017`).
- Pengumuman mempunyai tanggal kedaluwarsa (`DATA-016`).
- Sebelum atau pada tanggal kedaluwarsa, pengumuman tampil sebagai pengumuman aktif pada area terkait.
- Setelah kedaluwarsa, pengumuman tidak lagi berada dalam daftar aktif, tetap tersedia di dashboard, dan tetap dapat dilihat publik dalam **Arsip Pengumuman** (`FR-018`).

**Arsip Pengumuman tidak sama dengan Nonaktif / Soft Delete.** Arsip Pengumuman tetap publik. Nonaktif / Soft Delete digunakan untuk data operasional yang disembunyikan dari publik, tetap disimpan, dan dapat dipulihkan (`ROLE-006`, `FR-018`).

# 18. Map Product Requirements

## 18.1 Peta Desa dan Peta Dusun

- Peta Desa menampilkan titik lokasi aktif dari seluruh Dusun aktif (`MAP-002`).
- Peta Dusun menggunakan sumber lokasi konseptual yang konsisten dan otomatis difilter untuk Dusun aktif yang sedang dibuka (`MAP-001`, `MAP-002`).
- Dusun dan data/titik yang tidak aktif tidak tampil pada Peta Desa publik (`FR-022`).

## 18.2 MVP Map Capabilities

MVP mencakup:

- marker lokasi;
- filter Dusun;
- filter kategori;
- popup marker;
- nama;
- kategori;
- foto atau placeholder;
- alamat;
- tombol “Lihat Detail”;
- tombol “Buka Arah/Navigasi” ke Google Maps;
- input lokasi oleh admin melalui klik peta atau latitude/longitude.

Deskripsi singkat tidak menjadi isi popup. Referensi baseline: `MAP-003`–`MAP-007`, `MEDIA-002`.

## 18.3 Coordinate Rules

- Koordinat Fasilitas wajib (`MAP-008`).
- Koordinat UMKM opsional; UMKM tetap tampil pada direktori tanpa koordinat (`MAP-009`).
- Lokasi Kontak Pelayanan atau rumah pribadi opsional, hanya relevan sebagai lokasi pelayanan, dan memerlukan izin administratif/offline sebelum dipublikasikan (`MAP-010`, `PRIV-001`).

## 18.4 Future Map Capabilities

- pencarian lokasi berdasarkan nama (`MAP-011`, `FUTURE`);
- garis atau bidang batas wilayah Dusun (`MAP-012`, `FUTURE`).

PRD tidak menentukan Leaflet, OpenStreetMap, Google Maps API, atau provider peta portal. Google Maps hanya diputuskan sebagai tujuan navigasi eksternal (`MAP-007`).

# 19. QR Product Experience

Alur pengalaman produk:

`Papan utama → Scan QR → Homepage Desa → Pilih Dusun / akses informasi`

MVP menggunakan satu papan utama Desa Bendung di Balai Desa dan satu QR utama yang menuju homepage (`BR-003`, `OPS-001`). Tujuan QR tidak mengunci domain sebelum keputusan hosting/domain final.

Enhancement berstatus `FUTURE`:

- QR khusus per Dusun yang langsung membuka halaman Dusun (`FR-020`);
- papan QR kecil di lokasi masing-masing Dusun (`OPS-002`).

Konten dan desain visual final papan tetap `OPEN — NON-BLOCKING` (`OPEN-008`).

# 20. Admin Dusun Product Requirements

Admin Dusun mempunyai kemampuan produk berikut:

- login menggunakan username dan password (`SEC-008`);
- setelah login, langsung masuk ke dashboard Dusunnya sendiri (`ROLE-004`);
- membuat, melihat, dan mengubah profil, Kontak Pelayanan, UMKM, Fasilitas, Agenda/Kegiatan, dan Pengumuman hanya pada Dusunnya (`ROLE-003`);
- mempublikasikan penambahan/perubahan langsung tanpa approval Super Admin (`FR-019`);
- melakukan Nonaktifkan / Soft Delete agar data tidak tampil publik tetapi tetap tersimpan dan dapat dipulihkan (`ROLE-006`);
- tidak melakukan hard delete (`ROLE-006`, `SEC-009`);
- tidak membuat akun Admin lain (`ROLE-005`);
- tidak memilih, melihat, atau mengelola data Dusun lain (`ROLE-004`, `SEC-003`);
- tidak mengatur urutan manual; seluruh daftar menggunakan pengurutan otomatis/default sistem (`ROLE-007`).

Baseline tidak memberikan kewenangan restore secara eksplisit kepada Admin Dusun. Restore merupakan bagian dari pengelolaan penuh Super Admin (`ROLE-008`). PRD tidak menambahkan workflow approval Super Admin untuk publikasi dan tidak menentukan algoritma sorting rinci.

# 21. Super Admin Product Requirements

Super Admin mempunyai full management atas:

- seluruh enam Dusun;
- identitas Desa;
- homepage;
- profil semua Dusun;
- Kontak Pelayanan;
- UMKM;
- Fasilitas;
- Agenda & Kegiatan;
- Pengumuman;
- kategori Fasilitas;
- data tingkat Desa;
- data terkait Peta;
- akun Admin Dusun.

Operasi yang tersedia mencakup melihat, membuat, mengubah, mengaktifkan/menonaktifkan, melakukan Soft Delete, melakukan restore, dan melakukan hard delete permanen sesuai batas berikut (`ROLE-008`):

- hard delete hanya boleh dilakukan Super Admin;
- hard delete hanya berlaku terhadap data selain entitas Dusun;
- entitas Dusun tidak memiliki hard delete melalui UI (`SEC-007`, `SEC-009`).

Untuk entitas Dusun, Super Admin dapat mengubah nama, mengedit profil, menonaktifkan, dan mengaktifkan kembali (`ROLE-010`). Penambahan Dusun baru tidak masuk MVP dan berstatus `FUTURE` (`DATA-004`). Super Admin juga membuat/menghapus akun Admin Dusun dan mereset password Admin Dusun (`ROLE-009`).

# 22. Dusun Lifecycle

## 22.1 Active

Dusun berstatus `ACTIVE`:

- tampil dalam pilihan Dusun pada homepage;
- data/titik aktifnya dapat tampil pada Peta Desa publik;
- halaman publik Dusun menampilkan konten normal;
- Admin Dusun dapat login dan mengelola data sesuai kewenangannya.

## 22.2 Inactive

Dusun berstatus `INACTIVE`:

- tidak tampil dalam pilihan Dusun pada homepage;
- data/titiknya tidak tampil pada Peta Desa publik;
- URL langsung tidak menampilkan konten publik normal;
- seluruh data Dusun, termasuk UMKM, Fasilitas, Kontak, Agenda, koordinat, dan data terkait, tetap tersimpan;
- Admin Dusun tetap dapat login dan memperbarui/mengelola data Dusunnya;
- Super Admin dapat mengaktifkan kembali Dusun.

PRD tidak menentukan desain visual, komponen, atau redaksi halaman untuk Dusun tidak aktif. Referensi baseline: `FR-022`, `ROLE-010`.

# 23. Authentication & Access Control

- Public User tidak mempunyai akun dan tidak perlu login (`FR-001`, `ROLE-001`).
- Admin menggunakan username dan password (`SEC-008`).
- Admin Dusun terikat pada satu Dusun dan tidak dapat mengakses data Dusun lain (`ROLE-004`, `SEC-003`).
- Satu Dusun dapat mempunyai lebih dari satu Admin Dusun (`ROLE-002`).
- Super Admin mempunyai cakupan global atas seluruh Dusun dan modul (`ROLE-008`).
- Jika Admin Dusun lupa password, reset dilakukan Super Admin melalui area admin (`SEC-008`).
- Mekanisme pemulihan akun Super Admin tetap `OPEN — NON-BLOCKING` (`OPEN-010`).

PRD tidak menentukan JWT, session design, auth provider, library, kompleksitas password, atau masa sesi.

# 24. Media & Image Product Requirements

- Foto bersifat opsional untuk seluruh jenis data (`MEDIA-001`).
- Jika foto tidak tersedia, produk menggunakan placeholder atau ilustrasi yang sesuai (`MEDIA-002`).
- Satu UMKM dapat menggunakan satu foto utama pada MVP, tetapi foto tersebut tidak wajib (`MEDIA-003`).
- Poster awal dan dokumentasi pascakegiatan bersifat opsional (`MEDIA-007`).
- Galeri umum dapat dikerjakan jika waktu cukup dan tetap berstatus `OPTIONAL` (`MEDIA-005`).
- Gambar unggahan dioptimalkan melalui resize, kompresi, dan konversi ke format gambar web modern (`MEDIA-006`).
- WebP merupakan contoh format modern dari source, bukan keputusan library atau pipeline.
- SVG digunakan untuk aset vektor seperti logo dan ikon (`MEDIA-006`).
- Galeri beberapa foto per UMKM berstatus `FUTURE` (`MEDIA-004`).

PRD tidak memilih library image processing atau implementasi penyimpanan media.

# 25. Privacy & Publication Rules

`PRIV-001` menetapkan bahwa consent publikasi pada MVP dilakukan secara administratif/offline.

- Admin bertanggung jawab memastikan izin publikasi telah diperoleh sebelum memasukkan data privat ke sistem.
- Aturan ini mencakup nomor personal/WhatsApp, foto personal, rumah pribadi, dan lokasi privat.
- Rumah pribadi atau lokasi pelayanan privat hanya dapat dipublikasikan jika relevan dan izin telah diperoleh.
- Sistem tidak menyediakan field consent Ya/Tidak, upload surat persetujuan, digital consent management, atau workflow approval consent.

Mekanisme administratif berada di luar fitur software MVP. PRD tidak mengubahnya menjadi proses persetujuan digital.

# 26. Product Security Requirements

Pada level produk, sistem harus memenuhi requirement berikut tanpa mengunci implementasi:

- otentikasi login admin harus diamankan (`SEC-001`);
- password harus disimpan menggunakan hashing yang kuat (`SEC-002`);
- Role-Based Access Control membatasi Admin Dusun pada data Dusunnya sendiri (`SEC-003`);
- sistem memiliki perlindungan terhadap SQL injection (`SEC-004`);
- sistem memiliki perlindungan terhadap XSS (`SEC-005`);
- login dilindungi dari brute force melalui rate limiting (`SEC-006`);
- hard delete entitas Dusun tidak tersedia pada UI (`SEC-007`);
- Admin Dusun tidak dapat melakukan hard delete dan Super Admin hanya dapat melakukan hard delete pada data selain Dusun (`SEC-009`).

Hard delete Super Admin merupakan operasi berisiko tinggi karena bersifat permanen dan tidak mengikuti mekanisme restore Soft Delete. PRD tidak membuat desain confirmation modal, audit log, backup policy, atau mekanisme teknis baru yang belum diputuskan baseline. Algoritma atau library password hashing juga tidak dipilih pada tahap ini.

# 27. Non-Functional Product Requirements

- **Mobile-first dan responsive:** pengalaman diprioritaskan untuk smartphone setelah scan QR (`NFR-001`).
- **Bahasa:** antarmuka publik menggunakan Bahasa Indonesia saja (`NFR-002`).
- **Lightweight dan fast load:** website diprioritaskan ringan dan cepat pada koneksi yang tidak selalu cepat (`NFR-003`).
- **Maintainable:** solusi harus stabil, ringan, mudah dikembangkan, dan mudah dirawat oleh operator desa (`NFR-004`).
- **Sustainable after handover:** pengelolaan dilanjutkan Admin Dusun dengan supervisi pihak Desa serta didukung pelatihan/panduan dan handover (`OPS-005`–`OPS-008`).

PRD tidak menetapkan SLA, performance budget, Core Web Vitals, target detik, target uptime, atau angka keberhasilan yang belum ada pada baseline.

> **NO TECH STACK HAS BEEN APPROVED.**

Framework, database, ORM, hosting, map provider, auth provider, image processing library, dan deployment platform belum dipilih. Evaluasi teknis dilakukan pada tahap R&D berikutnya. Google Maps hanya merupakan tujuan navigasi eksternal.

# 28. Optional MVP Items

Tabel berikut memuat seluruh 13 requirement `OPTIONAL` pada baseline. Item ini tidak boleh menjadi syarat wajib penerimaan MVP.

| Requirement ID | Optional Item | Product Interpretation |
| --- | --- | --- |
| `DATA-002` | Email Desa | Ditampilkan jika tersedia. |
| `DATA-006` | Jenis/jabatan Kontak Pelayanan | Komposisinya fleksibel sesuai pihak yang tersedia dan bersedia di setiap Dusun. |
| `DATA-008` | Foto Kontak Pelayanan | Dapat digunakan jika tersedia dan telah memperoleh izin publikasi. |
| `DATA-010` | Jenis/keberadaan Fasilitas | Mengikuti kondisi nyata; tidak wajib seragam di semua Dusun. |
| `DATA-012` | Nomor kontak Fasilitas | Tidak wajib; tombol WhatsApp hanya tampil jika nomor tersedia. |
| `DATA-015` | Tanggal selesai kegiatan | Diisi bila kegiatan berlangsung lebih dari satu hari; jika kosong, tanggal mulai menjadi tanggal selesai untuk status. |
| `DATA-017` | Jam Agenda/Kegiatan | Agenda dapat dibuat dan dipublikasikan tanpa jam. |
| `MAP-009` | Koordinat UMKM | UMKM tetap tampil di direktori tanpa koordinat. |
| `MAP-010` | Lokasi pelayanan/rumah pribadi | Hanya digunakan bila relevan dan izin offline telah diperoleh. |
| `MEDIA-001` | Foto pada semua jenis data | Foto tidak wajib; placeholder berlaku jika tidak tersedia. |
| `MEDIA-003` | Satu foto utama UMKM | Didukung pada MVP jika tersedia, tetapi tidak wajib. |
| `MEDIA-005` | Galeri umum | Dikerjakan hanya jika waktu cukup. |
| `MEDIA-007` | Poster dan dokumentasi Agenda/Kegiatan | Dapat ditambahkan jika tersedia. |

# 29. Future Enhancements

Hanya enam enhancement berikut yang berstatus `FUTURE`:

| Requirement ID | Future Enhancement |
| --- | --- |
| `DATA-004` | Penambahan Dusun baru di luar struktur awal enam Dusun |
| `FR-020` | QR khusus per Dusun yang langsung membuka halaman Dusun |
| `MEDIA-004` | Galeri beberapa foto untuk satu UMKM |
| `MAP-011` | Pencarian lokasi berdasarkan nama pada peta |
| `MAP-012` | Garis atau bidang batas wilayah Dusun pada peta |
| `OPS-002` | Papan QR kecil di lokasi masing-masing Dusun |

Tidak ada wishlist tambahan pada PRD ini.

# 30. Open Decisions — Non-Blocking

Semua keputusan pada bagian ini berlabel **NON-BLOCKING** dan tidak mengubah scope produk yang telah dibekukan.

## 30.1 Operational

1. **`OPEN-004 — Identitas pemegang Super Admin setelah KKN`** — `NON-BLOCKING`.
2. **`OPEN-005 — Calon Admin Dusun untuk seluruh enam Dusun`** — `NON-BLOCKING`.
3. **`OPEN-006 — Personel atau jabatan supervisor operasional pasca-KKN`** — `NON-BLOCKING`.

## 30.2 Pre-launch

4. **`OPEN-001 — Nama resmi keenam Dusun`** — `NON-BLOCKING`; placeholder A–F tetap digunakan sampai data resmi tersedia.
5. **`OPEN-002 — Redaksi final template pesan awal WhatsApp`** — `NON-BLOCKING`; penggunaan template sudah final.
6. **`OPEN-007 — Hosting/domain, kepemilikan akun, biaya, dan prosedur serah terima final`** — `NON-BLOCKING`.
7. **`OPEN-008 — Konten dan desain visual final papan QR fisik`** — `NON-BLOCKING`.
8. **`OPEN-010 — Mekanisme pemulihan akun Super Admin`** — `NON-BLOCKING`.
9. **`OPEN-011 — Dataset aktual dan placeholder yang tersedia saat peluncuran`** — `NON-BLOCKING`.

## 30.3 R&D

10. **`OPEN-009 — Pemilihan tech stack, database, provider peta portal, dan deployment`** — `NON-BLOCKING`.

Tidak ada Product / Software Blocker yang masih terbuka pada baseline.

# 31. Dependencies & Constraints

| Area | FACT | RISK / DEPENDENCY |
| --- | --- | --- |
| Data awal | Data dikumpulkan Tim KKN bersama perangkat Dusun (`OPS-003`). | Ketersediaan pihak dan kelengkapan data memengaruhi kesiapan konten. |
| Validasi data | Data awal diperiksa bersama Kepala Dusun, Pemerintah Desa, dan Tim KKN (`OPS-004`). | Peluncuran bergantung pada data aktual yang sudah diperiksa; bagian kosong tetap dapat menggunakan empty state. |
| Koordinat | Fasilitas wajib mempunyai koordinat; koordinat UMKM opsional (`MAP-008`, `MAP-009`). | Akurasi koordinat memengaruhi marker dan arah eksternal. |
| Perangkat/koneksi | Pengalaman utama menggunakan smartphone dan harus ringan (`NFR-001`, `NFR-003`). | Media atau halaman berat dapat menghambat akses pada koneksi terbatas. |
| Papan QR | MVP memakai satu papan dan satu QR utama (`OPS-001`). | Entry point fisik bergantung pada tujuan/domain yang tetap dapat diakses. |
| Domain/akun | Arah handover kepada Pemerintah Desa/operator sudah ditetapkan (`OPS-007`). | Provider, ownership, biaya, dan prosedur handover masih `OPEN-007`. |
| Keberlanjutan admin | Pembaruan pasca-KKN dilakukan Admin Dusun dengan supervisi (`OPS-005`). | Belum semua Admin dan supervisor final ditetapkan (`OPEN-005`, `OPEN-006`). |
| Pelatihan/handover | Perangkat desa perlu pelatihan/panduan dan serah terima (`OPS-006`–`OPS-008`). | Kesiapan operasional bergantung pada pelaksanaan kegiatan tersebut. |
| Teknologi | Belum ada tech stack yang disetujui. | Pemilihan teknologi melalui R&D harus mempertimbangkan stabilitas, biaya, dan maintainability tanpa mengubah requirement produk. |
| Struktur Dusun | MVP menggunakan enam Dusun dengan placeholder sampai nama resmi tersedia (`DATA-003`). | Nama resmi masih `OPEN-001`; penambahan Dusun berada di luar MVP. |

# 32. Risks

| Risk Area | Risk | Product Boundary / Mitigation Direction from Baseline |
| --- | --- | --- |
| Data completeness | Konten antar-Dusun dapat tidak lengkap atau tidak seragam saat rilis. | Empty state diperbolehkan; data aktual tetap harus dikumpulkan dan divalidasi. |
| Map accuracy | Koordinat salah menurunkan keandalan marker dan tombol arah. | Fasilitas wajib mempunyai koordinat dan data awal melalui validasi bersama. |
| Privacy | Consent tidak direkam sistem sehingga kepatuhan bergantung pada proses administratif Admin. | `PRIV-001` mewajibkan izin diperoleh sebelum data privat dimasukkan. |
| Direct publishing | Kesalahan data Admin Dusun dapat langsung terlihat publik. | Publikasi langsung adalah keputusan produk; PRD tidak menambahkan workflow approval. |
| Hard delete | Hard delete Super Admin dapat menyebabkan kehilangan data permanen. | Hanya Super Admin dan hanya data selain Dusun; Admin Dusun menggunakan Soft Delete. |
| Admin sustainability | Pembaruan data dapat tidak merata atau berhenti setelah KKN. | Tanggung jawab Admin Dusun, supervisi, pelatihan, dan handover harus disiapkan. |
| Connectivity | Halaman atau media berat dapat menghambat fungsi kritis pada koneksi terbatas. | Produk harus ringan; gambar di-resize dan dikompresi. |
| QR/domain dependency | Perubahan domain atau hilangnya akses akun dapat memutus QR utama. | Ownership dan handover domain/akun harus diselesaikan sebelum operasional. |
| Maintainability | Solusi terlalu kompleks dapat sulit dirawat operator desa. | Tech stack belum dipilih dan harus dievaluasi terhadap maintainability. |
| KKN project scope | Banyak modul MUST meningkatkan risiko hasil yang tidak merata dalam waktu pelaksanaan. | Scope MVP tetap dibekukan; OPTIONAL dan FUTURE tidak boleh menggeser MUST. |
| Arsip Pengumuman | Volume Arsip Pengumuman dapat bertambah karena arsip tetap publik. | Retensi rinci belum ditetapkan; PRD tidak membuat kebijakan baru. |

# 33. Product Success Definition

Keberhasilan produk dinilai secara kualitatif berdasarkan kemampuan yang telah dibekukan, tanpa KPI angka yang belum mempunyai data:

- pengguna dapat memindai QR dan mencapai homepage serta informasi Dusun aktif;
- pengguna dapat menemukan Fasilitas dan UMKM melalui peta sesuai ketersediaan koordinat;
- pengguna dapat membuka arah lokasi melalui Google Maps;
- pengguna dapat menemukan dan menghubungi Kontak Pelayanan melalui WhatsApp;
- pengguna dapat melihat Agenda/Kegiatan dan Pengumuman yang relevan, termasuk Arsip Pengumuman;
- Admin Dusun dapat memperbarui dan mempublikasikan data Dusunnya tanpa mengakses Dusun lain;
- Super Admin dapat mengelola seluruh modul, data tingkat Desa, seluruh Dusun, dan akun Admin Dusun sesuai batas hard delete;
- portal tetap usable dari smartphone dan pada koneksi yang tidak selalu cepat;
- pengelolaan produk dapat dilanjutkan setelah handover kepada Pemerintah Desa/operator.

Referensi baseline: `BR-004`–`BR-007`, `NFR-001`, `NFR-003`, `ROLE-003`–`ROLE-010`, `OPS-005`–`OPS-008`.

# 34. Requirement Traceability

| PRD Section / Feature | Baseline Requirement IDs |
| --- | --- |
| Executive summary, problem, vision, dan goals | `BR-001`–`BR-007` |
| Public Website | `FR-001`, `FR-007`, `FR-009`, `NFR-001`–`NFR-003`, `ROLE-001` |
| Homepage dan Profil Desa | `FR-002`–`FR-004`, `FR-021`, `DATA-001`–`DATA-003` |
| Halaman dan lifecycle Dusun | `FR-005`–`FR-007`, `FR-022`, `DATA-005`, `ROLE-010` |
| Kontak Pelayanan | `FR-010`, `DATA-006`–`DATA-008`, `PRIV-001` |
| UMKM | `FR-011`, `FR-012`, `DATA-009`, `MAP-009`, `MEDIA-003`, `MEDIA-004` |
| Fasilitas | `FR-013`, `DATA-010`–`DATA-013`, `MAP-008`, `MEDIA-001`, `MEDIA-002` |
| Agenda & Kegiatan | `FR-014`–`FR-016`, `DATA-014`, `DATA-015`, `DATA-017`, `MEDIA-007` |
| Pengumuman | `FR-008`, `FR-017`, `FR-018`, `DATA-016` |
| Peta Desa/Dusun | `MAP-001`–`MAP-012`, `FR-022`, `PRIV-001` |
| QR Product Experience | `BR-003`, `FR-020`, `OPS-001`, `OPS-002` |
| Admin Dusun | `ROLE-002`–`ROLE-007`, `FR-019`, `SEC-003`, `SEC-008`, `SEC-009` |
| Super Admin | `ROLE-008`–`ROLE-011`, `SEC-007`–`SEC-009` |
| Authentication dan access control | `FR-001`, `ROLE-001`, `ROLE-004`, `ROLE-008`, `SEC-001`–`SEC-003`, `SEC-008` |
| Media/Image | `MEDIA-001`–`MEDIA-007` |
| Privacy dan publication | `PRIV-001`, `MAP-010`, `DATA-007`, `DATA-008`, `DATA-012` |
| Product security | `SEC-001`–`SEC-009` |
| Non-functional requirements | `NFR-001`–`NFR-004`, `MEDIA-006` |
| Data collection, validation, dan handover | `OPS-003`–`OPS-008` |
| Optional items | `DATA-002`, `DATA-006`, `DATA-008`, `DATA-010`, `DATA-012`, `DATA-015`, `DATA-017`, `MAP-009`, `MAP-010`, `MEDIA-001`, `MEDIA-003`, `MEDIA-005`, `MEDIA-007` |
| Future enhancements | `DATA-004`, `FR-020`, `MEDIA-004`, `MAP-011`, `MAP-012`, `OPS-002` |

# 35. Product Acceptance / PRD Review Checklist

- [x] Product problem terdefinisi tanpa klaim riset pengguna yang tidak tersedia.
- [x] Target users konsisten dengan tiga role pada baseline.
- [x] MVP Scope tidak berubah.
- [x] Seluruh 13 item `OPTIONAL` tetap opsional.
- [x] Seluruh 6 enhancement `FUTURE` tetap berada di luar MVP.
- [x] Tidak ada fitur atau wishlist baru.
- [x] Role dan permission Admin Dusun serta Super Admin konsisten.
- [x] Tidak ada manual ordering pada MVP.
- [x] Peta Desa/Dusun dan aturan koordinat konsisten.
- [x] Homepage tetap data-driven dan tidak menggunakan page builder.
- [x] Arsip Pengumuman dibedakan dari Nonaktif / Soft Delete.
- [x] Lifecycle Agenda/Kegiatan hanya menggunakan Akan Datang, Berlangsung, dan Selesai.
- [x] Aturan Dusun tidak aktif konsisten tanpa menentukan desain halaman.
- [x] Out-of-scope jelas dan tidak kembali masuk MVP.
- [x] Sepuluh Open Decisions tetap `NON-BLOCKING`.
- [x] `NO TECH STACK HAS BEEN APPROVED` dan tidak ada keputusan teknis tersembunyi.
- [x] Tidak ada schema database, ERD, sitemap, detailed user flow, SRS, technical architecture, wireframe, desain UI, test plan, atau kode.
- [x] Traceability feature-level ke `BR`, `FR`, `NFR`, `DATA`, `MAP`, `MEDIA`, `ROLE`, `SEC`, `PRIV`, dan `OPS` tersedia.
- [x] Tidak ada perbedaan yang memerlukan `BASELINE CHANGE REQUEST`.
- [x] PRD telah melalui human review.
- [x] PRD ditetapkan sebagai Version 1.0 — FROZEN FOR MVP.
