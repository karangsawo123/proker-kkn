# CONTINUATION REDESIGN — DASHBOARD ADMIN
## Portal Informasi Desa Bendung

Redesign Homepage dan area publik sebelumnya telah menghasilkan visual direction yang saya setujui.

Sekarang lanjutkan redesign ke area:

> **DASHBOARD ADMIN DUSUN + DASHBOARD SUPER ADMIN**

Fokus utama tahap ini adalah membuat dashboard:

- jauh lebih mobile-friendly;
- lebih profesional;
- lebih modern;
- lebih mudah dipahami;
- lebih efisien untuk pengelolaan data;
- tetap terasa sebagai bagian dari Portal Informasi Desa Bendung;
- tidak terlihat seperti generic SaaS/admin template;
- tidak mengubah functionality sedikit pun.

---

# SCOPE TAHAP INI

Redesign terlebih dahulu:

```text
resources/views/layouts/admin.blade.php
resources/views/layouts/super-admin.blade.php

resources/views/admin/dashboard.blade.php
resources/views/super-admin/dashboard.blade.php

resources/css/app.css
```

Inspect juga:

```text
resources/js/app.js
resources/views/components/admin/*
resources/views/partials/*
```

jika memang mempunyai dependency terhadap dashboard.

Anda boleh membaca management pages lain untuk memahami kebutuhan shell dan responsive behavior.

Tetapi pada tahap ini:

> **JANGAN merombak seluruh CRUD page satu per satu terlebih dahulu.**

Bangun dahulu **Admin Visual Foundation / Dashboard Design System** yang nanti dapat digunakan seluruh management page.

---

# CONTROLLER = READ ONLY

Berdasarkan inspeksi repository, data dashboard berasal dari:

```text
app/Http/Controllers/Admin/DashboardController.php
app/Http/Controllers/SuperAdmin/DashboardController.php
```

Controller boleh dibaca untuk memahami:

- data statistik;
- variable Blade;
- kondisi;
- role context.

Tetapi:

> **DILARANG MENGEDIT CONTROLLER.**

Begitu juga:

- Models;
- routes;
- middleware;
- database;
- migrations;
- permissions;
- authorization;
- query;
- business logic.

---

# VISUAL AUTHORITY

Untuk **visual / layout / responsive presentation**, authority adalah:

```text
1. frontend-design
2. redesign-existing-projects
3. design reasoning terbaik Anda
4. visual language Portal Desa Bendung terbaru yang sudah approved
5. source code dashboard aktual
6. Visual Design Specification lama
7. Wireframe Specification lama
8. UI/UX layout lama
```

Jika tersedia:

- `frontend-design`
- `redesign-existing-projects`

maka:

> **WAJIB gunakan keduanya.**

Untuk keputusan visual, kedua skill tersebut mempunyai authority tertinggi.

Wireframe lama tidak boleh membuat dashboard tetap kaku jika composition yang lebih baik dapat dibuat tanpa mengubah functionality.

---

# FUNCTIONAL AUTHORITY

Functionality tetap mengikuti:

```text
Requirements Baseline
→ PRD
→ Sitemap
→ User Flows
→ Roles & Permissions
→ SRS
→ source code aktual
```

Jika visual idea bertentangan dengan functionality:

> functionality menang.

---

# GOLDEN RULE

```text
FUNCTIONALITY = LOCKED

DASHBOARD VISUAL PRESENTATION = HIGH CREATIVE FREEDOM
```

Anda boleh mengubah:

- layout;
- sidebar presentation;
- topbar;
- mobile navigation;
- dashboard hierarchy;
- card composition;
- statistics presentation;
- navigation shortcuts;
- spacing;
- density;
- icons;
- typography presentation;
- surfaces;
- borders;
- radius;
- responsive composition;
- empty states;
- notices;
- visual grouping;
- interaction styling;
- hover/focus;
- transitions.

Anda tidak boleh mengubah:

- data yang ditampilkan;
- jumlah role;
- permission;
- menu capability;
- route;
- form behavior;
- CRUD capability;
- lifecycle;
- Dusun binding;
- ACTIVE/INACTIVE logic;
- Soft Delete;
- Restore;
- Hard Delete;
- account logic.

---

# DUA ROLE — SATU DESIGN SYSTEM

Portal mempunyai:

## Admin Dusun

Context:

