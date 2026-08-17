# Pertanyaan Keputusan Redesign — Halaman Dusun

## Tujuan

Pertanyaan ini digunakan untuk menentukan **prioritas informasi, urutan section, kepadatan konten, dan pola interaksi** pada Halaman Dusun sebelum redesign dilakukan.

AI Agent boleh:

* membaca source code project;
* membaca dokumentasi project;
* melihat struktur data dan fitur yang sudah ada;
* memberikan rekomendasi untuk setiap pilihan;
* menjelaskan kelebihan dan kekurangan pilihan.

AI Agent **tidak boleh mengubah requirement atau functionality** hanya untuk menjawab pertanyaan ini.

Keputusan yang dibahas di sini hanya menyangkut:

* urutan informasi;
* layout;
* visual composition;
* navigation presentation;
* kepadatan konten;
* pola card/list/carousel;
* responsive behavior;
* cara mengurangi scroll berlebihan;
* kemudahan penggunaan mobile.

---

# Pertanyaan 1 — Konten Pertama Setelah Hero dan Quick Navigation

Setelah pengguna membuka Halaman Dusun dan melihat:

1. Hero / identitas Dusun
2. Quick Navigation

Informasi apa yang sebaiknya muncul **paling awal**?

### A. Peta Dusun

Peta langsung menjadi bagian utama setelah Quick Navigation.

Tujuannya agar pengguna segera mengetahui:

* lokasi penting;
* fasilitas;
* UMKM;
* pelayanan;
* persebaran tempat di Dusun.

### B. Profil Dusun

Tetap menggunakan pendekatan informasi tradisional:

Hero → Quick Nav → Profil Dusun → informasi lainnya.

### C. Kontak Pelayanan

Pelayanan masyarakat menjadi informasi paling prioritas setelah Quick Navigation.

### D. Pendapat lain

Tuliskan urutan yang menurut Anda lebih tepat.

**Jawaban:**
B. Profil Dusun — Mengenalkan identitas & narasi dusun terlebih dahulu secara ringkas (editorial & ringkas) sebelum masuk ke direktori dan peta wilayah.

---

# Pertanyaan 2 — Quick Navigation pada Mobile

Saat ini Halaman Dusun memiliki banyak section seperti:

* Profil
* Kepala Dusun
* Kontak
* UMKM
* Fasilitas
* Agenda
* Pengumuman
* Peta

Bagaimana Quick Navigation sebaiknya ditampilkan pada mobile?

### A. Grid / dua baris

Semua menu langsung terlihat tanpa pengguna harus swipe horizontal.

Contoh konseptual:

Profil | Peta | Kontak | UMKM
Fasilitas | Agenda | Pengumuman | Kepala Dusun

Layout aktual boleh dibuat lebih baik ketika redesign.

### B. Horizontal scroll

Quick Navigation tetap satu baris dan pengguna swipe kiri/kanan.

### C. Tombol menu

Hanya tampil tombol seperti:

**Jelajahi Dusun**

Ketika ditekan, semua pilihan section muncul.

### D. Pendapat lain

**Jawaban:**
A. Grid / dua baris — Semua menu langsung terlihat sekaligus tanpa pengguna harus swipe horizontal (tata letak kompak & scannable di mobile).

---

# Pertanyaan 3 — Sticky Quick Navigation

Apakah Quick Navigation perlu tetap tersedia ketika pengguna sudah scroll jauh ke bawah?

### A. Selalu sticky

Quick Navigation tetap berada di bagian atas viewport selama pengguna menjelajahi Halaman Dusun.

### B. Tidak sticky

Quick Navigation hanya tampil satu kali setelah Hero.

### C. Sticky setelah Hero dilewati

Quick Navigation awalnya berada di bawah Hero.

Setelah pengguna scroll melewati Hero, navigation berubah menjadi versi lebih compact dan tetap tersedia di atas layar.

### D. Pendapat lain

