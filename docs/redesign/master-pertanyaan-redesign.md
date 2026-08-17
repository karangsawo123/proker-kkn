# Master Pertanyaan Keputusan Redesign

## Portal Informasi Desa Bendung

## Status

Dokumen ini digunakan **sebelum implementasi redesign** untuk menentukan keputusan:

* hierarchy visual;
* urutan informasi;
* density;
* composition;
* responsive behavior;
* navigation presentation;
* card/list/table treatment;
* map presentation;
* dashboard workspace;
* form presentation;
* detail page presentation;
* interaction visual;
* konsistensi Public dan Admin.

Dokumen ini **BUKAN** perubahan business requirement.

---

# ATURAN UNTUK AI AGENT

Sebelum membantu menjawab:

1. Baca source code project aktual.
2. Baca:

   * Requirements Baseline;
   * PRD;
   * Sitemap;
   * User Flows;
   * UI/UX Specification;
   * Wireframe Specification;
   * Visual Design Specification;
   * hasil audit frontend;
   * `pertanyaan-redesign-halaman-dusun.md`.
3. Jangan mengarang data Desa/Dusun.
4. Jangan menambah page, role, permission, model, field, route, lifecycle, atau business functionality hanya demi UX.
5. Jika sebuah opsi berpotensi menjadi functionality baru, tandai dengan jelas:
   `POTENTIAL NEW BEHAVIOR`.
6. Jawaban boleh merekomendasikan layout berbeda dari Wireframe lama karena questionnaire ini memang digunakan untuk memutuskan redesign baru.
7. Semua fitur dan data yang sudah diwajibkan upstream tetap harus tersedia.
8. Homepage yang sudah disetujui diperlakukan sebagai salah satu benchmark visual area publik, bukan sesuatu yang harus dibongkar tanpa alasan.

---

# BAGIAN A — OTORITAS DAN ARAH GLOBAL REDESIGN

## Pertanyaan 1 — Tingkat Kebebasan Visual

Seberapa bebas frontend boleh mengubah composition selama functionality tidak berubah?

### A.

Sangat konservatif. Struktur lama dipertahankan dan hanya styling diperbaiki.

### B.

Composition boleh berubah cukup bebas, tetapi urutan besar halaman lama dipertahankan.

### C.

Visual composition, grouping, grid, section treatment, density, dan responsive layout boleh berubah bebas selama seluruh informasi/action/state/functionality lama tetap tersedia.

### D.

Pendapat lain.

**Jawaban:**
C. Visual composition, grouping, grid, section treatment, density, dan responsive layout boleh berubah bebas selama seluruh informasi, action, state, dan fungsionalitas lama tetap tersedia dan berfungsi 100%.

---

## Pertanyaan 2 — Sumber Visual Utama

Apa yang seharusnya menjadi otoritas visual tertinggi saat agent melakukan redesign?

### A.

Wireframe lama.

### B.

Visual Design Specification lama.

### C.

Homepage yang sudah approved + keputusan dalam Master Redesign Decisions + skill `frontend-design` dan `redesign-existing-projects`.

### D.

Pendapat lain.

**Jawaban:**
C. Homepage yang sudah approved + keputusan dalam Master Redesign Decisions + panduan skill `frontend-design` dan `redesign-existing-projects`.

---

## Pertanyaan 3 — Warm Natural

Apakah identitas Warm Natural tetap dipertahankan?

### A.

Ya, pertahankan palette dan karakter dasarnya tetapi tingkatkan kualitas composition agar tidak template-like.

### B.

Pertahankan hanya warna, typography boleh berubah.

### C.

Boleh direvisi besar.

### D.

Pendapat lain.

**Jawaban:**
A. Ya, pertahankan palette dan karakter dasarnya (Forest Green, Warm Off-White, Earthy Accents), tetapi tingkatkan kualitas komposisi, kontras, dan kedalaman agar tidak terasa seperti template generik.

---

## Pertanyaan 4 — Typography Global

Source code saat ini memakai beberapa font seperti Playfair Display, Lora, Plus Jakarta Sans, dan Outfit.

Bagaimana sebaiknya?

### A.

Gunakan dua keluarga font utama saja:

* serif/editorial untuk public heading;
* sans-serif untuk UI/body/admin.

### B.

Tetap gunakan seluruh font yang ada sesuai halaman.

### C.

Public dan Admin boleh punya font berbeda total.

### D.

Pendapat lain.

**Jawaban:**
A. Gunakan dua keluarga font utama saja yang konsisten:
* Serif / Editorial (Playfair Display / Lora) untuk heading publik besar;
* Sans-Serif modern (Plus Jakarta Sans) untuk seluruh UI, body copy, navigation, buttons, form, tabel, dan area Admin Dashboard.

---

## Pertanyaan 5 — Konsistensi Public vs Dashboard

Hubungan visual Public dan Dashboard sebaiknya:

### A.

Hampir identik.

### B.

Satu design system, tetapi expression berbeda:

* Public lebih editorial/visual;
* Admin lebih utility-focused.

### C.

Benar-benar berbeda.

### D.

Pendapat lain.

**Jawaban:**
B. Satu design system dengan ekspresi berbeda:
* Public lebih editorial, visual, lapang, dan berorientasi narasi/warga;
* Admin lebih terstruktur, ringkas, data-dense, dan utility-focused untuk efisiensi kerja petugas.

