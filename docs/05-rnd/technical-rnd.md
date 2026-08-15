# Technical R&D — Portal Informasi Desa Bendung

| Field | Value |
|---|---|
| Project | Portal Informasi Desa Bendung |
| Document | Technical R&D |
| Version | 1.0 |
| Status | FROZEN FOR MVP |
| Research Date | 2026-08-13 |
| Product Source | PRD v1.0 — FROZEN FOR MVP |
| System Source | ERD/Data Model v1.0 — FROZEN FOR MVP |
| Authorization Source | Roles & Permissions v1.0 — FROZEN FOR MVP |
| Tech Stack | APPROVED TECHNICAL BASELINE |
| Approved Stack | Stack A — Laravel Conventional Monolith |
| Human Review | COMPLETED — Stack A approved |

> Technical R&D v1.0 telah melalui human review. Stack A telah memperoleh human approval dan ditetapkan sebagai **APPROVED TECHNICAL BASELINE** untuk MVP. Approval ini tidak memilih provider/paket hosting, domain, production tile provider, image processing library, physical filesystem path, backup retention, atau physical database schema.

# 1. Document Purpose

Technical R&D ini mengevaluasi pilihan teknologi, membandingkan trade-off, dan mendokumentasikan technical baseline MVP yang telah disetujui manusia berdasarkan bukti dari dokumentasi resmi. Hasilnya menjadi source bagi Physical Database Schema / Technical Data Design dan technical specification downstream.

R&D tidak mengubah product behavior, information architecture, user flow, permissions, atau conceptual data model yang telah FROZEN. Requirement produk selalu mengalahkan kenyamanan teknologi.

# 2. Product-Driven Technical Constraints

## 2.1 Public Experience

- Mobile-first, responsif, dan berbahasa Indonesia.
- Tetap ringan pada koneksi terbatas.
- Public User tidak memerlukan login.
- Jalur kritis QR → Homepage → Halaman Dusun harus sederhana.
- Homepage bersifat data-driven.
- Peta interaktif mendukung marker, filter, popup, dan detail.
- WhatsApp dan Google Maps adalah external handoff; portal tidak membuat routing internal.

## 2.2 Admin

- Login menggunakan **username + password**, bukan email sebagai identitas wajib.
- Admin Dusun selalu `OWN_DUSUN`, satu akun terikat tepat satu Dusun, dan satu Dusun dapat memiliki beberapa Admin.
- Super Admin memiliki scope `GLOBAL`.
- Publikasi Admin Dusun langsung berlaku tanpa approval gate.
- Soft Delete tersedia pada data operasional; restore hanya Super Admin.
- Hard delete data selain entitas Dusun hanya Super Admin; entitas Dusun tidak dapat hard delete.
- Akun Admin Dusun yang dihapus secara operasional tidak dapat login, tetapi identity record tetap dipertahankan secara konseptual.

## 2.3 Data

- Model relasional: 11 conceptual entities dan 13 main relationships.
- Mendukung 35 Data Integrity Rules tanpa mengubah semantics.
- Kategori Fasilitas dinamis.
- Koordinat wajib untuk Fasilitas dan opsional untuk UMKM.
- Media bersifat opsional dan mengikuti parent resource.
- Agenda memiliki lifecycle Akan Datang, Berlangsung, Selesai, serta manual override yang berwenang.
- Pengumuman berpindah dari aktif ke arsip publik berdasarkan expiry; arsip bukan Soft Delete.
- Taxonomy Peta diturunkan dari parent resource, bukan entity kategori Peta baru.

## 2.4 Security

- Authentication aman dan password hashing kuat.
- Enforcement `PUBLIC`, `OWN_DUSUN`, dan `GLOBAL`.
- Validasi input dan perlindungan SQL injection/XSS.
- Rate limiting login.
- Upload file harus dibatasi dan divalidasi.
- Secret production tidak disimpan di source code.

## 2.5 Operations

- Biaya rendah dan dapat diprediksi.
- Mudah dipelihara, dibackup, diekspor, dan diserahterimakan.
- Dokumentasi dan komunitas harus memadai.
- Aset production tidak bergantung hanya pada akun personal anggota KKN.
- Operasi rutin tidak boleh bergantung berlebihan pada tim KKN setelah serah terima.

# 3. Evaluation Criteria

Skala penilaian: `1 = buruk`, `2 = kurang`, `3 = cukup`, `4 = baik`, `5 = sangat baik`.

Bobot digunakan secara kasar untuk menonjolkan faktor handover, keamanan, relational fit, portability, dan sustainability. Total bukan ukuran presisi dan hanya alat bantu perbandingan.

| # | Criterion | Weight | Reason |
|---:|---|---:|---|
| 1 | Development simplicity | 2 | MVP perlu selesai dalam periode KKN. |
| 2 | Maintainability | 3 | Sistem harus dapat dirawat setelah tim berganti. |
| 3 | Handover friendliness | 3 | Kepemilikan dan operasi pasca-KKN adalah faktor utama. |
| 4 | Mobile/web performance suitability | 2 | Public portal diakses dari perangkat dan jaringan beragam. |
| 5 | Security support | 3 | Admin mengelola data publik dan kredensial. |
| 6 | Relational data suitability | 3 | ERD dan integrity rules bersifat relasional. |
| 7 | RBAC suitability | 3 | Boundary `OWN_DUSUN`/`GLOBAL` tidak boleh bocor. |
| 8 | Map integration suitability | 1 | Peta wajib, tetapi kebutuhan GIS MVP sederhana. |
| 9 | Media handling suitability | 2 | Upload, resize, compression, placeholder, dan backup diperlukan. |
| 10 | Deployment simplicity | 2 | Deployment perlu dapat diulang oleh penerus. |
| 11 | Backup/export portability | 3 | Data dan media harus dapat dipindahkan. |
| 12 | Vendor lock-in risk | 3 | Skor tinggi berarti lock-in lebih rendah. |
| 13 | Free/low-cost suitability | 3 | Biaya operasional desa harus rendah dan jelas. |
| 14 | Documentation/community | 1 | Memengaruhi onboarding dan troubleshooting. |
| 15 | Long-term sustainability | 3 | Memperhitungkan runtime, provider, dan operasional jangka panjang. |

Maximum weighted score adalah 185.

# 4. Architecture Approach Candidates