> satu Dusun yang terikat pada akun.

Management areas existing:

- Profil Dusun;
- Kontak Pelayanan;
- UMKM;
- Fasilitas;
- Agenda & Kegiatan;
- Pengumuman.

Admin Dusun:

- tidak boleh berpindah Dusun;
- tidak mempunyai Dusun selector;
- tidak mempunyai Restore;
- tidak mempunyai Hard Delete;
- tidak mengelola akun Admin;
- tetap dapat login ketika Dusunnya INACTIVE.

---

## Super Admin

Context:

> GLOBAL / seluruh Desa dan Dusun.

Management areas existing:

- Identitas / Profil Desa;
- Dusun;
- Kontak Pelayanan;
- UMKM;
- Fasilitas;
- Kategori Fasilitas;
- Agenda & Kegiatan;
- Pengumuman;
- Data / Peta;
- Admin Dusun.

Super Admin mempunyai capability existing yang lebih luas.

---

# DESIGN PRINCIPLE

Saya tidak ingin dua dashboard yang terasa berasal dari dua produk berbeda.

Buat:

> **ONE ADMIN DESIGN SYSTEM**

dengan role/context yang berbeda.

Contoh:

```text
ADMIN DESIGN SYSTEM
│
├── Shared Shell
├── Shared Navigation Language
├── Shared Topbar
├── Shared Cards
├── Shared Typography
├── Shared Forms
├── Shared Tables
├── Shared Buttons
├── Shared Badges
├── Shared Alerts
└── Shared Responsive Rules
     │
     ├── Admin Dusun Context
     └── Super Admin Global Context
```

Jangan copy-paste dua desain berbeda.

---

# IMPORTANT — PUBLIC VS ADMIN

Dashboard tetap harus terasa terkait dengan Portal Desa Bendung.

Pertahankan DNA visual:

- Warm Natural;
- forest/moss green;
- cream/warm neutral;
- dark readable typography;
- restrained terracotta accent;
- coherent icons;
- high-quality spacing.

Tetapi dashboard harus lebih:

- utilitarian;
- compact;
- task-focused;
- information-dense;
- clean.

Public boleh editorial.

Admin jangan menjadi halaman editorial.

---

# ANTI GENERIC ADMIN TEMPLATE

Jangan membuat dashboard seperti generic:

- Bootstrap admin;
- SaaS analytics;
- crypto dashboard;
- startup dashboard;
- Tailwind template marketplace.

Hindari:

- gradient biru/ungu;
- neon;
- excessive glassmorphism;
- semua content floating card;
- card di dalam card di dalam card;
- giant KPI numbers tanpa context;
- chart palsu;
- fake analytics;
- fake percentage growth;
- fake notifications;
- fake activity;
- fake users;
- fake data visualization.

Gunakan hanya data existing.

---

# REMOVE AMATEUR VISUAL PATTERNS

Dashboard sekarang diketahui menggunakan beberapa emoji hardcoded seperti:

```text
🏛️
📊
🏘️
📞
🛍️
📍
🏷️
📅
📢
🗺️
👥
```

Untuk redesign:

> jangan gunakan emoji sebagai icon navigation/dashboard utama.

Gunakan satu coherent icon language.

Prefer:

- inline SVG;
- Lucide-like outline icons;
- simple consistent stroke;
- icon + textual label.

Jangan menambah dependency besar hanya untuk icon jika tidak diperlukan.

---

# 1. DASHBOARD SHELL

Redesign shell sebagai admin workspace modern.

Desktop conceptual:

```text
┌───────────────┬─────────────────────────────────────┐
│               │ TOPBAR                              │
│ SIDEBAR       ├─────────────────────────────────────┤
│               │                                     │
│ NAVIGATION    │ MAIN CONTENT                        │
│               │                                     │
│               │                                     │
└───────────────┴─────────────────────────────────────┘
```

Tetapi jangan mengikuti ASCII ini secara literal.

Gunakan skill desain untuk menghasilkan composition terbaik.

---

# 2. SIDEBAR DESKTOP

Sidebar harus:

- jelas;
- mudah discan;
- tidak terlalu lebar;
- navigation hierarchy jelas;
- active item sangat mudah dikenali;
- role/context terlihat;
- icon konsisten;
- logout/account tidak bercampur dengan management navigation.

Existing behavior collapse boleh dipertahankan jika memang sudah bekerja.