---

## Pertanyaan 6 — Card Usage Global

Apakah seluruh aplikasi perlu banyak menggunakan card?

### A.

Ya, card menjadi pola utama.

### B.

Gunakan card hanya jika membantu grouping. Hindari setiap section menjadi floating rounded box.

### C.

Minim card sama sekali.

### D.

Pendapat lain.

**Jawaban:**
B. Gunakan card hanya jika membantu grouping informasi. Hindari jebakan "card fatigue" di mana setiap elemen menjadi floating rounded box tanpa hierarki.

---

## Pertanyaan 7 — Border Radius

Karakter radius sebaiknya:

### A.

Rounded cukup besar dan soft.

### B.

Medium/controlled; rounded hanya saat memang cocok.

### C.

Mayoritas square/minimal radius.

### D.

Biarkan skill frontend-design memutuskan berdasarkan context.

**Jawaban:**
B. Medium / controlled radius (8px – 16px); rounded pill hanya saat memang cocok (badge/filter chips/button), memberikan kesan modern, rapi, dan matang tanpa berlebihan.

---

## Pertanyaan 8 — Shadow / Elevation

### A.

Gunakan shadow cukup jelas agar setiap elemen terlihat terpisah.

### B.

Shadow sangat restrained; hierarchy lebih banyak dari spacing, border, typography, dan surface.

### C.

Tanpa shadow.

### D.

Pendapat lain.

**Jawaban:**
B. Shadow sangat restrained dan diffuse (halus & menyebar); hierarki kedalaman visual lebih banyak dibangun melalui kontras surface, border subtil (1px), spacing, dan hierarki tipografi.

---

# BAGIAN B — HOMEPAGE YANG SUDAH APPROVED

## Pertanyaan 9 — Status Homepage

Homepage saat ini:

### A.

LOCK visual — jangan ubah kecuali shared component membutuhkan adjustment kecil.

### B.

Boleh polish minor.

### C.

Boleh redesign lagi agar mengikuti keseluruhan design system baru.

### D.

Pendapat lain.

**Jawaban:**
B. Boleh polish minor — Struktur dan section utama homepage yang sudah approved tetap dipertahankan, hanya dilakukan penyelarasan token, elevation, dan shared components agar harmonis dengan sistem baru.

---

## Pertanyaan 10 — Homepage Sebagai Benchmark

Apakah Homepage digunakan sebagai acuan untuk:

* palette;
* typography;
* navbar;
* footer;
* button;
* icon style;
* spacing rhythm;
* image treatment?

### A.

Ya, semuanya.

### B.

Ya, tetapi hanya brand identity; composition halaman lain boleh sangat berbeda.

### C.

Tidak.

**Jawaban:**
B. Ya, sebagai acuan brand identity (palette, typography, navbar, footer, buttons, icons, card styling), namun komposisi layout halaman Dusun & Detail disesuaikan secara dinamis dengan konteks masing-masing.

---

## Pertanyaan 11 — Header Public

Untuk seluruh halaman public, header sebaiknya:

### A.

Persis sama di seluruh halaman.

### B.

Sama secara struktur/brand, tetapi dapat memiliki mode transparan/solid sesuai Hero.

### C.

Header detail page dibuat berbeda.

### D.

Pendapat lain.

**Jawaban:**
B. Sama secara struktur dan branding (`layouts/public.blade.php`), tetapi memiliki transisi adaptif (soft blur / glassmorphism di atas Hero, solid surface saat scroll atau di halaman detail).

---

## Pertanyaan 12 — Footer Public

### A.

Satu footer konsisten untuk seluruh public site.

### B.

Homepage memakai footer besar, detail memakai footer lebih ringkas.

### C.

Footer disesuaikan per halaman.

### D.

Pendapat lain.

**Jawaban:**
A. Satu footer konsisten untuk seluruh public site (tema *Forest Heritage Dark* di `layouts/public.blade.php`), memuat identitas desa, navigasi cepat, kontak, dan tautan login portal admin.

---

# BAGIAN C — SISTEM DETAIL PAGE PUBLIK

Detail yang sudah tersedia:

* UMKM;
* Fasilitas;
* Agenda/Kegiatan;
* Pengumuman.

Tidak boleh membuat detail type kelima hanya karena redesign.

---

## Pertanyaan 13 — Common Detail Shell

Apakah keempat Detail sebaiknya memiliki common shell?

### A.

Ya:

* back/context;
* title;
* metadata;
* content;
* action;
* footer.

Tetapi composition internal tiap resource berbeda.

### B.

Semua detail dibuat visual identik.

### C.

Masing-masing dibuat sepenuhnya berbeda.

### D.

Pendapat lain.

**Jawaban:**
A. Ya, menggunakan common shell yang konsisten:
* back navigation / context badge;
* title & primary tags;
* metadata card/strip;
* content body;
* primary CTA actions;
* shared footer.
Namun komposisi visual internal masing-masing resource disesuaikan secara spesifik (UMKM = produk & kontak, Fasilitas = peta arah & lokasi, Agenda = poster & timeline status, Pengumuman = maklumat dokumen resmi).

---

## Pertanyaan 14 — Back Navigation

Pada Detail Page, navigasi kembali sebaiknya:

### A.

Breadcrumb desktop + back link mobile.

### B.

Back link sederhana di semua viewport.

### C.

Breadcrumb saja.

### D.

Biarkan browser Back tanpa UI tambahan.

**Jawaban:**
A. Breadcrumb kontekstual di Desktop (misal: Beranda / Dusun Krajan / Nama UMKM) + Back Link ringkas di Mobile ("← Kembali ke Dusun").

---

## Pertanyaan 15 — Detail Hero

Detail page membutuhkan:

### A.

Hero besar seperti Homepage.

### B.

Compact detail header dengan context, title, metadata, dan image bila relevan.

### C.

Tidak perlu hero/header khusus.

### D.

Pendapat lain.

**Jawaban:**
B. Compact detail header dengan context badge dusun/kategori, judul utama yang jelas, metadata ringkas, serta foto/media representatif bila relevan tanpa menyita satu viewport penuh.

---

## Pertanyaan 16 — Lebar Konten Detail

Desktop:

### A.

Full-width.

### B.

Readable centered width untuk teks, dengan media/action dapat lebih lebar.

### C.

Selalu layout 2 kolom.

### D.

Context-dependent.

**Jawaban:**
B. Readable centered width untuk teks narasi/deskripsi (optimal ~720–840px), dipadukan dengan layout 2-kolom asimetris (konten utama + sidebar informasi/aksi/peta pendukung) pada viewport desktop.

---

## Pertanyaan 17 — Mobile Detail Action

Action seperti WhatsApp/Google Maps sebaiknya:

### A.

Tetap di dalam flow konten.

### B.

Sticky bottom action bar di mobile.

### C.

Floating action.

### D.

Context-dependent.

Catatan: Sticky/floating hanya presentation dari action yang memang sudah ada.

**Jawaban:**
A. Tetap di dalam flow konten dan header kartu kontak — Tombol aksi WhatsApp dan Petunjuk Arah diletakkan jelas dan mudah diakses di dalam alur konten utama tanpa sticky bottom bar yang menutupi konten di layar mobile.

---

## Pertanyaan 18 — Related Content

Setelah Detail, apakah perlu menampilkan "UMKM lainnya", "Fasilitas lainnya", dan sejenisnya?

### A.

Tidak. Tetap scope MVP sekarang.

### B.

Ya.

`POTENTIAL NEW BEHAVIOR` karena perlu query/content recommendation baru.

### C.

Hanya link kembali ke konteks asal.

**Jawaban:**

---

# BAGIAN D — DETAIL UMKM

## Pertanyaan 19 — Fokus Visual Detail UMKM

### A.

Foto usaha sebagai fokus utama.

### B.

Informasi usaha + owner + kontak sebagai fokus, foto supporting.

### C.

Produk sebagai fokus utama.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 20 — Produk UMKM

Produk sebaiknya ditampilkan sebagai:

### A.

Tags/chips.

### B.

List sederhana.

### C.

Compact visual rows.

### D.

Gabungan tergantung jumlah produk.

Tidak boleh menjadi shopping/catalog commerce UI.

**Jawaban:**

---

## Pertanyaan 21 — WhatsApp UMKM

CTA WhatsApp sebaiknya:

### A.

Dominant primary action.

### B.

Secondary action.

### C.

Menyesuaikan keberadaan lokasi/metadata.

**Jawaban:**

---

## Pertanyaan 22 — Lokasi UMKM

Jika UMKM memiliki koordinat:

### A.

Tampilkan map preview.

### B.

Tampilkan compact location context saja.

### C.

Tampilkan link kembali ke Peta Dusun.

### D.

Pendapat lain.

Jangan mengubah UMKM tanpa koordinat menjadi seolah memiliki lokasi.

**Jawaban:**

---

# BAGIAN E — DETAIL FASILITAS

## Pertanyaan 23 — Fokus Detail Fasilitas

### A.

Nama + kategori + informasi.

### B.

Lokasi/map sebagai fokus utama.

### C.

Foto fasilitas sebagai fokus utama.

### D.

Balance informasi + location.

**Jawaban:**

---

## Pertanyaan 24 — Map Detail Fasilitas

Karena koordinat Fasilitas wajib:

### A.

Map preview besar.

### B.

Map medium.

### C.

Compact preview + tombol Google Maps.

### D.

Tidak perlu map preview; tombol arah saja.

**Jawaban:**

---

## Pertanyaan 25 — CTA Petunjuk Arah

### A.

Primary CTA paling dominan.

### B.

Secondary CTA.

### C.

Dominant hanya di mobile.

**Jawaban:**

---

## Pertanyaan 26 — WhatsApp Fasilitas

Jika nomor tersedia:

### A.

Sejajar dengan Petunjuk Arah.

### B.

Secondary di bawah Petunjuk Arah.

### C.

Masuk metadata saja.

**Jawaban:**

---

# BAGIAN F — DETAIL AGENDA & KEGIATAN

## Pertanyaan 27 — Detail Agenda

Karakter visual:

### A.

Event poster style.

### B.

Editorial event article.

### C.

Hybrid: poster/media + event information.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 28 — Metadata Agenda

Tanggal, jam, lokasi, status sebaiknya:

### A.

Satu info card.

### B.

Inline compact metadata.

### C.

