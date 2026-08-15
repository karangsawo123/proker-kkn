# Requirements Baseline — Portal Informasi Desa Bendung

## 1. Document Information

| Field | Value |
| --- | --- |
| Project Name | Portal Informasi Desa Bendung |
| Document | Requirements Baseline |
| Version | 1.0 |
| Status | FROZEN FOR MVP |
| Source Documents | `pertanyaan.md`; `pertanyaan-lanjutan.md`; `pertanyaan-ambigu.md` |

Dokumen ini menstrukturkan keputusan yang tercatat dalam tiga dokumen sumber dan membekukan scope MVP. Untuk topik Q47–Q56, `pertanyaan-ambigu.md` adalah keputusan terbaru dan menggantikan keputusan lama hanya pada topik yang terkait. Dokumen ini bukan PRD, sitemap, user flow, ERD, SRS, keputusan arsitektur, test plan, desain UI, ataupun schema database.

Aturan pembacaan status:

- `CONFIRMED`: keputusan telah ditetapkan dan masuk baseline MVP, termasuk batasan eksplisit MVP.
- `OPTIONAL`: kapabilitas didukung atau data dapat digunakan, tetapi keberadaannya tidak wajib.
- `FUTURE`: tidak masuk MVP dan hanya dicatat untuk pengembangan setelah versi awal.
- `OPEN`: keputusan belum final; setiap item dibedakan sebagai blocker produk/software atau keputusan operasional non-blocking.
- `RESOLVED`: ambiguity telah memperoleh keputusan manusia final dan dipertahankan sebagai decision log.

Konvensi penghitungan: jumlah requirement `CONFIRMED`, `OPTIONAL`, dan `FUTURE` dihitung dari satu baris per ID unik pada Bagian 32. Jumlah `OPEN` dihitung dari keputusan pada Bagian 29. Bagian 30 menghitung ambiguity `RESOLVED` dan ambiguity yang masih unresolved secara terpisah.

## 2. Product Overview

Portal Informasi Desa Bendung adalah website informasi publik untuk identitas Desa Bendung dan enam dusunnya, kontak pelayanan, UMKM, fasilitas umum, agenda/kegiatan, pengumuman, serta peta lokasi penting. Gagasan awal terutama berangkat dari kebutuhan petunjuk jalan/peta lokasi penting dan kemudahan menemukan kontak pelayanan warga. Portal pada MVP bersifat informasional; portal tidak menyediakan proses pelayanan warga secara online.

Satu papan fisik utama di Balai Desa memuat satu QR Code yang mengarah ke homepage Desa Bendung. Setelah memindai QR, warga Desa Bendung atau pengunjung dari luar desa dapat memilih salah satu dari enam dusun, melihat informasi yang relevan, menemukan fasilitas dan UMKM pada peta, melihat kegiatan, serta menghubungi kontak pelayanan melalui WhatsApp.

Portal dimaksudkan membantu akses informasi warga dan pengunjung sekaligus membantu perangkat desa menyampaikan dan memperbarui informasi. Konteks penggunaan utama adalah smartphone setelah pemindaian QR, termasuk pada kondisi koneksi internet yang tidak terlalu cepat.

Source: `pertanyaan.md — Q1–Q3, Q23, Q36`; `pertanyaan-lanjutan.md — Q36, Q38–Q41, Q45–Q46`.

## 3. Product Goal

### 3.1 Tujuan utama

**BR-001 — Portal menyediakan satu titik akses informasi publik untuk identitas desa/dusun, kontak pelayanan, UMKM, fasilitas umum, agenda/kegiatan, pengumuman, dan peta lokasi penting.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q1, Q35`.

**BR-002 — Fokus utama produk adalah membantu petunjuk jalan/pencarian lokasi penting dan memudahkan pengguna menemukan kontak pelayanan warga.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q1, Q36`.

### 3.2 Fungsi pendukung

**BR-003 — Papan fisik, QR Code, dan website membentuk satu alur: papan utama di Balai Desa menyediakan QR, QR membuka homepage, lalu pengguna memilih dusun atau informasi yang dibutuhkan.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q23`; `pertanyaan-lanjutan.md — Q39, Q41`.

### 3.3 Hasil yang diharapkan

**BR-004 — Warga dan pengunjung diharapkan dapat memindai QR, memilih dusun, menemukan fasilitas dan UMKM pada peta, melihat kegiatan, serta menemukan nomor kontak pelayanan dengan mudah; portal juga diharapkan membantu perangkat desa.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q36`.

### 3.4 Tiga fungsi paling penting dan tidak boleh gagal

**BR-005 — Akses melalui scan QR dan navigasi antar-dusun harus cepat, mobile-first, dan responsif.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q46`.

**BR-006 — Peta interaktif harus menyajikan lokasi fasilitas umum dan UMKM secara akurat serta menyediakan akses ke navigasi Google Maps.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q46`.

**BR-007 — Direktori Kontak Pelayanan harus membuat kontak warga mudah dihubungi melalui tombol WhatsApp.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q46`.

## 4. Target Users

### 4.1 Public User / Pengunjung

Public User mencakup warga Desa Bendung dan pengunjung dari luar desa. Mereka membutuhkan akses tanpa akun ke homepage desa, pilihan enam dusun, profil, pengumuman, agenda/kegiatan, direktori UMKM, fasilitas, peta, dan Kontak Pelayanan. Konteks utama mereka adalah membuka portal dari smartphone setelah memindai QR.

Source: `pertanyaan.md — Q1–Q3, Q23, Q36`; `pertanyaan-lanjutan.md — Q36, Q41, Q45–Q46`.

### 4.2 Admin Dusun

Admin Dusun adalah pengelola data untuk satu dusun tertentu. Satu dusun dapat memiliki lebih dari satu Admin Dusun. Mereka membutuhkan dashboard yang langsung terkunci pada dusunnya sendiri untuk mengelola profil, kontak pelayanan, UMKM, fasilitas, agenda/kegiatan, dan pengumuman tanpa dapat memilih atau mengelola dusun lain.

Source: `pertanyaan.md — Q25–Q28, Q31`; `pertanyaan-lanjutan.md — Q29–Q33`.

### 4.3 Super Admin

Super Admin adalah pengelola tingkat Desa Bendung dengan hak pengelolaan penuh atas seluruh modul dan seluruh enam dusun. Cakupannya meliputi profil semua Dusun, Kontak Pelayanan, UMKM, Fasilitas, Agenda & Kegiatan, Pengumuman, kategori fasilitas, data tingkat Desa, homepage, akun Admin Dusun, dan data terkait Peta. Identitas pemegang peran ini setelah KKN belum final dan merupakan keputusan operasional non-blocking.

Source: `pertanyaan.md — Q4, Q28–Q30, Q33`; `pertanyaan-lanjutan.md — Q1, Q14, Q20, Q33`; `pertanyaan-ambigu.md — Q47, Q49–Q50, Q55`.

## 5. MVP Scope

| Area | Cakupan MVP | Status | Source |
| --- | --- | --- | --- |
| Homepage Desa | Identitas desa dikelola langsung oleh Super Admin; pilihan Dusun aktif, peta data aktif, agenda terbaru, dan pengumuman aktif ditampilkan otomatis dari modul sumber | `CONFIRMED` | `pertanyaan.md — Q3, Q35`; `pertanyaan-lanjutan.md — Q2, Q4`; `pertanyaan-ambigu.md — Q55` |
| Pilihan Dusun | Struktur awal enam dusun; hanya Dusun aktif tersedia pada pilihan publik | `CONFIRMED` | `pertanyaan.md — Q3, Q23, Q35`; `pertanyaan-lanjutan.md — Q1`; `pertanyaan-ambigu.md — Q50, Q55` |
| Halaman Dusun | Profil, Kepala Dusun, kontak, UMKM, fasilitas, agenda/kegiatan, pengumuman, dan peta dalam halaman utama dusun | `CONFIRMED` | `pertanyaan.md — Q5, Q35`; `pertanyaan-lanjutan.md — Q5–Q7` |
| Profil Desa | Identitas singkat pada homepage; tidak ada halaman khusus Tentang Desa pada MVP | `CONFIRMED` | `pertanyaan-lanjutan.md — Q2–Q3` |
| Profil Dusun | Nama, banner/foto, deskripsi, Kepala Dusun, dan jumlah RT/RW | `CONFIRMED` | `pertanyaan.md — Q6` |
| Kontak Pelayanan | Direktori kontak fleksibel per dusun dengan WhatsApp | `CONFIRMED` | `pertanyaan.md — Q7–Q9, Q35`; `pertanyaan-lanjutan.md — Q8–Q10` |
| UMKM | Direktori UMKM, informasi produk, WhatsApp, dan lokasi jika tersedia; bukan e-commerce | `CONFIRMED` | `pertanyaan.md — Q10–Q11, Q35`; `pertanyaan-lanjutan.md — Q11–Q13` |
| Fasilitas | Direktori fasilitas sesuai kondisi tiap dusun dan seluruh fasilitas terhubung ke peta | `CONFIRMED` | `pertanyaan.md — Q12–Q13, Q35`; `pertanyaan-lanjutan.md — Q14–Q16` |
| Agenda & Kegiatan | Satu modul tingkat dusun/desa dengan lifecycle Akan Datang, Berlangsung, dan Selesai; jam serta media bersifat opsional | `CONFIRMED` | `pertanyaan.md — Q14–Q15, Q35`; `pertanyaan-lanjutan.md — Q17–Q20`; `pertanyaan-ambigu.md — Q51–Q52` |
| Pengumuman | Modul desa dan dusun, tanggal kedaluwarsa, serta Arsip Pengumuman | `CONFIRMED` | `pertanyaan.md — Q16–Q17, Q35`; `pertanyaan-lanjutan.md — Q7, Q21–Q22` |
| Peta Desa/Dusun | Marker data aktif, filter, popup, dan tombol arah; data Dusun nonaktif tidak tampil pada peta publik | `CONFIRMED` | `pertanyaan.md — Q18–Q22, Q35`; `pertanyaan-lanjutan.md — Q23–Q28`; `pertanyaan-ambigu.md — Q50, Q55` |
| Admin Dashboard | Pengelolaan data dusun sendiri, publikasi langsung, serta Nonaktifkan / Soft Delete; tidak ada pengurutan manual atau hard delete | `CONFIRMED` | `pertanyaan.md — Q25–Q28`; `pertanyaan-lanjutan.md — Q29–Q33`; `pertanyaan-ambigu.md — Q47, Q54` |
| Super Admin Dashboard | Pengelolaan penuh seluruh modul, seluruh enam Dusun, data tingkat Desa, homepage, data Peta, dan akun Admin Dusun; termasuk soft delete, restore, serta hard delete data selain entitas Dusun | `CONFIRMED` | `pertanyaan.md — Q4, Q28–Q30`; `pertanyaan-lanjutan.md — Q1, Q14, Q20, Q33`; `pertanyaan-ambigu.md — Q47, Q49–Q50, Q55` |
| QR Entry Point | Satu QR utama di papan Balai Desa menuju homepage | `CONFIRMED` | `pertanyaan.md — Q23`; `pertanyaan-lanjutan.md — Q39, Q41` |

Galeri umum hanya berstatus `OPTIONAL`/tambahan jika waktu cukup. QR per dusun dan kemampuan terkaitnya tidak masuk MVP dan berstatus `FUTURE`.

Source: `pertanyaan.md — Q24, Q35`; `pertanyaan-lanjutan.md — Q13, Q23, Q25, Q39`.

## 6. Public Website Requirements

**FR-001 — Public User dapat mengakses seluruh website publik tanpa login atau akun warga.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q45`.

