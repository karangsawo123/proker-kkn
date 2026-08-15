# Pertanyaan Lanjutan Finalisasi Requirement Web Desa Bendung

Pertanyaan berikut merupakan lanjutan dari 36 pertanyaan sebelumnya. Tujuannya untuk menyelesaikan detail yang masih belum pasti sebelum masuk ke sitemap, user flow, PRD/SRS, ERD, desain UI, dan implementasi.

Tidak perlu menjawab panjang. Jawaban singkat sudah cukup.

---

# A. Identitas Desa dan 6 Dusun

## 1. Apa nama resmi keenam dusun yang ada di Desa Bendung?

1. Dusun:
2. Dusun:
3. Dusun:
4. Dusun:
5. Dusun:
6. Dusun:

**Jawaban:**
Untuk awal menggunakan struktur 6 dusun (default/placeholder: Dusun A, Dusun B, Dusun C, Dusun D, Dusun E, Dusun F yang nantinya diisi nama resmi).
* **Hak Akses Super Admin (MVP):** Mengubah nama dusun, mengedit informasi/profil dusun, serta mengaktifkan/menonaktifkan (*toggle active*) status dusun.
* **Pengembangan Lanjutan:** Penambahan dusun baru.
* **Batasan Keamanan:** Meniadakan fitur hapus dusun permanen (*hard delete*) dari UI agar seluruh data terkait (UMKM, fasilitas, koordinat, kontak, agenda) tidak hilang sembarangan jika terjadi salah klik.

---

## 2. Data apa saja yang ingin ditampilkan sebagai identitas Desa Bendung di halaman utama?

Usulan:

* Nama Desa
* Logo
* Foto/banner
* Deskripsi singkat
* Alamat kantor desa
* Nomor kontak desa
* Email jika ada
* Nama kepala desa
* Jam pelayanan kantor desa
* Lainnya: ...

**Jawaban:**
Semua usulan di atas (Nama Desa, Logo, Foto/banner, Deskripsi singkat, Alamat kantor desa, Nomor kontak desa, Email jika ada, Nama kepala desa, Jam pelayanan kantor desa).

---

## 3. Apakah profil Desa Bendung perlu memiliki halaman khusus "Tentang Desa", atau cukup ditampilkan singkat di halaman utama?

Pilihan:

A. Cukup di halaman utama
B. Ada halaman khusus Tentang Desa
C. Belum perlu untuk MVP

**Jawaban:**
C. Belum perlu untuk MVP

---

# B. Halaman Utama dan Halaman Dusun

## 4. Pada halaman utama, setelah banner/identitas desa, bagian apa yang paling ingin ditonjolkan terlebih dahulu?

Pilihan:

A. Pilihan 6 Dusun
B. Peta Desa Bendung
C. Pengumuman/agenda terbaru
D. Kombinasi pilihan 6 Dusun dan Peta Desa
E. Lainnya: ...

**Jawaban:**
Kombinasi C dan D (Highlight utama pada kombinasi Pilihan 6 Dusun dan Peta Desa Bendung, serta menampilkan Pengumuman/Agenda terbaru).

---

## 5. Ketika pengguna membuka halaman sebuah dusun, informasi apa yang sebaiknya langsung terlihat paling atas?

Usulan:

* Nama dusun
* Foto/banner dusun
* Deskripsi singkat
* Nama Kepala Dusun
* Tombol kontak
* Menu informasi dusun
* Lainnya: ...

**Jawaban:**
Foto/banner + Nama Dusun + Menu navigasi cepat ke informasi dusun (UMKM, Fasilitas, Peta, Agenda/Kegiatan, Kontak).

---

## 6. Apakah setiap fitur dusun dibuat sebagai halaman terpisah atau tetap berada dalam satu halaman dusun?

Contoh:

**Model A — satu halaman panjang**

Dusun A
→ Profil
→ Kontak
→ UMKM
→ Fasilitas
→ Agenda
→ Peta