Visual calendar-like block.

### D.

Context-dependent.

**Jawaban:**

---

## Pertanyaan 29 — Dokumentasi Kegiatan

Jika Agenda selesai dan dokumentasi tersedia:

### A.

Grid gallery.

### B.

Horizontal gallery.

### C.

Satu media utama + sisanya compact.

### D.

Pendapat lain.

Tetap gunakan media yang sudah tersedia; jangan menambah galeri resource baru.

**Jawaban:**

---

## Pertanyaan 30 — Status Agenda

Status `Akan Datang`, `Berlangsung`, `Selesai`:

### A.

Badge sangat prominent.

### B.

Badge cukup terlihat tetapi tidak menjadi fokus.

### C.

Metadata text saja.

**Jawaban:**

---

# BAGIAN G — PENGUMUMAN & ARSIP

## Pertanyaan 31 — Detail Pengumuman

Tampilan sebaiknya lebih menyerupai:

### A.

Artikel berita.

### B.

Maklumat/pengumuman resmi.

### C.

Generic detail card.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 32 — Status Aktif / Arsip

### A.

Badge prominent.

### B.

Context label subtle.

### C.

Header surface berbeda.

### D.

Gabungan B + C.

**Jawaban:**

---

## Pertanyaan 33 — Arsip Pengumuman

Page Arsip sebaiknya:

### A.

List compact chronological.

### B.

Card grid.

### C.

Timeline.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 34 — Filter Arsip

Perlukah filter/search Arsip?

### A.

Tidak. Tetap MVP sekarang.

### B.

Search.

### C.

Filter tahun/bulan.

### D.

Keduanya.

`POTENTIAL NEW BEHAVIOR` jika belum tersedia di source code/requirement.

**Jawaban:**

---

## Pertanyaan 35 — Pagination Arsip

Jika pagination sudah tersedia:

### A.

Pertahankan pagination.

### B.

Gunakan Load More.

### C.

Infinite scroll.

B/C dapat mengubah interaction/implementation sehingga harus diverifikasi.

**Jawaban:**

---

# BAGIAN H — MAP VISUAL SYSTEM

## Pertanyaan 36 — Konsistensi Peta

Peta Desa, Peta Dusun, dan Data/Peta Super Admin sebaiknya:

### A.

Memiliki visual frame/filter/popup language yang sama.

### B.

Public dan Admin menggunakan style berbeda.

### C.

Context-dependent tetapi marker/popup tetap satu family.

**Jawaban:**

---

## Pertanyaan 37 — Filter Peta Mobile

### A.

Select dropdown standar.

### B.

Compact segmented/pill controls jika taxonomy memungkinkan.

### C.

Button yang membuka filter panel.

### D.

Biarkan frontend-design memilih berdasarkan jumlah opsi aktual.

Tidak boleh menghilangkan filter yang diwajibkan.

**Jawaban:**

---

## Pertanyaan 38 — Map Height Mobile

### A.

Compact.

### B.

Medium sekitar sebagian viewport.

### C.

Large hampir satu viewport.

### D.

Adaptive berdasarkan context.

**Jawaban:**

---

## Pertanyaan 39 — Marker Visual

### A.

Pin klasik.

### B.

Icon badge per kategori.

### C.

Minimal dot + label.

### D.

Biarkan design skill menentukan.

Tetap harus dapat membedakan kategori tanpa color-only.

**Jawaban:**

---

## Pertanyaan 40 — Popup Peta

### A.

Minimal: nama, kategori, action.

### B.

Medium: foto bila ada + alamat + actions.

### C.

Rich popup dengan banyak detail.

Rekomendasi harus tetap menjaga popup bukan pengganti Detail Page.

**Jawaban:**

---

## Pertanyaan 41 — Map Filter Fasilitas

Kategori interaktif hanya digunakan pada konteks Peta sesuai requirement.

Apakah setuju bahwa category chip pada direktori Fasilitas public hanya visual label dan **bukan filter interaktif baru**?

### A.

Setuju.

### B.

Tidak, saya ingin filter fasilitas interaktif.

`POTENTIAL NEW BEHAVIOR`.

**Jawaban:**

---

# BAGIAN I — LOGIN ADMIN

## Pertanyaan 42 — Karakter Login

### A.

Minimal centered login card.

### B.

Split layout desktop: branding/imagery + form.

### C.

Full background image + form overlay.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 43 — Hubungan Login dengan Public

### A.

Login sangat terasa sebagai bagian Portal Desa.

### B.

Login lebih utilitarian tetapi tetap memakai brand token Portal.

### C.

Terpisah visual.

**Jawaban:**

---

## Pertanyaan 44 — Image Login

### A.

Gunakan foto Desa bila tersedia.

### B.

Gunakan motif/shape Warm Natural.

### C.

Tidak perlu image.

### D.

Context-dependent.

**Jawaban:**

---

## Pertanyaan 45 — Mobile Login

### A.

Single clean card.

### B.

Tanpa card; form langsung pada page surface.

### C.

Mini branding di atas + form.

### D.

Pendapat lain.

**Jawaban:**

---

# BAGIAN J — ADMIN DESIGN SYSTEM GLOBAL

## Pertanyaan 46 — Karakter Dashboard

Dashboard sebaiknya terasa:

### A.