**Jawaban:**
B. Tidak sticky — Quick Navigation hanya tampil satu kali secara statis setelah Hero untuk menghemat ruang vertikal layar mobile dan menjaga pengalaman baca tetap bersih tanpa elemen yang menutupi konten.

---

# Pertanyaan 4 — Tingkat Dominasi Peta Dusun

Jika Peta Dusun ditempatkan dekat bagian atas halaman, bagaimana ukurannya?

### A. Peta besar sebagai centerpiece

Peta menjadi salah satu visual utama Halaman Dusun.

### B. Peta ukuran sedang

Peta ditampilkan bersama ringkasan beberapa lokasi penting.

### C. Preview peta kecil

Peta hanya berupa preview dan pengguna melakukan tindakan tertentu untuk melihatnya lebih besar.

### D. Pendapat lain

**Jawaban:**
B. Peta ukuran sedang — Peta ditampilkan proporsional bersama ringkasan lokasi penting/filter kategori tanpa memakan seluruh tinggi layar mobile, menjaga agar pengguna tetap mudah melakukan scroll halaman.

---

# Pertanyaan 5 — Kontak Pelayanan Jika Datanya Banyak

Jika satu Dusun mempunyai banyak Kontak Pelayanan, bagaimana sebaiknya ditampilkan agar halaman tidak terlalu panjang?

### A. Horizontal swipe cards

Tampilkan beberapa card dalam satu baris horizontal yang dapat digeser.

Sebagian card berikutnya dapat terlihat untuk memberi tanda bahwa masih ada data lain.

### B. Grid semua kontak

Semua kontak langsung terlihat.

### C. Beberapa kontak + Lihat Lainnya

Tampilkan misalnya 3 kontak terlebih dahulu kemudian:

**Lihat kontak lainnya**

### D. Pendapat lain

**Jawaban:**
A. Horizontal swipe cards — Menampilkan kartu kontak dalam baris horizontal yang dapat digeser (swipeable) secara natural pada mobile, dengan potongan kartu berikutnya terlihat sebagai affordance visual.

---

# Pertanyaan 6 — UMKM Jika Datanya Banyak

Jika satu Dusun memiliki banyak UMKM, bagaimana sebaiknya tampilannya?

### A. Horizontal swipe / carousel

Card UMKM digeser secara horizontal.

Tidak harus auto-scroll.

### B. Grid semua UMKM

Semua UMKM langsung ditampilkan pada halaman.

### C. Beberapa UMKM + Lihat Semua

Tampilkan beberapa UMKM terlebih dahulu kemudian sediakan akses ke data lainnya.

Perlu diperhatikan bahwa jangan membuat page/fitur baru apabila belum tersedia pada requirement.

### D. Pendapat lain

**Jawaban:**
A. Horizontal swipe / carousel — Kartu UMKM ditampilkan dalam format horizontal swipeable yang mulus, memungkinkan pengguna menjelajahi banyak UMKM tanpa memanjangkan halaman vertikal secara berlebihan.

---

# Pertanyaan 7 — Perlukah Carousel Bergerak Otomatis?

Untuk section seperti:

* UMKM;
* Fasilitas;
* Kontak;

apakah carousel sebaiknya bergerak otomatis?

### A. Tidak

Pengguna menggeser sendiri.

Ini lebih stabil untuk membaca konten.

### B. Ya, auto-slide lambat

Carousel bergeser otomatis dengan interval yang cukup lama dan tetap dapat dikontrol pengguna.

### C. Auto-slide hanya pada desktop

Mobile menggunakan swipe manual.

### D. Pendapat lain

**Jawaban:**
A. Tidak (Manual Swipe) — Pengguna menggeser kartu secara mandiri. Ini memberikan kontrol penuh bagi pembaca, menghindari disorientasi visual, serta mematuhi prinsip aksesibilitas (tidak bergerak tiba-tiba saat dibaca).

---

# Pertanyaan 8 — Fasilitas Jika Datanya Banyak

Bagaimana section Fasilitas sebaiknya ditampilkan?