**Model B — halaman/menu terpisah**

Dusun A
→ Profil
→ UMKM
→ Fasilitas
→ Agenda
→ Peta

Pilihan:

A. Satu halaman utama dusun, detail tertentu bisa dibuka lagi
B. Semua dibuat halaman terpisah
C. Belum tahu, ditentukan saat desain UI/UX

**Jawaban:**
A. Satu halaman utama dusun (single page/scroll), detail tertentu (seperti rincian UMKM atau agenda) bisa dibuka lagi.

---

## 7. Pengumuman dusun sebelumnya disebut opsional karena tidak selalu ada, tetapi modul Pengumuman ditetapkan sebagai fitur WAJIB.

Apakah maksudnya:

A. Fitur/modul Pengumuman wajib tersedia, tetapi tidak wajib setiap dusun memiliki pengumuman setiap saat
B. Pengumuman sebenarnya tidak perlu menjadi fitur wajib
C. Lainnya: ...

**Jawaban:**
A. Fitur/modul Pengumuman wajib tersedia secara sistem, tetapi tidak wajib setiap dusun memiliki data pengumuman aktif setiap saat.

---

# C. Kontak Pelayanan

## 8. Apakah Kepala Dusun juga otomatis dimasukkan sebagai salah satu Kontak Pelayanan?

Pilihan:

A. Ya
B. Tidak, Kepala Dusun hanya ditampilkan di profil dusun
C. Tergantung masing-masing dusun

**Jawaban:**
C. Tergantung masing-masing dusun

---

## 9. Untuk kontak pelayanan, data minimal apa yang perlu disimpan?

Usulan:

* Nama
* Jabatan
* Nomor WhatsApp
* Foto opsional
* Status aktif/tidak aktif

**Jawaban:**
Semua usulan (Nama, Jabatan, Nomor WhatsApp, Foto opsional, Status aktif/tidak aktif).

---

## 10. Ketika tombol WhatsApp ditekan, bagaimana perilakunya?

A. Langsung membuka chat WhatsApp tanpa pesan otomatis
B. Membuka WhatsApp dengan pesan awal otomatis, misalnya:
"Halo, saya mendapatkan kontak ini dari Portal Desa Bendung..."
C. Belum perlu ditentukan

**Jawaban:**
B. Membuka WhatsApp dengan template pesan awal otomatis (misal: "Halo, saya mendapatkan kontak ini dari Portal Desa Bendung...") untuk menunjukkan bahwa pesan berasal dari web desa/dusun.

---

# D. UMKM

## 11. Untuk bagian "Produk" UMKM, apakah satu UMKM bisa mempunyai beberapa produk?

Contoh:

UMKM Bu Siti

* Keripik pisang
* Keripik singkong
* Kue kering

Pilihan:

A. Ya, bisa beberapa produk
B. Cukup ditulis sebagai deskripsi sederhana
C. Belum tahu

**Jawaban:**
A. Ya, bisa beberapa produk (format list/tags produk).

---

## 12. Apakah setiap UMKM wajib mempunyai lokasi/koordinat di peta?

A. Wajib
B. Opsional, jika lokasi berhasil didapatkan
C. Tidak perlu

**Jawaban:**
B. Opsional, jika lokasi berhasil didapatkan (UMKM tanpa koordinat tetap bisa tampil di direktori).

---

## 13. Berapa banyak foto yang diperlukan untuk satu UMKM?

A. Satu foto utama saja
B. Bisa beberapa foto
C. Satu foto untuk MVP, galeri bisa dikembangkan kemudian

**Jawaban:**
C. Satu foto untuk MVP, fitur galeri banyak foto bisa dikembangkan kemudian.

---

# E. Fasilitas Umum

## 14. Apakah kategori fasilitas dibuat tetap atau Super Admin dapat menambah kategori baru?