Jangan mengubah menu capability.

---

# MOBILE SIDEBAR — PRIORITAS BESAR

Dashboard harus nyaman di smartphone.

Pada mobile:

> sidebar desktop TIDAK boleh sekadar diperkecil.

Gunakan openable navigation drawer/panel yang baik.

Mobile topbar minimal harus memberikan:

- menu trigger;
- page/context orientation;
- account/logout access sesuai behavior existing.

Drawer:

- full usable height;
- mudah ditutup;
- tidak menyebabkan horizontal overflow;
- touch target nyaman;
- current page jelas;
- role/context terlihat;
- focus/ARIA behavior tetap baik.

Pertahankan ID/function JS existing jika layout menggunakan coupling seperti:

```text
#sidebarToggleBtn
#sidebarCloseBtn
#adminSidebar
```

Inspect dahulu.

---

# 3. ADMIN DUSUN CONTEXT

Admin Dusun harus selalu memahami:

> "Saya sedang mengelola Dusun X."

Tetapi context fixed tersebut:

> **JANGAN terlihat seperti dropdown/select.**

Tidak boleh memberi kesan pengguna bisa mengganti Dusun.

Gunakan context treatment yang baik pada:

- sidebar;
- topbar;
- page header;

sesuai judgment desain.

Jangan mengulang nama Dusun secara berlebihan.

---

# 4. SUPER ADMIN CONTEXT

Super Admin mempunyai context global.

Berikan orientation yang jelas bahwa user berada pada:

> Super Admin / Global Desa Bendung.

Tetapi jangan menggunakan giant badge atau elemen dekoratif berlebihan.

---

# 5. TOPBAR

Topbar harus sederhana.

Pertimbangkan hierarchy:

```text
Page / context
                         Account
```

atau composition yang lebih baik.

Jangan memenuhi topbar dengan:

- fake search;
- fake notification;
- fake message;
- setting yang tidak tersedia;
- dark mode toggle baru;
- unsupported actions.

Hanya existing behavior.

---

# 6. PAGE HEADER SYSTEM

Bangun pola page header reusable secara visual.

Misalnya memiliki:

- page title;
- supporting context;
- primary action jika applicable;
- filter jika applicable.

Dashboard overview sendiri mungkin tidak memiliki Create action.

Tujuannya agar nanti management pages dapat mengikuti bahasa yang sama.

---

# 7. DASHBOARD ADMIN DUSUN OVERVIEW

Inspect:

```text
resources/views/admin/dashboard.blade.php
```

Jangan mengarang statistik baru.

Gunakan statistik existing saja.

Dashboard Admin Dusun sebaiknya menjawab:

1. Saya sedang mengelola Dusun apa?
2. Status Dusun bagaimana?
3. Data apa yang sudah tersedia?
4. Ke mana saya harus masuk untuk mengelola data?

Jangan sekadar menampilkan deretan stat card besar.

Gunakan hierarchy yang lebih bermakna.

---

# ADMIN DUSUN DASHBOARD CHARACTER

Saya ingin dashboard overview terasa seperti:

> **control center sederhana untuk pengelola Dusun**

bukan analytics dashboard.

Boleh menggunakan:

- compact statistics;
- management shortcuts;
- profile/status context;
- content completeness feeling jika benar-benar berasal dari data existing.

Tetapi jangan membuat calculation/analytics baru tanpa source.

---

# 8. ADMIN DUSUN INACTIVE NOTICE

Jika Dusun `INACTIVE`, existing informational notice tetap harus muncul.

Redesign agar:

- terlihat;
- jelas;
- tidak seperti catastrophic error;
- tidak memakan terlalu banyak layar;
- menjelaskan context.

Jangan menambahkan:

- Activate button;
- toggle;
- link Super Admin action.

Admin Dusun tidak mempunyai capability tersebut.

---

# 9. SUPER ADMIN DASHBOARD OVERVIEW

Inspect:

```text
resources/views/super-admin/dashboard.blade.php
```

Gunakan data existing.

Super Admin dashboard sebaiknya menjadi:

> **global control center Portal Desa Bendung**

Tetapi tetap utility-focused.

Super Admin memiliki lebih banyak modul, jadi hierarchy lebih penting.

Jangan membuat:

> sepuluh navigation cards identik + tujuh statistik identik