### A. Horizontal carousel

Semua fasilitas menggunakan card horizontal yang dapat digeser.

### B. Kategori terlebih dahulu

Tampilkan kategori seperti:

* Pendidikan
* Ibadah
* Kesehatan
* Pemerintahan
* dan kategori lain yang tersedia

kemudian pengguna melihat fasilitas berdasarkan kategori.

### C. Kategori + horizontal cards

Kategori membantu filter/scanning dan data fasilitas tetap ditampilkan dalam card horizontal.

### D. Grid/list biasa

### E. Pendapat lain

**Jawaban:**
C. Kategori + horizontal cards — Menyediakan filter kategori (Pendidikan, Ibadah, Kesehatan, Pemerintahan, dll.) berbentuk pills/tabs yang interaktif, dengan daftar kartu fasilitas yang ditampilkan secara horizontal swipeable sesuai kategori terpilih.

---

# Pertanyaan 9 — Profil Dusun dan Kepala Dusun

Saat ini Profil Dusun dan Kepala Dusun merupakan section yang terpisah.

Apakah perlu tetap seperti itu?

### A. Tetap dua section

Profil Dusun dan Kepala Dusun memiliki area masing-masing.

### B. Gabungkan secara visual menjadi "Tentang Dusun"

Bukan menghapus data atau fitur.

Informasi tetap tersedia, tetapi secara visual dapat menjadi satu composition.

Contoh:

* deskripsi Dusun;
* foto/banner;
* jumlah RT/RW;
* Kepala Dusun;
* informasi identitas penting.

### C. Pendapat lain

**Jawaban:**
B. Gabungkan secara visual menjadi "Tentang Dusun" — Menyatukan narasi profil, foto lanskap dusun, statistik data RT/RW, dan kartu profil Kepala Dusun dalam satu komposisi editorial yang terpadu dan berdimensi, tanpa mengurangi satu pun data atau fungsionalitas yang ada.

---

# Pertanyaan 10 — Agenda dan Pengumuman

Bagaimana Agenda & Kegiatan serta Pengumuman sebaiknya ditampilkan?

### A. Dua section besar dan terpisah

Agenda mempunyai section sendiri.

Pengumuman mempunyai section sendiri.

### B. Satu area visual "Informasi Terbaru"

Secara visual ditempatkan berdekatan.

Tetapi secara data dan functionality tetap:

* Agenda & Kegiatan;
* Pengumuman.

Tidak boleh digabung menjadi satu model/fitur.

### C. Agenda lebih dominan

Agenda ditampilkan besar, Pengumuman lebih compact.

### D. Pengumuman lebih dominan

Pengumuman ditampilkan besar, Agenda lebih compact.

### E. Pendapat lain

**Jawaban:**
B. Satu area visual "Informasi Terbaru" — Menempatkan Agenda Kegiatan dan Pengumuman dalam satu area visual terpadu (berdampingan 2 kolom di desktop, tab/accordion cerdas di mobile) untuk memangkas panjang halaman vertikal secara drastis tanpa menggabungkan relasi data atau fungsinya.

---

# Pertanyaan 11 — Mengurangi Scroll Vertikal

Halaman Dusun tetap merupakan single-page.

Namun bagaimana strategi terbaik untuk menghindari halaman menjadi terlalu panjang?

Boleh memilih beberapa:

### A.

Horizontal carousel untuk resource yang memiliki banyak item.

### B.

Batasi jumlah item yang langsung terlihat.

### C.

Gabungkan section yang secara visual berkaitan tanpa menggabungkan functionality.

### D.

Gunakan layout dua kolom pada desktop.

### E.

Gunakan compact card pada mobile.

### F.

Collapse/expand untuk informasi sekunder.

### G.

Tetap tampilkan seluruh informasi secara vertikal.

### H.

Pendapat lain.