Corporate admin dashboard.

### B.

Modern civic/local-government workspace.

### C.

Minimal SaaS dashboard.

### D.

Utility-focused extension dari Portal Desa, tanpa terasa seperti template SaaS.

### E.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 47 — Sidebar Desktop

### A.

Dark forest sidebar.

### B.

Light/Cream sidebar.

### C.

Hybrid: light shell dengan active item forest.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 48 — Sidebar Collapse

Saat desktop:

### A.

Tetap collapsible seperti behavior sekarang.

### B.

Selalu expanded.

### C.

Collapsible tetapi bukan fokus redesign.

**Jawaban:**

---

## Pertanyaan 49 — Sidebar Icons

### A.

Gunakan SVG/Lucide-style coherent icons + label.

### B.

Label tanpa icon.

### C.

Pertahankan emoji.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 50 — Role/Context Indicator

Admin Dusun harus selalu tahu Dusun yang sedang dikelola.

Bagaimana tampilannya?

### A.

Context block di topbar.

### B.

Context block di sidebar.

### C.

Page header context.

### D.

Gabungan sidebar + page header, tetapi tidak berlebihan.

**Jawaban:**

---

## Pertanyaan 51 — Topbar

Topbar desktop sebaiknya memuat:

### A.

Page title + account.

### B.

Breadcrumb + title + account.

### C.

Minimal account/menu saja; title di content.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 52 — Dashboard Background

### A.

Cream/Warm off-white.

### B.

Light neutral.

### C.

White.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 53 — Density Dashboard

### A.

Spacious.

### B.

Balanced.

### C.

Compact/high-density.

### D.

Adaptive: overview lebih spacious, table/form lebih compact.

**Jawaban:**

---

## Pertanyaan 54 — Card Dashboard

### A.

Semua statistik/navigation berupa card.

### B.

Card hanya untuk statistik dan grouping penting.

### C.

Minimal card; banyak flat sections.

### D.

Pendapat lain.

**Jawaban:**

---

# BAGIAN K — DASHBOARD OVERVIEW ADMIN DUSUN

## Pertanyaan 55 — Tujuan Dashboard Admin Dusun

Homepage dashboard sebaiknya berfungsi sebagai:

### A.

Navigation hub.

### B.

Summary statistik.

### C.

Gabungan context + summary + shortcut management.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 56 — Statistik

Jika statistik existing tersedia:

### A.

Tampilkan semua stat card.

### B.

Tampilkan hanya statistik yang membantu tindakan admin.

### C.

Compact summary bar.

### D.

Biarkan agent menilai data aktual.

**Jawaban:**

---

## Pertanyaan 57 — Shortcut Modul

Enam management area:

### A.

Juga tampil sebagai navigation cards di dashboard.

### B.

Cukup sidebar saja.

### C.

Tampilkan 3–4 shortcut paling berguna.

Catatan: jangan mengarang priority feature; gunakan area yang sudah ada.

**Jawaban:**

---

## Pertanyaan 58 — Status Dusun INACTIVE

Notice sebaiknya:

### A.

Banner cukup prominent.

### B.

Compact contextual alert.

### C.

Persistent topbar indicator.

### D.

Gabungan B + status badge.

Tidak boleh memberikan activation control ke Admin Dusun.

**Jawaban:**

---

# BAGIAN L — SUPER ADMIN DASHBOARD OVERVIEW

## Pertanyaan 59 — Super Admin Dashboard

Tujuan utamanya:

### A.

Navigation hub 10 modul.

### B.

Overview data global.

### C.

Gabungan summary + navigation.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 60 — Perbedaan Admin Dusun vs Super Admin

### A.

Layout hampir sama; hanya menu berbeda.

### B.

Shared shell sama, tetapi Super Admin lebih data-dense dan global.

### C.

Dashboard Super Admin sangat berbeda.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 61 — Global Context

Label `GLOBAL` / konteks Super Admin sebaiknya:

### A.

Badge di topbar.

### B.

Context block.

### C.

Cukup page title.

### D.

Pendapat lain.

**Jawaban:**

---

# BAGIAN M — MANAGEMENT LIST / TABLE

## Pertanyaan 62 — Desktop List

### A.

Table full-width.

### B.

Cards.

### C.

Hybrid: table untuk structured data, card untuk resource visual.

### D.

Context-dependent.

**Jawaban:**

---

## Pertanyaan 63 — Mobile List

### A.

Table horizontal-scroll.

### B.

Stacked management cards.

### C.

Compact list rows.

### D.

Context-dependent antara B/C.

**Jawaban:**

---

## Pertanyaan 64 — Table Density

### A.

Compact.

### B.

Balanced.

### C.

Spacious.

**Jawaban:**

---

## Pertanyaan 65 — Row Actions Desktop

Edit / Nonaktifkan / Restore / Hard Delete dan action lain yang memang authorized:

### A.

Selalu sebagai text button.

### B.

Icon + label.

### C.

Primary action visible, sisanya overflow menu.

### D.

Context-dependent.

Pastikan destructive actions tetap jelas.

**Jawaban:**

---

## Pertanyaan 66 — Row Actions Mobile

### A.

Semua tombol terlihat.

### B.

Primary action visible + More menu.

### C.

Action block di bawah card.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 67 — Filters Super Admin