jika composition yang lebih cerdas dapat dibuat.

Gunakan:

- hierarchy;
- grouping;
- density;
- context;
- spatial composition.

---

# 10. SUPER ADMIN MODULE GROUPING — VISUAL ONLY

Anda boleh **mengelompokkan menu secara visual** jika membantu scanning.

Misalnya secara konseptual:

```text
DESA
- Identitas Desa
- Dusun

INFORMASI
- Kontak
- UMKM
- Fasilitas
- Kategori

KONTEN
- Agenda
- Pengumuman

SISTEM
- Data / Peta
- Admin Dusun
```

Tetapi:

> Ini hanya VISUAL NAVIGATION GROUPING.

Jangan:

- membuat role baru;
- route baru;
- parent page baru;
- permission group baru.

Gunakan grouping aktual terbaik setelah membaca navigation existing.

---

# 11. STAT CARDS

Redesign `.stat-card`.

Jangan menggunakan pola:

```text
[emoji besar]
999
Label
```

berulang-ulang tanpa hierarchy.

Statistik harus:

- compact;
- readable;
- context-aware;
- tidak terlalu tinggi;
- cocok mobile.

Boleh memakai icon + value + label dengan treatment restrained.

---

# MOBILE STATISTICS

Pada smartphone:

Jangan menghasilkan:

```text
[STAT CARD]
[STAT CARD]
[STAT CARD]
[STAT CARD]
[STAT CARD]
```

yang membuat pengguna scroll hanya untuk statistik.

Gunakan layout lebih compact seperti:

- 2-column grid jika cukup;
- compact metric rows;
- responsive grouping;

sesuai kemampuan desain terbaik Anda.

Pastikan value panjang tetap aman.

---

# 12. MOBILE DASHBOARD OVERVIEW

Ini adalah prioritas redesign.

Test pada width kecil.

Dashboard mobile harus:

- tidak horizontal scroll;
- sidebar drawer bekerja;
- title tidak terpotong;
- cards tidak terlalu tinggi;
- statistics compact;
- shortcut management mudah ditekan;
- account/logout accessible;
- context jelas;
- content padding tidak berlebihan.

Jangan hanya membuat:

```css
grid-template-columns: 1fr;
```

lalu menganggap dashboard sudah mobile-friendly.

Redesign composition mobile secara nyata.

---

# 13. TABLE / FORM FOUNDATION

Walaupun tahap ini belum meredesign seluruh CRUD page, Anda harus memastikan shared dashboard visual foundation siap untuk:

- tables;
- mobile management cards;
- forms;
- filters;
- buttons;
- badges;
- modals;
- pagination;
- empty states.

Jangan merombak semua view tersebut dahulu.

Tetapi CSS foundation yang Anda buat jangan hanya cocok untuk dashboard overview.

---

# 14. ADMIN CARDS

Gunakan card dengan bijak.

Card cocok untuk:

- grouped information;
- statistic;
- important context.

Jangan membuat:

```text
admin-content
└── card
    └── card
        └── stat-card
```

tanpa kebutuhan.

Gunakan whitespace, dividers, typography, dan surface sebagai alternatif.

---

# 15. BUTTON SYSTEM

Pastikan hierarchy jelas:

- Primary;
- Secondary;
- Tertiary;
- Destructive.

Jangan mengubah action existing.

Danger/destructive action harus terlihat berbeda tetapi tidak menggunakan styling berlebihan.

---

# 16. STATUS BADGES

Lifecycle dan status yang berbeda tidak boleh dicampur.

Contoh:

- Dusun Aktif/Nonaktif;
- Agenda Akan Datang/Berlangsung/Selesai;
- Pengumuman Aktif/Arsip;
- operational record state.

Visual boleh diperbaiki.

Semantics jangan berubah.

---

# 17. MODALS — PROTECT FUNCTIONALITY

Layouts sekarang mempunyai modal behavior existing.

Admin:

```text
#deactivateModal
```

Super Admin dapat memiliki:

```text
#deactivateModal
#restoreModal
#forceDeleteModal
#removeAccountModal
```

Inspect aktual.

Anda boleh redesign:

- modal surface;
- hierarchy;
- spacing;
- icon;
- buttons;
- responsive width.

Tetapi jangan mengubah:

- form action;
- method;
- hidden data;
- IDs;
- JS function;
- destructive behavior.

---

