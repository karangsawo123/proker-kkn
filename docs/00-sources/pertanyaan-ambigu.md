# O. Finalisasi Ambiguity Requirements

Bagian ini merupakan klarifikasi terakhir untuk menyelesaikan ambiguity yang masih memengaruhi perilaku software sebelum `requirements-baseline.md` ditetapkan sebagai baseline MVP final.

Pertanyaan operasional yang belum harus selesai sekarang, seperti nama resmi dusun, nama pemegang Super Admin, calon Admin setiap dusun, provider hosting/domain, dan dataset aktual saat launching, tetap boleh berstatus `OPEN`.

---

## 47. Bagaimana aturan hapus permanen untuk data selain entitas Dusun?

Keputusan yang sudah ada:

* Admin Dusun **tidak boleh hard delete**.
* Admin Dusun hanya dapat melakukan **Nonaktifkan / Soft Delete** sehingga data hilang dari publik tetapi masih tersimpan.
* Entitas Dusun sendiri **tidak memiliki hard delete dari UI**.

Yang belum ditentukan adalah kewenangan Super Admin terhadap data seperti UMKM, fasilitas, kontak, agenda/kegiatan, dan pengumuman.

Pilihan:

**A.** Super Admin boleh melakukan hard delete permanen terhadap data selain Dusun.

**B.** Tidak ada hard delete dari dashboard sama sekali. Super Admin hanya dapat melakukan soft delete dan restore.

**C.** Super Admin boleh hard delete hanya untuk jenis data tertentu. Sebutkan: ...

**Jawaban:** A. Super Admin boleh melakukan hard delete permanen terhadap data selain Dusun.

---

## 48. Apakah kita sepakat membedakan istilah "Arsip Pengumuman" dan "Soft Delete/Nonaktif"?

Agar tidak membingungkan:

### Arsip Pengumuman

Pengumuman yang sudah kedaluwarsa.

* Tidak lagi tampil sebagai pengumuman aktif.
* **Tetap dapat dilihat publik** pada halaman Arsip Pengumuman.
* Tetap tersedia di dashboard admin.

### Nonaktif / Soft Delete

Data operasional seperti UMKM, fasilitas, kontak, agenda, dan lainnya yang dinonaktifkan admin.

* **Tidak tampil kepada publik.**
* Tetap tersimpan di database.
* Dapat dipulihkan/diaktifkan kembali.

Dengan demikian istilah "Arsip" sebaiknya khusus digunakan untuk **Arsip Pengumuman**, sedangkan penghapusan sementara data menggunakan istilah **Nonaktifkan / Soft Delete / Sampah**.

Pilihan:

**A.** Setuju.

**B.** Tidak setuju, gunakan konsep lain: ...

**Jawaban:** A. Setuju (Arsip khusus untuk Pengumuman publik yang kedaluwarsa, Nonaktif/Soft Delete untuk data operasional non-publik).

---

## 49. Seberapa besar hak pengelolaan Super Admin terhadap seluruh data dari 6 dusun?

Saat ini sudah ditetapkan bahwa Super Admin mempunyai akses ke seluruh dusun dan seluruh modul.

Apakah maksudnya Super Admin dapat melakukan pengelolaan penuh terhadap:

* Profil setiap dusun
* Kontak Pelayanan
* UMKM
* Fasilitas
* Agenda & Kegiatan
* Pengumuman
* Kategori fasilitas
* Data tingkat Desa
* Akun Admin Dusun

Pilihan:

**A.** Ya. Super Admin memiliki hak pengelolaan penuh terhadap seluruh modul dan seluruh dusun, dengan aturan penghapusan tetap mengikuti jawaban Pertanyaan 47.

**B.** Tidak. Super Admin hanya boleh melihat sebagian data dan mengelola modul tertentu.

Jika B, jelaskan batasannya:

**Jawaban:** A. Ya. Super Admin memiliki hak pengelolaan penuh terhadap seluruh modul dan seluruh dusun, dengan aturan penghapusan tetap mengikuti jawaban Pertanyaan 47.

---

## 50. Apa yang terjadi jika Super Admin menonaktifkan sebuah Dusun?

Contoh:

`Dusun A → Status: Tidak Aktif`

Pilihan:

### A.

Dusun yang tidak aktif:

* Tidak muncul pada pilihan dusun di homepage.
* Titik dari dusun tersebut tidak muncul di Peta Desa publik.
* Halaman publik Dusun tidak dapat digunakan seperti biasa / menampilkan informasi bahwa Dusun sedang tidak aktif.
* Seluruh data tetap tersimpan.
* Admin Dusun **masih boleh login dan memperbarui data**.
* Super Admin dapat mengaktifkannya kembali.