Filter Dusun/status/scope:

### A.

Selalu visible toolbar.

### B.

Desktop visible, mobile collapsible filter panel.

### C.

Compact single-row horizontal scroll.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 68 — Create Button

### A.

Top-right page header desktop; full/obvious button mobile.

### B.

Floating action button mobile.

### C.

Sticky bottom action mobile.

### D.

Context-dependent.

**Jawaban:**

---

## Pertanyaan 69 — Empty State Admin

### A.

Illustrated empty state.

### B.

Simple icon + message + Create CTA.

### C.

Plain text.

### D.

Pendapat lain.

**Jawaban:**

---

# BAGIAN N — CREATE / EDIT FORM

## Pertanyaan 70 — Form Page Width

Desktop:

### A.

Narrow readable form.

### B.

Medium centered form.

### C.

Wide form dengan grouping dua kolom.

### D.

Adaptive berdasarkan jumlah field.

**Jawaban:**

---

## Pertanyaan 71 — Form Grouping

### A.

Satu form card besar.

### B.

Beberapa section/card berdasarkan kategori data.

### C.

Flat sections dengan divider.

### D.

Hybrid, hindari card berlebihan.

**Jawaban:**

---

## Pertanyaan 72 — Create dan Edit

### A.

Visual sama persis, hanya title/action berbeda.

### B.

Edit sedikit lebih contextual dengan existing data preview.

### C.

Context-dependent.

Jangan menambah functionality baru.

**Jawaban:**

---

## Pertanyaan 73 — Save Actions

Desktop:

### A.

Di bawah form.

### B.

Sticky action bar.

### C.

Page header + bottom.

### D.

Context-dependent.

**Jawaban:**

---

## Pertanyaan 74 — Save Actions Mobile

### A.

Di bawah form.

### B.

Sticky bottom Save/Cancel.

### C.

Floating Save.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 75 — Required / Optional

### A.

Required memakai `*`, optional normal.

### B.

Required normal, optional diberi label "Opsional".

### C.

Keduanya diberi label eksplisit.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 76 — Helper Text

### A.

Selalu tampil di bawah field.

### B.

Hanya field yang memang membutuhkan penjelasan.

### C.

Tooltip.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 77 — Validation Summary

Jika banyak error:

### A.

Hanya inline field errors.

### B.

Error summary di atas + inline field errors.

### C.

Toast + inline.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 78 — Image Upload

### A.

Dropzone besar.

### B.

Compact upload field + preview.

### C.

Current image preview + replace/remove action.

### D.

B/C berdasarkan Create/Edit.

**Jawaban:**

---

## Pertanyaan 79 — Coordinate Picker

Untuk form yang mendukung lokasi:

### A.

Map besar dahulu lalu Lat/Lng.

### B.

Lat/Lng dahulu lalu Map.

### C.

Compact field + map integrated dalam satu section.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 80 — Long Form

Jika form panjang seperti UMKM/Agenda:

### A.

Semua dalam satu vertical form.

### B.

Section grouping + anchor mini navigation.

### C.

Accordion.

### D.

Wizard.

Catatan: wizard tidak ada dalam UX MVP lama; jika dipilih menjadi perubahan interaction yang lebih besar.

**Jawaban:**

---

# BAGIAN O — ADMIN DUSUN SPECIFIC

## Pertanyaan 81 — Fixed Dusun Context

Karena Admin Dusun tidak boleh berpindah Dusun:

### A.

Tampilkan nama Dusun cukup sekali di topbar.

### B.

Tampilkan pada topbar + page context kecil.

### C.

Tampilkan di setiap form.

### D.

Pendapat lain.

Jangan membuat Dusun selector.

**Jawaban:**

---

## Pertanyaan 82 — Soft Delete / Nonaktifkan

Tombol sebaiknya:

### A.

Visible di setiap row.

### B.

Masuk More menu.

### C.

Visible hanya di edit/detail management state.

### D.

Context-dependent.

**Jawaban:**

---

## Pertanyaan 83 — Confirmation Nonaktifkan

### A.

Modal standar.

### B.

Inline confirmation.

### C.

Bottom sheet mobile + modal desktop.

### D.

Pendapat lain.

**Jawaban:**

---

# BAGIAN P — SUPER ADMIN SPECIFIC

## Pertanyaan 84 — Filter Dusun Global

Untuk modul lintas Dusun:

### A.

Dusun filter prominent.

### B.

Compact filter.

### C.

Filter panel dengan semua filter.

### D.

Context-dependent.

**Jawaban:**

---

## Pertanyaan 85 — Record Status vs Lifecycle

Untuk Agenda dan Pengumuman, ada beberapa axis berbeda.

Bagaimana UI harus membedakannya?

### A.

Separate labeled filters:

* Lifecycle;
* Record Status.

### B.

Satu filter gabungan.

### C.

Tabs.

### D.

Pendapat lain.

Catatan: Lifecycle dan Soft Delete tidak boleh digabung secara semantik.

**Jawaban:**

---

## Pertanyaan 86 — Restore

### A.

Restore terlihat langsung pada Soft Deleted row.

### B.

Masuk action menu.

### C.

Detail confirmation dulu.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 87 — Hard Delete

### A.

Button terlihat langsung.

### B.

Masuk overflow/destructive menu agar tidak mudah tertekan.