# MOBILE MODALS

Pastikan modal pada smartphone:

- tidak overflow viewport;
- action mudah disentuh;
- long target name tetap terbaca;
- scroll internal hanya jika benar-benar perlu.

Boleh menggunakan mobile-friendly dialog composition.

Jangan membuat functionality baru.

---

# 18. RESPONSIVE SYSTEM

Gunakan pendekatan nyata:

## MOBILE

Priority:

```text
context
↓
page title
↓
important information
↓
primary actions
↓
supporting information
```

## TABLET

Gunakan ruang tambahan dengan bijak.

## DESKTOP

Dashboard dapat memanfaatkan:

- sidebar;
- wider content;
- denser statistics;
- management grouping.

Desktop jangan terasa seperti mobile yang diperlebar.

---

# 19. TYPOGRAPHY

Admin tidak perlu terlalu editorial.

Gunakan clean sans-serif sebagai typography utama.

Serif dari public brand boleh muncul sangat selektif jika memang meningkatkan branding.

Dashboard harus:

- sangat readable;
- cepat discan;
- cocok untuk data/table/form.

Jangan menggunakan terlalu banyak font family.

---

# 20. COLOR

Gunakan visual family Portal Bendung yang approved.

Prefer:

- Cream / warm neutral background;
- Forest/Moss navigation/accent;
- Dark Olive readable text;
- Sage supporting;
- Terracotta restrained.

Tetapi jangan membuat seluruh dashboard hijau.

Gunakan neutral space untuk membantu kerja admin.

---

# 21. ACCESSIBILITY

Pastikan:

- visible focus;
- keyboard navigation;
- semantic navigation;
- readable contrast;
- buttons tidak icon-only untuk critical actions;
- mobile touch target cukup;
- modal focus behavior tidak rusak;
- navigation drawer accessible.

---

# 22. MOTION

Dashboard tidak membutuhkan banyak animation.

Gunakan hanya:

- sidebar transition;
- hover/focus;
- modal transition;
- subtle state feedback.

Hindari:

- scroll reveal untuk management content;
- card flying;
- bouncing;
- continuous animation.

Dashboard adalah workspace.

---

# 23. CSS STRATEGY

`resources/css/app.css` saat ini merupakan global stylesheet besar.

Pada tahap ini:

Boleh:

- redesign Section Admin CSS;
- memperbaiki shared admin tokens;
- memperbaiki sidebar;
- topbar;
- statistics;
- modal;
- dashboard layout;
- responsive rules.

Jangan:

- refactor seluruh CSS application;
- merusak Homepage/Dusun/public;
- menghapus public redesign;
- melakukan architecture refactor besar yang tidak diperlukan.

Scope CSS harus jelas.

---

# PUBLIC REGRESSION PROTECTION

Homepage dan Halaman Public sudah memiliki direction visual yang approved.

Setelah admin redesign:

> area public tidak boleh berubah/rusak.

Cek:

- Homepage;
- public header;
- public footer;
- typography;
- public buttons;
- map.

Jika menggunakan shared token, pastikan tidak menimbulkan regression.

---

# 24. JAVASCRIPT PROTECTION

Inspect scripts di:

```text
resources/views/layouts/admin.blade.php
resources/views/layouts/super-admin.blade.php
resources/js/app.js
```

Cari coupling:

```text
sidebarToggleBtn
sidebarCloseBtn
adminSidebar

openDeactivateModal()
openRestoreModal()
openForceDeleteModal()
openRemoveAccountModal()
```

dan ID/form lainnya.

Jangan mengubah class/ID/function secara sembarangan demi visual.

---

# IMPLEMENTATION WORKFLOW

## STEP 1 — INSPECT

Baca secara menyeluruh:

```text
resources/views/layouts/admin.blade.php
resources/views/layouts/super-admin.blade.php
resources/views/admin/dashboard.blade.php
resources/views/super-admin/dashboard.blade.php
resources/css/app.css
```

Kemudian inspect dependency yang diperlukan.

---

## STEP 2 — USE DESIGN SKILLS

Gunakan:

- `frontend-design`
- `redesign-existing-projects`

secara aktif.

Saya ingin melihat kemampuan desain terbaik Anda.

Jangan meminta saya memilih desain terlebih dahulu.

---

## STEP 3 — DESIGN SHARED ADMIN FOUNDATION