### B.

Sama seperti A, tetapi Admin Dusun juga tidak dapat mengakses dashboard selama Dusun berstatus tidak aktif.

### C.

Konsep lain: ...

**Jawaban:** A. Dusun tidak aktif disembunyikan dari publik, namun Admin Dusun tetap boleh login ke dashboard untuk mengelola/memperbarui data.

---

## 51. Bagaimana lifecycle/status Agenda & Kegiatan?

Saat ini sistem mendukung:

* Kegiatan satu hari.
* Kegiatan beberapa hari.
* Status otomatis berdasarkan tanggal.
* Admin tetap dapat melakukan override status jika diperlukan.

Pilihan:

### A. Tiga status

`Akan Datang → Berlangsung → Selesai`

Aturan:

* Sebelum tanggal mulai → **Akan Datang**
* Saat tanggal kegiatan berlangsung → **Berlangsung**
* Setelah tanggal selesai → **Selesai**
* Jika tanggal selesai kosong, tanggal mulai dianggap sebagai tanggal selesai untuk perhitungan status.
* Admin tetap dapat melakukan override manual jika diperlukan.

### B. Dua status

`Akan Datang → Selesai`

Tidak ada status Berlangsung.

### C. Konsep lain: ...

**Jawaban:** A. Tiga status (Akan Datang → Berlangsung → Selesai) otomatis berdasarkan tanggal dengan opsi override manual.

---

## 52. Apakah field "Jam Kegiatan" wajib diisi?

Contoh:

**Kerja Bakti**

Tanggal: 20 Agustus
Jam: 07.00 WIB

Tetapi mungkin ada kegiatan yang belum mempunyai jam pasti.

Pilihan:

**A.** Jam wajib.

**B.** Jam opsional. Jika belum diketahui, kegiatan tetap dapat dibuat tanpa jam.

**Jawaban:** B. Jam opsional (kegiatan tetap dapat dibuat dan dipublikasikan tanpa jam).

---

## 53. Untuk fasilitas yang mempunyai nomor kontak, tombol apa yang ditampilkan?

Contoh fasilitas:

`Posyandu Melati`

Nomor kontak tersedia.

Pilihan:

**A.** Tombol WhatsApp saja.

**B.** Tombol Telepon saja.

**C.** Mendukung keduanya. Jika nomor dapat digunakan untuk WhatsApp, tampilkan tombol WhatsApp; jika tersedia nomor telepon, dapat pula ditampilkan tombol Telepon.

**D.** Konsep lain: ...

**Jawaban:** A. Tombol WhatsApp saja.

---

## 54. Modul apa saja yang boleh diatur urutan prioritas tampilnya oleh Admin Dusun?

Contoh:

Admin ingin menentukan UMKM tertentu tampil terlebih dahulu.

Pilihan:

### A.

Hanya:

* UMKM
* Fasilitas

### B.

Direktori yang sifatnya relatif statis:

* UMKM
* Fasilitas
* Kontak Pelayanan

Sedangkan:

* Agenda/Kegiatan diurutkan berdasarkan tanggal.
* Pengumuman diurutkan berdasarkan status/tanggal.
* Data lain menggunakan urutan otomatis yang relevan.

### C.

Semua jenis informasi dapat diberikan urutan manual oleh Admin.

### D.

Tidak perlu pengurutan manual sama sekali.

**Jawaban:** D. Tidak perlu pengurutan manual sama sekali (semua modul menggunakan urutan otomatis/default sistem).

---

## 55. Apa saja isi Homepage Desa yang dapat dikelola oleh Super Admin?

Homepage memiliki:

* Nama dan identitas Desa
* Logo
* Banner/foto
* Deskripsi singkat
* Alamat kantor desa
* Nomor kontak
* Email jika tersedia
* Nama Kepala Desa
* Jam pelayanan
* Pilihan 6 Dusun
* Pengumuman Desa
* Agenda/Kegiatan Desa
* Peta Desa

Pilihan:

### A.

Semua informasi homepage dapat dikelola oleh Super Admin.

Namun untuk bagian yang berasal dari data lain:

* **Pilihan Dusun** otomatis mengambil data Dusun aktif.
* **Peta Desa** otomatis mengambil data lokasi/fasilitas/UMKM.
* **Agenda terbaru** otomatis mengambil data Agenda Desa.
* **Pengumuman terbaru** otomatis mengambil data Pengumuman Desa.