Contoh kategori awal:

* Pemerintahan/Pelayanan
* Kesehatan
* Pendidikan
* Ibadah
* Keamanan
* Lingkungan
* Olahraga
* Lainnya

Pilihan:

A. Kategori tetap
B. Super Admin bisa menambah/mengubah kategori
C. Belum tahu

**Jawaban:**
B. Super Admin bisa menambah/mengubah kategori fasilitas secara dinamis.

---

## 15. Apakah setiap fasilitas wajib mempunyai titik koordinat?

A. Ya, karena fasilitas akan terhubung ke peta
B. Tidak wajib, fasilitas tanpa koordinat tetap boleh ditampilkan
C. Tergantung fasilitasnya

**Jawaban:**
A. Ya, karena seluruh fasilitas akan terhubung langsung ke peta.

---

## 16. Untuk fasilitas yang memiliki kontak, apakah tombol WhatsApp/telepon juga perlu tersedia seperti Kontak Pelayanan?

A. Ya
B. Tidak
C. Hanya jika fasilitas memang mempunyai nomor pelayanan

**Jawaban:**
A. Ya, tombol interaktif tampil jika nomor kontak diisi. Nomor kontak untuk fasilitas bersifat opsional (tidak diwajibkan untuk semua fasilitas).

---

# F. Agenda dan Kegiatan

## 17. Data minimal sebuah Agenda & Kegiatan apa saja?

Usulan:

* Judul kegiatan
* Deskripsi
* Tanggal
* Jam
* Lokasi
* Foto/poster
* Dokumentasi setelah kegiatan selesai

**Jawaban:**
Judul kegiatan, Tanggal, Lokasi, Deskripsi singkat, serta Jam dan Foto/Poster awal (jika ada). Dokumentasi foto dapat ditambahkan setelah kegiatan berstatus selesai.

---

## 18. Apakah status kegiatan ingin ditentukan otomatis berdasarkan tanggal?

Contoh:

Sebelum tanggal kegiatan → **Akan Datang**

Setelah tanggal kegiatan → **Selesai**

Pilihan:

A. Ya, otomatis
B. Admin menentukan sendiri
C. Otomatis tetapi admin bisa mengubah jika diperlukan

**Jawaban:**
C. Otomatis berdasarkan tanggal sistem, namun Admin tetap dapat mengubah status secara manual jika diperlukan.

---

## 19. Apakah kegiatan bisa berlangsung lebih dari satu hari?

Jika iya, sistem membutuhkan:

* Tanggal mulai
* Tanggal selesai

Pilihan:

A. Ya
B. Tidak / cukup satu tanggal
C. Sebaiknya tetap didukung walaupun jarang

**Jawaban:**
C. Sebaiknya tetap didukung (Tanggal Selesai bersifat opsional jika kegiatan berlangsung lebih dari satu hari).

---

## 20. Apakah agenda tingkat Desa Bendung juga perlu dikelola oleh Super Admin?

Contoh:

* Jalan sehat desa
* Musyawarah desa
* Acara 17 Agustus tingkat desa

Pilihan:

A. Ya
B. Tidak, hanya agenda masing-masing dusun
C. Ya, tetapi hanya jika diperlukan

**Jawaban:**
A. Ya (Super Admin dapat mengelola agenda/kegiatan tingkat Desa Bendung).

---

# G. Pengumuman

## 21. Pengumuman tingkat desa dan pengumuman tingkat dusun akan dibedakan, benar?

Contoh:

**Pengumuman Desa**
→ berlaku untuk seluruh warga Desa Bendung

**Pengumuman Dusun**
→ hanya muncul di Dusun A

Pilihan:

A. Ya
B. Tidak
C. Ada konsep lain: ...

**Jawaban:**
A. Ya (dibedakan antara Pengumuman Desa dan Pengumuman Dusun).

---

## 22. Ketika pengumuman sudah melewati tanggal kedaluwarsa, apa yang terjadi?