**NFR-001 — Website menggunakan pendekatan mobile-first, responsif, dan diprioritaskan untuk smartphone setelah scan QR.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q36, Q46`.

**NFR-002 — Bahasa website adalah Bahasa Indonesia saja.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q37`.

**FR-007 — Halaman dusun menyediakan navigasi cepat menuju UMKM, Fasilitas, Peta, Agenda/Kegiatan, dan Kontak.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q5`.

**FR-009 — Jika suatu bagian belum memiliki data, website tetap menampilkan bagian tersebut dengan empty state informatif “Belum ada data”.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q44`.

**NFR-003 — Website diprioritaskan ringan dan cepat dimuat, termasuk bagi pengguna dengan koneksi internet yang tidak terlalu cepat.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q38`.

Akses melalui QR mengikuti alur pada `BR-003` dan `BR-005`. Sumber tidak menetapkan detail layout, komponen visual, atau target performa numerik pada tahap baseline ini.

## 7. Homepage Desa Requirements

**FR-002 — Homepage menampilkan identitas Desa Bendung, foto/banner, deskripsi singkat, pilihan enam dusun, Pengumuman Desa, Peta Desa, kontak kantor desa, dan Agenda/Kegiatan Desa.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q3`; `pertanyaan-lanjutan.md — Q2, Q4`.

**FR-003 — Homepage menonjolkan kombinasi pilihan enam dusun dan Peta Desa Bendung serta menampilkan pengumuman/agenda terbaru.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q3`; `pertanyaan-lanjutan.md — Q4`.

**FR-004 — Super Admin mengelola seluruh informasi homepage: data identitas Desa dikelola langsung, sedangkan pilihan Dusun, Peta Desa, agenda terbaru, dan pengumuman terbaru diambil otomatis dari data aktif pada modul sumber; hasil data-driven tersebut bukan konten statis yang diurutkan atau diedit manual melalui page builder.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q4`; `pertanyaan-lanjutan.md — Q2, Q4`; `pertanyaan-ambigu.md — Q55`.

**FR-021 — Profil Desa pada MVP ditampilkan secara singkat di homepage dan tidak memiliki halaman khusus “Tentang Desa”.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q3`.

**DATA-001 — Data identitas desa yang didukung mencakup nama desa, logo, foto/banner, deskripsi singkat, alamat kantor desa, nomor kontak desa, nama Kepala Desa, dan jam pelayanan kantor desa.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q2`.

**DATA-002 — Email desa dapat ditampilkan jika tersedia.**  
Status: `OPTIONAL`  
Source: `pertanyaan-lanjutan.md — Q2`.

**DATA-003 — Sistem awal menggunakan enam dusun dengan placeholder Dusun A sampai Dusun F sampai nama resmi diisikan.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q1`.

Data identitas Desa yang dikelola langsung meliputi `DATA-001` dan `DATA-002`. Pilihan Dusun mengambil Dusun berstatus aktif; Peta Desa mengambil lokasi, fasilitas, UMKM, dan data peta aktif; agenda terbaru mengambil Agenda/Kegiatan Desa; pengumuman terbaru mengambil Pengumuman Desa aktif.

**FR-022 — Dusun berstatus tidak aktif tidak tampil pada pilihan Dusun di homepage maupun Peta Desa publik, dan URL publik langsung ke Dusun tersebut tidak menampilkan konten publik normal; seluruh data terkait tetap tersimpan, Admin Dusun tetap dapat login dan mengelola data, serta Super Admin dapat mengaktifkan kembali Dusun.**  
Status: `CONFIRMED`  
Source: `pertanyaan-ambigu.md — Q50`.

Baseline tidak menentukan desain halaman atau pesan visual untuk URL Dusun yang tidak aktif.

## 8. Halaman Dusun Requirements

**FR-005 — Setiap halaman dusun menyediakan profil/identitas dusun, Kepala Dusun, Kontak Pelayanan, UMKM, Fasilitas Umum, Agenda & Kegiatan, modul Pengumuman, dan Peta Dusun.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q5, Q35`; `pertanyaan-lanjutan.md — Q7`.

**FR-006 — Halaman dusun menggunakan satu halaman utama model single page/scroll; detail tertentu, seperti rincian UMKM atau agenda, dapat dibuka lebih lanjut.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q6`.

Bagian teratas halaman dusun memuat foto/banner, nama dusun, dan navigasi cepat sebagaimana `FR-007`. Foto tetap mengikuti status opsional pada `MEDIA-001`.

**DATA-005 — Profil dusun mendukung nama dusun, foto/banner, deskripsi singkat, nama Kepala Dusun, jumlah RT, dan jumlah RW.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q6`; `pertanyaan-lanjutan.md — Q5`.

Kepala Dusun tetap ditampilkan sebagai bagian profil. Kepala Dusun tidak otomatis menjadi Kontak Pelayanan; keikutsertaannya mengikuti keputusan masing-masing dusun. Jika konten tertentu kosong, halaman menerapkan `FR-009` dan bukan menyembunyikan seluruh menu.

Source: `pertanyaan-lanjutan.md — Q8, Q44`.

## 9. Kontak Pelayanan Requirements

**DATA-006 — Jenis/jabatan Kontak Pelayanan bersifat fleksibel sesuai orang yang tersedia dan bersedia melayani pada masing-masing dusun; tidak ada daftar jabatan yang wajib sama untuk semua dusun.**  
Status: `OPTIONAL`  
Source: `pertanyaan.md — Q7`; `pertanyaan-lanjutan.md — Q8`.

**DATA-007 — Data inti Kontak Pelayanan mencakup nama, jabatan, nomor WhatsApp, dan status aktif/tidak aktif; setiap kontak yang ditampilkan wajib memiliki nomor WhatsApp.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q8`; `pertanyaan-lanjutan.md — Q9`.

**DATA-008 — Foto Kontak Pelayanan dapat disimpan dan ditampilkan jika tersedia.**  
Status: `OPTIONAL`  
Source: `pertanyaan-lanjutan.md — Q9, Q34`.

**FR-010 — Tombol WhatsApp membuka chat dengan template pesan awal yang menunjukkan bahwa kontak diperoleh dari Portal Desa Bendung.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q10`.

Keterangan jenis pelayanan yang terpisah dari jabatan tidak diperlukan. Redaksi final template WhatsApp belum ditetapkan (`OPEN-002`). Izin publikasi mengikuti mekanisme administratif/offline pada `PRIV-001`.

Source: `pertanyaan.md — Q8–Q9`; `pertanyaan-lanjutan.md — Q10`.

## 10. UMKM Requirements

**FR-011 — Modul UMKM berfungsi sebagai direktori informasi dan kontak WhatsApp, bukan toko online, pemesanan, transaksi, atau pembayaran di dalam portal.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q11`; `pertanyaan-lanjutan.md — Q45`.

**DATA-009 — Sistem mendukung informasi UMKM berupa nama UMKM, nama pemilik, jenis usaha, produk, deskripsi, alamat, nomor WhatsApp, jam operasional, foto, dan lokasi peta jika tersedia.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q10`; `pertanyaan-lanjutan.md — Q12–Q13, Q34`.

**FR-012 — Satu UMKM dapat mencantumkan beberapa produk dalam format list/tags produk tanpa menjadi katalog transaksi.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q11`; diperkuat oleh `pertanyaan.md — Q10–Q11`.

Koordinat UMKM mengikuti `MAP-009`: opsional, dan UMKM tanpa koordinat tetap tampil di direktori. Foto mengikuti `MEDIA-003`: satu foto utama didukung pada MVP tetapi keberadaan foto tidak wajib. Galeri beberapa foto mengikuti `MEDIA-004` dan tidak masuk MVP.

## 11. Fasilitas Requirements

**DATA-010 — Jenis dan keberadaan fasilitas pada setiap dusun mengikuti kondisi nyata setempat; tidak ada kategori yang wajib tersedia di seluruh dusun.**  
Status: `OPTIONAL`  
Source: `pertanyaan.md — Q12`.

Contoh kategori yang disebut sumber meliputi pemerintahan/pelayanan, kesehatan, pendidikan, ibadah, keamanan, lingkungan, olahraga, Balai Dusun, Posyandu, sekolah, PAUD, lapangan, Pos Kamling, Bank Sampah, makam, dan kategori lain yang relevan. Daftar contoh ini bukan daftar tertutup.

**DATA-011 — Data inti fasilitas mencakup nama, kategori, deskripsi, alamat, dan koordinat/peta; sistem juga mendukung foto dan kontak jika tersedia.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q13`; `pertanyaan-lanjutan.md — Q15–Q16, Q34`.

**DATA-012 — Nomor kontak fasilitas tidak wajib tersedia untuk setiap fasilitas.**  
Status: `OPTIONAL`  
Source: `pertanyaan.md — Q13`; `pertanyaan-lanjutan.md — Q16`; `pertanyaan-ambigu.md — Q53`.

**DATA-013 — Kategori fasilitas dikelola secara dinamis; Super Admin dapat menambah dan mengubah kategori.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q14`.

**MAP-008 — Setiap fasilitas wajib mempunyai titik koordinat dan terhubung langsung ke peta.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q15`.

**FR-013 — Jika nomor kontak fasilitas diisi, website menampilkan tombol WhatsApp; nomor kontak tetap opsional dan tidak ada tombol telepon sebagai requirement MVP.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q16`; `pertanyaan-ambigu.md — Q53`.

Foto fasilitas mengikuti aturan umum `MEDIA-001` dan `MEDIA-002`.

## 12. Agenda & Kegiatan Requirements

**FR-014 — Agenda dan dokumentasi kegiatan menggunakan satu modul “Agenda & Kegiatan”.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q14–Q15`.