| Approach | Shape | Advantages | Main Trade-off | Fit |
|---|---|---|---|---|
| A — Integrated conventional full-stack | Satu aplikasi server-rendered, satu database relasional, media pada storage hosting | Sedikit moving parts, username auth natural, backup/handover sederhana | Kualitas operasi bergantung pada paket hosting; deployment modern lebih manual | Sangat cocok bila desa menerima hosting cPanel/PHP |
| B — Integrated modern cloud full-stack | Satu codebase Next.js, tetapi DB dan object storage terkelola terpisah | Public performance, deployment preview, managed infrastructure | Beberapa akun/provider, billing dan handover lebih kompleks | Cocok bila ownership cloud dan developer JS/TS tersedia |
| C — BaaS-assisted modern cloud | Next.js dengan PostgreSQL dan storage Supabase; auth tetap application-managed | Database/storage dashboard terpadu dan cepat untuk MVP | Free project dapat pause; managed Auth tidak native username; vendor surface bertambah | Cocok untuk development, lebih lemah untuk handover production gratis |

Dedicated API terpisah tidak direkomendasikan untuk MVP karena tidak ada mobile client atau third-party API requirement. Pemisahan tersebut menambah deployment, authentication surface, observability, dan dokumentasi tanpa nilai produk yang setara.

# 5. Frontend R&D

## 5.1 Next.js / React

Next.js mendukung server/static rendering, SEO, komponen admin, dan image optimization. Dokumentasi resmi menyatakan `next/image` dapat memberikan ukuran gambar sesuai perangkat, lazy loading, dan format modern; self-hosting tetap memungkinkan melalui Node.js server. Kelemahannya untuk proyek ini adalah toolchain dan runtime Node yang lebih kompleks dibanding server-rendered HTML pada hosting tradisional.

Fit: **baik**, terutama untuk cloud deployment dan tim penerus yang kuat di TypeScript/React.

## 5.2 Laravel Blade + Progressive JavaScript

Blade/server-rendered HTML cukup untuk Homepage, Halaman Dusun single-page/scroll, detail, dan dashboard CRUD. JavaScript digunakan secara progresif untuk Peta, filter, dan interaction yang memang perlu. Pendekatan ini mengurangi bundle public dan menjaga satu runtime aplikasi.

Fit: **sangat baik** untuk scope MVP dan handover cPanel, dengan syarat hosting memenuhi runtime Laravel yang dipilih.

## 5.3 Plain HTML/CSS/JavaScript

Sangat ringan untuk public pages, tetapi kebutuhan authentication, RBAC, lifecycle, direct publishing, validation, dan 11-entity data model tetap membutuhkan application layer. Implementasi seluruhnya dari nol meningkatkan risiko security dan maintainability.

Fit: **tidak dipilih sebagai aplikasi lengkap**; tetap relevan sebagai prinsip progressive enhancement.

# 6. Backend / Application Layer R&D

- **Integrated full-stack** paling proporsional: satu boundary authorization, satu deployment, dan satu dokumentasi operasi.
- **Dedicated backend/API** tidak memberi manfaat yang cukup untuk MVP dan memperbesar attack/maintenance surface.
- **BaaS-assisted** mempercepat penyediaan DB/storage, tetapi authorization `OWN_DUSUN` tetap harus dirancang eksplisit dan provider ownership ikut diserahterimakan.
- **Conventional server-side application** cocok dengan form-based admin, cookie session, relational CRUD, Soft Delete, lifecycle, dan scheduled expiry.

Untuk semua kandidat, lifecycle Agenda/Pengumuman dan Soft Delete harus ditegakkan pada application/service boundary, bukan diserahkan pada tampilan klien.

# 7. Database R&D

| Candidate | Relational fit | Backup/export | Operations | Portability/lock-in | Assessment |
|---|---|---|---|---|---|
| MariaDB | Sangat baik untuk 11 entities/13 relationships | `mariadb-dump`/hosting backup; restore wajib diuji | Umum pada hosting cPanel | SQL relasional dan dump mudah dipindahkan, tetapi versi/fitur provider harus diperiksa | Pilihan utama Stack A |
| MySQL | Sangat baik | `mysqldump` menghasilkan logical backup | Umum pada shared hosting | Portabel antar-provider MySQL-compatible dengan pengujian versi | Alternatif dekat jika MariaDB tidak tersedia |
| PostgreSQL | Sangat baik; constraint dan data integrity kuat | `pg_dump` menyediakan script/archive portabel; bukan satu-satunya mekanisme regular production backup | Sangat baik pada managed DB | Engine open-source; provider dapat diganti dengan dump/restore | Pilihan Stack B/C |
| Neon PostgreSQL | PostgreSQL penuh | `pg_dump` + restore window provider | Scale-to-zero dan pooled connections sesuai serverless deployment | Database cukup portabel; compute/restore features provider-specific | Baik untuk modern cloud |
| Supabase PostgreSQL | PostgreSQL penuh | Export DB perlu dipisahkan dari export object storage | DB, storage, auth, API dalam satu project | SQL portabel, tetapi storage/auth/RLS coupling dapat meningkatkan lock-in | Baik bila boundaries dijaga |

**Human decision:** MariaDB ditetapkan sebagai database engine MVP. R&D tidak membuat physical schema; exact tables, columns, data types, indexes, constraints implementation, foreign-key actions, SQL, dan migrations ditunda ke Physical Database Schema / Technical Data Design.

# 8. Authentication R&D

## 8.1 Application-Managed Username/Password

Ini adalah fit terbaik terhadap `SEC-008` dan telah disetujui untuk MVP. Laravel browser authentication menggunakan server-side/browser session approach dan dapat mengambil user berdasarkan kolom username apa pun; dokumentasi resminya menegaskan email hanya contoh, bukan kewajiban. Password menggunakan strong hashing melalui Laravel hashing facility, tanpa mengunci Bcrypt versus Argon2 pada tahap ini. Physical/session storage final belum ditentukan.

Reset password Admin Dusun tetap dilakukan Super Admin. Mekanisme recovery akun Super Admin tetap upstream `OPEN-010 — NON-BLOCKING` dan tidak diselesaikan oleh technical baseline ini.

Pada Next.js, application-managed auth juga dapat memenuhi username/password, tetapi secure session, CSRF boundary, password reset oleh Super Admin, dan throttling harus dirangkai dan didokumentasikan lebih eksplisit.

## 8.2 Managed Authentication

Supabase password identities menggunakan email atau phone sebagai identity. Karena requirement membekukan **username + password**, mengganti username menjadi email tidak diperbolehkan. Workaround synthetic email atau mapping tersembunyi meningkatkan kompleksitas dan risiko operasional.

Keputusan R&D: managed Supabase Auth **tidak digunakan** pada Stack C; database dan storage dapat digunakan tanpa mengubah credential semantics. RLS tetap boleh dievaluasi pada Technical Decision, bukan diputuskan di sini.

# 9. Authorization Implementation Direction

Direction konseptual yang kompatibel untuk seluruh kandidat:

- `PUBLIC`: query hanya menghasilkan data visible/public, bukan sekadar menyembunyikan tombol.
- `OWN_DUSUN`: setiap write/read administratif Admin Dusun memverifikasi parent resource mempunyai `dusun` yang sama dengan akun.
- `GLOBAL`: Super Admin dapat mengelola seluruh Dusun dan data tingkat Desa sesuai applicability.
- Enforcement harus server-side pada setiap operasi; filter UI bukan authorization control.
- Soft Delete, restore, hard delete, status Dusun, account management, dan direct publishing mengikuti Roles & Permissions v1.0.

Laravel Policies/Gates bersama server-side ownership/scope validation ditetapkan sebagai direction authorization Stack A. PostgreSQL RLS hanya merupakan catatan historical untuk Stack B/C yang tidak dipilih dan bukan bagian technical baseline MVP.

# 10. Map R&D

## 10.1 Library

| Library | Findings | Fit |
|---|---|---|
| Leaflet | Open-source, mobile-friendly, sekitar 42 KB gzipped JS menurut situs resmi; mendukung tile layer, markers, popups, events, dan controls | **Recommended** untuk MVP sederhana |
| MapLibre GL JS | Open-source TypeScript/WebGL renderer untuk vector tiles, markers, popup, dan style kompleks | Baik, tetapi lebih berat dan kompleks daripada kebutuhan MVP |

**Human decision:** Leaflet ditetapkan sebagai map library MVP karena kebutuhan tidak mencakup 3D, polygon boundary, search, atau internal routing. Leaflet tidak menetapkan tile provider.

## 10.2 Tile / Basemap Provider — Pre-Production Open

Library dan tile provider adalah keputusan terpisah. OpenStreetMap menyediakan data terbuka, tetapi server `tile.openstreetmap.org` adalah layanan best-effort tanpa SLA; policy mewajibkan attribution, caching, valid Referer/User-Agent, dan melarang bulk download/prefetch. Layanan dapat memblokir penggunaan yang merugikan service.

Direction:

- Development/low-volume validation dapat memakai standard OSM tiles bila seluruh policy dipenuhi.
- Production handover perlu mengonfirmasi traffic dan memilih standard OSM tiles yang policy-compliant atau provider OSM-derived dengan kuota/ownership yang jelas. Production tile provider belum dikunci.
- Tile URL/provider harus dapat diganti tanpa mengubah business data.
- Attribution OpenStreetMap wajib terlihat.

MapTiler Cloud dievaluasi sebagai managed alternative. Free plan bersifat non-commercial dan berhenti saat quota habis; Flex tercantum USD 25/month pada tanggal riset. Karena kepemilikan billing belum diputuskan, MapTiler belum direkomendasikan sebagai provider final.

## 10.3 External Navigation

Google Maps tetap hanya destination untuk aksi arah. Portal berhenti pada handoff dan tidak membangun routing engine.

# 11. Media / Image R&D

| Option | Advantages | Risks | Best fit |
|---|---|---|---|
| Hosting local filesystem | Satu akun dan satu backup surface; sederhana pada cPanel | Kapasitas/IO bergantung paket; deploy tidak boleh menimpa uploads | **Approved direction** untuk Stack A; exact path/disk belum dipilih |
| S3-compatible object storage | Aplikasi stateless, mudah dipisahkan dari runtime | Akun/provider dan export tambahan | Stack B; Cloudflare R2 memberi S3-compatible direction |
| Supabase Storage | Satu dashboard dengan DB Supabase | Storage policy dan export menambah provider coupling | Stack C |

Stack A menggunakan hosting filesystem direction. Upload tetap harus memvalidasi MIME/signature, ukuran, dimensi, dan jenis file; menghasilkan derivative/resized image; melakukan compression; menyajikan format web modern bila didukung; mempertahankan placeholder; dan masuk backup media. Exact image library, directory structure, public/private disk representation, naming convention, physical database column, CDN, dan filesystem path belum dipilih.

# 12. Deployment / Hosting R&D

## 12.1 Modern Cloud Deployment

Vercel menyederhanakan deployment Next.js, HTTPS, CDN, dan preview. Namun Hobby ditujukan untuk personal/non-commercial use. Pro tercantum USD 20/month dengan USD 20 included usage credit pada tanggal riset. Stack cloud juga membutuhkan DB dan storage account terpisah.

Suitable for development: **ya**, dengan free-tier limits dipantau.

Suitable for production handover: **bersyarat**; gunakan plan/ownership yang sesuai Terms, billing organisasi, dan documented transfer.

## 12.2 Traditional / Shared Hosting

**Human decision:** cPanel-compatible shared hosting ditetapkan sebagai hosting model MVP. Laravel + MariaDB pada model ini dapat menyatukan aplikasi, database, media, domain, dan backup dalam satu contract sehingga jumlah akun yang diserahterimakan lebih rendah. Provider dan paket aktual belum dipilih; harga dan limits belum dapat diverifikasi.

Status biaya/limits shared hosting: **UNVERIFIED / REQUIRES MANUAL CONFIRMATION**.

Paket kandidat wajib diverifikasi terhadap PHP >= 8.3 dan required extensions Laravel 13; HTTPS; document root aman ke Laravel `public`; Composer/deployment support; cron/scheduler; MariaDB/MySQL compatibility dan version; image processing capability; writable filesystem storage; storage, bandwidth/traffic, dan database limits; backup availability; restore capability/support; environment/secret configuration; serta production error/debug configuration.

Jika satu provider/paket gagal qualification, tindakan pertama adalah mencari provider/paket cPanel lain yang compatible. Tech stack tidak berubah otomatis. Technical Change Decision baru diperlukan jika tidak ada provider viable.

Scheduler/cron adalah infrastructure qualification, tetapi lifecycle Agenda/Pengumuman tidak dikunci hanya pada cron. Exact strategy—request-time calculation, scheduled normalization, atau kombinasi—ditentukan pada Technical Design/SRS dengan tetap menjaga application semantics FROZEN.

## 12.3 VPS

VPS memberi kontrol, tetapi menambah patching OS, web server, database, firewall, TLS, backup, dan monitoring. Untuk scope KKN, burden ini lebih besar daripada manfaatnya kecuali ada pengelola teknis pasca-KKN.

# 13. Domain & Ownership Considerations

`OPEN-007` tetap **OPEN — NON-BLOCKING**. Domain final tidak dipilih.

Direction operasional:

- Domain, hosting, database, storage, source repository, billing, dan recovery channel menggunakan ownership organisasi/tim yang dapat dialihkan.
- Hindari aset production kritis yang hanya dimiliki akun personal mahasiswa.
- Catat pemilik akun, billing contact, recovery contact, renewal date, dan prosedur transfer sebelum launch.
- Gunakan least privilege untuk akses provider dan cabut akses anggota KKN setelah handover bila sudah tidak diperlukan.