**Jawaban:**
Pilihan: **A, C, D, E**
1. **A** — Horizontal carousel / swipeable cards untuk item banyak (UMKM, Fasilitas, Kontak).
2. **C** — Penggabungan visual section yang berdekatan konteksnya (Profil + Kepala Dusun, Agenda + Pengumuman).
3. **D** — Layout multi-kolom asimetris pada desktop untuk memaksimalkan ruang horizontal.
4. **E** — Penggunaan compact card terstruktur pada mobile (padding efisien & hemat ruang vertikal).

---

# Pertanyaan 12 — Apakah Semua Section Harus Memiliki Card?

Bagaimana pendekatan visual Halaman Dusun?

### A.

Sebagian besar informasi menggunakan card agar konsisten.

### B.

Gunakan variasi composition.

Contoh:

* Profil → editorial section;
* Kepala Dusun → profile composition;
* Peta → full-width visual section;
* Kontak → compact directory;
* UMKM → visual carousel;
* Fasilitas → category/card system;
* Agenda → event treatment;
* Pengumuman → notice/list treatment.

### C.

Pendapat lain.

**Jawaban:**
B. Gunakan variasi komposisi visual — Setiap section memiliki perlakuan unik yang disesuaikan dengan jenis kontennya (Profil = editorial narasi, Peta = visual landscape terintegrasi, UMKM = visual carousel, Fasilitas = category filter pills, Agenda = event cards, Pengumuman = official notice list, Kontak = compact swipeable directory) sehingga antarmuka berdimensi, dinamis, dan tidak terasa flat.

---

# Pertanyaan 13 — Posisi Kontak Pelayanan

Karena salah satu kebutuhan utama portal adalah memudahkan warga menghubungi pelayanan, di mana Kontak Pelayanan sebaiknya berada?

### A.

Setelah Profil/Kepala Dusun.

### B.

Setelah Peta.

### C.

Sangat dekat dengan bagian atas, bahkan sebelum Profil.

### D.

Posisi lain.

**Jawaban:**
A. Setelah Profil/Kepala Dusun ("Tentang Dusun") — Membentuk hierarki informasi yang runut: Pengunjung mengidentifikasi nama dusun dan pimpinannya terlebih dahulu, kemudian langsung disajikan akses kontak petugas pelayanan publik untuk kebutuhan warga.

---

# Pertanyaan 14 — Hubungan Peta dengan Fasilitas dan UMKM

Peta dan directory UMKM/Fasilitas sebenarnya menunjukkan data yang berkaitan.

Bagaimana hubungan visualnya sebaiknya dibuat?

### A.

Peta berdiri sendiri dan UMKM/Fasilitas tetap section biasa.

### B.

Peta menjadi orientasi awal.

Setelah Peta, pengguna diperkenalkan ke resource seperti:

* Pelayanan;
* Fasilitas;
* UMKM.

### C.

Peta ditempatkan setelah seluruh directory seperti sekarang.

### D.

Pendapat lain.

**Jawaban:**
B. Peta menjadi orientasi awal sebelum eksplorasi detail — Peta interaktif memberikan pemahaman spasial persebaran wilayah dusun terlebih dahulu, lalu disambung secara harmonis dengan direktori Fasilitas umum dan UMKM warga yang ada di titik-titik tersebut.

---

# Pertanyaan 15 — Prioritas Informasi Mobile

Jika ruang layar mobile sangat terbatas, informasi apa yang paling penting muncul lebih dahulu?

Urutkan dari **1 = paling penting**.

* [ ] Identitas / Nama Dusun
* [ ] Quick Navigation
* [ ] Peta
* [ ] Profil
* [ ] Kepala Dusun
* [ ] Kontak Pelayanan
* [ ] UMKM
* [ ] Fasilitas
* [ ] Agenda
* [ ] Pengumuman

**Jawaban / Urutan:**