**DATA-014 — Data inti Agenda & Kegiatan mencakup judul, tanggal mulai/tanggal kegiatan, lokasi, dan deskripsi singkat.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q17, Q19`.

**DATA-015 — Tanggal selesai dapat diisi untuk kegiatan yang berlangsung lebih dari satu hari.**  
Status: `OPTIONAL`  
Source: `pertanyaan-lanjutan.md — Q19`; `pertanyaan-ambigu.md — Q51`.

**DATA-017 — Jam Agenda/Kegiatan bersifat opsional; Agenda/Kegiatan tetap dapat dibuat dan dipublikasikan ketika jam belum tersedia.**  
Status: `OPTIONAL`  
Source: `pertanyaan-ambigu.md — Q52`.

**MEDIA-007 — Foto/poster awal dan dokumentasi foto setelah kegiatan selesai dapat ditambahkan jika tersedia.**  
Status: `OPTIONAL`  
Source: `pertanyaan.md — Q15`; `pertanyaan-lanjutan.md — Q17, Q34`.

**FR-015 — Agenda/Kegiatan memiliki lifecycle `Akan Datang → Berlangsung → Selesai`: tanggal sekarang sebelum tanggal mulai berarti Akan Datang; tanggal sekarang berada pada tanggal/rentang kegiatan berarti Berlangsung; dan tanggal sekarang setelah tanggal selesai berarti Selesai. Jika tanggal selesai kosong, tanggal mulai diperlakukan sebagai tanggal selesai. Admin dapat melakukan override manual bila diperlukan.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q15`; `pertanyaan-lanjutan.md — Q18–Q19`; `pertanyaan-ambigu.md — Q51`.

Untuk kegiatan satu hari, pada hari kegiatan statusnya `Berlangsung` dan setelah hari tersebut statusnya `Selesai`. Foto/poster tetap opsional sesuai `MEDIA-007`.

**FR-016 — Agenda/Kegiatan tingkat dusun dikelola dalam konteks dusun, sedangkan Super Admin dapat mengelola Agenda/Kegiatan tingkat Desa Bendung.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q26, Q30`; `pertanyaan-lanjutan.md — Q20`.

## 13. Pengumuman Requirements

**FR-008 — Modul Pengumuman wajib tersedia sebagai kapabilitas sistem, tetapi setiap dusun tidak wajib memiliki pengumuman aktif setiap saat.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q5, Q35`; `pertanyaan-lanjutan.md — Q7`.

**FR-017 — Pengumuman Desa dan Pengumuman Dusun dibedakan: Pengumuman Desa berlaku untuk seluruh Desa Bendung, sedangkan Pengumuman Dusun ditampilkan pada dusun terkait.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q17`; `pertanyaan-lanjutan.md — Q21`.

**DATA-016 — Pengumuman memiliki tanggal kedaluwarsa sebagai dasar siklus aktif dan arsip.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q16`; `pertanyaan-lanjutan.md — Q22`.

**FR-018 — Sebelum atau pada tanggal kedaluwarsa, pengumuman tampil pada homepage atau halaman dusun terkait; setelah kedaluwarsa, pengumuman turun dari daftar aktif, tetap tersimpan di dashboard, dan tetap dapat dilihat publik pada “Arsip Pengumuman”.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q16`; `pertanyaan-lanjutan.md — Q22`; `pertanyaan-ambigu.md — Q48`.

“Kedaluwarsa” adalah pemicu perpindahan Pengumuman dari daftar aktif ke **Arsip Pengumuman**, bukan penghapusan. Arsip Pengumuman tetap publik dan tersedia pada dashboard. Istilah **Nonaktif / Soft Delete** digunakan untuk data operasional yang disembunyikan dari publik, tetap disimpan, dan dapat dipulihkan. Ketika tidak ada pengumuman aktif, modul tetap tersedia dan menggunakan empty state `FR-009`.

Source: `pertanyaan-ambigu.md — Q48`.

Pengumuman tingkat dusun dikelola Admin Dusun pada dusunnya sendiri, sedangkan Pengumuman Desa berada dalam cakupan Super Admin.

Source: `pertanyaan.md — Q26, Q30`.

## 14. Peta Desa & Peta Dusun Requirements

### 14.1 Konsep peta

**MAP-001 — Peta masuk MVP dan menggunakan satu sumber data lokasi konseptual untuk tampilan Peta Desa dan Peta Dusun.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q18–Q19`.

**MAP-002 — Peta Desa menampilkan titik lokasi aktif dari seluruh Dusun aktif; Peta Dusun aktif otomatis hanya menampilkan titik aktif milik dusun yang sedang dibuka.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q19`; `pertanyaan-ambigu.md — Q50, Q55`.

Konsep “satu sumber data” pada baseline ini hanya menyatakan konsistensi data yang ditampilkan. Baseline tidak menetapkan schema, relasi database, provider, atau library peta.

### 14.2 Marker dan kategori lokasi

**MAP-003 — Marker publik dapat mewakili fasilitas umum, UMKM, dan titik pelayanan masyarakat yang diizinkan untuk dipublikasikan.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q20–Q21`; `pertanyaan-lanjutan.md — Q28`.

**MAP-004 — Admin dapat menentukan lokasi dengan klik langsung pada peta atau input latitude dan longitude secara manual.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q22`.

**MAP-005 — Peta Desa menyediakan filter dusun dan filter kategori lokasi.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q24`.

### 14.3 Popup dan navigasi eksternal

**MAP-006 — Popup marker menampilkan nama, kategori, foto, alamat, tombol “Lihat Detail”, dan tombol “Buka Arah/Navigasi”; deskripsi singkat tidak ditampilkan pada popup.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q26`.

Jika foto tidak tersedia, aturan placeholder pada `MEDIA-002` berlaku.

**MAP-007 — Tombol arah membuka Google Maps sebagai layanan navigasi eksternal; portal tidak membuat routing/navigasi sendiri.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q26–Q27, Q45–Q46`.

Google Maps pada requirement ini adalah tujuan tombol navigasi eksternal, bukan keputusan provider/base map untuk peta portal.

### 14.4 Aturan koordinat

`MAP-008` mewajibkan koordinat untuk setiap fasilitas.

**MAP-009 — Koordinat UMKM bersifat opsional; UMKM tanpa koordinat tetap tampil di direktori tetapi tidak dapat ditampilkan sebagai marker sampai koordinat tersedia.**  
Status: `OPTIONAL`  
Source: `pertanyaan-lanjutan.md — Q12`.

**MAP-010 — Titik lokasi Kontak Pelayanan atau rumah pribadi hanya dapat ditampilkan jika relevan sebagai lokasi pelayanan dan pemilik/orang terkait bersedia atau memberikan izin publikasi.**  
Status: `OPTIONAL`  
Source: `pertanyaan.md — Q20–Q21`; `pertanyaan-lanjutan.md — Q28`.

### 14.5 Pengembangan peta di luar MVP

**MAP-011 — Pencarian lokasi berdasarkan nama disiapkan sebagai kemungkinan pengembangan setelah MVP; filter dianggap cukup untuk MVP.**  
Status: `FUTURE`  
Source: `pertanyaan-lanjutan.md — Q25`.

**MAP-012 — Garis atau bidang batas wilayah dusun tidak masuk MVP dan menjadi pengembangan setelah versi awal.**  
Status: `FUTURE`  
Source: `pertanyaan-lanjutan.md — Q23`.

## 15. QR Requirements

### 15.1 Requirement software

Satu QR utama mengarah ke homepage Desa Bendung. Alur perangkat lunaknya adalah `scan QR → homepage Desa Bendung → pilih salah satu dari enam dusun`. Tujuan ini mengikuti `BR-003` dan tidak mengunci domain sebelum keputusan hosting/domain final.

Source: `pertanyaan.md — Q23`; `pertanyaan-lanjutan.md — Q41`.

**FR-020 — QR khusus per dusun yang langsung membuka halaman dusun tidak dibuat pada MVP, tetapi dicatat sebagai kapabilitas pengembangan berikutnya.**  
Status: `FUTURE`  
Source: `pertanyaan.md — Q24, Q35`.

### 15.2 Artefak fisik

**OPS-001 — Proyek fisik menggunakan satu papan utama Desa Bendung di Balai Desa dengan satu QR utama.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q39, Q41`.

**OPS-002 — Papan QR kecil di depan rumah Kepala Dusun atau Balai Dusun dapat dipertimbangkan setelah versi awal.**  
Status: `FUTURE`  
Source: `pertanyaan-lanjutan.md — Q39`.

Konten cetak dan desain visual papan bukan requirement UI website dan masih `OPEN-008`. Lokasi alternatif papan kecil juga belum perlu diputuskan untuk MVP.

## 16. Role & Permission Requirements

### 16.1 Public User

**ROLE-001 — Public User hanya melihat informasi publik dan menggunakan navigasi, peta, tombol detail, serta tombol kontak; Public User tidak memiliki akun atau akses pengelolaan data pada MVP.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q2`; `pertanyaan-lanjutan.md — Q45`.

### 16.2 Admin Dusun

**ROLE-002 — Satu dusun dapat mempunyai lebih dari satu Admin Dusun.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q25`.

**ROLE-003 — Admin Dusun dapat membuat, melihat, dan mengubah profil dusun, Kontak Pelayanan, UMKM, Fasilitas, Agenda/Kegiatan, dan Pengumuman hanya untuk dusunnya sendiri.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q26–Q27`; `pertanyaan-lanjutan.md — Q29`.

**ROLE-004 — Setelah login, Admin Dusun langsung masuk ke dashboard dusunnya dan tidak dapat memilih atau mengakses data dusun lain.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q31`.

**ROLE-005 — Admin Dusun tidak dapat membuat akun Admin Dusun lain; akun Admin Dusun hanya dibuat oleh Super Admin.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q28`.

**ROLE-006 — Admin Dusun tidak dapat melakukan hard delete; Admin Dusun hanya dapat melakukan Nonaktifkan / Soft Delete terhadap data operasional pada dusunnya sendiri sehingga data tidak tampil publik, tetap tersimpan, dan dapat dipulihkan.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q29`; `pertanyaan-ambigu.md — Q47–Q48`.

**ROLE-007 — Admin Dusun tidak mengatur urutan prioritas secara manual; seluruh daftar menggunakan pengurutan otomatis/default sistem.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q30` (superseded untuk keputusan pengurutan manual); `pertanyaan-ambigu.md — Q54`.

MVP tidak memerlukan drag and drop, field prioritas manual, tombol naik/turun urutan, atau featured order manual. Algoritma sorting per daftar belum ditetapkan dan dapat dirinci pada tahap UX/SRS bila diperlukan.

**FR-019 — Penambahan atau perubahan informasi oleh Admin Dusun langsung tampil pada website tanpa persetujuan Super Admin terlebih dahulu.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q27`.

### 16.3 Super Admin

**ROLE-008 — Super Admin memiliki hak pengelolaan penuh atas profil seluruh Dusun, Kontak Pelayanan, UMKM, Fasilitas, Agenda & Kegiatan, Pengumuman, kategori fasilitas, data tingkat Desa, homepage, akun Admin Dusun, dan data terkait Peta pada seluruh enam Dusun. Hak ini mencakup melihat, membuat, mengubah, mengaktifkan/menonaktifkan, soft delete, dan restore, serta hard delete sesuai `SEC-009`.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q30`; `pertanyaan-ambigu.md — Q47, Q49, Q55`.

**ROLE-009 — Super Admin dapat membuat dan menghapus akun Admin Dusun serta mereset password Admin Dusun.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q28, Q30`; `pertanyaan-lanjutan.md — Q33`; `pertanyaan-ambigu.md — Q49`.

**ROLE-010 — Super Admin dapat mengubah nama Dusun, mengedit informasi/profil Dusun, serta mengaktifkan atau menonaktifkan Dusun; dampak status tidak aktif mengikuti `FR-022`.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q1`; `pertanyaan-ambigu.md — Q50`.