A. Tidak tampil ke publik tetapi tetap tersimpan di dashboard admin
B. Otomatis dihapus
C. Tetap tampil sebagai arsip
D. Lainnya: ...

**Jawaban:**
Definisi siklus pengumuman:
* **Pengumuman Aktif (sebelum/pada tanggal kedaluwarsa):** Tampil di halaman utama homepage / halaman dusun terkait.
* **Pengumuman Sudah Kedaluwarsa:** Otomatis turun dari daftar pengumuman aktif utama, dan tetap dapat diakses/dilihat pada bagian **"Arsip Pengumuman"** (serta tersimpan di dashboard admin).

---

# H. Peta Desa dan Peta Dusun

## 23. Peta Desa hanya perlu menampilkan titik/marker lokasi atau juga batas wilayah setiap dusun?

**Model sederhana:**

📍 Balai Dusun
📍 Posyandu
📍 UMKM
📍 Sekolah

**Model lebih kompleks:**

Selain marker, terdapat garis/bidang batas wilayah Dusun A, B, C, dan seterusnya.

Pilihan:

A. Cukup titik/marker lokasi untuk MVP
B. Marker + batas wilayah dusun
C. Batas wilayah menjadi pengembangan nanti

**Jawaban:**
C. Cukup titik/marker lokasi untuk MVP, batas wilayah menjadi pengembangan nanti.

---

## 24. Filter apa yang diperlukan di Peta Desa?

Usulan:

**Filter Dusun**

* Semua Dusun
* Dusun A
* Dusun B
* dst.

**Filter Kategori**

* Semua
* UMKM
* Kesehatan
* Pendidikan
* Ibadah
* Pelayanan
* dll.

Pilihan:

A. Filter Dusun + Kategori
B. Hanya filter Dusun
C. Hanya filter Kategori
D. Lainnya: ...

**Jawaban:**
A. Filter Dusun + Kategori (Pengguna dapat memfilter berdasarkan dusun dan jenis kategori lokasi).

---

## 25. Apakah peta perlu memiliki pencarian nama lokasi?

Contoh pengguna mengetik:

`Posyandu Melati`

kemudian peta menunjukkan lokasi tersebut.

Pilihan:

A. Perlu untuk MVP
B. Tidak perlu, filter sudah cukup
C. Pengembangan nanti

**Jawaban:**
C. Pengembangan nanti (filter sudah cukup untuk MVP).

---

## 26. Saat pengguna memilih titik lokasi di peta, informasi apa yang perlu muncul?

Usulan:

* Nama
* Kategori
* Foto
* Alamat
* Deskripsi singkat
* Tombol lihat detail
* Tombol buka arah/navigasi

**Jawaban:**
Nama, Kategori, Foto, Alamat, Tombol Lihat Detail (di web), dan Tombol Buka Arah/Navigasi (ke Google Maps). Deskripsi singkat tidak ditampilkan di popup agar tampilan peta tetap rapi dan ringkas.

---

## 27. Apakah tombol "Arah ke Lokasi" perlu tersedia?

Tombol tersebut nantinya dapat membuka aplikasi Google Maps/aplikasi peta pengguna.

Pilihan:

A. Ya
B. Tidak
C. Pengembangan nanti

**Jawaban:**
A. Ya (tombol 'Arah ke Lokasi' tersedia dan membuka Google Maps).

---

## 28. Apakah Kontak Pelayanan sendiri perlu mempunyai titik lokasi di peta?

Contoh: Kepala Dusun/Kader Posyandu.

A. Tidak. Peta hanya untuk UMKM, fasilitas, dan lokasi publik
B. Bisa jika tempat pelayanan memang mempunyai lokasi publik
C. Semua kontak pelayanan mempunyai lokasi
D. Lainnya: ...