# 14. Backup / Export / Recovery R&D

- Database: logical export berkala menggunakan tool resmi engine; managed provider backup bukan pengganti export portabel.
- Media: export seluruh originals dan derivatives dengan manifest/path mapping yang dapat direkonsiliasi dengan database.
- Application: source, dependency lock file, configuration template tanpa secret, dan deployment runbook harus dipertahankan.
- Restore: backup dinilai berhasil hanya setelah restore drill pada environment terpisah.
- Provider migration: database, media, domain/DNS, dan secrets harus mempunyai daftar langkah transfer.

PostgreSQL `pg_dump` menyediakan export konsisten dan format archive portabel, tetapi dokumentasi resminya mengingatkan bahwa `pg_dump` bukan satu-satunya mekanisme regular production backup. MySQL menyediakan `mysqldump`; cPanel menyediakan account/database backup interfaces, namun kemampuan restore dapat bergantung pada hosting provider.

# 15. Security R&D

| Requirement | Direction |
|---|---|
| `SEC-001` Secure authentication | Cookie session aman, HTTPS, session regeneration, no public registration |
| `SEC-002` Strong hashing | Laravel hashing facility; tidak menyimpan plaintext; algoritma final belum dikunci |
| `SEC-003` RBAC | Server-side policy + ownership query constraint pada setiap operasi |
| `SEC-004` SQL injection | ORM/query builder parameter binding; larang concatenated user input |
| `SEC-005` XSS | Escaping default, sanitasi bila rich content diizinkan, CSP sebagai defense-in-depth |
| `SEC-006` Login rate limit | Kombinasi username dan IP; logging tanpa kredensial |
| `SEC-007` No hard-delete Dusun UI | Capability tidak diekspos dan tetap ditolak server-side |
| `SEC-008` Username/password reset boundary | Reset hanya oleh Super Admin; tidak ada self-service Admin Dusun |
| `SEC-009` Delete authority | Operation-specific authorization; hard delete data non-Dusun hanya Super Admin |

Tambahan direction: upload allowlist dan ukuran maksimum, secret management melalui provider environment/secret facility, least-privilege DB credentials, dependency updates, secure headers, serta production debug off. Ini bukan penetration testing plan.

# 16. Tech Stack Candidate Packages

## 16.1 Stack A — Laravel Conventional Monolith

**Status: APPROVED TECHNICAL BASELINE — HUMAN DECISION**

**Frontend:** Laravel Blade, mobile-first CSS, progressive JavaScript  
**Backend/runtime:** Laravel 13 / PHP 8.3+ integrated application  
**Database:** MariaDB  
**Auth:** Laravel application-managed username/password, server-side/browser session; strong hashing through Laravel hashing facility without locking the final algorithm  
**Authorization:** Laravel policies/gates + server-side `OWN_DUSUN` query constraint  
**Map:** Leaflet; production tile provider remains open; standard OSM tiles are only a policy-compliant low-volume option  
**External navigation:** Google Maps  
**Storage/media:** Hosting filesystem direction; resize/compression/modern format/backup required; exact library/path not selected  
**Hosting:** Qualified cPanel-compatible shared hosting model; provider/package not selected  
**Backup:** cPanel/account backup + logical DB export + separate media export  

**Strengths:** satu aplikasi, natural username auth, sedikit provider, relational fit kuat, backup dan handover paling mudah dijelaskan.  
**Weaknesses:** shared-host capabilities berbeda-beda; deployment dan rollback lebih manual; image processing/cron/SSH harus diverifikasi.  
**Operational risk:** provider quality, outdated runtime, backup yang belum pernah direstore.  
**Estimated cost class:** **Low — UNVERIFIED / REQUIRES MANUAL CONFIRMATION**.  
**Handover complexity:** **Low**, setelah akun dan runbook dimiliki organisasi.

## 16.2 Stack B — Next.js Managed Cloud + Neon + R2

**Status: ALTERNATIVE — NOT SELECTED FOR MVP**

**Frontend/backend:** Next.js integrated full-stack application  
**Runtime/hosting:** Vercel Pro untuk production; Hobby hanya development/personal sesuai Terms  
**Database:** Neon PostgreSQL  
**Auth:** Application-managed username/password and secure cookie session  
**Authorization:** Server-side policies/query constraints; RLS hanya kandidat defense-in-depth  
**Map:** Leaflet dengan replaceable OSM-derived tile provider  
**Storage/media:** Cloudflare R2 Standard, S3-compatible access  
**Backup:** `pg_dump`, R2 media export, source/deploy ownership transfer  

**Strengths:** public performance, managed deployment, PostgreSQL portability, object storage, good developer experience.  
**Weaknesses:** minimal tiga provider production; credential, billing, and incident ownership lebih kompleks.  
**Operational risk:** multi-provider outage/limits, cold/scale-to-zero behavior, usage-based billing, Vercel plan eligibility.  
**Estimated cost class:** **Moderate**; Vercel Pro USD 20/month, Neon Launch typical spend shown USD 15/month, R2 usage-based after free allowances; re-check before deployment.  
**Handover complexity:** **Medium–High**. Stack B remains the historical runner-up and may only replace the approved baseline through a future Technical Change Decision.

## 16.3 Stack C — Next.js + Supabase Database/Storage

**Status: ALTERNATIVE — NOT SELECTED FOR MVP**

**Frontend/backend:** Next.js integrated full-stack application  
**Runtime/hosting:** Vercel Pro for production  
**Database:** Supabase PostgreSQL  
**Auth:** Application-managed username/password; **Supabase Auth not used** because its password identities are email/phone based  
**Authorization:** Server-side policies/query constraints; optional RLS evaluation later  
**Map:** Leaflet with replaceable OSM-derived tile provider  
**Storage/media:** Supabase Storage  
**Backup:** PostgreSQL export + separate Storage export + provider transfer runbook  

**Strengths:** DB and media in one managed project; dashboard-friendly; PostgreSQL base.  
**Weaknesses:** managed Auth advantage tidak dapat dipakai tanpa mengubah username requirement; free project pausing; DB/storage policy coupling.  
**Operational risk:** provider lock-in above SQL layer, inactivity pause, separate Vercel ownership, export discipline.  
**Estimated cost class:** **Moderate**; Supabase Pro starts USD 25/month and Vercel Pro USD 20/month; re-check before deployment.  
**Handover complexity:** **Medium**.

# 17. Decision Matrix