**ROLE-011 — Dalam cakupan pengelolaan penuhnya, Super Admin dapat menambah/mengubah kategori fasilitas serta mengelola data tingkat Desa, termasuk Agenda/Kegiatan Desa dan Pengumuman Desa.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q14, Q20`; `pertanyaan-ambigu.md — Q49`.

Admin Dusun dan Super Admin sama-sama dapat mengedit profil Dusun sesuai cakupan masing-masing: Admin Dusun hanya pada dusunnya sendiri, sedangkan Super Admin lintas seluruh Dusun. Hanya Super Admin yang ditetapkan dapat mengaktifkan/menonaktifkan entitas Dusun.

## 17. Authentication Requirements

**SEC-008 — Login admin menggunakan username dan password; jika Admin Dusun lupa password, Super Admin melakukan reset langsung melalui panel admin.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q32–Q33`.

Tidak ada self-service password reset melalui email atau WhatsApp untuk Admin Dusun dalam MVP. Tidak ada login warga (`FR-001`). Mekanisme pemulihan akun Super Admin belum dijelaskan (`OPEN-010`). Kebijakan panjang/kompleksitas password dan masa sesi tidak ditetapkan oleh source dan tidak dibuat pada baseline ini.

## 18. Media & Image Requirements

**MEDIA-001 — Foto bersifat opsional untuk semua jenis data.**  
Status: `OPTIONAL`  
Source: `pertanyaan.md — Q5`; `pertanyaan-lanjutan.md — Q34`.

**MEDIA-002 — Jika foto tidak tersedia, sistem menggunakan default placeholder atau ilustrasi yang rapi sesuai kategori.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q34–Q35`.

**MEDIA-003 — Pada MVP, satu UMKM dapat menggunakan satu foto utama; keberadaan foto tersebut tetap opsional.**  
Status: `OPTIONAL`  
Source: `pertanyaan-lanjutan.md — Q13, Q34`.

**MEDIA-004 — Galeri beberapa foto untuk satu UMKM tidak masuk MVP dan menjadi pengembangan setelah versi awal.**  
Status: `FUTURE`  
Source: `pertanyaan-lanjutan.md — Q13`.

**MEDIA-005 — Galeri umum dapat dikerjakan hanya jika waktu cukup.**  
Status: `OPTIONAL`  
Source: `pertanyaan.md — Q35`.

**MEDIA-006 — Gambar unggahan dioptimalkan otomatis melalui resize dan kompresi serta dikonversi ke format gambar web modern; SVG digunakan hanya untuk aset vektor seperti logo dan ikon.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q38`.

`WebP` disebut sebagai contoh format modern dalam source, bukan keputusan library pemrosesan gambar. Baseline tidak memilih library atau pipeline implementasi.

## 19. Data Requirements

Entitas/data konseptual berikut dibutuhkan oleh requirement. Daftar ini bukan ERD dan tidak menetapkan primary key, foreign key, tipe kolom, schema SQL, index, atau relasi teknis.

| Entitas/data konseptual | Informasi yang didukung | Source utama |
| --- | --- | --- |
| Desa | Identitas Desa Bendung, kontak kantor, jam pelayanan, media | `pertanyaan-lanjutan.md — Q2` |
| Dusun | Enam dusun awal, nama, status aktif, profil, Kepala Dusun, jumlah RT/RW | `pertanyaan.md — Q5–Q6`; `pertanyaan-lanjutan.md — Q1` |
| Admin/User | Akun Super Admin dan satu atau lebih Admin Dusun; tidak ada akun warga | `pertanyaan.md — Q25–Q30`; `pertanyaan-lanjutan.md — Q31–Q33, Q45` |
| Kontak Pelayanan | Nama, jabatan, WhatsApp, foto opsional, status aktif | `pertanyaan.md — Q7–Q9`; `pertanyaan-lanjutan.md — Q8–Q10` |
| UMKM | Identitas usaha/pemilik, jenis usaha, deskripsi, alamat, WhatsApp, jam operasional, foto/lokasi opsional | `pertanyaan.md — Q10–Q11`; `pertanyaan-lanjutan.md — Q12–Q13` |
| Produk UMKM | Beberapa nama produk dalam bentuk list/tags | `pertanyaan-lanjutan.md — Q11` |
| Fasilitas | Nama, kategori, deskripsi, alamat, koordinat, foto/kontak opsional | `pertanyaan.md — Q12–Q13`; `pertanyaan-lanjutan.md — Q15–Q16` |
| Kategori Fasilitas | Kategori dinamis yang dapat ditambah/diubah Super Admin | `pertanyaan-lanjutan.md — Q14` |
| Agenda/Kegiatan | Judul, deskripsi, tanggal mulai, tanggal selesai opsional, jam opsional, lokasi, status lifecycle, media opsional | `pertanyaan.md — Q14–Q15`; `pertanyaan-lanjutan.md — Q17–Q20`; `pertanyaan-ambigu.md — Q51–Q52` |
| Pengumuman | Scope desa/dusun, masa aktif/kedaluwarsa, status aktif, Arsip Pengumuman | `pertanyaan.md — Q16–Q17`; `pertanyaan-lanjutan.md — Q21–Q22` |
| Media | Logo, banner, foto utama, poster, dokumentasi, placeholder/ilustrasi | `pertanyaan-lanjutan.md — Q2, Q13, Q17, Q34–Q38` |
| Lokasi/Koordinat | Latitude/longitude dan konteks lokasi untuk marker fasilitas, UMKM, atau pelayanan yang diizinkan | `pertanyaan.md — Q18–Q22`; `pertanyaan-lanjutan.md — Q12, Q15, Q23–Q28` |

Aturan konseptual penting:

- fasilitas wajib memiliki koordinat (`MAP-008`);
- UMKM dapat ada tanpa koordinat (`MAP-009`);
- lokasi pelayanan/rumah pribadi hanya dapat dipublikasikan dengan izin (`MAP-010`);
- jam Agenda/Kegiatan tidak wajib untuk membuat atau mempublikasikan data (`DATA-017`);
- foto pada seluruh entitas tetap opsional (`MEDIA-001`);
- data kosong tidak menghalangi peluncuran dan menggunakan empty state (`FR-009`).

**DATA-004 — Kemampuan menambah dusun baru di luar enam dusun awal tidak masuk MVP.**  
Status: `FUTURE`  
Source: `pertanyaan-lanjutan.md — Q1`.

## 20. Non-Functional Requirements

Selain `NFR-001` sampai `NFR-003`, berlaku requirement berikut.

**NFR-004 — Solusi akhir harus stabil, ringan, mudah dikembangkan, dan mudah dirawat oleh operator desa dalam jangka panjang.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Catatan Tambahan Kelompok, butir 2`.

Interpretasi kualitas tanpa menambah target baru:

- **Usability:** navigasi cepat (`FR-007`), Bahasa Indonesia (`NFR-002`), empty state ramah pengguna (`FR-009`), dan tombol kontak langsung (`FR-010`) adalah keputusan tersurat.
- **Reliability:** tiga fungsi pada `BR-005`–`BR-007` dinyatakan tidak boleh gagal; peta juga dituntut akurat. Source tidak menetapkan SLA, uptime, atau angka toleransi kesalahan.
- **Performance:** website harus ringan dan cepat, tetapi source tidak memberikan target detik, ukuran bundle, atau skor audit.
- **Maintainability:** kriteria ada pada `NFR-004`, tetapi tech stack belum dipilih.
- **Accessibility:** source tidak menetapkan standar atau tingkat aksesibilitas tertentu; baseline tidak membuat requirement aksesibilitas baru.

## 21. Security Requirements

**SEC-001 — Otentikasi login admin harus diamankan.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Catatan Tambahan Kelompok, butir 1`.

**SEC-002 — Password harus disimpan menggunakan hashing yang kuat.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Catatan Tambahan Kelompok, butir 1`.

`bcrypt` dan `Argon2` hanya contoh kandidat yang disebut sumber; baseline tidak memilih algoritma/library final.

**SEC-003 — Role-Based Access Control harus membatasi Admin Dusun hanya pada data dusunnya sendiri.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q26`; `pertanyaan-lanjutan.md — Q31, Catatan Tambahan Kelompok butir 1`.

**SEC-004 — Sistem harus memiliki perlindungan terhadap SQL injection.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Catatan Tambahan Kelompok, butir 1`.

**SEC-005 — Sistem harus memiliki perlindungan terhadap XSS.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Catatan Tambahan Kelompok, butir 1`.

**SEC-006 — Sistem harus menerapkan rate limiting untuk melindungi login dari serangan brute force.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Catatan Tambahan Kelompok, butir 1`.

**SEC-007 — Hard delete entitas Dusun tidak tersedia pada UI agar data terkait tidak hilang akibat salah klik.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q1`; `pertanyaan-ambigu.md — Q47`.