**Jawaban:**
B. Opsional (hanya ditambahkan ke titik peta jika yang bersangkutan bersedia/mengizinkan lokasinya dipublikasikan).

---

# I. Dashboard Admin

## 29. Apakah Admin Dusun boleh menghapus data secara permanen?

Contoh:

UMKM tutup atau kontak pelayanan sudah tidak aktif.

Pilihan:

A. Boleh langsung hapus
B. Sebaiknya ada opsi Nonaktifkan/Arsipkan sehingga data tidak langsung hilang
C. Hanya Super Admin yang boleh menghapus permanen

**Jawaban:**
B & C (Mekanisme *Soft Delete* / Nonaktifkan demi keamanan data):
* **Admin Dusun:** Hanya memiliki akses **Nonaktifkan / Arsipkan / Soft Delete** (data disembunyikan dari publik tanpa menghilangkan titik koordinat, foto, dan histori dari database).
* **Hapus Permanen (*Hard Delete*):** Hanya dapat dilakukan oleh Super Admin (atau ditiadakan dari UI) guna mencegah terhapusnya data penting UMKM/Fasilitas secara permanen akibat salah klik.

---

## 30. Apakah Admin Dusun perlu bisa mengatur urutan informasi?

Contoh menentukan UMKM/fasilitas tertentu yang tampil lebih dahulu.

Pilihan:

A. Perlu
B. Tidak perlu, sistem mengurutkan otomatis
C. Hanya Super Admin

**Jawaban:**
A. Perlu (Admin Dusun dapat mengatur urutan prioritas tampilnya informasi).

---

## 31. Ketika Admin Dusun login, apakah dashboard langsung masuk ke dusunnya tanpa pilihan dusun?

Contoh:

Admin Dusun A login
→ langsung Dashboard Dusun A
→ tidak bisa memilih Dusun B

Pilihan:

A. Ya
B. Tidak

**Jawaban:**
A. Ya (dashboard Admin Dusun langsung terkunci pada dusunnya masing-masing).

---

## 32. Untuk login Admin, identitas yang paling nyaman digunakan apa?

A. Username + password
B. Email + password
C. Nomor telepon + password
D. Belum ditentukan

**Jawaban:**
A. Username + password (paling praktis dan mudah diingat).

---

## 33. Jika Admin Dusun lupa password, bagaimana proses pemulihannya?

A. Meminta Super Admin melakukan reset password
B. Reset sendiri melalui email
C. Reset melalui WhatsApp/nomor HP
D. Belum perlu ditentukan

**Jawaban:**
A. Meminta Super Admin melakukan reset password secara langsung dari panel admin.

---

# J. Foto dan Media

## 34. Apakah foto diwajibkan untuk semua jenis data?

Contoh:

* Profil dusun
* UMKM
* Fasilitas
* Agenda

Pilihan:

A. Semua wajib foto
B. Foto hanya wajib untuk bagian tertentu
C. Foto bersifat opsional

Jika B, sebutkan bagian yang wajib:

**Jawaban:**
C. Foto bersifat opsional (sistem menyediakan gambar ilustrasi/default placeholder jika belum ada foto).

---

## 35. Jika suatu data tidak memiliki foto, apakah boleh menggunakan gambar/default placeholder?

A. Ya
B. Tidak
C. Tergantung jenis data

**Jawaban:**
A. Ya (menggunakan default placeholder/gambar ilustrasi yang rapi sesuai kategori).

---

# K. Pengalaman Pengguna

## 36. Target utama web adalah pengguna smartphone setelah scan QR. Apakah desain harus diprioritaskan untuk HP/mobile terlebih dahulu?

A. Ya, mobile-first
B. Desktop dan mobile sama penting
C. Belum ditentukan

**Jawaban:**
A. Ya, mobile-first (dioptimalkan untuk tampilan smartphone setelah scan QR).

---

## 37. Bahasa yang digunakan di web?