| Criterion | Weight | Stack A | Stack B | Stack C |
|---|---:|---:|---:|---:|
| Development simplicity | 2 | 5 | 4 | 3 |
| Maintainability | 3 | 4 | 4 | 3 |
| Handover friendliness | 3 | 5 | 2 | 2 |
| Mobile/web performance | 2 | 4 | 5 | 5 |
| Security support | 3 | 4 | 4 | 3 |
| Relational data suitability | 3 | 5 | 5 | 5 |
| RBAC suitability | 3 | 5 | 4 | 4 |
| Map integration suitability | 1 | 5 | 5 | 5 |
| Media handling suitability | 2 | 4 | 5 | 4 |
| Deployment simplicity | 2 | 4 | 5 | 5 |
| Backup/export portability | 3 | 5 | 4 | 4 |
| Vendor lock-in risk | 3 | 5 | 3 | 2 |
| Free/low-cost suitability | 3 | 4 | 3 | 4 |
| Documentation/community | 1 | 5 | 5 | 5 |
| Long-term sustainability | 3 | 5 | 3 | 3 |
| **Weighted total / 185** |  | **170** | **144** | **134** |

Alasan perbedaan terbesar:

- Stack A unggul pada jumlah provider, username auth, portability, dan handover.
- Stack B unggul pada managed deployment dan media delivery, tetapi tiga-provider ownership menurunkan handover score.
- Stack C memiliki layanan terpadu DB/storage, tetapi managed Auth tidak cocok dengan username dan free-tier pause berisiko untuk production.
- Nilai Stack A mengasumsikan tersedia paket cPanel-compatible yang lulus qualification. Kegagalan satu provider tidak membatalkan stack; provider/paket lain dicari terlebih dahulu.

# 18. Approved Technical Baseline

## 18.1 Human-Approved Stack

**Stack A — Laravel Conventional Monolith**  
**Status: APPROVED TECHNICAL BASELINE — HUMAN DECISION**

Alasan:

- paling sedikit moving parts untuk scope KKN;
- application-managed username/password sesuai requirement tanpa workaround;
- server-side policy cocok untuk `OWN_DUSUN` dan `GLOBAL`;
- MariaDB mendukung ERD relasional tanpa perubahan;
- Blade + progressive JavaScript cukup untuk public portal, dashboard, dan Leaflet;
- satu hosting contract memudahkan ownership, backup, renewal, dan handover.

Trade-off dan risiko:

- paket hosting harus mendukung Laravel 13/PHP 8.3+, Composer/deployment, scheduler, HTTPS, dan image processing;
- local filesystem membutuhkan disiplin backup media dan deploy-safe paths;
- shared hosting tidak memberi portability operasional otomatis; runbook dan restore drill tetap wajib.

**Historical runner-up:** Stack B — Next.js Managed Cloud + Neon + R2 — **NOT SELECTED FOR MVP**.

Stack B tidak menjadi fallback otomatis. Perubahan ke Stack B atau architecture lain memerlukan Technical Change Decision. Kondisi yang dapat memicu evaluasi perubahan:

- tidak ditemukan shared hosting cPanel-compatible yang lulus technical checklist setelah provider/package alternatif dicari;
- pengelola pasca-KKN memiliki kemampuan JS/TypeScript dan menerima multi-provider handover;
- organisasi menyetujui recurring cloud billing dan ownership team accounts;
- kebutuhan deployment preview/CDN/stateless runtime dianggap lebih penting daripada kesederhanaan operasi.

## 18.2 Tech Stack Approval Scope

### APPROVED

- Laravel 13.
- PHP 8.3+ compatible runtime sesuai Laravel 13.
- Laravel Blade, mobile-first CSS, dan progressive JavaScript.
- MariaDB.
- Application-managed username/password.
- Server-side/browser session approach Laravel; physical session storage belum dipilih.
- Strong hashing melalui Laravel hashing facility; algoritma final belum dikunci.
- Laravel Policies/Gates dan server-side `PUBLIC`/`OWN_DUSUN`/`GLOBAL` enforcement.
- Leaflet.
- cPanel-compatible shared hosting model.
- Hosting filesystem media direction.
- Conventional integrated monolith: Laravel menangani public website, authentication, admin dashboard, business rules, database access, dan authorization; Blade menangani server-rendered interface; progressive JavaScript digunakan untuk interaction yang memerlukan client-side behavior seperti Peta.

### NOT YET SELECTED

- Hosting provider/package.
- Domain final.
- Production tile provider.
- Image processing library.
- Exact filesystem path/directory/disk representation.
- Exact backup product dan retention.
- Physical database representation.
- Exact deployment mechanism.
- Exact server configuration.
- Physical/session storage final.

Dedicated REST API dan microservices tidak menjadi requirement MVP.

# 19. Approval Confidence / Residual Operational Confidence

**MEDIUM**

Stack A sudah approved dan confidence ini bukan approval gate. Nilai MEDIUM hanya mencerminkan residual operational uncertainty: provider hosting aktual belum dipilih, package qualification belum dilakukan, production tile provider belum final, serta ownership/domain/billing dan kemampuan operator pasca-KKN belum final.

# 20. Cost Analysis

Pricing verified on **2026-08-13**; re-check before deployment.

| Service/model | Verified allowance/price | Likely MVP fit | Paid trigger / caveat |
|---|---|---|---|
| Shared hosting/cPanel | **UNVERIFIED / REQUIRES MANUAL CONFIRMATION** karena provider belum dipilih | Berpotensi cocok production | PHP/runtime, storage, traffic, backup, cron, SSL, support, renewal |
| Vercel Hobby | USD 0; limits antara lain 4 active CPU-hours, 1,000,000 function invocations, 1,000 image optimization source images | Development/prototype | Personal/non-commercial only; project dapat pause saat allowance habis |
| Vercel Pro | USD 20/month dengan USD 20 included usage credit | Production cloud candidate | Usage-based overage dan team/billing ownership |
| Neon Free | USD 0; 100 CU-hours/project, 0.5 GB storage/project, scale-to-zero setelah idle, 5 GB network transfer | Development dan low-traffic validation | Compute suspension/limit behavior; 0.5 GB kecil untuk growth |
| Neon Launch | Usage-based; official page memberi typical spend USD 15/month untuk intermittent load 1 GB | Production cloud candidate | Compute, storage, history, dan network usage |
| Cloudflare R2 Standard | Free: 10 GB-month, 1M Class A, 10M Class B/month; egress direct R2 free | Kemungkinan cukup untuk MVP media | Operation charges dan storage di atas free allowance |
| Supabase Free | USD 0; 500 MB DB, 1 GB file storage, 5 GB egress; 2 active projects | Development | Free project pause setelah 1 minggu inactivity |
| Supabase Pro | From USD 25/month; 8 GB disk, 100 GB file storage, 250 GB egress; daily backups 7 days | Production managed candidate | Overage and additional project cost |
| MapTiler Free | USD 0; 5k sessions/100k requests per month | Development/non-commercial validation | Non-commercial; service pauses at quota |
| MapTiler Flex | USD 25/month; 25k sessions/500k requests included | Managed production map candidate | Overage billed; provider account/billing |
| OSM standard tile service | No usage fee stated | Low-volume, policy-compliant use only | Best-effort, no SLA, may block; attribution/caching/policy mandatory |