**SEC-009 — Admin Dusun tidak memiliki kewenangan hard delete. Super Admin dapat melakukan hard delete permanen terhadap data selain entitas Dusun; operasi ini berisiko tinggi karena data yang dihapus permanen tidak mengikuti mekanisme restore Soft Delete.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q29`; `pertanyaan-ambigu.md — Q47`.

Source menetapkan hasil perlindungan terhadap SQL injection dan XSS, tetapi tidak menetapkan implementasi final. Input validation/sanitization dapat dievaluasi sebagai bagian mekanisme perlindungan pada tahap specification/R&D, namun tidak ditetapkan di sini sebagai satu-satunya solusi atau library tertentu. Baseline tidak menetapkan desain modal konfirmasi, audit log, backup policy, atau mekanisme teknis hard delete; detail tersebut dapat dibahas pada SRS/R&D.

## 22. Data Privacy & Publication

Aturan publikasi yang telah diputuskan:

**PRIV-001 — Untuk MVP, persetujuan publikasi nomor WhatsApp, foto personal, rumah pribadi, dan lokasi privat dilakukan secara administratif/offline. Admin bertanggung jawab memastikan izin publikasi telah diperoleh sebelum memasukkan data privat ke sistem. Sistem tidak menyediakan field consent Ya/Tidak, upload surat persetujuan, digital consent management, atau workflow approval consent.**  
Status: `CONFIRMED`  
Source: `pertanyaan-ambigu.md — Q56`.

- Setiap Kontak Pelayanan yang ditampilkan kepada publik wajib mencantumkan nomor WhatsApp. Source menyatakan nomor tersebut boleh ditampilkan secara publik.  
  Source: `pertanyaan.md — Q8`.
- Jenis Kontak Pelayanan mengikuti siapa yang tersedia dan bersedia melayani pada masing-masing dusun. Kepala Dusun tidak otomatis menjadi kontak.  
  Source: `pertanyaan.md — Q7`; `pertanyaan-lanjutan.md — Q8`.
- Fasilitas dapat memiliki nomor kontak jika tersedia; tombol kontak hanya muncul jika nomor diisi.  
  Source: `pertanyaan.md — Q13`; `pertanyaan-lanjutan.md — Q16`.
- Data UMKM yang ditampilkan dapat mencakup nama pemilik, alamat, nomor WhatsApp, dan lokasi jika tersedia.  
  Source: `pertanyaan.md — Q10`; `pertanyaan-lanjutan.md — Q12`.
- Rumah pribadi perangkat desa/Ketua RT/Kepala Dusun sebaiknya tidak ditampilkan kecuali memang diperlukan dan pemilik telah memberikan izin.  
  Source: `pertanyaan.md — Q20–Q21`.
- Lokasi Kontak Pelayanan hanya ditambahkan ke peta jika pihak yang bersangkutan bersedia atau mengizinkan publikasi lokasi.  
  Source: `pertanyaan-lanjutan.md — Q28`.
- Foto merupakan informasi opsional dan dapat diganti placeholder jika tidak tersedia.  
  Source: `pertanyaan-lanjutan.md — Q34–Q35`.

Mekanisme administratif/offline berada di luar fitur software MVP. Prinsip privasi yang berlaku adalah: **“Admin bertanggung jawab memastikan izin publikasi telah diperoleh sebelum memasukkan data privat ke sistem.”**

## 23. Admin Data Management

### 23.1 Create, read, update, dan publikasi

- Admin Dusun dapat menambah dan mengubah data pada modul dusunnya sendiri (`ROLE-003`).
- Perubahan Admin Dusun langsung tampil tanpa approval Super Admin (`FR-019`).
- Super Admin memiliki pengelolaan penuh lintas seluruh Dusun dan modul sesuai `ROLE-008`.

### 23.2 Status aktif dan pengurutan otomatis

- Kontak Pelayanan memiliki status aktif/tidak aktif (`DATA-007`).
- Super Admin dapat mengaktifkan/menonaktifkan Dusun (`ROLE-010`), dengan dampak publik, data, dan akses admin yang ditetapkan pada `FR-022`.
- Seluruh daftar menggunakan pengurutan otomatis/default sistem; Admin Dusun tidak memiliki pengurutan manual (`ROLE-007`).

### 23.3 Penghapusan, Nonaktif / Soft Delete, dan Arsip Pengumuman

- Admin Dusun hanya dapat melakukan Nonaktifkan / Soft Delete; data disembunyikan dari publik, tetap disimpan, dan dapat dipulihkan (`ROLE-006`).
- Super Admin dapat melakukan soft delete dan restore seluruh data, serta hard delete permanen terhadap data selain entitas Dusun (`ROLE-008`, `SEC-009`).
- Hard delete entitas Dusun ditiadakan dari UI (`SEC-007`).
- Pengumuman kedaluwarsa tetap dapat dilihat publik dalam **Arsip Pengumuman** (`FR-018`); istilah arsip tidak digunakan untuk Soft Delete data operasional.

### 23.4 Data kosong

Website boleh diluncurkan dengan data yang belum lengkap. Bagian tanpa data menampilkan empty state `FR-009`. Modul Pengumuman tetap ada walaupun tidak mempunyai data aktif (`FR-008`).

Risiko hard delete permanen dan batas visibilitas masing-masing status dicatat pada Bagian 31.

## 24. Initial Data Collection & Validation

**OPS-003 — Data awal dikumpulkan bersama oleh Tim KKN dan perangkat dusun, termasuk Kepala Dusun, RT, dan RW setempat.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q42`.

**OPS-004 — Sebelum rilis publik, data awal diperiksa bersama oleh Kepala Dusun, Pemerintah Desa, dan Tim KKN.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Q43`.

Source tidak menetapkan form, urutan approval teknis, bukti validasi, atau siapa yang memberi keputusan terakhir ketika pemeriksa berbeda pendapat. Baseline tidak membuat workflow tersebut. Website tetap boleh diluncurkan dengan bagian data kosong sepanjang menggunakan empty state, tetapi data aktual yang tersedia saat rilis masih perlu diinventarisasi (`OPEN-011`).

## 25. Post-KKN Operations & Maintenance

**OPS-005 — Setelah KKN, Admin Dusun masing-masing memperbarui data dengan supervisi Perangkat Desa, Sekretaris Desa, atau Operator Desa.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q31`.

Peran/personel supervisor final belum dipilih (`OPEN-006`). Baru beberapa dusun memiliki calon admin, termasuk kemungkinan Kepala Dusun; ketersediaan calon untuk seluruh enam dusun belum final (`OPEN-005`).