A. Bahasa Indonesia saja
B. Bahasa Indonesia + Jawa
C. Bahasa Indonesia + bahasa lain
D. Lainnya: ...

**Jawaban:**
A. Bahasa Indonesia saja.

---

## 38. Karena sebagian pengguna mungkin menggunakan koneksi internet yang tidak terlalu cepat, apakah kita sepakat web harus ringan dan foto dikompres/dioptimalkan?

A. Ya
B. Tidak menjadi prioritas
C. Belum tahu

**Jawaban:**
A. Ya. Web diprioritaskan ringan dan cepat dimuat. Foto yang diunggah akan dioptimalkan secara otomatis melalui resize dan kompresi, serta dikonversi ke format modern seperti WebP. SVG digunakan untuk aset vektor seperti logo dan ikon.

---

# L. Papan QR Fisik

## 39. Untuk proker fisiknya, sebenarnya akan dibuat berapa papan?

A. Satu papan utama Desa Bendung di Balai Desa
B. Satu papan yang memuat informasi seluruh 6 dusun
C. Enam papan/panel untuk masing-masing dusun tetapi ditempatkan di Balai Desa
D. Konsep lain: ...

**Jawaban:**
1 papan utama Desa Bendung di Balai Desa (pasti), dengan opsi pengembangan papan QR kecil di depan rumah Kepala Dusun / Balai Dusun masing-masing.

---

## 40. Informasi apa yang akan dicetak langsung pada papan selain QR Code?

Contoh:

* Nama Desa Bendung
* Nama 6 dusun
* Petunjuk "Scan QR untuk melihat informasi"
* Logo KKN/desa
* Penjelasan singkat portal
* Lainnya: ...

**Jawaban:**
Masih opsional / draf usulan (Nama Desa Bendung, Nama 6 dusun, Petunjuk Scan QR, Logo KKN & Desa, Penjelasan portal), karena desain visual papan akan dikerjakan oleh divisi/tim PDD dan masih akan didiskusikan lebih lanjut.

---

## 41. Apakah QR utama cukup satu dan mengarah ke Homepage Desa Bendung?

A. Ya
B. Ada beberapa QR pada papan
C. Belum ditentukan

**Jawaban:**
A. Ya (cukup 1 QR utama di Balai Desa yang mengarah ke Homepage Desa Bendung).

---

# M. Pengelolaan Data Awal

## 42. Siapa yang akan mengumpulkan data awal dari masing-masing dusun sebelum website diluncurkan?

A. Tim KKN
B. Kepala Dusun/Admin Dusun
C. Tim KKN bersama perangkat dusun
D. Lainnya: ...

**Jawaban:**
C. Tim KKN bersama perangkat dusun (Kepala Dusun / RT / RW setempat).

---

## 43. Siapa yang akan melakukan pengecekan bahwa data awal sudah benar sebelum website dipublikasikan?

A. Kepala Dusun masing-masing
B. Pemerintah Desa/Super Admin
C. Tim KKN
D. Kepala Dusun + Pemerintah Desa + Tim KKN
E. Lainnya: ...

**Jawaban:**
D. Kepala Dusun + Pemerintah Desa + Tim KKN (pengecekan bersama sebelum rilis publik).

---

## 44. Apakah data yang kosong boleh dibiarkan kosong saat website diluncurkan?

Contoh Dusun A belum mempunyai UMKM atau belum ada agenda.

A. Ya, tampilkan keterangan "Belum ada data"
B. Menu tersebut disembunyikan jika tidak memiliki data
C. Website baru diluncurkan setelah semua data lengkap

**Jawaban:**
A. Ya, tampilkan keterangan informatif "Belum ada data" (empty state ramah pengguna).

---

# N. Konfirmasi Scope Akhir

## 45. Apakah kita sepakat bahwa untuk MVP TIDAK membuat fitur berikut?