Tidak ada konversi ke rupiah karena exchange rate dan pajak/billing lokal tidak dievaluasi.

# 21. Free Tier Risk

| Area | Suitable for development | Suitable for production handover |
|---|---|---|
| Vercel Hobby | Ya | Tidak dijadikan baseline production karena personal/non-commercial Terms dan pause on limits |
| Neon Free | Ya | Bersyarat; storage 0.5 GB, 100 CU-hours, scale-to-zero, dan transfer limit perlu diuji |
| Supabase Free | Ya | Tidak direkomendasikan untuk always-available portal karena inactivity pause |
| R2 Free allowances | Ya | Mungkin, tetapi operations/storage harus dimonitor dan owner billing jelas |
| MapTiler Free | Ya | Tidak menjadi baseline karena non-commercial restriction dan quota pause |
| OSM standard tiles | Ya bila policy dipenuhi | Bersyarat; tidak ada SLA dan bukan guaranteed production service |

Free tier tidak dianggap sebagai jaminan biaya nol jangka panjang. Provider dapat mengubah quota, policy, availability, dan pricing.

# 22. Vendor Lock-In Analysis

| Layer | Stack A | Stack B | Stack C |
|---|---|---|---|
| Database | MariaDB dump relatif portabel | PostgreSQL/`pg_dump` portabel; Neon restore/branch features provider-specific | PostgreSQL portabel; Supabase features di luar SQL menambah coupling |
| Auth | App-owned username records/session semantics | App-owned, hosting-independent | App-owned; sengaja tidak memakai Supabase Auth |
| Storage | Files dapat diekspor langsung; path convention tetap perlu dijaga | R2 S3-compatible mengurangi API lock-in | Supabase Storage export/policy membutuhkan prosedur khusus |
| Hosting | Laravel dapat pindah ke server PHP compatible | Next.js dapat self-host, tetapi Vercel-specific behavior perlu dihindari/diinventarisasi | Sama dengan Stack B plus Supabase project dependency |
| Map | Leaflet dan provider boundary dapat diganti | Sama | Sama |

Direction: gunakan standard engine exports, hindari business logic eksklusif provider bila manfaatnya kecil, dan dokumentasikan provider-specific dependencies.

# 23. Post-KKN Handover

| Factor | Stack A | Stack B | Stack C |
|---|---|---|---|
| Provider accounts | 1 hosting/domain account; repository terpisah | Vercel + Neon + Cloudflare + domain + repository | Vercel + Supabase + domain + repository |
| Billing complexity | Rendah; satu renewal utama | Tinggi; beberapa usage-based services | Sedang; dua service utama |
| Credential ownership | Sederhana bila hosting organisasi | Wajib team ownership di tiap provider | Wajib team ownership Vercel/Supabase |
| Operator knowledge | cPanel, backup, deploy Laravel | Git/Vercel, Neon, R2, environment secrets | Git/Vercel, Supabase DB/storage/policies |
| Backup/export | Full account + DB/media exports | `pg_dump` + R2 export + deploy config | DB export + Storage export + deploy config |
| Update difficulty | Medium; manual but one runtime | Medium; deployment easy, provider coordination harder | Medium; deployment easy, data/storage policy knowledge needed |
| Documentation burden | Low–Medium | High | Medium–High |

Approved-baseline handover package direction: ownership register, credential transfer channel, renewal calendar, backup/restore runbook, deployment runbook, environment variable inventory without secret values, and maintenance contact. Bentuk dokumen final ditentukan pada fase berikutnya.

# 24. Development Experience

| Concern | Stack A | Stack B | Stack C |
|---|---|---|---|
| Setup | PHP/Composer/Node asset build/MariaDB | Node/package manager/Neon/R2 credentials | Node/Supabase CLI or project credentials |
| Local development | Satu app + DB | App + remote/local PostgreSQL + object storage setup | App + local/remote Supabase services |
| Migrations | Laravel migration tooling | ORM/migration tool belum dipilih | ORM/migration tool belum dipilih; Supabase tooling tersedia tetapi belum diputuskan |
| Deployment | Upload/Git/Composer steps provider-dependent | Git-based managed deployment | Git-based deployment plus Supabase project operations |
| Debugging | App/server logs in one hosting | Logs spread across Vercel/Neon/R2 | Logs spread across Vercel/Supabase |
| Onboarding | Familiar conventional MVC | Requires modern React/server runtime knowledge | Requires Next.js plus Supabase operational knowledge |

Tidak ada ORM, migration framework, atau deployment mechanism final yang dipilih pada R&D ini.

# 25. Physical Schema Implications

- MariaDB atau PostgreSQL sama-sama dapat menerjemahkan 11 conceptual entities dan 13 relationships ke physical schema.
- Exact table, column, type, constraint, index, enum/check strategy, foreign key, delete action, dan migration belum ditentukan.
- Derived map taxonomy tetap query/application derivation dari parent resource.
- Logical removal akun Admin tetap conceptual lifecycle; representasi fisiknya belum dipilih.
- Parent-owned media/location tetap dipertahankan tanpa membuat generic business entity baru.

Tech stack telah mendapat human approval. Physical Database Schema / Technical Data Design menjadi tahap berikutnya dan tidak dibuat dalam dokumen ini.

# 26. ERD Compatibility

| ERD concern | Stack A | Stack B | Stack C |
|---|---|---|---|
| 11 conceptual entities | Supported | Supported | Supported |
| 13 main relationships | Supported | Supported | Supported |
| 35 Data Integrity Rules | Supported | Supported | Supported |
| Derived map taxonomy | Query/application derivation | Query/application derivation | Query/application derivation |
| Logical Admin removal | Application lifecycle + persistence | Application lifecycle + persistence | Application lifecycle + persistence |
| Announcement expiry/archive | Scheduled/request-time lifecycle | Scheduled/request-time lifecycle | Scheduled/request-time lifecycle |
| Agenda lifecycle/manual override | Supported | Supported | Supported |
| Parent-owned media/location | Supported | Supported | Supported |

**ERD Change Request: 0.**

# 27. Authorization Compatibility

Ketiga stack mampu mendukung `AUTH-INV-001` sampai `AUTH-INV-012`. Tidak ada kandidat yang memerlukan perubahan `PUBLIC`, `OWN_DUSUN`, `GLOBAL`, delete semantics, inactive-Dusun access, direct publishing, atau homepage data-driven.

**Authorization Invariant compatibility: 12/12.**  
**Roles/Permissions Change Request: 0.**