**OPS-006 — Perangkat desa harus menerima pelatihan dan/atau panduan penggunaan dashboard.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q34`.

**OPS-007 — Arah serah terima hosting, domain, dan akun Super Admin adalah kepada Pemerintah Desa/operator desa setelah KKN.**  
Status: `CONFIRMED`  
Source: `pertanyaan.md — Q33`.

**OPS-008 — Solusi hosting/domain harus handal, efisien atau hemat biaya, dan memiliki prosedur serah terima akun yang jelas serta mudah dipahami Pemerintah Desa.**  
Status: `CONFIRMED`  
Source: `pertanyaan-lanjutan.md — Catatan Tambahan Kelompok, butir 3`.

Pemegang individu Super Admin (`OPEN-004`) dan rincian provider, kepemilikan akun/domain, biaya, serta prosedur handover (`OPEN-007`) belum final. Proses serah terima setidaknya perlu mencakup akun yang dirujuk source, pelatihan/panduan, dan tanggung jawab pembaruan, tetapi bentuk dokumen/prosedur akhirnya tidak dibuat dalam baseline ini.

## 26. Explicit Non-Goals / Out of Scope

Fitur berikut secara eksplisit tidak masuk MVP:

- pengajuan surat online;
- formulir atau proses pengaduan warga;
- pendaftaran/pelayanan warga secara online;
- akun atau login warga;
- chat internal dengan perangkat desa;
- transaksi atau e-commerce UMKM;
- pemesanan dan pembayaran online;
- GPS tracking;
- navigasi/routing buatan portal sendiri;
- forum warga;
- notifikasi aplikasi;
- halaman khusus “Tentang Desa” pada MVP.

Source: `pertanyaan.md — Q2, Q11`; `pertanyaan-lanjutan.md — Q3, Q45`.

Batasan ini tidak meniadakan:

- informasi beberapa produk dalam format list/tags pada direktori UMKM (`FR-012`);
- tombol yang membuka WhatsApp eksternal (`FR-010`);
- tombol yang membuka Google Maps untuk arah/rute eksternal (`MAP-007`).

Pelayanan online dan halaman khusus Tentang Desa tidak otomatis dicatat sebagai `FUTURE`, karena source hanya menetapkannya di luar MVP/tidak diperlukan untuk MVP dan tidak menyatakan komitmen pengembangan berikutnya.

## 27. Future / Possible Enhancements

Hanya pengembangan yang dinyatakan secara eksplisit dalam source yang dicatat:

1. **`DATA-004` — Penambahan dusun baru**, di luar struktur awal enam dusun.  
   Status: `FUTURE`  
   Source: `pertanyaan-lanjutan.md — Q1`.
2. **`FR-020` — QR khusus per dusun** yang langsung membuka halaman dusun.  
   Status: `FUTURE`  
   Source: `pertanyaan.md — Q24, Q35`.
3. **`MEDIA-004` — Galeri beberapa foto untuk satu UMKM.**  
   Status: `FUTURE`  
   Source: `pertanyaan-lanjutan.md — Q13`.
4. **`MAP-011` — Pencarian lokasi berdasarkan nama pada peta.**  
   Status: `FUTURE`  
   Source: `pertanyaan-lanjutan.md — Q25`.
5. **`MAP-012` — Garis/bidang batas wilayah dusun pada peta.**  
   Status: `FUTURE`  
   Source: `pertanyaan-lanjutan.md — Q23`.
6. **`OPS-002` — Papan QR kecil di lokasi masing-masing dusun.**  
   Status: `FUTURE`  
   Source: `pertanyaan-lanjutan.md — Q39`.

Galeri umum (`MEDIA-005`) tetap `OPTIONAL` untuk MVP jika waktu cukup, bukan `FUTURE` yang pasti. Lokasi papan kecil—rumah Kepala Dusun atau Balai Dusun—belum perlu dipilih sebelum enhancement tersebut dikerjakan.

## 28. Technical Candidates — Not Yet Decided

> **NO TECH STACK HAS BEEN APPROVED YET.**

Seluruh opsi berikut hanya kandidat untuk tahap R&D dan bukan keputusan arsitektur final:

| Area | Kandidat yang disebut source | Fokus evaluasi dari source |
| --- | --- | --- |
| Frontend | Modern HTML/CSS/JavaScript; React/Next.js | Mobile-first, loading di HP, kemudahan pemeliharaan |
| Backend & Auth | Node.js dengan Express; Next.js API Routes | Integrasi middleware keamanan dan role-based access |
| Database | PostgreSQL melalui Supabase/Neon; MySQL/MariaDB | Keandalan cloud versus kompatibilitas cPanel lokal |
| Peta interaktif | Leaflet.js + OpenStreetMap | Ringan dan menghindari biaya API-key billing |
| Hosting & Deployment | Vercel, Netlify, Railway; shared hosting cPanel desa | Stabilitas uptime dan transfer kepemilikan akun |
| Password hashing | bcrypt; Argon2 | Contoh hashing kuat, bukan pilihan final |

Source: `pertanyaan-lanjutan.md — Catatan Tambahan Kelompok dan Opsi Kandidat Solusi Teknis`.

Google Maps telah diputuskan sebagai tujuan tombol navigasi eksternal (`MAP-007`), tetapi bukan sebagai provider/base map portal. Pemilihan frontend, backend, database, ORM, authentication library, provider peta portal, hosting, image library, dan deployment platform belum disetujui dan tetap menjadi kandidat R&D (`OPEN-009`).

## 29. Open Decisions

### A. Product / Software Blockers

**Count: 0.** Tidak ada keputusan terbuka yang menghalangi perilaku software MVP atau pembekuan Requirements Baseline.

### B. Non-Blocking Operational Open Decisions

Seluruh keputusan berikut berstatus `OPEN — NON-BLOCKING`. Item ini harus diselesaikan pada tahap operasional, R&D, atau pre-launch yang sesuai, tetapi tidak menghalangi status `FROZEN FOR MVP`.

### OPEN-001 — Nama resmi keenam dusun

Status: `OPEN — NON-BLOCKING`

Placeholder Dusun A sampai Dusun F masih harus diganti dengan nama resmi.

Source: `pertanyaan-lanjutan.md — Q1`.

### OPEN-002 — Redaksi final template pesan awal WhatsApp

Status: `OPEN — NON-BLOCKING`

Keputusan menggunakan template sudah final, tetapi kalimat pada source hanya contoh. Redaksi final belum ditetapkan.

Source: `pertanyaan-lanjutan.md — Q10`.

### OPEN-004 — Identitas pemegang Super Admin setelah KKN

Status: `OPEN — NON-BLOCKING`

Kemungkinan diserahkan kepada perangkat desa tertentu, tetapi individu atau jabatan final belum ditentukan.

Source: `pertanyaan.md — Q29, Q33`.

### OPEN-005 — Calon Admin Dusun untuk seluruh enam dusun

Status: `OPEN — NON-BLOCKING`

Baru beberapa dusun memiliki calon admin. Penanggung jawab untuk setiap dusun belum lengkap.

Source: `pertanyaan.md — Q32`.

### OPEN-006 — Personel atau jabatan supervisor operasional pasca-KKN

Status: `OPEN — NON-BLOCKING`

Supervisi disebut dapat dilakukan Perangkat Desa, Sekretaris Desa, atau Operator Desa, tetapi pemegang tanggung jawab final belum dipilih.

Source: `pertanyaan.md — Q31`.

### OPEN-007 — Hosting/domain, kepemilikan akun, biaya, dan prosedur serah terima final

Status: `OPEN — NON-BLOCKING`

Arah penyerahan kepada Pemerintah Desa/operator telah ditetapkan, tetapi provider, paket, sumber biaya, nama pemegang akun, kepemilikan domain, dan prosedur handover final masih harus dibahas.

Source: `pertanyaan.md — Q33`; `pertanyaan-lanjutan.md — Catatan Tambahan Kelompok, butir 3`.

### OPEN-008 — Konten dan desain visual final papan QR fisik

Status: `OPEN — NON-BLOCKING`

Nama desa/dusun, petunjuk scan, logo, dan penjelasan portal masih berupa draf usulan. Keputusan akan dibahas oleh divisi/tim PDD.

Source: `pertanyaan-lanjutan.md — Q40`.

### OPEN-009 — Pemilihan tech stack, database, provider peta portal, dan deployment

Status: `OPEN — NON-BLOCKING`

Semua teknologi pada Bagian 28, termasuk provider/deployment platform, hanya kandidat R&D dan belum disetujui.

Source: `pertanyaan-lanjutan.md — Catatan Tambahan Kelompok dan Opsi Kandidat Solusi Teknis`.

### OPEN-010 — Mekanisme pemulihan akun Super Admin

Status: `OPEN — NON-BLOCKING`

Source menetapkan reset password Admin Dusun oleh Super Admin, tetapi tidak menetapkan cara pemulihan bila akun Super Admin sendiri tidak dapat diakses.

Source: `pertanyaan-lanjutan.md — Q33`.

### OPEN-011 — Dataset aktual dan placeholder yang tersedia saat peluncuran

Status: `OPEN — NON-BLOCKING`

Source mengizinkan empty state dan menetapkan proses pengumpulan/validasi, tetapi nama resmi dusun serta daftar aktual kontak, UMKM, fasilitas, agenda, pengumuman, media, dan koordinat yang siap saat rilis belum tersedia dalam dokumen requirement.

Source: `pertanyaan-lanjutan.md — Q1, Q42–Q44`.

## 30. Resolved Ambiguities / Decision Log

**Unresolved Conflict / Ambiguity: 0.** Seluruh ambiguity yang sebelumnya memengaruhi perilaku software telah memperoleh keputusan manusia final.

### AMB-001 — Hard Delete

Status: `RESOLVED`  
Resolution: Admin Dusun hanya dapat Nonaktifkan / Soft Delete. Super Admin dapat melakukan hard delete permanen terhadap data selain entitas Dusun. Entitas Dusun tidak memiliki hard delete dari UI.  
Source: `pertanyaan-ambigu.md — Q47`.

### AMB-002 — Arsip Pengumuman vs Nonaktif / Soft Delete

Status: `RESOLVED`  
Resolution: Arsip Pengumuman berisi pengumuman kedaluwarsa yang tidak lagi aktif tetapi tetap dapat dilihat publik dan tersedia pada dashboard. Nonaktif / Soft Delete digunakan untuk data operasional yang tidak tampil publik, tetap disimpan, dan dapat dipulihkan.  
Source: `pertanyaan.md — Q16`; `pertanyaan-lanjutan.md — Q22, Q29`; `pertanyaan-ambigu.md — Q48`.

### AMB-003 — Hak Pengelolaan Super Admin

Status: `RESOLVED`  
Resolution: Super Admin memiliki hak pengelolaan penuh atas seluruh modul dan seluruh Dusun, termasuk melihat, membuat, mengubah, mengaktifkan/menonaktifkan, soft delete, dan restore, serta hard delete sesuai AMB-001.  
Source: `pertanyaan.md — Q30`; `pertanyaan-ambigu.md — Q47, Q49`.

### AMB-004 — Dusun Tidak Aktif

Status: `RESOLVED`  
Resolution: Dusun tidak aktif tidak tampil pada pilihan homepage maupun Peta Desa publik; URL langsung tidak menampilkan konten publik normal. Seluruh data tetap tersimpan, Admin Dusun tetap dapat login/mengelola data, dan Super Admin dapat mengaktifkan kembali Dusun.  
Source: `pertanyaan-lanjutan.md — Q1, Q31`; `pertanyaan-ambigu.md — Q50`.

### AMB-005 — Lifecycle Agenda & Kegiatan

Status: `RESOLVED`  
Resolution: Lifecycle otomatis adalah Akan Datang, Berlangsung, lalu Selesai berdasarkan tanggal mulai/selesai. Jika tanggal selesai kosong, tanggal mulai juga menjadi tanggal selesai untuk perhitungan status. Admin dapat melakukan override manual.  
Source: `pertanyaan-lanjutan.md — Q18–Q19`; `pertanyaan-ambigu.md — Q51`.

### AMB-006 — Jam Agenda/Kegiatan

Status: `RESOLVED`  
Resolution: Jam bersifat opsional; Agenda/Kegiatan dapat dibuat dan dipublikasikan tanpa jam. Foto/poster tetap opsional.  
Source: `pertanyaan-lanjutan.md — Q17, Q34`; `pertanyaan-ambigu.md — Q52`.

### AMB-007 — Kontak Fasilitas

Status: `RESOLVED`  
Resolution: Jika fasilitas mempunyai nomor kontak, MVP menampilkan tombol WhatsApp saja. Nomor kontak bersifat opsional dan tombol tidak tampil jika nomor tidak tersedia.  
Source: `pertanyaan-lanjutan.md — Q16`; `pertanyaan-ambigu.md — Q53`.

### AMB-008 — Urutan Prioritas

Status: `RESOLVED`  
Resolution: Keputusan manual ordering pada `pertanyaan-lanjutan.md — Q30` telah superseded. Admin Dusun tidak mengatur urutan manual; semua daftar menggunakan pengurutan otomatis/default sistem tanpa menetapkan algoritma sorting detail pada baseline.  
Source: `pertanyaan-lanjutan.md — Q30` (superseded); `pertanyaan-ambigu.md — Q54`.

### AMB-009 — Homepage Data-Driven

Status: `RESOLVED`  
Resolution: Super Admin mengelola data identitas Desa secara langsung dan mengelola sumber data bagi bagian data-driven. Pilihan Dusun, Peta Desa, agenda terbaru, dan pengumuman terbaru mengambil data aktif secara otomatis dari modul sumber; tidak ada page builder atau editing manual atas hasil data-driven.  
Source: `pertanyaan.md — Q3–Q4`; `pertanyaan-lanjutan.md — Q2, Q4`; `pertanyaan-ambigu.md — Q55`.

### Resolved Decision — OPEN-003 Izin Publikasi

Status: `RESOLVED`  
Resolution: Consent dilakukan secara administratif/offline. Admin hanya memasukkan nomor WhatsApp, foto personal, rumah pribadi, atau lokasi privat setelah izin diperoleh; sistem tidak memerlukan field consent, upload surat, digital consent management, atau workflow approval consent.  
Source: `pertanyaan-ambigu.md — Q56`.

Hal-hal berikut telah dinormalisasi oleh source lanjutan dan tidak dihitung sebagai konflik:

- modul Pengumuman wajib, tetapi keberadaan pengumuman aktif per dusun tidak wajib;
- Pengumuman kedaluwarsa berpindah ke Arsip Pengumuman dan tetap publik;
- UMKM tanpa koordinat tetap tampil di direktori;
- foto UMKM opsional, MVP mendukung satu foto, dan galeri multi-foto berstatus `FUTURE`;
- portal tidak membuat routing sendiri, tetapi boleh membuka Google Maps;
- QR per dusun tidak masuk MVP dan berstatus `FUTURE`.

## 31. Risks & Constraints

Tabel berikut memisahkan fakta requirement dari inference/risiko yang harus dipantau.

| Area | Fakta dari requirement | Inference / risk | Source |
| --- | --- | --- | --- |
| Kelengkapan data | Nama dusun masih placeholder; data kosong diperbolehkan; calon admin baru ada di beberapa dusun | Kelengkapan dan kualitas konten antar-dusun dapat tidak seragam saat rilis | `pertanyaan.md — Q32`; `pertanyaan-lanjutan.md — Q1, Q44` |
| Akurasi koordinat | Semua fasilitas wajib memiliki koordinat; peta adalah salah satu fungsi yang tidak boleh gagal | Koordinat salah akan menurunkan keandalan marker dan tombol arah | `pertanyaan-lanjutan.md — Q15, Q46` |
| Izin publikasi | Consent MVP dilakukan administratif/offline dan Admin hanya memasukkan data privat setelah izin diperoleh | Karena sistem tidak merekam consent, kepatuhan bergantung pada disiplin administratif Admin | `pertanyaan.md — Q8, Q20–Q21`; `pertanyaan-lanjutan.md — Q28`; `pertanyaan-ambigu.md — Q56` |
| Keberlanjutan admin | Pemegang Super Admin belum final dan belum semua dusun memiliki calon admin | Pembaruan data pasca-KKN dapat tidak merata atau berhenti | `pertanyaan.md — Q29, Q32` |
| Publikasi langsung | Perubahan Admin Dusun langsung tampil tanpa review Super Admin | Kesalahan data atau konten yang belum layak publik dapat segera terlihat | `pertanyaan.md — Q27` |
| Integritas data | Admin Dusun hanya dapat Soft Delete; Super Admin dapat hard delete data selain Dusun; entitas Dusun tidak dapat di-hard-delete dari UI | Hard delete oleh Super Admin adalah operasi berisiko tinggi karena menghapus data secara permanen | `pertanyaan-lanjutan.md — Q1, Q29`; `pertanyaan-ambigu.md — Q47` |
| Koneksi pengguna | Pengguna utama membuka website lewat smartphone dan sebagian koneksi mungkin lambat | Media atau halaman yang berat dapat menghambat tiga fungsi kritis | `pertanyaan-lanjutan.md — Q36, Q38, Q46` |
| QR dan domain | Satu QR fisik utama mengarah ke homepage; kepemilikan hosting/domain belum final | Perubahan domain atau hilangnya akses akun setelah papan dicetak dapat memutus entry point utama | `pertanyaan-lanjutan.md — Q39, Q41`; `pertanyaan.md — Q33` |
| Maintainability | Stack harus stabil, ringan, mudah dirawat; pilihan teknis belum final | Stack yang terlalu kompleks dapat menyulitkan operator desa setelah handover | `pertanyaan-lanjutan.md — Catatan Tambahan Kelompok, butir 2–3` |
| Scope pelaksanaan | Banyak modul ditetapkan wajib dalam periode KKN | Luas scope meningkatkan risiko kualitas tidak merata jika waktu/data terbatas | `pertanyaan.md — Q35` |
| Arsip | Pengumuman kedaluwarsa tetap disimpan dan dapat dilihat publik | Retensi dan volume arsip jangka panjang belum ditetapkan | `pertanyaan-lanjutan.md — Q22` |

Constraints yang telah ditetapkan meliputi struktur awal enam dusun, satu papan/QR utama, website mobile-first berbahasa Indonesia, performa ringan, tanpa akun warga, dan belum adanya tech stack yang disetujui.

## 32. Requirement Traceability Summary

Ringkasan hitungan baseline:

| Classification | Count |
| --- | ---: |
| `CONFIRMED` requirements | 79 |
| `OPTIONAL` requirements | 13 |
| `FUTURE` requirements | 6 |
| `OPEN` decisions — product/software blocker | 0 |
| `OPEN` decisions — non-blocking operational | 10 |
| Unresolved `CONFLICT / AMBIGUITY` | 0 |
| Resolved ambiguities (`AMB-001`–`AMB-009`) | 9 |

Tabel berikut memuat satu baris untuk setiap requirement ber-ID. Keputusan `OPEN-xxx` dan decision log `AMB-xxx` dihitung pada bagian masing-masing dan tidak diduplikasi sebagai requirement ber-ID.

| Requirement ID | Requirement | Status | Source |
| --- | --- | --- | --- |
| BR-001 | Satu titik akses untuk informasi desa/dusun dan seluruh modul informasi utama | `CONFIRMED` | `pertanyaan.md — Q1, Q35` |
| BR-002 | Fokus pada petunjuk lokasi penting dan Kontak Pelayanan | `CONFIRMED` | `pertanyaan.md — Q1, Q36` |
| BR-003 | Alur papan fisik → QR → homepage → pilih dusun | `CONFIRMED` | `pertanyaan.md — Q23`; `pertanyaan-lanjutan.md — Q39, Q41` |
| BR-004 | Pengguna menemukan lokasi, kegiatan, dan kontak; portal membantu perangkat desa | `CONFIRMED` | `pertanyaan.md — Q36` |
| BR-005 | Akses QR dan navigasi antar-dusun sebagai fungsi kritis | `CONFIRMED` | `pertanyaan-lanjutan.md — Q46` |
| BR-006 | Peta fasilitas/UMKM dan arah Google Maps sebagai fungsi kritis | `CONFIRMED` | `pertanyaan-lanjutan.md — Q46` |
| BR-007 | Direktori Kontak Pelayanan via WhatsApp sebagai fungsi kritis | `CONFIRMED` | `pertanyaan-lanjutan.md — Q46` |
| FR-001 | Website publik tanpa login/akun warga | `CONFIRMED` | `pertanyaan-lanjutan.md — Q45` |
| FR-002 | Konten inti homepage Desa Bendung | `CONFIRMED` | `pertanyaan.md — Q3`; `pertanyaan-lanjutan.md — Q2, Q4` |
| FR-003 | Highlight pilihan dusun, peta, serta pengumuman/agenda terbaru | `CONFIRMED` | `pertanyaan.md — Q3`; `pertanyaan-lanjutan.md — Q4` |
| FR-004 | Homepage dikelola Super Admin melalui identitas langsung dan sumber data modul aktif | `CONFIRMED` | `pertanyaan.md — Q4`; `pertanyaan-lanjutan.md — Q2, Q4`; `pertanyaan-ambigu.md — Q55` |
| FR-005 | Modul inti pada halaman setiap dusun | `CONFIRMED` | `pertanyaan.md — Q5, Q35`; `pertanyaan-lanjutan.md — Q7` |
| FR-006 | Halaman dusun single page/scroll dengan detail tertentu | `CONFIRMED` | `pertanyaan-lanjutan.md — Q6` |
| FR-007 | Navigasi cepat halaman dusun | `CONFIRMED` | `pertanyaan-lanjutan.md — Q5` |
| FR-008 | Modul Pengumuman wajib, data aktif dapat kosong | `CONFIRMED` | `pertanyaan.md — Q5, Q35`; `pertanyaan-lanjutan.md — Q7` |
| FR-009 | Empty state “Belum ada data” | `CONFIRMED` | `pertanyaan-lanjutan.md — Q44` |
| FR-010 | Tombol WhatsApp dengan template pesan awal | `CONFIRMED` | `pertanyaan-lanjutan.md — Q10` |
| FR-011 | UMKM sebagai direktori, bukan e-commerce | `CONFIRMED` | `pertanyaan.md — Q11`; `pertanyaan-lanjutan.md — Q45` |
| FR-012 | Beberapa produk UMKM dalam format list/tags | `CONFIRMED` | `pertanyaan-lanjutan.md — Q11` |
| FR-013 | Tombol WhatsApp fasilitas tampil jika nomor diisi | `CONFIRMED` | `pertanyaan-lanjutan.md — Q16`; `pertanyaan-ambigu.md — Q53` |
| FR-014 | Agenda dan dokumentasi dalam satu modul | `CONFIRMED` | `pertanyaan.md — Q14–Q15` |
| FR-015 | Lifecycle Akan Datang, Berlangsung, dan Selesai otomatis dengan override Admin | `CONFIRMED` | `pertanyaan.md — Q15`; `pertanyaan-lanjutan.md — Q18–Q19`; `pertanyaan-ambigu.md — Q51` |
| FR-016 | Agenda tingkat dusun dan agenda tingkat desa | `CONFIRMED` | `pertanyaan.md — Q26, Q30`; `pertanyaan-lanjutan.md — Q20` |
| FR-017 | Pengumuman Desa dan Dusun dibedakan | `CONFIRMED` | `pertanyaan.md — Q17`; `pertanyaan-lanjutan.md — Q21` |
| FR-018 | Pengumuman kedaluwarsa berpindah ke Arsip Pengumuman publik | `CONFIRMED` | `pertanyaan.md — Q16`; `pertanyaan-lanjutan.md — Q22`; `pertanyaan-ambigu.md — Q48` |
| FR-019 | Perubahan Admin Dusun langsung dipublikasikan | `CONFIRMED` | `pertanyaan.md — Q27` |
| FR-020 | QR khusus per dusun | `FUTURE` | `pertanyaan.md — Q24, Q35` |
| FR-021 | Profil Desa singkat di homepage tanpa halaman Tentang Desa pada MVP | `CONFIRMED` | `pertanyaan-lanjutan.md — Q3` |
| FR-022 | Perilaku publik, data, dan admin untuk Dusun tidak aktif | `CONFIRMED` | `pertanyaan-ambigu.md — Q50` |
| NFR-001 | Mobile-first dan responsif | `CONFIRMED` | `pertanyaan-lanjutan.md — Q36, Q46` |
| NFR-002 | Bahasa Indonesia saja | `CONFIRMED` | `pertanyaan-lanjutan.md — Q37` |
| NFR-003 | Ringan dan cepat pada koneksi tidak terlalu cepat | `CONFIRMED` | `pertanyaan-lanjutan.md — Q38` |
| NFR-004 | Stabil, ringan, mudah dikembangkan dan dirawat | `CONFIRMED` | `pertanyaan-lanjutan.md — Catatan Tambahan butir 2` |
| DATA-001 | Data inti identitas Desa Bendung | `CONFIRMED` | `pertanyaan-lanjutan.md — Q2` |
| DATA-002 | Email desa jika tersedia | `OPTIONAL` | `pertanyaan-lanjutan.md — Q2` |
| DATA-003 | Enam dusun awal dengan placeholder A–F | `CONFIRMED` | `pertanyaan-lanjutan.md — Q1` |
| DATA-004 | Penambahan dusun baru | `FUTURE` | `pertanyaan-lanjutan.md — Q1` |
| DATA-005 | Data profil Dusun | `CONFIRMED` | `pertanyaan.md — Q6`; `pertanyaan-lanjutan.md — Q5` |
| DATA-006 | Jenis Kontak Pelayanan fleksibel per dusun | `OPTIONAL` | `pertanyaan.md — Q7`; `pertanyaan-lanjutan.md — Q8` |
| DATA-007 | Nama, jabatan, WhatsApp, dan status Kontak Pelayanan | `CONFIRMED` | `pertanyaan.md — Q8`; `pertanyaan-lanjutan.md — Q9` |
| DATA-008 | Foto Kontak Pelayanan | `OPTIONAL` | `pertanyaan-lanjutan.md — Q9, Q34` |
| DATA-009 | Cakupan informasi UMKM | `CONFIRMED` | `pertanyaan.md — Q10`; `pertanyaan-lanjutan.md — Q12–Q13, Q34` |
| DATA-010 | Jenis/keberadaan fasilitas sesuai kondisi dusun | `OPTIONAL` | `pertanyaan.md — Q12` |
| DATA-011 | Data inti fasilitas | `CONFIRMED` | `pertanyaan.md — Q13`; `pertanyaan-lanjutan.md — Q15–Q16` |
| DATA-012 | Nomor kontak fasilitas | `OPTIONAL` | `pertanyaan.md — Q13`; `pertanyaan-lanjutan.md — Q16`; `pertanyaan-ambigu.md — Q53` |
| DATA-013 | Kategori fasilitas dinamis | `CONFIRMED` | `pertanyaan-lanjutan.md — Q14` |
| DATA-014 | Data inti Agenda/Kegiatan | `CONFIRMED` | `pertanyaan-lanjutan.md — Q17, Q19` |
| DATA-015 | Tanggal selesai kegiatan multi-hari | `OPTIONAL` | `pertanyaan-lanjutan.md — Q19`; `pertanyaan-ambigu.md — Q51` |
| DATA-016 | Tanggal kedaluwarsa Pengumuman | `CONFIRMED` | `pertanyaan.md — Q16`; `pertanyaan-lanjutan.md — Q22` |
| DATA-017 | Jam Agenda/Kegiatan opsional | `OPTIONAL` | `pertanyaan-ambigu.md — Q52` |
| MAP-001 | Peta masuk MVP dengan sumber data tampilan yang konsisten | `CONFIRMED` | `pertanyaan.md — Q18–Q19` |
| MAP-002 | Peta Desa dari data aktif dan Peta Dusun aktif terfilter otomatis | `CONFIRMED` | `pertanyaan.md — Q19`; `pertanyaan-ambigu.md — Q50, Q55` |
| MAP-003 | Marker fasilitas, UMKM, dan pelayanan yang diizinkan | `CONFIRMED` | `pertanyaan.md — Q20–Q21`; `pertanyaan-lanjutan.md — Q28` |
| MAP-004 | Input lokasi melalui klik peta atau latitude/longitude | `CONFIRMED` | `pertanyaan.md — Q22` |
| MAP-005 | Filter dusun dan kategori pada Peta Desa | `CONFIRMED` | `pertanyaan-lanjutan.md — Q24` |
| MAP-006 | Isi popup marker dan tombol detail/arah | `CONFIRMED` | `pertanyaan-lanjutan.md — Q26` |
| MAP-007 | Arah lokasi membuka Google Maps eksternal | `CONFIRMED` | `pertanyaan-lanjutan.md — Q26–Q27, Q45–Q46` |
| MAP-008 | Koordinat wajib untuk fasilitas | `CONFIRMED` | `pertanyaan-lanjutan.md — Q15` |
| MAP-009 | Koordinat UMKM jika tersedia | `OPTIONAL` | `pertanyaan-lanjutan.md — Q12` |
| MAP-010 | Lokasi pelayanan/rumah pribadi dengan izin offline terlebih dahulu | `OPTIONAL` | `pertanyaan.md — Q20–Q21`; `pertanyaan-lanjutan.md — Q28`; `pertanyaan-ambigu.md — Q56` |
| MAP-011 | Pencarian nama lokasi | `FUTURE` | `pertanyaan-lanjutan.md — Q25` |
| MAP-012 | Batas wilayah dusun pada peta | `FUTURE` | `pertanyaan-lanjutan.md — Q23` |
| MEDIA-001 | Foto pada semua jenis data | `OPTIONAL` | `pertanyaan.md — Q5`; `pertanyaan-lanjutan.md — Q34` |
| MEDIA-002 | Placeholder/ilustrasi saat foto tidak ada | `CONFIRMED` | `pertanyaan-lanjutan.md — Q34–Q35` |
| MEDIA-003 | Satu foto utama UMKM pada MVP | `OPTIONAL` | `pertanyaan-lanjutan.md — Q13, Q34` |
| MEDIA-004 | Galeri beberapa foto UMKM | `FUTURE` | `pertanyaan-lanjutan.md — Q13` |
| MEDIA-005 | Galeri umum jika waktu cukup | `OPTIONAL` | `pertanyaan.md — Q35` |
| MEDIA-006 | Resize, kompresi, format modern, dan SVG untuk vektor | `CONFIRMED` | `pertanyaan-lanjutan.md — Q38` |
| MEDIA-007 | Poster awal dan dokumentasi pascakegiatan | `OPTIONAL` | `pertanyaan.md — Q15`; `pertanyaan-lanjutan.md — Q17, Q34` |
| ROLE-001 | Public User hanya menggunakan area publik | `CONFIRMED` | `pertanyaan.md — Q2`; `pertanyaan-lanjutan.md — Q45` |
| ROLE-002 | Lebih dari satu Admin per dusun | `CONFIRMED` | `pertanyaan.md — Q25` |
| ROLE-003 | Admin mengelola modul pada dusunnya sendiri | `CONFIRMED` | `pertanyaan.md — Q26–Q27`; `pertanyaan-lanjutan.md — Q29` |
| ROLE-004 | Dashboard Admin terkunci pada dusunnya | `CONFIRMED` | `pertanyaan-lanjutan.md — Q31` |
| ROLE-005 | Admin Dusun tidak membuat akun admin | `CONFIRMED` | `pertanyaan.md — Q28` |
| ROLE-006 | Admin Dusun hanya Nonaktifkan / Soft Delete, tanpa hard delete | `CONFIRMED` | `pertanyaan-lanjutan.md — Q29`; `pertanyaan-ambigu.md — Q47–Q48` |
| ROLE-007 | Tidak ada pengurutan manual oleh Admin Dusun; daftar diurutkan otomatis/default | `CONFIRMED` | `pertanyaan-lanjutan.md — Q30` (superseded); `pertanyaan-ambigu.md — Q54` |
| ROLE-008 | Super Admin mengelola penuh seluruh modul dan Dusun | `CONFIRMED` | `pertanyaan.md — Q30`; `pertanyaan-ambigu.md — Q47, Q49, Q55` |
| ROLE-009 | Super Admin mengelola akun dan reset password Admin Dusun | `CONFIRMED` | `pertanyaan.md — Q28, Q30`; `pertanyaan-lanjutan.md — Q33`; `pertanyaan-ambigu.md — Q49` |
| ROLE-010 | Super Admin mengelola nama, profil, dan status Dusun | `CONFIRMED` | `pertanyaan-lanjutan.md — Q1`; `pertanyaan-ambigu.md — Q50` |
| ROLE-011 | Super Admin mengelola kategori fasilitas dan data tingkat Desa | `CONFIRMED` | `pertanyaan-lanjutan.md — Q14, Q20`; `pertanyaan-ambigu.md — Q49` |
| SEC-001 | Otentikasi login aman | `CONFIRMED` | `pertanyaan-lanjutan.md — Catatan Tambahan butir 1` |
| SEC-002 | Password hashing kuat | `CONFIRMED` | `pertanyaan-lanjutan.md — Catatan Tambahan butir 1` |
| SEC-003 | RBAC dan isolasi data antar-dusun | `CONFIRMED` | `pertanyaan.md — Q26`; `pertanyaan-lanjutan.md — Q31, Catatan Tambahan butir 1` |
| SEC-004 | Perlindungan SQL injection | `CONFIRMED` | `pertanyaan-lanjutan.md — Catatan Tambahan butir 1` |
| SEC-005 | Perlindungan XSS | `CONFIRMED` | `pertanyaan-lanjutan.md — Catatan Tambahan butir 1` |
| SEC-006 | Rate limiting untuk perlindungan brute force | `CONFIRMED` | `pertanyaan-lanjutan.md — Catatan Tambahan butir 1` |
| SEC-007 | Tidak ada hard delete Dusun pada UI | `CONFIRMED` | `pertanyaan-lanjutan.md — Q1`; `pertanyaan-ambigu.md — Q47` |
| SEC-008 | Login username/password dan reset oleh Super Admin | `CONFIRMED` | `pertanyaan-lanjutan.md — Q32–Q33` |
| SEC-009 | Hard delete hanya untuk Super Admin dan hanya terhadap data selain Dusun | `CONFIRMED` | `pertanyaan-lanjutan.md — Q29`; `pertanyaan-ambigu.md — Q47` |
| PRIV-001 | Consent publikasi dilakukan administratif/offline tanpa fitur consent digital MVP | `CONFIRMED` | `pertanyaan-ambigu.md — Q56` |
| OPS-001 | Satu papan/QR utama di Balai Desa | `CONFIRMED` | `pertanyaan-lanjutan.md — Q39, Q41` |
| OPS-002 | Papan QR kecil per dusun | `FUTURE` | `pertanyaan-lanjutan.md — Q39` |
| OPS-003 | Pengumpulan data oleh Tim KKN dan perangkat dusun | `CONFIRMED` | `pertanyaan-lanjutan.md — Q42` |
| OPS-004 | Validasi bersama sebelum rilis | `CONFIRMED` | `pertanyaan-lanjutan.md — Q43` |
| OPS-005 | Pembaruan pasca-KKN oleh Admin Dusun dengan supervisi | `CONFIRMED` | `pertanyaan.md — Q31` |
| OPS-006 | Pelatihan/panduan dashboard | `CONFIRMED` | `pertanyaan.md — Q34` |
| OPS-007 | Arah serah terima ke Pemerintah Desa/operator | `CONFIRMED` | `pertanyaan.md — Q33` |
| OPS-008 | Hosting handal, hemat, dan mudah diserahterimakan | `CONFIRMED` | `pertanyaan-lanjutan.md — Catatan Tambahan butir 3` |

## 33. MVP Freeze Checklist

### A. Requirement Freeze Checklist

- [x] Ketiga source requirement sudah dibaca dan `pertanyaan-ambigu.md` diperlakukan sebagai keputusan terbaru untuk Q47–Q56.
- [x] Product Goal, target user, tiga fungsi kritis, MVP Scope, `OPTIONAL`, `FUTURE`, dan out-of-scope sudah jelas.
- [x] Scope Public Website, Homepage data-driven, Halaman Dusun, modul informasi, Peta, QR, Admin Dusun, dan Super Admin sudah jelas.
- [x] Admin Dusun hanya mengelola data dusunnya, langsung mempublikasikan perubahan, hanya menggunakan Nonaktifkan / Soft Delete, dan tidak mengatur urutan manual.
- [x] Super Admin mempunyai full management seluruh modul/Dusun, restore, serta hard delete data selain entitas Dusun.
- [x] Dampak status Dusun tidak aktif pada publik, data, Admin Dusun, dan reaktivasi sudah jelas tanpa menetapkan desain halaman.
- [x] Lifecycle Pengumuman membedakan Arsip Pengumuman dari Nonaktif / Soft Delete.
- [x] Lifecycle Agenda/Kegiatan satu hari dan multi-hari, tanggal selesai kosong, override manual, jam opsional, dan media opsional sudah jelas.
- [x] Kontak fasilitas menggunakan tombol WhatsApp saja apabila nomor tersedia.
- [x] Izin publikasi ditetapkan administratif/offline tanpa fitur consent digital MVP.
- [x] `AMB-001` sampai `AMB-009` dan `OPEN-003` telah diselesaikan manusia; blocker produk/software tersisa berjumlah 0.
- [x] Requirement keamanan telah direview tanpa menambahkan desain modal konfirmasi, audit log, backup policy, atau implementasi teknis yang belum diputuskan.
- [x] `NO TECH STACK HAS BEEN APPROVED YET`; seluruh teknologi tetap kandidat R&D dan Google Maps hanya tujuan navigasi eksternal.
- [x] Traceability requirement ke tiga source sudah diperiksa dan keputusan superseded tidak lagi terbaca sebagai fitur MVP aktif.
- [x] Tidak ada PRD, sitemap, user flow, ERD, SRS, schema database, Technical Architecture, UI, atau kode yang dibuat atau disisipkan.
- [x] Baseline telah melewati final review requirement dan ditetapkan `Version 1.0 — FROZEN FOR MVP`.

### B. Pre-Launch / Operational Checklist — Non-Blocking

Item berikut belum harus selesai untuk membekukan Requirements Baseline:

- [ ] Nama resmi keenam Dusun menggantikan placeholder A–F.
- [ ] Redaksi final template pesan WhatsApp ditetapkan.
- [ ] Pemegang Super Admin, calon Admin seluruh Dusun, dan supervisor operasional pasca-KKN ditetapkan.
- [ ] Provider hosting/domain, biaya, ownership akun/domain, deployment, dan prosedur handover disepakati.
- [ ] Desain visual final papan QR diselesaikan oleh pihak terkait.
- [ ] Tech stack, database, dan provider peta portal dipilih melalui R&D.
- [ ] Mekanisme pemulihan akun Super Admin ditetapkan.
- [ ] Dataset aktual, koordinat, dan media untuk launching dikumpulkan serta divalidasi.
- [ ] Pelatihan/panduan dashboard dan serah terima dilaksanakan.

Ketidakselesaian item Bagian B tidak mengubah status Requirements Baseline dan tidak membuka kembali requirement produk yang telah dibekukan.