### C.

Hanya setelah membuka record.

### D.

Pendapat lain.

Tetap hanya untuk resource yang authorized.

**Jawaban:**

---

## Pertanyaan 88 — High Risk Confirmation

Hard Delete sebaiknya:

### A.

Modal dengan confirmation biasa.

### B.

Modal dengan target name + permanent warning + explicit destructive button.

### C.

Wajib mengetik nama target.

`POTENTIAL NEW INTERACTION` jika belum ada.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 89 — Kelola Dusun

List enam Dusun sebaiknya:

### A.

Table.

### B.

Cards.

### C.

Compact status list.

### D.

Context-dependent.

**Jawaban:**

---

## Pertanyaan 90 — Admin Dusun Accounts

Kelola akun Admin Dusun:

### A.

Table identity-management.

### B.

Cards grouped per Dusun.

### C.

Table dengan filter Dusun.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 91 — Removed Account

Akun logically removed:

### A.

Subdued read-only row.

### B.

Dipisah visual.

### C.

Hidden dari default view.

Harus tetap mengikuti behavior yang sudah dibekukan; jangan menambahkan restore.

**Jawaban:**

---

## Pertanyaan 92 — Data/Peta Super Admin

Page map-centric ini sebaiknya:

### A.

Map sebagai centerpiece besar.

### B.

Map + compact filter toolbar.

### C.

Map + side summary/list.

C berpotensi memerlukan additional data presentation; verifikasi source code sebelum memilih.

### D.

Pendapat lain.

**Jawaban:**

---

# BAGIAN Q — RESPONSIVE MOBILE DASHBOARD

## Pertanyaan 93 — Mobile Sidebar

### A.

Full-height drawer.

### B.

Compact navigation sheet.

### C.

Menu page.

### D.

Pendapat lain.

Behavior tetap openable navigation.

**Jawaban:**

---

## Pertanyaan 94 — Mobile Topbar

### A.

Menu + page title + account.

### B.

Menu + logo/context; title di content.

### C.

Minimal menu + account.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 95 — Mobile Table/Card Density

### A.

Satu record per large card.

### B.

Compact stacked card.

### C.

List row dengan expandable details.

C dapat menjadi interaction baru jika expand belum ada.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 96 — Mobile Filters

### A.

Selalu visible stacked controls.

### B.

Button "Filter" → panel/bottom sheet.

### C.

Horizontal controls.

### D.

Context-dependent.

**Jawaban:**

---

# BAGIAN R — MOTION & MICRO-INTERACTION

## Pertanyaan 97 — Motion Level

### A.

Hampir tanpa animation.

### B.

Subtle transitions/reveal/hover saja.

### C.

Lebih ekspresif.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 98 — Scroll Reveal Public

Source code sekarang memiliki scroll reveal.

### A.

Pertahankan sangat subtle.

### B.

Hapus.

### C.

Gunakan hanya section tertentu.

### D.

Biarkan frontend-design memutuskan.

**Jawaban:**

---

## Pertanyaan 99 — Carousel Animation

Horizontal carousel public:

### A.

Manual swipe saja.

### B.

Manual + smooth snapping.

### C.

Auto-slide.

Untuk keputusan Dusun sebelumnya, manual sudah dipilih.

**Jawaban:**

---

## Pertanyaan 100 — Hover Desktop

### A.

Card naik sedikit/elevation.

### B.

Border/background change.

### C.

Minimal/no movement.

### D.

Context-dependent.

**Jawaban:**

---

# BAGIAN S — ACCESSIBILITY & USABILITY

## Pertanyaan 101 — Visible Focus

### A.

Strong visible focus pada seluruh interactive control.

### B.

Subtle focus.

### C.

Browser default.

**Jawaban:**

---

## Pertanyaan 102 — Icon-only Actions

### A.

Boleh jika tooltip tersedia.

### B.

Untuk action penting/destructive selalu gunakan icon + text.

### C.

Mayoritas text only.

**Jawaban:**

---

## Pertanyaan 103 — Mobile Touch Targets

### A.

Prioritaskan touch target nyaman meski layout sedikit lebih tinggi.

### B.

Prioritaskan density.

### C.

Balance.

**Jawaban:**

---

## Pertanyaan 104 — Reduced Motion

### A.

Hormati `prefers-reduced-motion`.

### B.

Tidak diperlukan.

### C.

Biarkan implementation memutuskan.

**Jawaban:**

---

# BAGIAN T — KONSISTENSI DAN DESIGN DEBT

## Pertanyaan 105 — Inline Styles

### A.

Pindahkan inline styles visual ke class CSS saat view tersebut disentuh redesign.

### B.

Biarkan jika masih berfungsi.

### C.

Refactor semua sekaligus.

**Jawaban:**

---

## Pertanyaan 106 — app.css Monolitik

`app.css` sekarang sangat besar.

### A.

Tetap satu file untuk mengurangi risiko KKN; rapikan section/tokens saja.

### B.

Pecah menjadi public/admin/components.

### C.

Refactor total.

### D.

Agent menentukan setelah audit dependency.

**Jawaban:**

---

## Pertanyaan 107 — Duplicate Components

Jika terdapat partial/component visual duplikat yang ternyata tidak digunakan:

### A.