# 28. User Flow Compatibility

Ketiga kandidat mendukung:

- 10 Public User Flows tanpa login;
- 6 Admin Dusun User Flows dalam satu konteks Dusun;
- 9 Super Admin User Flows dalam scope global;
- external handoff WhatsApp dan Google Maps;
- public Arsip Pengumuman, Soft Delete, restore, status Dusun, dan empty state.

**User Flow compatibility: 25/25.**  
**User Flow Change Request: 0.**

# 29. Technical Risks

| Risk | Likelihood | Impact | Mitigation Direction |
|---|---|---|---|
| Provider/free-tier pricing changes | Medium | Medium | Verify before approval/deploy; budget paid fallback |
| Shared hosting tidak memenuhi runtime | Medium | High | Technical qualification checklist dan staging deployment |
| Billing surprise pada cloud | Medium | Medium–High | Spend controls, quota alerts, owner billing, monthly review |
| Production assets dimiliki akun mahasiswa | Medium | High | Organization/team ownership dan recovery contacts sebelum launch |
| OSM tile policy/quota disruption | Medium | High | Comply, cache, attribution, replaceable provider, monitor usage |
| Media storage growth | Medium | Medium | Resize/compress, upload limits, usage monitoring, export plan |
| Backup tidak dapat direstore | Medium | High | Scheduled logical/media exports dan restore drill |
| Admin credential attack | Medium | High | Strong hashing, HTTPS, rate limiting, secure sessions, least privilege |
| Cross-Dusun authorization leak | Low–Medium | High | Server-side ownership checks and authorization tests |
| Handover knowledge loss | Medium | High | Runbooks, training, ownership register, supervised handover |
| Deployment complexity/failed update | Medium | Medium | Repeatable deploy checklist, staging, rollback direction |
| Vendor lock-in | Medium | Medium | Standard SQL exports, S3-compatible storage where applicable, provider boundary |

# 30. Technical Open Questions and Resolution

## 30.1 Resolved by Human Decision

| ID | Resolution | Status |
|---|---|---|
| `RND-OQ-001` | cPanel-compatible shared hosting model dipilih untuk MVP. Provider/package belum dipilih dan tetap harus melalui qualification. | **RESOLVED — HUMAN DECISION** |

## 30.2 Blocking for Production Hosting Approval / Deployment

Tidak ada pertanyaan yang memblokir technical stack decision. Pertanyaan berikut memblokir persetujuan provider/paket hosting dan production deployment:

| ID | Open Question | Required Qualification |
|---|---|---|
| `RND-OQ-002` | Apakah provider/paket shared hosting aktual compatible dan layak untuk production? | PHP >= 8.3 dan required extensions; HTTPS; safe document root ke Laravel `public`; Composer/deployment support; cron/scheduler; MariaDB/MySQL version compatibility; image processing; writable storage; storage/bandwidth/database limits; backup/restore; secret configuration; production error/debug configuration. |

Jika kandidat gagal, cari provider/paket cPanel lain. Technical Change Decision diperlukan hanya bila tidak ditemukan provider viable.

## 30.3 Pre-Production / Deployment

| ID | Open Question | Timing |
|---|---|---|
| `RND-OQ-003` | Tile provider production apa yang dipilih setelah traffic dan Terms diverifikasi? | Sebelum production launch |
| `RND-OQ-004` | Berapa estimasi traffic, jumlah media, ukuran upload, dan pertumbuhan tahunan? | Sebelum final cost/storage sizing |
| `RND-OQ-005` | Siapa pemilik backup, retention, database/media export, dan restore drill? | Sebelum production handover; angka retention belum ditetapkan |
| `RND-OQ-006` | Domain, billing contact, recovery contact, dan renewal process final? | Sebelum production deployment; terkait upstream `OPEN-007` |

## 30.4 Handover

| ID | Open Question | Timing |
|---|---|---|
| `RND-OQ-007` | Kompetensi operator/developer penerus dan kebutuhan pelatihan teknis? | Sebelum handover; terkait `OPEN-009` secara operasional |

**Technical Open Questions final: 6.**  
**Blocking Technical Stack Decisions: 0.**  
**Blocking Pre-Production Questions: 1.**

# 31. R&D Decision Log

RND IDs berikut adalah normalization keputusan/rekomendasi internal R&D, bukan requirement produk baru.

| ID | Decision / Recommendation | Status |
|---|---|---|
| `RND-DEC-001` | Conventional integrated application dipilih; dedicated REST API dan microservices bukan requirement MVP. | APPROVED |
| `RND-DEC-002` | Stack A — Laravel Conventional Monolith dipilih sebagai technical baseline MVP. | APPROVED — HUMAN DECISION |
| `RND-DEC-003` | Stack B Next.js + Neon + R2 dipertahankan sebagai historical runner-up. | NOT SELECTED FOR MVP |
| `RND-DEC-004` | Authentication menggunakan application-managed username/password; tidak diganti email login. | APPROVED |
| `RND-DEC-005` | Leaflet dipilih sebagai map library; tile provider tetap boundary terpisah. | APPROVED |
| `RND-DEC-006` | Standard OSM tile service bukan SLA-backed production dependency. | RESEARCH FINDING |
| `RND-DEC-007` | Organization/team ownership dan portable exports menjadi prinsip operasional. | APPROVED OPERATIONAL PRINCIPLE |
| `RND-DEC-008` | cPanel-compatible shared hosting dipilih sebagai hosting model; provider/package menunggu qualification. | APPROVED — HUMAN DECISION |
| `RND-DEC-009` | Stack C Next.js + Supabase dipertahankan sebagai historical alternative. | NOT SELECTED FOR MVP |

# 32. Source References

Semua source diakses pada **2026-08-13**.