* Pengajuan surat online
* Pengaduan warga
* Login/akun warga
* Chat dengan perangkat desa
* Transaksi/e-commerce UMKM
* Pembayaran online
* GPS tracking
* Navigasi/rute buatan sendiri
* Forum warga
* Notifikasi aplikasi

Pilihan:

A. Setuju, tidak masuk MVP
B. Ada yang ingin dimasukkan. Sebutkan: ...

**Jawaban:**
A. Setuju, seluruh fitur kompleks di luar scope tersebut tidak masuk ke dalam MVP.

---

## 46. Dari seluruh sistem, tiga fungsi yang menurut kelompok PALING PENTING dan tidak boleh gagal adalah apa?

1. Akses Cepat Scan QR & Navigasi Antar Dusun yang responsif dan mobile-first.
2. Peta Interaktif Lokasi Fasilitas & UMKM yang akurat serta terintegrasi tombol navigasi Google Maps.
3. Direktori Kontak Pelayanan Warga yang mudah dihubungi via tombol WhatsApp langsung.

**Jawaban:**
1. Akses Cepat Scan QR & Navigasi Antar Dusun (mobile-first & responsif).
2. Peta Interaktif Fasilitas Umum & UMKM (+ rute Google Maps).
3. Direktori Kontak Pelayanan Warga via WhatsApp langsung.

---

# Catatan Tambahan Kelompok

Apakah ada ide, kekhawatiran, kebutuhan perangkat desa, atau kondisi lapangan yang belum terwakili dari semua pertanyaan sebelumnya?

**Jawaban:**
1. **Aspek Keamanan Sistem:** Pengamanan otentikasi login, hashing password yang kuat (bcrypt/argon2), proteksi dari celah injeksi (SQL/XSS), pembatasan akses data antar-admin dusun (Role-Based Access Control), dan rate-limiting agar aman dari serangan brute force.
2. **Pemilihan Tech Stack & Database:** Perlu memilih stack dan database yang stabil, ringan, mudah dikembangkan, serta tidak rumit untuk dirawat (maintainable) oleh operator desa dalam jangka panjang.
3. **Deploy & Hosting:** Perlu solusi hosting dan domain yang handal, efisien/hemat biaya (memanfaatkan opsi cloud free-tier atau hosting desa yang stabil), serta memiliki prosedur serah terima akun yang jelas dan mudah dipahami oleh pemerintah desa setelah masa KKN berakhir.

### Opsi Kandidat Solusi Teknis (Tahap R&D — Belum Merupakan Keputusan Final):
> **Catatan Penting:** Bagian di bawah ini merupakan **daftar opsi kandidat untuk tahap Riset & Evaluasi Teknis (R&D)**, dan **bukan merupakan keputusan arsitektur final**. Pemilihan tech stack definitif akan dikunci setelah evaluasi mendalam terhadap kemudahan serah terima ke pihak desa, stabilitas, dan efisiensi biaya.

* **Kandidat Frontend:** Modern HTML/CSS/JavaScript atau React/Next.js (Fokus evaluasi: *mobile-first*, kecepatan loading di HP, dan kemudahan pemeliharaan).
* **Kandidat Backend & Auth:** Node.js (Express / Next.js API Routes) (Fokus evaluasi: kemudahan integrasi middleware keamanan & role-based access).
* **Kandidat Database:** PostgreSQL (via Supabase / Neon) atau MySQL/MariaDB (Fokus evaluasi: kehandalan cloud database vs kompatibilitas cPanel hosting lokal desa).
* **Kandidat Peta Interaktif:** Leaflet.js + OpenStreetMap (OSM) (Fokus evaluasi: bebas biaya *API key billing* Google Maps dan ringan dimuat).
* **Kandidat Hosting & Deployment:** Cloud Modern (Vercel / Netlify / Railway) atau Shared Hosting cPanel Desa (Fokus evaluasi: stabilitas uptime dan prosedur transfer kepemilikan akun ke pihak desa).