Jangan bersihkan saat redesign; fokus visual dulu.

### B.

Boleh cleanup hanya jika dipastikan dead code dan tests aman.

### C.

Refactor besar.

**Jawaban:**

---

## Pertanyaan 108 — Shared Admin Components

Jika banyak CRUD menggunakan markup yang sama:

### A.

Redesign lewat CSS shared primitives dulu.

### B.

Sekaligus refactor menjadi Blade components.

### C.

CSS-first, lalu refactor hanya jika benar-benar membantu dan tidak berisiko.

### D.

Pendapat lain.

**Jawaban:**

---

# BAGIAN U — PRIORITAS IMPLEMENTASI

## Pertanyaan 109 — Urutan Redesign Public

Pilih urutan:

### A.

Homepage → Dusun → Details → Map.

### B.

Dusun → Details → Public QA; Homepage hanya polish karena sudah approved.

### C.

Semua sekaligus.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 110 — Urutan Redesign Admin

### A.

Admin Dusun dulu, lalu Super Admin.

### B.

Shared admin shell/primitives → Admin Dusun + Super Admin secara bertahap.

### C.

Super Admin dulu.

### D.

Pendapat lain.

**Jawaban:**

---

## Pertanyaan 111 — Login

Login dikerjakan:

### A.

Sebelum dashboard.

### B.

Setelah dashboard design system sudah terbentuk.

### C.

Bersamaan dengan admin shell.

### D.

Pendapat lain.

**Jawaban:**

---

# BAGIAN V — REKOMENDASI AI AGENT

## Pertanyaan 112 — Public Design System Recommendation

Setelah membaca semua source dan keputusan pengguna:

Tuliskan rekomendasi struktur visual public site:

```text
PUBLIC DESIGN SYSTEM
├── Brand / Tokens
├── Header
├── Homepage
├── Dusun
├── Detail
├── Map
├── Public components
└── Footer
```

Jelaskan:

* apa yang shared;
* apa yang page-specific;
* apa yang tidak boleh diubah.

**Jawaban AI Agent:**

---

## Pertanyaan 113 — Admin Design System Recommendation

Buat rekomendasi:

```text
ADMIN DESIGN SYSTEM
├── Shell
├── Navigation
├── Context
├── Dashboard overview
├── Tables / Mobile rows
├── Forms
├── Filters
├── Feedback
├── Modals
├── Coordinate picker
└── Map
```

Jelaskan bagaimana satu sistem dapat digunakan oleh Admin Dusun dan Super Admin tanpa mencampur permissions.

**Jawaban AI Agent:**

---

## Pertanyaan 114 — File Impact Recommendation

Berdasarkan source code aktual, klasifikasikan:

### P0 — Shared visual foundation

### P1 — Public

### P2 — Public Detail

### P3 — Admin shell

### P4 — Admin module exceptions

### LOCK — functionality/backend

Jangan mengubah file.

**Jawaban AI Agent:**

---

## Pertanyaan 115 — Conflict Detection

Bandingkan seluruh jawaban questionnaire dengan:

* Requirements Baseline;
* PRD;
* Sitemap;
* User Flows;
* Roles/Permissions;
* source code saat ini.

Laporkan keputusan yang:

### SAFE VISUAL OVERRIDE

Hanya mengubah presentation/layout.

### REQUIRES OLD UI/WIREFRAME OVERRIDE

Bertentangan dengan keputusan visual/layout lama tetapi tidak mengubah functionality.

### POTENTIAL FUNCTIONAL CHANGE

Berpotensi menambah behavior/fitur.

### FORBIDDEN / CONTRADICTS PRODUCT

Bertentangan dengan requirement/role/data/lifecycle.

Gunakan format:

```text
Decision:
...

Classification:
SAFE VISUAL OVERRIDE / REQUIRES OLD UI OVERRIDE /
POTENTIAL FUNCTIONAL CHANGE / FORBIDDEN

Reason:
...
```

**Jawaban AI Agent:**

---

# BAGIAN W — REKOMENDASI FINAL AI AGENT

## Pertanyaan 116

Jika seluruh jawaban pengguna dianggap final, berikan rekomendasi **urutan implementation redesign paling aman**.

Gunakan:

```text
Phase 1
...

Phase 2
...

Phase 3
...
```

Jangan mengimplementasikan apa pun.

**Jawaban AI Agent:**

---

## Pertanyaan 117

Sebutkan keputusan pengguna yang menurut Anda masih berisiko menghasilkan:

* excessive scrolling;
* hidden content;
* poor mobile usability;
* accidental new functionality;
* inconsistent visual system;
* accessibility issue;
* maintainability problem.

Berikan kritik jika memang diperlukan.

**Jawaban AI Agent:**

---

# FINAL HUMAN DECISION

Setelah AI Agent memberi rekomendasi, keputusan akhir tetap milik manusia.

Tandai:

```text
[ ] Semua jawaban telah direview.
[ ] Potential Functional Change telah diputuskan.
[ ] Tidak ada fitur baru yang masuk secara tidak sengaja.
[ ] Halaman Dusun Decisions telah disinkronkan.
[ ] Public Design Decisions final.
[ ] Admin Design Decisions final.
[ ] Responsive Decisions final.
[ ] Redesign siap diturunkan menjadi ux-redesign-decisions.md.
```