| Area | Official Source | URL |
|---|---|---|
| Laravel current auth/session/username/throttling | Laravel 13 Authentication | https://laravel.com/docs/13.x/authentication |
| Laravel password hashing | Laravel 13 Hashing | https://laravel.com/docs/13.x/hashing |
| Laravel rate limiting | Laravel 13 Rate Limiting | https://laravel.com/docs/13.x/rate-limiting |
| Laravel server requirements/deployment | Laravel 13 Deployment | https://laravel.com/docs/13.x/deployment |
| Laravel database support and parameter binding | Laravel 13 Database | https://laravel.com/docs/13.x/database |
| Laravel authorization | Laravel 13 Authorization | https://laravel.com/docs/13.x/authorization |
| Laravel validation/CSRF | Laravel 13 Validation; CSRF Protection | https://laravel.com/docs/13.x/validation ; https://laravel.com/docs/13.x/csrf |
| Laravel filesystem abstraction | Laravel 13 File Storage | https://laravel.com/docs/13.x/filesystem |
| Next.js image optimization | Next.js Images | https://nextjs.org/docs/app/getting-started/images |
| Next.js hosting portability | Next.js Self-Hosting | https://nextjs.org/docs/app/guides/self-hosting |
| Vercel plans/limits | Vercel Plans, Hobby, Limits, Pricing | https://vercel.com/docs/plans ; https://vercel.com/docs/plans/hobby ; https://vercel.com/docs/limits ; https://vercel.com/pricing |
| Neon pricing/limits | Neon Pricing | https://neon.com/pricing |
| Neon network transfer | Neon Network Transfer | https://neon.com/docs/introduction/network-transfer |
| Supabase password identity | Supabase Password-based Auth | https://supabase.com/docs/guides/auth/passwords |
| Supabase pricing/pausing/backups | Supabase Pricing | https://supabase.com/pricing |
| Supabase authorization direction | Supabase Auth | https://supabase.com/docs/guides/auth |
| Leaflet | Leaflet Official Site | https://leafletjs.com/ |
| MapLibre alternative | MapLibre GL JS Docs | https://maplibre.org/maplibre-gl-js/docs |
| OSM tile policy | OpenStreetMap Foundation Tile Usage Policy | https://operations.osmfoundation.org/policies/tiles/ |
| OSM attribution | OpenStreetMap Copyright and Attribution | https://www.openstreetmap.org/copyright/attribution-guide/ |
| MapTiler price/limits | MapTiler Cloud Pricing and Terms | https://www.maptiler.com/cloud/pricing/ ; https://www.maptiler.com/terms/cloud/ |
| R2 pricing/limits | Cloudflare R2 Pricing | https://developers.cloudflare.com/r2/pricing/ |
| PostgreSQL export | PostgreSQL `pg_dump` | https://www.postgresql.org/docs/current/app-pgdump.html |
| MySQL export | MySQL 8.4 `mysqldump` | https://dev.mysql.com/doc/refman/8.4/en/mysqldump.html |
| cPanel backup | cPanel Backup | https://docs.cpanel.net/cpanel/files/backup-for-cpanel/ |

Pricing/limits bersifat dinamis. Nilai pada dokumen ini harus diperiksa ulang sebelum human tech approval dan sekali lagi sebelum production deployment.

# 33. Change Request Summary

| Change Request | Count |
|---|---:|
| Baseline Change Request | 0 |
| PRD Change Request | 0 |
| Sitemap Change Request | 0 |
| User Flow Change Request | 0 |
| Roles/Permissions Change Request | 0 |
| ERD Change Request | 0 |

Tidak ada kandidat yang direkomendasikan dengan syarat mengubah requirement FROZEN.

# 34. Technical R&D Review Checklist

- [x] Seluruh source FROZEN telah dibaca.
- [x] Requirement produk tidak diubah.
- [x] Research menggunakan sumber official terbaru.
- [x] Research date dicatat.
- [x] Frontend dievaluasi.
- [x] Backend/application layer dievaluasi.
- [x] Database dievaluasi.
- [x] Authentication dievaluasi.
- [x] Authorization compatibility dievaluasi.
- [x] Map library/provider dievaluasi.
- [x] Media/storage dievaluasi.
- [x] Deployment/hosting dievaluasi.
- [x] Security dievaluasi.
- [x] Backup/portability dievaluasi.
- [x] Handover pasca-KKN dievaluasi.
- [x] Complete stack candidates dibuat.
- [x] Decision matrix tersedia.
- [x] Historical recommendation dan comparison tersedia.
- [x] Stack A telah mendapat human approval.
- [x] Pricing/limits menggunakan source official atau ditandai unverified.
- [x] Dynamic pricing diberi tanggal verifikasi.
- [x] Vendor lock-in dianalisis.
- [x] Free-tier risk dianalisis.
- [x] ERD compatibility diperiksa.
- [x] 25/25 User Flow compatible.
- [x] 12/12 Authorization Invariants compatible.
- [x] Tidak ada Physical Schema.
- [x] Tidak ada SQL.
- [x] Tidak ada API specification.
- [x] Tidak ada implementation code.
- [x] Tidak ada source FROZEN yang diubah.
- [x] Laravel 13 ditetapkan sebagai application framework MVP.
- [x] MariaDB ditetapkan sebagai database engine MVP.
- [x] Leaflet ditetapkan sebagai map library MVP.
- [x] cPanel-compatible shared hosting ditetapkan sebagai hosting model.
- [x] Hosting provider/package masih harus melalui qualification.
- [x] Production tile provider belum dikunci.
- [x] `RND-OQ-001` telah resolved.
- [x] Tidak ada Blocking Technical Stack Decision tersisa.
- [x] Technical R&D ditetapkan Version 1.0 — FROZEN FOR MVP.
- [x] Technical R&D siap menjadi source Physical Database Schema / Technical Data Design.

# 35. Final Validation

| Validation | Result |
|---|---|
| Hanya `docs/05-rnd/technical-rnd.md` dibuat | PASS |
| Version 1.0 | PASS |
| Status FROZEN FOR MVP | PASS |
| Stack A — Laravel Conventional Monolith | APPROVED TECHNICAL BASELINE — PASS |
| Stack B dan Stack C | NOT SELECTED FOR MVP — PASS |
| `RND-OQ-001` | RESOLVED — HUMAN DECISION |
| Blocking Technical Stack Decisions | 0 — PASS |
| Blocking Pre-Production Questions | 1 — OPEN BEFORE DEPLOYMENT |
| Hosting provider/package qualification | OPEN — PRE-PRODUCTION |
| Production tile provider | OPEN — PRE-PRODUCTION |
| Source FROZEN tidak berubah | PASS |
| Tidak ada requirement baru | PASS |
| Tidak ada physical schema/SQL/API/code | PASS |
| Official-source research digunakan | PASS |
| Dynamic pricing/limits bertanggal | PASS |
| Tiga complete stack candidates dibandingkan | PASS |
| KKN handover dan security menjadi faktor keputusan | PASS |
| Laravel 13, Blade, MariaDB, username/password, Policies/Gates, Leaflet, media, backup ter-cover | PASS |
| 11 conceptual entities dan 35 Data Integrity Rules | COMPATIBLE — PASS |
| User Flow compatibility | 25/25 — PASS |
| Authorization Invariant compatibility | 12/12 — PASS |
| ERD/Data Model compatibility | PASS |
| Upstream Change Request | 0 — PASS |

**Document status:** Version 1.0 — FROZEN FOR MVP.  
**Tech stack:** APPROVED TECHNICAL BASELINE.  
**Approved stack:** Stack A — Laravel Conventional Monolith.  
**Next-stage readiness:** READY as source for Physical Database Schema / Technical Data Design; no physical schema is created in this document.