Tentukan visual system yang dapat digunakan Admin Dusun dan Super Admin.

---

## STEP 4 — IMPLEMENT BOTH DASHBOARD SHELLS

Redesign:

- Admin layout;
- Super Admin layout.

Pastikan keduanya satu family.

---

## STEP 5 — IMPLEMENT DASHBOARD OVERVIEWS

Redesign:

```text
admin/dashboard.blade.php
super-admin/dashboard.blade.php
```

Gunakan hanya data existing.

---

## STEP 6 — MOBILE-FIRST QA

Ini wajib.

Periksa width smartphone nyata/conceptual seperti:

```text
320px
360px
375px
390px
430px
```

Periksa:

- sidebar;
- cards;
- stat grid;
- navigation;
- topbar;
- role/context;
- long text;
- notices;
- buttons;
- modals.

---

## STEP 7 — DESKTOP QA

Periksa dashboard tidak terlalu kosong atau terlalu lebar.

Gunakan appropriate content max-width/layout.

---

## STEP 8 — FUNCTIONAL QA

Pastikan:

### Admin Dusun

- login redirect tetap benar;
- sidebar links tetap benar;
- hanya enam area existing;
- fixed Dusun context tetap;
- INACTIVE notice tetap;
- logout tetap;
- modal Nonaktif tetap.

### Super Admin

- semua 10 management area tetap;
- links tetap;
- global context tetap;
- modal existing tetap;
- account actions tetap.

---

# DO NOT TOUCH

Kecuali hanya untuk READ/inspection:

```text
app/Http/Controllers/**
app/Models/**
routes/web.php
database/**
app/Policies/**
app/Http/Middleware/**
```

Jangan mengubah backend agar cocok dengan desain.

Desain harus menyesuaikan functionality existing.

---

# TESTING

Setelah implementasi:

1. Jalankan existing tests relevan.
2. Jalankan Vite/build.
3. Jangan mengubah test hanya agar redesign lolos.
4. Periksa Blade syntax.
5. Periksa JavaScript error.
6. Periksa sidebar toggle.
7. Periksa modal.
8. Periksa logout.
9. Periksa links.
10. Periksa responsive behavior.

Jika test sebelumnya sudah gagal sebelum redesign, laporkan terpisah.

---

# FINAL REPORT

Setelah selesai berikan:

## 1. Design Concept

Jelaskan konsep dashboard.

## 2. Shared Admin System

Jelaskan apa yang sekarang shared antara Admin Dusun dan Super Admin.

## 3. Admin Dusun Dashboard

Ringkas perubahan.

## 4. Super Admin Dashboard

Ringkas perubahan.

## 5. Mobile Improvements

Sebutkan secara spesifik bagaimana mobile UX diperbaiki.

## 6. Files Changed

Daftar seluruh file yang diubah.

## 7. Functionality Preservation

Konfirmasi tidak ada business logic yang berubah.

## 8. JavaScript Dependencies

Sebutkan coupling yang dipertahankan.

## 9. Public Regression

Konfirmasi Homepage/Public tidak terdampak.

## 10. Tests / Build

Laporkan hasil.

---

# FINAL AUTHORITY

Jika konflik hanya menyangkut:

```text
layout
composition
sidebar visual
dashboard hierarchy
cards
spacing
responsive layout
typography presentation
icons
surface
mobile treatment
```

maka:

> **frontend-design + redesign-existing-projects MENANG atas Wireframe/UI/Visual Specification lama.**

Jika konflik menyangkut:

```text
role
permission
route
data
CRUD capability
Soft Delete
Restore
Hard Delete
Dusun binding
Active/Inactive
authentication
business logic
```

maka:

> **PRODUCT CONTRACT + SOURCE CODE FUNCTIONALITY MENANG.**

---

# TARGET AKHIR

Saya ingin Dashboard Portal Desa Bendung terasa seperti:

> **workspace administrasi desa yang modern, tenang, profesional, mudah digunakan, dan sangat nyaman di smartphone**

bukan:

> template dashboard SaaS.

Admin Dusun dan Super Admin harus jelas berbeda dalam context dan capability, tetapi secara visual terlihat berasal dari **satu Admin Design System Portal Informasi Desa Bendung**.

Prioritaskan kualitas mobile dengan serius.

Jangan mengubah functionality.

Tunjukkan kreativitas terbaik Anda.