1. **Identitas / Nama Dusun (Hero)**
2. **Quick Navigation (Grid 2 Baris Kompak)**
3. **Profil & Kepala Dusun ("Tentang Dusun" Editorial)**
4. **Peta Dusun (Peta Orientasi Spasial Sedang)**
5. **Kontak Pelayanan (Swipeable Service Cards)**
6. **UMKM (Katalog Usaha Warga Swipeable)**
7. **Fasilitas (Sarana Publik + Filter Kategori)**
8. **Agenda Kegiatan (Event Terkini)**
9. **Pengumuman (Maklumat Resmi)**

---

# Pertanyaan 16 — Tujuan Utama Halaman Dusun

Karakter Halaman Dusun sebaiknya paling mendekati:

### A. Profil resmi Dusun

Prioritas utama pada identitas, profil, pemerintahan, dan informasi formal.

### B. Direktori pelayanan

Prioritas utama menemukan pelayanan, kontak, dan fasilitas.

### C. Portal eksplorasi Dusun

Pengguna dapat dengan cepat:

1. memahami Dusun;
2. melihat lokasi melalui Peta;
3. menemukan pelayanan;
4. melihat fasilitas;
5. menemukan UMKM;
6. melihat kegiatan dan Pengumuman.

### D. Campuran

Jelaskan prioritasnya.

**Jawaban:**
C. Portal Eksplorasi Dusun Terpadu — Berfungsi sebagai pusat orientasi dan eksplorasi warga/pengunjung: mengenal dusun dan pimpinannya, memahami peta sebaran titik, mengakses layanan kontak cepat, menjelajahi potensi ekonomi (UMKM) & fasilitas, serta memantau kegiatan & pengumuman resmi.

---

# Pertanyaan 17 — Rekomendasi AI Agent

Setelah membaca:

* source code Halaman Dusun saat ini;
* Sitemap;
* User Flow;
* UI/UX Specification;
* Wireframe Specification;
* Visual Design Specification;

berikan rekomendasi Anda mengenai **urutan section Halaman Dusun yang paling efektif**, khususnya untuk pengguna smartphone.

Gunakan format:

```text
Hero
↓
...
↓
...
↓
Footer
```

Jangan menambah fitur baru.

Jelaskan singkat alasan dari urutan tersebut.

**Jawaban AI Agent:**

```text
Hero / Identitas Dusun (Banner + Nama Dusun + Deskripsi Singkat)
↓
Quick Navigation (Kompak 2-Row Grid — 8 Menu Terlihat Sekaligus)
↓
Tentang Dusun (Editorial: Narasi Profil + Ringkasan RT/RW + Kartu Kepala Dusun)
↓
Peta Dusun (Peta Wilayah Terintegrasi Ukuran Sedang + Kategori Filter)
↓
Kontak Pelayanan (Horizontal Swipeable Cards + Direct WhatsApp CTA)
↓
Potensi UMKM Warga (Horizontal Swipeable Showcase Usaha Lokal)
↓
Fasilitas Umum (Kategori Filter Pills + Horizontal Cards)
↓
Informasi Terkini (Komposisi Berdampingan / Tab: Agenda Kegiatan & Pengumuman)
↓
Footer Publik Resmi
```

**Alasan / Rationale:**
1. **Orientasi Cepat:** Hero dan Quick Nav langsung memberikan identitas dusun dan jalan pintas ke seluruh section.
2. **Konteks Manusiawi & Wilayah ("Tentang Dusun"):** Penggabungan Profil dan Kepala Dusun memberikan gambaran lengkap siapa pimpinan dan bagaimana karakteristik wilayah dalam satu pandangan ringkas.
3. **Jembatan Spasial (Peta):** Peta dinaikkan setelah profil agar pengguna memahami peta sebaran titik dusun sebelum melihat daftar detailnya di bawah.
4. **Aksesibilitas Layanan Warga (Kontak):** Kontak pelayanan ditaruh strategis agar warga yang butuh nomor darurat/pelayanan dapat langsung menghubunginya tanpa scroll jauh.
5. **Anti Scroll-Fatigue (Katalog Horizontal):** UMKM dan Fasilitas menggunakan horizontal swipe berfilter kategori, memangkas panjang halaman hingga >60%.
6. **Berita Terkini:** Agenda dan Pengumuman dikelompokkan bersama di bagian penutup sebelum footer sebagai informasi dinamis.