Jadi Super Admin mengelola **sumber datanya**, bukan mengedit hasil tampilannya sebagai konten statis secara manual.

### B.

Hanya informasi identitas seperti logo, banner, deskripsi, kontak, dan Pengumuman Desa yang dapat diedit.

### C.

Konsep lain: ...

**Jawaban:** A. Semua informasi homepage dikelola Super Admin berbasis sumber data modul masing-masing (identitas via pengaturan, bagian lain otomatis dari data modul aktif).

---

## 56. Bagaimana mekanisme izin publikasi nomor, foto pribadi, dan lokasi privat pada MVP?

Contoh data sensitif:

* Nomor WhatsApp Kontak Pelayanan
* Foto seseorang
* Rumah Kepala Dusun
* Rumah Ketua RT
* Lokasi pelayanan yang berada di rumah pribadi

Pilihan:

### A.

Persetujuan dilakukan secara administratif/offline.

Admin hanya memasukkan informasi jika pihak terkait sebelumnya sudah memberikan izin. Sistem tidak menyimpan status consent khusus.

### B.

Persetujuan dilakukan di luar sistem, tetapi dashboard menyediakan field sederhana:

`Izin publikasi sudah dikonfirmasi: Ya / Tidak`

Data privat hanya dapat dipublikasikan jika status tersebut `Ya`.

Tidak perlu upload surat/bukti persetujuan pada MVP.

### C.

Sistem menyimpan bukti persetujuan/form consent secara digital.

### D.

Konsep lain: ...

**Jawaban:** A. Persetujuan dilakukan secara administratif/offline (Admin memastikan pihak terkait telah memberi izin sebelum input data, tanpa field consent khusus di form).

---

# Ringkasan Keputusan Final

Setelah semua pertanyaan di atas dijawab, isi ringkas keputusan:

**47. Hard Delete:**
Jawaban: A - Super Admin boleh melakukan hard delete permanen terhadap data selain entitas Dusun. Admin Dusun hanya soft delete.

**48. Arsip vs Soft Delete:**
Jawaban: A - Setuju (Arsip khusus pengumuman expired yang tetap bisa diakses publik; Nonaktif/Soft delete untuk data non-publik yang disembunyikan).

**49. Hak Super Admin:**
Jawaban: A - Super Admin memiliki hak pengelolaan penuh terhadap seluruh modul dan seluruh dusun (penghapusan sesuai aturan Q47).

**50. Dusun Tidak Aktif:**
Jawaban: A - Dusun tidak aktif disembunyikan dari publik (homepage/peta), tapi data tersimpan aman dan Admin Dusun tetap bisa login dashboard.

**51. Lifecycle Agenda/Kegiatan:**
Jawaban: A - Tiga status (Akan Datang → Berlangsung → Selesai) otomatis berdasarkan tanggal dengan opsi override manual admin.

**52. Jam Kegiatan:**
Jawaban: B - Field jam bersifat opsional jika belum ada kepastian jam / seharian.

**53. Kontak Fasilitas:**
Jawaban: A - Tombol WhatsApp saja.

**54. Urutan Prioritas:**
Jawaban: D - Tidak perlu pengurutan manual sama sekali, gunakan pengurutan otomatis/default sistem.

**55. Homepage Editable:**
Jawaban: A - Super Admin mengelola profil/identitas desa, sedangkan bagian lain homepage mengambil otomatis dari data modul yang aktif (data-driven).

**56. Izin Publikasi:**
Jawaban: A - Persetujuan dilakukan secara offline/administratif sebelum data diinput oleh Admin.

---

# Catatan

Open decision berikut **tidak menjadi blocker untuk freeze requirement produk** dan dapat diselesaikan pada tahap operasional, R&D, atau menjelang deployment:

* Nama resmi enam dusun.
* Redaksi final template pesan WhatsApp.
* Nama/personel pemegang Super Admin.
* Calon Admin untuk seluruh dusun.
* Supervisor operasional setelah KKN.
* Provider hosting dan domain.
* Kepemilikan akun hosting/domain.
* Desain visual final papan QR.
* Dataset aktual UMKM, fasilitas, kontak, koordinat, dan media saat launching.
* Pemilihan tech stack, database, map provider, dan hosting.
* Detail teknis pemulihan akun Super Admin.

Setelah Pertanyaan 47–56 selesai, hasilnya digunakan untuk memperbarui `pertanyaan_lanjutan.md` dan kemudian merevisi `requirements-baseline.md` sebelum ditetapkan sebagai **Requirements Baseline v1.0 — FROZEN FOR MVP**.