---

# Pertanyaan 18 — Masalah UX yang Mungkin Belum Kami Sadari

Periksa Halaman Dusun saat ini.

Apakah terdapat masalah UX seperti:

* terlalu panjang;
* terlalu banyak card;
* hierarchy informasi kurang jelas;
* resource terlalu banyak tampil sekaligus;
* navigation sulit di mobile;
* Peta terlalu jauh di bawah;
* CTA penting sulit ditemukan;
* pengulangan informasi;
* section yang dapat digabung secara visual;
* mobile interaction yang kurang efisien?

Tuliskan hanya masalah yang benar-benar Anda temukan dari source code dan dokumentasi.

Untuk setiap masalah gunakan format:

```text
Masalah:
...

Dampak:
...

Rekomendasi:
...
```

**Jawaban AI Agent:**

Masalah 1:
```text
Masalah:
Peta Dusun "Terkubur" di Bagian Paling Dasar Halaman (Section 10).

Dampak:
Fitur peta interaktif Leaflet yang kaya informasi menjadi hampir tidak pernah dilihat oleh pengguna smartphone karena berada di urutan paling akhir sebelum footer.

Rekomendasi:
Naikkan posisi Peta Dusun ke posisi tengah (setelah Tentang Dusun / Kontak) dengan tinggi sedang (usable height), menjadikannya jembatan visual sebelum pengguna mengeksplorasi UMKM dan Fasilitas.
```

Masalah 2:
```text
Masalah:
Vertical Scroll Fatigue Akibat 10 Section Bertumpuk Vertikal 1 Kolom.

Dampak:
Jika satu dusun memiliki 10 UMKM, 6 fasilitas, dan 5 kontak pelayanan, panjang halaman mobile menjadi sangat ekstrem (>8000px height), membuat pengunjung jenuh dan kehilangan orientasi halaman.

Rekomendasi:
Terapkan Horizontal Swipeable Cards (Carousel manual) untuk UMKM, Fasilitas, dan Kontak Pelayanan, serta gabungkan Profil + Kepala Dusun dan Agenda + Pengumuman.
```

Masalah 3:
```text
Masalah:
Card Fatigue & Visual Flatness (Semua Data Dibungkus Box Kotak Seragam).

Dampak:
Pengalaman pengguna terasa monoton dan datar. Tidak ada kontras hierarki visual antara data pimpinan dusun, nomor darurat kontak, etalase usaha UMKM, dan pengumuman resmi.

Rekomendasi:
Gunakan variasi komposisi visual: editorial narasi untuk profil dusun, card personil berelevasi untuk Kepala Dusun & Kontak, carousel visual untuk UMKM, filter pills untuk fasilitas, dan list resmi untuk pengumuman.
```

Masalah 4:
```text
Masalah:
Quick Navigation 1 Baris Horizontal Memiliki Hidden Menu di Layar Kecil.

Dampak:
Pada navigasi 1 baris swipe horizontal lama, item navigasi ke-5 hingga ke-8 (Fasilitas, Agenda, Pengumuman, Peta) tersembunyi di luar layar dan sering tidak disadari oleh pengguna.

Rekomendasi:
Gunakan Grid 2 Baris Kompak (4x2) pada mobile sehingga seluruh 8 pintasan section langsung terlihat jelas dalam satu pandangan tanpa perlu swipe.
```

Masalah 5:
```text
Masalah:
Penyebaran Puluhan Inline Styles Hardcoded di View Blade.

Dampak:
Menyulitkan maintenance, merusak konsistensi responsif, serta menghalangi penerapan efek hover/active state dan transisi sentuhan yang halus di mobile.

Rekomendasi:
Pindahkan seluruh inline style ke CSS tokens dan class terstruktur di app.css yang mendukung micro-interactions responsif.
```
