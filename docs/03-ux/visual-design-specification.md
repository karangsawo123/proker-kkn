# Visual Design Specification

**Project:** Portal Informasi Desa Bendung  
**Document:** Visual Design Specification  
**Version:** 1.0  
**Status:** FROZEN FOR MVP  
**Visual Direction:** Warm Natural  
**Visual Direction Status:** APPROVED AND FROZEN FOR MVP  
**Primary Layout Source:** Wireframe Specification v1.0 — FROZEN FOR MVP  
**Primary Interaction Source:** UI/UX Specification v1.0 — FROZEN FOR MVP  
**Software Contract:** SRS v1.0 — FROZEN FOR MVP  
**Normative Visual Reference:** `assets/warm-natural-direction.png`  
**Exploratory Application Reference:** `assets/homepage-exploratory-mockup.png` — `UX-SCR-001` ONLY

## 1. Document Purpose

**Human Review Note:** Visual Design Specification v1.0 telah melalui formal human review dan ditetapkan **FROZEN FOR MVP** bersama Warm Natural visual system untuk MVP.

Dokumen ini memformalkan Warm Natural sebagai visual system MVP yang konsisten untuk seluruh 28 screen/context, public website, authentication, dashboard Admin Dusun, dashboard Super Admin, future high-fidelity mockup, Figma, CSS/Blade implementation, dan visual QA. Existing exploratory Homepage mockup tetap reference dan tidak otomatis menjadi final/frozen Homepage screen.

Dokumen ini:

- tidak mengubah layout Wireframe Specification v1.0;
- tidak mengubah behavior UI/UX Specification v1.0;
- tidak mengubah requirement atau software contract;
- tidak menambah feature, page, actor, form field, lifecycle, permission, atau data faktual;
- hanya menentukan penerapan visual Warm Natural pada UI.

Specification boleh menentukan token warna, type hierarchy, spacing, border, radius, shadow, icon direction, imagery treatment, component hierarchy, surface/elevation, dan visual state. Specification ini belum menghasilkan CSS, Tailwind configuration, Blade, JavaScript, Figma, production mockup, image asset baru, test specification, atau implementation code.

### Source Precedence

Jika terjadi contradiction, authority chain yang reproducible adalah:

1. Requirements Baseline;
2. PRD;
3. Sitemap;
4. User Flows;
5. Roles & Permissions;
6. ERD / Data Model;
7. Technical R&D;
8. Physical Database Schema;
9. SRS;
10. UI/UX Specification;
11. Wireframe Specification;
12. Visual Design Specification;
13. visual reference/mockup.

Visual Design Specification tidak dapat mengubah atau override upstream behavior, data contract, authorization, information architecture, interaction, atau layout. Warm Natural board menjadi normative visual reference setelah human approval, tetapi hanya di dalam boundary product dan layout FROZEN. Homepage exploratory mockup tetap berada di bawah seluruh source FROZEN. Visual examples tidak pernah menciptakan product behavior atau real Desa data.

## 2. Visual Principles — Warm Natural

Warm Natural harus terasa hangat, alami, ramah, tenang, membumi, bernuansa pedesaan, dekat dengan warga, readable, dan bersih. Interface tetap modern tanpa kehilangan karakter lokal serta merepresentasikan alam, budaya, kehidupan desa, keramahan, dan keberlanjutan.

Prinsip prioritas:

1. **READABILITY > DECORATION.**
2. Usability tidak dikorbankan untuk aesthetic.
3. Hierarchy jelas sebelum ornamen.
4. Visual ramah tanpa menjadi kekanak-kanakan.
5. Public lebih editorial dan imagery-rich; admin lebih utility-focused.
6. Satu visual family digunakan di seluruh product.
7. Warm Natural bukan corporate blue, glassmorphism, brutalist, atau alternative direction lain.

## 3. Approved Color Palette

Palette berikut adalah canonical dan tidak mempunyai primary alternative:

| Canonical color | Value | Normative role |
| --- | --- | --- |
| Moss Green | `#2E5E3E` | Primary brand dan action. |
| Sage Green | `#7A8F6B` | Secondary natural accent dan supporting surface. |
| Terracotta | `#C46A3A` | Warm accent dan emphasis terbatas. |
| Warm Beige | `#F1E7D3` | Supporting background/surface. |
| Cream | `#FAF7F2` | Main light background/surface. |
| Dark Olive | `#2B2F23` | Primary text, heading, dan dark surface. |

Hue utama tidak boleh diganti tanpa formal Visual Design Change Decision. Warna contoh lain pada moodboard atau mockup bukan palette tambahan dan tidak distandardisasi.

## 4. Color Role System

| Semantic token concept | Canonical mapping | Usage boundary |
| --- | --- | --- |
| `color-primary` | Moss Green `#2E5E3E` | Primary CTA, selected navigation, key interactive emphasis. |
| `color-primary-hover` | Dark Olive `#2B2F23` | Hover emphasis dengan Cream text; bukan hue baru. |
| `color-primary-active` | Moss Green `#2E5E3E` | Pressed geometry/border membedakan active state. |
| `color-secondary` | Sage Green `#7A8F6B` | Supporting accent/surface; bukan default body text. |
| `color-accent` | Terracotta `#C46A3A` | Small highlight, selected accent, atau decorative mark. |
| `color-background` | Cream `#FAF7F2` | Main page background. |
| `color-surface` | Cream `#FAF7F2` | Default card/input/dialog surface. |
| `color-surface-supporting` | Warm Beige `#F1E7D3` | Section band, secondary panel, calm state surface. |
| `color-text-primary` | Dark Olive `#2B2F23` | Heading dan body text. |
| `color-text-secondary` | Moss Green `#2E5E3E` | Secondary emphasis on light surfaces. |
| `color-border` | Sage Green `#7A8F6B` | Default restrained divider/control boundary on light/Cream surfaces; contextual, not mandatory everywhere. |

Hover, focus, active, disabled, loading, error, destructive, dan status state tidak boleh dibedakan hanya melalui hue. Geometry, border weight, label, icon, pattern, dan message melengkapi color cue.

Untuk neutral/informational state—termasuk Dusun INACTIVE notice, read-only context, supporting information, dan non-destructive status context—gunakan Warm Beige supporting surface dengan Dark Olive readable text serta label/icon bila diperlukan. Ini tidak menciptakan product state baru.

Sage Green bukan border wajib pada setiap background. Jika boundary, focus, atau control distinction pada Warm Beige/surface lain tidak memadai, gunakan Moss Green atau Dark Olive pada approved weight 1px/2px/3px. Readability dan control recognition lebih penting daripada rigid token reuse; tidak ada warna baru.

## 5. Color Accessibility

Recommended measured pairings pada canonical values:

| Foreground / Background | Approximate contrast | Direction |
| --- | ---: | --- |
| Dark Olive / Cream | `12.81:1` | Preferred heading/body pairing. |
| Dark Olive / Warm Beige | `11.16:1` | Preferred text on supporting surface. |
| Cream / Dark Olive | `12.81:1` | Safe high-emphasis dark surface pairing. |
| Cream / Moss Green | `7.05:1` | Preferred primary-button pairing. |
| Moss Green / Cream | `7.05:1` | Preferred link/secondary emphasis pairing. |
| Moss Green / Warm Beige | `6.14:1` | Supporting emphasis pairing. |

Terracotta/Cream (`3.59:1`), Terracotta/Warm Beige (`3.13:1`), dan Dark Olive/Sage (`3.89:1`) tidak direkomendasikan untuk small body text tanpa further measurement dan contextual adjustment. Terracotta terutama menjadi accent, bukan default body text. Jika pairing tidak readable, gunakan Dark Olive, Cream, atau Moss Green yang sudah approved sebelum mempertimbangkan perubahan warna.

Contrast ratios di atas adalah design-reference measurement, bukan klaim WCAG certification. Actual rendered high-fidelity/implementation components tetap memerlukan contrast verification terhadap actual font size, weight, background, interaction state, overlay, browser rendering, dan component context. Status, success, warning, error, dan destructive meaning selalu memakai text/context selain warna.

## 6. Typography — Approved

| Role | Typeface | Weight direction |
| --- | --- | --- |
| Display / Heading | Lora | Semibold |
| Subheading | Lora | Medium |
| Body / UI | Inter | Regular |
| Button / Action | Inter | Semibold |

Tidak ada second typography proposal. Font fallback dan loading strategy adalah implementation qualification, bukan perubahan visual direction.

## 7. Type Scale

Semantic type hierarchy bersifat mobile-first dan memakai sedikit ukuran berulang:

| Token concept | Mobile reference | Desktop reference | Typeface/weight |
| --- | ---: | ---: | --- |
| Display | 40px | 48px | Lora Semibold |
| H1 | 32px | 40px | Lora Semibold |
| H2 | 24px | 32px | Lora Semibold |
| H3 | 20px | 24px | Lora Medium |
| Body Large | 16px | 16px | Inter Regular |
| Body | 16px | 16px | Inter Regular |
| Body Small | 14px | 14px | Inter Regular |
| Label | 14px | 14px | Inter Semibold where emphasis is needed |
| Button | 14px | 16px | Inter Semibold |
| Caption | 14px | 14px | Inter Regular |

Display digunakan terbatas. Responsive scaling mempertahankan hierarchy dan readable line length; exact implementation dapat memakai responsive interpolation selama tidak menambah arbitrary hierarchy level.

## 8. Typography Usage

- Lora diprioritaskan untuk display, H1, H2, dan important editorial/public headings.
- Lora Medium dapat digunakan untuk H3 atau section heading yang memerlukan local character.
- Inter digunakan untuk navigation, body, links, labels, forms, tables, buttons, badges, metadata, dashboard, dan feedback.
- Dashboard tidak memakai Lora pada setiap label; Lora hadir selektif pada page title atau major section title.
- Uppercase tidak digunakan untuk long text dan tidak menggantikan hierarchy.
- Status dan action label harus tetap textual dan mudah dipindai.

## 9. Spacing System

Base rhythm adalah **8px**.

| Alias | Value | Typical use |
| --- | ---: | --- |
| XS | 8px | Icon-label gap, compact internal separation. |
| SM | 16px | Control/card padding dan related fields. |
| MD | 24px | Card/section internal grouping. |
| LG | 32px | Section separation dan desktop grouping. |
| XL | 64px | Major public-section whitespace. |

Penggunaan boleh menggabungkan approved increments untuk kebutuhan layout yang dibuktikan oleh wireframe, tetapi arbitrary values tidak menjadi token baru tanpa alasan dan review. Spacing tidak mengubah urutan atau grouping layout FROZEN.

## 10. Border System

| Weight | Usage |
| ---: | --- |
| 1px | Default divider, input, card, table row, dan subtle boundary. |
| 2px | Focus, selected, validation, atau stronger emphasis. |
| 3px | Highly emphasized state secara sangat terbatas. |

Border tetap ringan, konsisten, dan tidak membentuk heavy-border aesthetic. Border style dan text/icon cue bersama-sama menjelaskan state.

## 11. Radius System

| Radius | Usage |
| ---: | --- |
| 8px | Compact controls, badge container, small utility elements. |
| 12px | Input, button, small card, popup. |
| 16px | Common card, dialog, dashboard panel. |
| 24px | Large hero/image/feature container jika cocok dengan wireframe. |

Radius mengikuti scale `8/12/16/24px`. Tidak semua element berbentuk pill; pill hanya untuk compact semantic item bila bentuknya membantu pemindaian.

## 12. Shadow System

| Level | Visual direction | Intended use |
| --- | --- | --- |
| Low | Soft, diffuse, natural, subtle | Card atau basic elevation. |
| Medium | Soft separation yang jelas | Floating control, dropdown, popup, dialog context. |
| High | Highest restrained elevation | Blocking/high-elevation layer hanya ketika diperlukan. |

Shadow tidak menggantikan border atau focus indication. Dramatic, hard, neon, atau glass-like shadow tidak digunakan. Exact box-shadow implementation ditunda.

## 13. Iconography

Iconography bersifat friendly, rounded, consistent, simple, recognizable, dan mudah dipahami. Konsep Beranda, Lokasi, Agenda, Kontak, Sekolah, Masjid, UMKM, dan Peta pada board hanya menunjukkan karakter ikon; availability dan placement tetap mengikuti Sitemap serta screen contract.

## 14. Icon Rules

- Gunakan satu coherent outline/simple style dengan rounded visual character.
- Pertahankan stroke weight dan optical size yang konsisten.
- Critical action selalu memiliki label atau contextual accessible name.
- Destructive icon selalu disertai text/context.
- Category distinction tidak bergantung hanya pada icon color.
- Exact icon library belum dipilih dan bukan Visual Design Open Question yang memblokir specification.
- Keberadaan icon pada moodboard tidak menciptakan feature/navigation item.

## 15. Imagery Direction

Imagery memprioritaskan konteks autentik Desa Bendung: alam, pertanian, kehidupan masyarakat, fasilitas lokal, UMKM, kegiatan warga, dan landscape. Real imagery hanya digunakan jika tersedia, faktual, dan memiliki izin publikasi yang berlaku.

Gambar pada board/mockup adalah visual reference, bukan bukti faktual Desa Bendung. Identitas “Sumberagung”, lokasi, nomor kontak, nama petugas, produk, harga, tanggal, dan foto contoh tidak boleh dipublikasikan sebagai data Desa Bendung. Placeholder/reference imagery harus diberi status yang jelas selama design stage.

## 16. Image Treatment

- Warm, natural, dan tidak oversaturated.
- Crop mendukung informasi dan tidak memotong subject penting secara menyesatkan.
- Text tidak ditempatkan di atas image tanpa readable separation/overlay yang tervalidasi.
- Optional image tetap optional; card dan page tidak runtuh ketika image tidak ada.
- Placeholder terlihat intentional, tenang, dan tidak menyamar sebagai fakta.
- Aspect treatment konsisten per component type, tetapi tidak memaksa semua resource memakai crop identik.

## 17. Decorative Motif

Subtle leaf, organic line, atau natural shape boleh menjadi supporting decoration. Motif:

- tidak menjadi UI control;
- tidak menutupi informasi atau focus indicator;
- tidak menurunkan contrast;
- tidak digunakan berlebihan;
- tidak wajib pada setiap heading/card;
- tidak menggantikan icon atau logo.

## 18. Brand Mark / Desa Identity

Logo resmi Desa, jika tersedia dan terverifikasi, tetap menjadi identity utama. Warm Natural motif bukan replacement logo. Header boleh menggabungkan Logo Desa, Nama Desa, dan locality context sesuai wireframe. Specification ini tidak redesign, redraw, atau memodifikasi logo resmi.

## 19. Public Header Visual

Public header memakai Cream/light surface, Dark Olive/Moss identity, restrained navigation/menu, selected-nav indicator yang subtle tetapi jelas, visible focus state, dan clean separation. Mobile tetap `[LOGO / NAMA DESA] [MENU]`; desktop tetap `[LOGO / NAMA DESA] [PRIMARY NAVIGATION]` sesuai Wireframe v1.0. Hierarchy, route, dan navigation item tidak berubah.

Primary CTA style Moss Green + Cream tetap tersedia melalui global Button System, tetapi CTA hanya dirender pada screen/context yang memang mempunyai authorized action menurut source FROZEN. Header tidak wajib mempunyai CTA. Exploratory Header CTA—termasuk “Hubungi Pelayanan”—**NOT STANDARDIZED** kecuali frozen screen contract secara eksplisit menempatkan action tersebut di Header.

## 20. Button System

| Variant | Visual treatment | Boundary |
| --- | --- | --- |
| Primary | Moss Green surface, Cream text, Inter Semibold | Satu dominant action per local context bila wireframe menunjukkannya. |
| Secondary | Cream surface, Moss Green text/border | Supporting action tanpa bersaing dengan primary. |
| Tertiary / Text | Transparent/light surface, Moss Green text, visible focus | Low-emphasis navigation/action. |
| Destructive | Cream/Warm Beige surface, Dark Olive readable text, Terracotta accent/border/icon, stronger border and explicit wording | Hanya behavior yang sudah authorized; tidak memakai color alone dan tidak menambah red palette. |
| External Action | Primary/secondary shell dengan external/WhatsApp/direction cue | Hanya ketika publication/data prerequisite terpenuhi. |

Primary tetap memakai Moss Green surface + Cream text. Destructive hierarchy berasal dari wording, icon, border, spacing, dialog hierarchy, clear target identity, dan Terracotta accent—bukan hue saja. Terracotta tidak menjadi small body/button text utama di atas Cream ketika contrast tidak memadai. Tidak ada new red, alert-red palette, atau second semantic palette. Button styling tidak menciptakan action baru.

## 21. Button States

| State | Visual requirement |
| --- | --- |
| Default | Variant, label, dan action hierarchy jelas. |
| Hover | Visible emphasis memakai approved palette/elevation; tidak menggeser layout. |
| Focus | 2px–3px Moss Green atau Dark Olive high-visibility boundary dengan separation memadai; tidak bergantung pada subtle shadow saja. |
| Active | Pressed geometry/border emphasis dan retained label. |
| Disabled | Non-interactive appearance, readable label, dan disabled semantics; bukan sekadar opacity ekstrem. |
| Loading | Label/context retained, progress cue textual/visual, repeated activation prevented. |

Exact CSS state implementation tidak ditentukan.

Implementation tidak boleh menghapus browser/semantic focus behavior. Exact focus CSS tetap downstream.

## 22. Section Heading Style

Major public section headings memakai Lora secara selektif dengan Dark Olive. Subtle Terracotta line atau botanical mark boleh membantu hierarchy jika contrast dan readability tetap terjaga. Decoration tidak wajib pada setiap heading dan tidak boleh mengubah heading level.

## 23. Public Card System

Kontak, UMKM, Fasilitas, Agenda, dan Pengumuman memakai shared family: Cream/light surface, subtle border, radius 12px–16px, Low shadow bila elevation diperlukan, clear media crop/placeholder, strong title, concise metadata, explicit status/action. Internal structure mengikuti wireframe masing-masing dan tidak dipaksa identik.

## 24. Status Badge System

| Lifecycle axis | Values | Visual direction |
| --- | --- | --- |
| Dusun lifecycle | Aktif / Nonaktif | Text label plus icon/border/surface distinction. |
| Operational record | Aktif / Nonaktif atau Soft Deleted | Distinct record-state label; never called Arsip/Selesai. |
| Agenda lifecycle | Akan Datang / Berlangsung / Selesai | Three textual labels; separate from record state. |
| Pengumuman lifecycle | Aktif / Arsip | Expiry-derived context; separate from record state. |
| Account lifecycle | Aktif / Logically Removed or approved user-facing wording | Removed state visibly read-only and non-interactive. |

Badges always include text. Moss/Sage/Terracotta/Warm Beige may distinguish emphasis, but icon, wording, and border treatment carry meaning when color is unavailable.

## 25. Contact Card

Contact card may show portrait/avatar when available, name, role, contact line, and authorized WhatsApp CTA. Missing photo uses intentional placeholder. CTA is conditional on source data and publication prerequisite. Kontak Pelayanan remains a card/list resource; no fifth public Detail page is created.

## 26. UMKM Card

Visual hierarchy: image/placeholder, name, type, short supporting information, Detail affordance, dan WhatsApp action when eligible. UMKM remains **DIRECTORY + WHATSAPP**.

Moodboard product card with price/cart-like treatment is explicitly excluded. No price requirement, cart, basket, checkout, purchase button, stock, transaction, or commerce state is adopted.

Produk UMKM tetap informational child rows/tags/list sesuai frozen source; visual treatment tidak mengubahnya menjadi merchandise atau purchasable item.

## 27. Facility Card

Facility card uses image/placeholder, name, category, address/location context, Detail/direction affordance, and conditional WhatsApp action. Optional contact absence removes the action cleanly; no disabled fake action is shown.

## 28. Agenda Card

Agenda card uses optional media, explicit status badge, title, date, location, and Detail affordance. Only Akan Datang, Berlangsung, dan Selesai are agenda lifecycle labels. Operational Soft Deleted state remains separate and is never styled/labeled as Selesai.

## 29. Pengumuman Card

Aktif and Arsip receive distinct but readable visual contexts. Arsip may use lower emphasis without becoming faded or inaccessible. Arsip is expiry-derived, not deleted state. Soft Deleted records do not appear publicly and are never styled/labeled as Arsip.

## 30. Homepage Visual Application

`homepage-exploratory-mockup.png` is a visual application reference for `UX-SCR-001` only. It informs Warm Natural atmosphere, imagery balance, card density, responsive visual character, and CTA hierarchy. Wireframe v1.0 remains the normative layout source; exploratory composition, labels, data, navigation, colors outside the canonical palette, and unsupported controls are not automatically retained.

## 31. Homepage Mockup Audit

| Mockup Element | Frozen Source Compatibility | Treatment |
| --- | --- | --- |
| Warm green/cream atmosphere | Compatible with approved Warm Natural direction. | KEEP — remap strictly to canonical palette. |
| Lora/Inter appearance | Compatible with approved typography direction. | KEEP — apply semantic scale from this specification. |
| Village imagery | Direction compatible; displayed imagery is not verified Desa Bendung evidence. | REFINE — replace with permitted verified imagery or explicit placeholder. |
| Card treatment and density | Compatible as visual inspiration, not exact component contract. | REFINE — follow each frozen resource structure. |
| Public navigation | Only compatible where route/order matches Sitemap/Wireframe. | REFINE — frozen navigation hierarchy wins. |
| CTA hierarchy | Compatible only for authorized actions and data prerequisites. | REFINE — retain action labels/availability from behavior source. |
| Exploratory Header CTA | Public Header contract contains identity + menu/navigation, not a mandatory CTA. | REMOVE / DO NOT STANDARDIZE unless a frozen screen contract places the action in Header. |
| Homepage sections | Exact order/content remains governed by `UX-SCR-001`. | REFINE — do not promote extra section. |
| Quick-navigation category colors | Multiple exploratory hues are outside canonical palette. | REMOVE / DO NOT STANDARDIZE — use canonical palette plus text/icon cues. |
| Mobile bottom navigation | Not automatically part of frozen layout contract. | REMOVE / DO NOT STANDARDIZE unless explicitly present in Wireframe. |
| “Dusun Sumberagung”, locality, names, contacts, dates, and other sample facts | Not verified Portal Informasi Desa Bendung data. | REMOVE / DO NOT STANDARDIZE; never publish as fact. |
| Price/product/cart-like visual | Contradicts UMKM directory + WhatsApp behavior. | REMOVE / DO NOT STANDARDIZE. |
| Unsupported report action, commerce, or other affordance | No visual example may create a new feature. | REMOVE / DO NOT STANDARDIZE unless a frozen source explicitly authorizes it. |
| Botanical accents | Compatible when decorative and restrained. | KEEP — never treat as control or identity replacement. |

**Audit result:** PASS — useful visual character retained; unsupported layout, data, palette, and behavior excluded.

Warm Natural character is approved. Exact components, actions, labels, data, and layout placement from the exploratory mockup are not automatically approved; Wireframe v1.0 remains layout authority.

## 32. Dashboard Visual Language

Dashboard uses the same Warm Natural family with greater utility density: Cream/light background, restrained Moss Green navigation, Dark Olive text, simple cards/tables, clear form hierarchy, Sage supporting separation, Terracotta accent only where appropriate, and subtle shadow. Decoration is reduced; efficiency and readability lead.

## 33. Dashboard Sidebar

Desktop sidebar remains expanded by default and collapsible; mobile remains an openable panel. It has clear separation, obvious selected item, visible role/context, and a restrained Moss/Dark Olive/Cream relationship without becoming excessively dark. Six Admin Dusun areas and ten Super Admin areas remain unchanged.

## 34. Management Table

Desktop tables use readable Inter text, restrained 1px dividers, clear headers, explicit status text, predictable row action hierarchy, and adequate whitespace. Mobile uses stacked management cards/rows defined by Wireframe v1.0. Excessive cell borders, decorative striping, and icon-only critical actions are avoided.

## 35. Form System

| Element | Visual treatment |
| --- | --- |
| Label | Inter; visible above/adjacent according to wireframe; not placeholder-only. |
| Required | Explicit indicator plus instruction/context; not color-only. |
| Optional | Clear optional text where ambiguity is possible. |
| Helper | Body Small/Caption; visually subordinate but readable. |
| Input/Textarea/Select | Cream surface, 1px border, 12px radius, familiar affordance. |
| Date/Password | Same family with explicit label and relevant control cue. |
| Validation | 2px emphasis where useful plus icon/text/message. |
| Read-only context | Supporting surface and read-only wording; no dropdown/edit affordance. |
| Coordinate input | Paired structure, clear labels, map/context relationship retained. |
| Upload | Select/preview/replace/remove states follow source permission and optionality. |

Inter is primary form typography. Specification does not add or remove a field.

## 36. Input States

| State | Visual requirement |
| --- | --- |
| Default | Clear boundary, label, and value affordance. |
| Hover | Restrained border/surface emphasis where pointer exists. |
| Focus | Visible 2px–3px Moss Green/Dark Olive boundary with adequate separation plus browser/assistive semantics; not shadow-only. |
| Filled | Value remains prominent; label does not disappear. |
| Error | Dark Olive readable message plus Terracotta border/accent/icon, explicit wording, and 2px emphasis where appropriate; no low-contrast Terracotta-only small text. |
| Disabled | Visibly unavailable and semantically disabled; label remains readable. |
| Read-only | Looks informational rather than selectable/editable. |

## 37. Admin Fixed Context

Admin Dusun sees Role `Admin Dusun` and fixed `OWN_DUSUN` context as readable contextual information. Fixed context uses supporting surface/read-only styling and never a select chevron, dropdown affordance, or editable-field appearance.

## 38. Agenda/Pengumuman Scope

Admin Dusun scope/Dusun remains implicit or read-only context; no selector is introduced. Super Admin scope controls are visually clear, with conditional Dusun selector only when the frozen behavior requires it. Agenda Status/Record Status and Announcement Lifecycle/Record Status remain visibly separate filter axes.

## 39. Map Visual System

Leaflet remains an external map canvas. Warm Natural applies to filter controls, map container, loading/error state, popup, and surrounding UI. Custom tile recoloring is not required. Production tile provider remains an external technical decision and is not resolved here.

## 40. Map Filters

Filters use clear Inter labels, compact but touch-friendly controls, visible selected state, and placement before/outside the map on mobile as frozen.

| Context | Visual controls |
| --- | --- |
| Peta Desa | Dusun + category. |
| Peta Dusun | Category only; no Dusun selector. |
| Data/Peta Admin | Dusun + category; map-centric. |

Data/Peta has no Soft Deleted filter, Active/Nonaktif record selector, Restore, or Hard Delete action.

## 41. Map Marker / Popup

Marker shape/icon/color may help category recognition only when text, icon shape, popup label, or legend supplies a non-color cue. Popup follows frozen content: name, category, optional image, optional/applicable address, detail/context link, and directions where eligible. Kontak Pelayanan does not receive a service Detail page.

## 42. Empty State

Warm Natural empty states are calm, friendly, non-alarming, and concise. A minimal botanical/simple placeholder may appear without impersonating data.

- Public: `Belum ada data` or behavior-source equivalent.
- Admin: `Belum ada data` plus Create action only if authorized.
- Filtered empty: identifies filter context and safe reset path if source behavior provides one.

No fake record fills an empty state.

## 43. Loading State

Loading is subtle, minimal, and non-distracting. Button loading, form saving, upload, and map loading retain context and prevent duplicate action. Skeleton is optional, not mandatory for every component, and never presents fabricated content as loaded data.

## 44. Error State

Errors use Dark Olive message text for readability; Terracotta border/accent/icon; explicit wording; and 2px state emphasis where appropriate. Focus moves or links to the affected field according to frozen UX. Terracotta small text alone on Cream is not the only error cue. No new error color is introduced. Warm Natural calmness does not weaken severity. Technical stack details, raw exception text, and sensitive data are not exposed.

## 45. Success Feedback

Success feedback is restrained and uses safe, behavior-neutral wording. Moss Green and/or Sage may support the state with readable pairing; high emphasis may use Moss Green surface + Cream text. Text and/or icon/context always accompanies color. Copy does not claim “Berhasil dipublikasikan” when the source only guarantees save/update.

## 46. Confirmation Dialog

| Risk level | Visual hierarchy |
| --- | --- |
| Standard | Clear target, consequence, Cancel and confirm. |
| Medium-risk | Stronger consequence text and explicit action label. |
| High-risk destructive | Cream/Warm Beige surface, Dark Olive readable text, Terracotta accent/border/icon, explicit wording, stronger border, spacing hierarchy, target identity, consequence, and separation from normal Save. |

The shell may remain calm, but Hard Delete never looks equivalent to Save. High-risk meaning comes from combined wording, icon, border, spacing, target identity, dialog hierarchy, and Terracotta accent—not hue alone. No red/alert-red palette is introduced. Dialog styling does not authorize an action absent from Roles/Permissions.

## 47. Soft Delete Visual

Admin Dusun normal lists do not show Soft Deleted rows. Super Admin can locate Soft Deleted rows through Record Status filter only in the applicable source management screen. Rows use explicit Soft Deleted/approved wording plus optional border/surface distinction. Soft Deleted is never labeled Arsip or Selesai, and Data/Peta never becomes its browser.

## 48. Admin Account Visual State

| Account state | Visual treatment | Actions |
| --- | --- | --- |
| ACTIVE | Normal management row/card with clear current Dusun and state. | Manage/assign, reset password, logical removal only as permitted. |
| LOGICALLY_REMOVED | Retained read-only historical identity with subdued but readable surface and explicit Removed/Read Only text. | None: no restore, reactivate, reassign, reset, remove-again, username reuse, or merge. |

Removed account styling must not look interactive. Username remains visibly reserved where relevant.

## 49. Responsive Visual Rules

### Mobile

- Single-column emphasis and comfortable card spacing.
- Touch-friendly visible actions and compact type hierarchy.
- Mobile navigation panel and stacked management rows.
- Filters precede map/list as defined by wireframe.
- Decorative motif and large imagery reduce before content legibility.

### Desktop

- Bounded readable content, expanded/collapsible dashboard sidebar.
- Grids/tables and larger imagery where source layout allows.
- Clear section whitespace using approved rhythm.
- Actions remain near their conceptual owner.

No product requirement depends on an exact breakpoint. Any exact breakpoint later documented is an implementation recommendation and must preserve Mobile/Desktop contracts.

## 50. Public vs Admin Consistency

| Area | Expression | Shared foundation |
| --- | --- | --- |
| Public | Warmer, more imagery, more editorial Lora headings, moderate card density. | Canonical palette, Inter UI, spacing, border/radius/shadow, accessible states. |
| Admin | Cleaner, more compact, more Inter, less decoration, utility-first tables/forms. | Same canonical palette, type family, controls, feedback, and lifecycle clarity. |

Both areas must clearly belong to Portal Informasi Desa Bendung without making dashboard decoration compete with work tasks.

## 51. Visual Component Inventory

| Component | Visual Role | Typography | Surface | State Notes |
| --- | --- | --- | --- | --- |
| `UI-CMP-001` Site Header | Public/auth identity shell | Lora identity where appropriate; Inter nav | Cream, subtle 1px separation | Mobile panel/desktop nav; no mandatory or mockup-derived Header CTA. |
| `UI-CMP-002` Primary Navigation | Public route access | Inter Semibold | Cream; Moss selected cue | Focus/selected textual; no mega menu. |
| `UI-CMP-003` Hero/Identity Block | Desa/Dusun visual identity | Lora H1/Display; Inter support | Cream/Warm Beige with optional image | Readable without image; verified imagery only. |
| `UI-CMP-004` Dusun Card | ACTIVE Dusun selection | Lora/Inter hierarchy | Cream, 16px radius, Low shadow | Only eligible Dusun; full label/link cue. |
| `UI-CMP-005` Quick Navigation | Section-anchor scanning | Inter Label | Cream/supporting band | Horizontal-scroll mobile; selected/focus visible. |
| `UI-CMP-006` Content Section | Public grouping | Lora H2/H3; Inter body | Background/surface by hierarchy | Empty content remains intentional. |
| `UI-CMP-007` Resource Card/List Item | Public/admin record summary | Lora selectively public; Inter admin | Cream, subtle border, 12–16px radius | Resource-specific layout and lifecycle text. |
| `UI-CMP-008` Detail Header | Detail identity/context | Lora H1/H2; Inter metadata | Cream/Warm Beige | Back/context/status visible; four Detail types only. |
| `UI-CMP-009` Status Badge | Lifecycle/state cue | Inter Semibold/Label | Canonical light surface/border | Text + non-color cue; axes never merged. |
| `UI-CMP-010` Empty State | Absence/filter-empty feedback | Lora optional heading; Inter body | Calm Cream/Warm Beige | No fake data; authorized CTA only. |
| `UI-CMP-011` Map Canvas | Location visualization | Inter surrounding UI | 16px container; map provider canvas | Loading/error/fallback; no required tile recolor. |
| `UI-CMP-012` Map Filter | Map query control | Inter Label/Body | Cream controls, 12px radius | Desa/Dusun/category rules remain exact. |
| `UI-CMP-013` Marker Popup | Location summary/action | Inter; Lora small title if useful | Cream, 12px radius, Medium shadow | Optional fields collapse; non-color category cue. |
| `UI-CMP-014` External CTA | WhatsApp/directions exit | Inter Semibold | Primary/secondary button shell | Only with valid source/publication prerequisite. |
| `UI-CMP-015` Media/Placeholder | Optional visual context | Caption for attribution/state | 12–24px image container | Verified/permitted image or explicit placeholder. |
| `UI-CMP-016` Archive Link/List | Expired announcement context | Inter link/list; Lora section title | Cream/supporting surface | Arsip remains readable and not Soft Deleted. |
| `UI-CMP-017` Site Footer | Supporting navigation/identity | Inter Body Small | Dark Olive or Cream high-contrast surface | Links textual, focus visible, no invented data. |
| `UI-CMP-018` Login Form | Authentication entry | Inter throughout | Cream card, 16px radius, Low shadow | Username/password only; clear error/loading. |
| `UI-CMP-019` Dashboard Shell | Admin workspace frame | Inter dominant; Lora page title optional | Cream/light background | OWN_DUSUN/GLOBAL context remains clear. |
| `UI-CMP-020` Dashboard Navigation | Role-sensitive area access | Inter Semibold | Restrained Moss/Cream sidebar | Selected, collapsed, panel states; 6/10 areas unchanged. |
| `UI-CMP-021` Context Header | Role/scope orientation | Inter; Lora title optional | Warm Beige/Cream supporting band | Fixed context never looks selectable. |
| `UI-CMP-022` Management List/Table | Desktop record management | Inter labels/body | Cream rows, 1px dividers | Separate status columns/axes and explicit actions. |
| `UI-CMP-023` Mobile Management Row | Mobile record management | Inter labels/body | Cream card, 12px radius | Stacked equivalent; action ownership retained. |
| `UI-CMP-024` Resource Form | CRUD data entry shell | Inter | Cream surface; grouped fields | Required/optional/conditional rules preserved. |
| `UI-CMP-025` Field Error/Summary | Validation orientation | Inter Body Small/Label | Cream; Terracotta accent/border with 2px emphasis | Dark Olive message, icon/text, focus target; no low-contrast Terracotta-only text. |
| `UI-CMP-026` Confirmation Dialog | Consequence acknowledgement | Lora optional title; Inter body/actions | Cream/Warm Beige, 16px radius, Medium/High elevation | Dark Olive text, Terracotta accent, risk hierarchy, and target explicit. |
| `UI-CMP-027` Feedback Banner/Toast | Safe action feedback | Inter | Warm Beige informational or Moss/Sage success treatment | Readable text + icon/context; outcome-neutral copy. |
| `UI-CMP-028` Loading/Submit State | Progress and duplicate prevention | Inter | Parent component surface | Context retained; subtle indicator; no fabricated result. |
| `UI-CMP-029` Coordinate Picker | Coordinate + map input | Inter labels/values | Cream form group and map boundary | Pair validation and read/write context clear. |
| `UI-CMP-030` Media Upload | Media selection lifecycle | Inter labels/helper | Cream bordered upload group | Optionality, preview, replace/remove, error states. |
| `UI-CMP-031` Scope/Dusun Filter | Super Admin resource scope | Inter Label/Body | Cream controls | Conditional Dusun; not a Data/Peta status browser. |
| `UI-CMP-032` Account Management Row | Admin identity management | Inter | Cream active; supporting read-only removed surface | ACTIVE actions; LOGICALLY_REMOVED has no mutation. |

**Visual component coverage:** 32/32.

This inventory defines visual treatment only, not implementation component architecture.

## 52. Form Coverage

| Form | Visual application | Required/optional and state boundary |
| --- | --- | --- |
| `UX-FORM-001` Login | Compact Inter form, Cream card, visible focus/error/loading. | Username/password only. |
| `UX-FORM-002` Identitas Desa | Group identity, contact, and optional media with clear hierarchy. | Existing required identity/contact and optional email/media retained. |
| `UX-FORM-003` Profil Dusun | Readable profile groups; status separate from editable fields. | Own fields preserved; no Admin status toggle. |
| `UX-FORM-004` Kontak Pelayanan | Contact/photo/address/coordinate grouping. | Optional photo/address/coordinate pair; no redundant status field. |
| `UX-FORM-005` UMKM | Identity, media, contact, and location grouping. | Optional main media/coordinates retained. |
| `UX-FORM-006` Produk UMKM | Repeatable compact rows with clear action ownership. | No price/cart/commerce field or action. |
| `UX-FORM-007` Fasilitas | Identity/category/contact plus coordinate group. | Required coordinates and optional photo/WhatsApp retained. |
| `UX-FORM-008` Kategori Fasilitas | Simple Inter label/input action hierarchy. | Super Admin only; no new field. |
| `UX-FORM-009` Agenda/Kegiatan | Detail, date/time, lifecycle override, and media groups. | Admin scope implicit; Super conditional; optional values retained. |
| `UX-FORM-010` Pengumuman | Scope, title, expiry, and content groups. | No archive control; archive stays expiry-derived. |
| `UX-FORM-011` Admin Dusun Account | Username/password/assignment with fixed role context. | Role fixed `ADMIN_DUSUN`; no role selector/Super Admin creation. |
| `UX-FORM-012` Reset Password | Focused dialog/form with account target visible. | ACTIVE account only; no self-service flow. |
| `UX-FORM-013` Dusun Status Action | Consequence-first confirmation treatment. | Super Admin only; no add/delete Dusun. |

**Form visual coverage:** 13/13. No new form or form field is introduced.

## 53. Screen Visual Coverage

| Screen | Visual Pattern | Key Tokens/Components | Special Notes |
| --- | --- | --- | --- |
| `UX-SCR-001` Homepage Desa Bendung | Editorial Warm Natural landing | Header, hero, sections, cards, map, footer | Mockup exploratory; frozen section order wins. |
| `UX-SCR-002` Halaman Dusun | Dusun identity + quick navigation + resources | Hero, Quick Navigation, cards, map | Only ACTIVE public data; no fifth Detail. |
| `UX-SCR-003` Arsip Pengumuman | Readable archive list | Archive list, badges, empty state | Arsip is expiry-derived, not Soft Deleted. |
| `UX-SCR-004` Detail UMKM | Editorial resource Detail | Detail Header, media, External CTA | Directory + WhatsApp; no commerce. |
| `UX-SCR-005` Detail Fasilitas/Lokasi | Location Detail | Detail Header, media, map, directions | Optional WhatsApp; location semantics retained. |
| `UX-SCR-006` Detail Agenda/Kegiatan | Event Detail | Detail Header, media, agenda badge | Three agenda states only. |
| `UX-SCR-007` Detail Pengumuman | Announcement Detail | Detail Header, Archive context | Aktif/Arsip distinct; no deleted context. |
| `UX-SCR-008` Peta Desa Context | Public map-centric | Map, Dusun/category filters, popup | Filters before map mobile. |
| `UX-SCR-009` Peta Dusun Context | Dusun map-centric | Map, category filter, popup | No Dusun selector. |
| `UX-SCR-010` Login Admin | Focused authentication | Compact Header, Login Form, feedback | Username/password only. |
| `UX-SCR-011` Dashboard Dusun | Admin Dusun overview | Dashboard Shell/Nav, Context Header, cards | Fixed OWN_DUSUN; 6 areas. |
| `UX-SCR-012` Admin Dusun / Kelola Profil Dusun | Utility form | Resource Form, Media Upload, feedback | Own fields editable; no status selector. |
| `UX-SCR-013` Admin Dusun / Kelola Kontak Pelayanan | Utility list/form | Rows, contact form, Coordinate Picker | Normal list excludes Soft Deleted. |
| `UX-SCR-014` Admin Dusun / Kelola UMKM | Utility list/form + product rows | Rows, two forms, upload | Directory behavior; no commerce UI. |
| `UX-SCR-015` Admin Dusun / Kelola Fasilitas | Utility list/form | Rows, form, Coordinate Picker | Required coordinates; no restore. |
| `UX-SCR-016` Admin Dusun / Kelola Agenda & Kegiatan | Utility list/form | Rows, Agenda form, badges | Scope implicit; lifecycle axes distinct. |
| `UX-SCR-017` Admin Dusun / Kelola Pengumuman | Utility list/form | Rows, Announcement form | Archive derived; no Soft Deleted browse. |
| `UX-SCR-018` Super Admin Dashboard | Global overview | Dashboard Shell/Nav, Context Header, filters | GLOBAL context; 10 areas. |
| `UX-SCR-019` Super Admin / Kelola Identitas dan Profil Desa | Global identity form | Resource Form, Media Upload | No page builder or invented data. |
| `UX-SCR-020` Super Admin / Kelola Dusun | Dusun lifecycle management | Table/cards, badge, dialog | No Add/Delete Dusun. |
| `UX-SCR-021` Super Admin / Kelola Kontak Pelayanan | Global resource management | Scope/filter, table/cards, form | Record Status filter and restore here. |
| `UX-SCR-022` Super Admin / Kelola UMKM | Global resource management | Scope/filter, table/cards, forms | Record Status separate; no commerce. |
| `UX-SCR-023` Super Admin / Kelola Fasilitas | Global resource management | Scope/filter, table/cards, form | Record Status and coordinates clear. |
| `UX-SCR-024` Super Admin / Kelola Kategori Fasilitas | Category utility management | Table/cards, form, dialog | No universal map category system. |
| `UX-SCR-025` Super Admin / Kelola Agenda & Kegiatan | Dual-axis management | Agenda Status + Record Status | `Selesai` is not Soft Deleted. |
| `UX-SCR-026` Super Admin / Kelola Pengumuman | Dual-axis management | Announcement Lifecycle + Record Status | `Arsip` is not Soft Deleted. |
| `UX-SCR-027` Super Admin / Kelola Data dan Peta | Map-centric inspection | Map, Dusun/category filters, popup | No Soft Delete browser/restore/delete/CRUD. |
| `UX-SCR-028` Super Admin / Kelola Admin Dusun | Identity management | Account rows, forms, dialog | Removed read-only; role fixed. |

**Screen visual coverage:** 28/28. Mobile and Desktop layout contracts remain 28/28 each; no high-fidelity screen is produced by this document.

## 54. Public Screen Visual Coverage

Homepage, Halaman Dusun, Arsip Pengumuman, four Detail types, Peta Desa, and Peta Dusun are covered: **9/9 public screens**. Kontak Pelayanan has no fifth Detail. Peta Dusun has category filter only.

## 55. Admin Screen Visual Coverage

Authentication (`UX-SCR-010`), seven Admin Dusun contexts (`UX-SCR-011–017`), and eleven Super Admin contexts (`UX-SCR-018–028`) are covered: **19/19 authentication/admin screens**. No dashboard area, permission, selector, restore path, or account mutation is added.

## 56. Accessibility Visual Direction

- Use measured readable foreground/background pairings and validate actual components.
- Keep visible keyboard focus on links, buttons, inputs, map controls, dialogs, and navigation.
- Distinguish links/actions through wording, underline/border/icon/context, not color alone.
- Distinguish button variants and destructive hierarchy beyond fill color.
- Present errors with text/message/icon associated with their target.
- Present every lifecycle/status with textual wording and non-color cue.
- Keep controls and touch targets visibly usable without tiny labels.
- Preserve semantic heading hierarchy and readable line length.
- Ensure imagery and decoration never obscure text or focus.

This is visual direction, not an accessibility or WCAG certification claim. Final rendered interfaces require measurement and interaction testing.

## 57. Content Density

Public cards use moderate density with clear breathing room, scannable metadata, and imagery only when useful. Admin surfaces are efficient but not cramped, with compact Inter hierarchy and predictable grouping. Tiny text, excessive decorative whitespace, and decoration that delays task completion are avoided.

## 58. Visual Design Tokens Summary

| Category | Canonical tokens/direction |
| --- | --- |
| Color | Moss Green `#2E5E3E`; Sage Green `#7A8F6B`; Terracotta `#C46A3A`; Warm Beige `#F1E7D3`; Cream `#FAF7F2`; Dark Olive `#2B2F23`. |
| Type | Lora Semibold heading; Lora Medium subheading; Inter Regular body/UI; Inter Semibold action. |
| Type scale | Display 40–48; H1 32–40; H2 24–32; H3 20–24; body/label/action 14–16px. |
| Spacing | 8px base; XS 8, SM 16, MD 24, LG 32, XL 64px. |
| Border | 1px default, 2px state emphasis, 3px limited high emphasis. |
| Radius | 8px compact, 12px inputs/small cards, 16px cards/dialogs, 24px large containers. |
| Shadow | Low, Medium, High; soft, natural, subtle. |
| Icon | One simple rounded outline family with consistent stroke and labels. |
| Imagery | Authentic/permitted Desa Bendung imagery or explicit placeholder; warm and natural. |

These are specification tokens, not CSS variables or implementation code.

## 59. Visual Design Decision Log

| ID | Decision | Status | Boundary |
| --- | --- | --- | --- |
| `VD-DEC-001` | Warm Natural is selected as MVP visual direction. | RESOLVED AND FROZEN FOR MVP — HUMAN/PROJECT TEAM APPROVAL | Resolves prior official deferred ID; specification is now v1.0. |
| `VD-DEC-002` | Six-color canonical palette is approved. | APPROVED AND FROZEN FOR MVP | No alternate palette/moodboard-only hue. |
| `VD-DEC-003` | Lora heading and Inter body/UI are approved. | APPROVED AND FROZEN FOR MVP | No second typography proposal. |
| `VD-DEC-004` | Spacing uses 8px base and 8/16/24/32/64 scale. | APPROVED AND FROZEN FOR MVP | Wireframe grouping/order unchanged. |
| `VD-DEC-005` | Border uses restrained 1/2/3px hierarchy. | APPROVED AND FROZEN FOR MVP | No heavy-border aesthetic. |
| `VD-DEC-006` | Radius scale is 8/12/16/24px. | APPROVED AND FROZEN FOR MVP | Not every element is pill-shaped. |
| `VD-DEC-007` | Elevation uses Low/Medium/High soft natural shadows. | APPROVED AND FROZEN FOR MVP | Exact implementation remains downstream. |
| `VD-DEC-008` | Iconography is friendly, rounded, simple, and coherent. | APPROVED AND FROZEN FOR MVP | Exact library is downstream. |
| `VD-DEC-009` | Public/admin share one family with editorial/utility emphasis. | APPROVED AND FROZEN FOR MVP | Behavior remains identical. |

**Visual Design Decisions:** 9. No decision creates new product behavior.

## 60. Resolve Prior Visual Deferred Decision

Prior official `VD-DEC-001` deferred exact visual direction. Human/project-team decision now resolves it:

- **Resolution:** Warm Natural is selected for MVP.
- **Status:** RESOLVED AND FROZEN FOR MVP — HUMAN/PROJECT TEAM APPROVAL.
- **Effect:** Warm Natural board is normative within source-conflict rules.
- **Freeze effect:** Visual Design Specification v1.0 and Warm Natural visual system are FROZEN FOR MVP.
- **Non-effect:** The exploratory Homepage mockup remains non-frozen and does not become the final Homepage screen.

## 61. Visual Design Open Questions

Approved board plus frozen UI/UX, Wireframe, and SRS provide sufficient information. Exact icon library, font delivery, tile provider, breakpoint implementation, and rendered contrast verification are downstream implementation/qualification details, not unresolved Visual Design decisions.

**Visual Design Open Questions:** 0.  
**Blocking Visual Design Questions:** 0.

Warm Natural selection is resolved and is not reopened.

## 62. Existing Homepage Mockup Status

`homepage-exploratory-mockup.png` remains **EXPLORATORY HIGH-FIDELITY REFERENCE — UX-SCR-001 ONLY**. It is not FROZEN, does not replace the low-fidelity wireframe, does not directly apply to `UX-SCR-002–028`, and is not automatically approved as the final Homepage.

## 63. Future Exclusion

No visuals, components, navigation, or states are created for:

- add Dusun;
- Dusun-specific QR;
- UMKM multi-photo gallery;
- map search;
- Dusun polygons;
- small QR boards.

## 64. Source-Conflict Rule

If the Warm Natural board or Homepage mockup implies unsupported behavior/content, frozen sources win. Sumberagung identity, sample people/contacts/dates, imagery, product price, cart, and commerce affordances are examples only—not Portal Informasi Desa Bendung facts or features.

UMKM remains directory + WhatsApp. Price UI, cart, basket, purchase, checkout, stock, transaction, and marketplace affordances are excluded. Visual examples cannot create real Desa data, feature, page, Detail, role, permission, lifecycle, or navigation item.

## 65. Change Request Summary

| Change Request category | Count |
| --- | ---: |
| Baseline Change Request | 0 |
| PRD Change Request | 0 |
| Sitemap Change Request | 0 |
| User Flow Change Request | 0 |
| Roles/Permissions Change Request | 0 |
| ERD Change Request | 0 |
| Technical Baseline Change Request | 0 |
| Physical Schema Change Request | 0 |
| SRS Change Request | 0 |
| UI/UX Specification Change Request | 0 |
| Wireframe Specification Change Request | 0 |
| **Seluruh Change Request** | **0** |

Visual formalization is compatible with all frozen sources and modifies no upstream behavior.

## 66. Review Checklist

- [x] CHK-001 — All FROZEN sources read.
- [x] CHK-002 — Wireframe v1.0 preserved.
- [x] CHK-003 — UI/UX v1.0 preserved.
- [x] CHK-004 — Warm Natural human approval recorded.
- [x] CHK-005 — No alternative visual direction introduced.
- [x] CHK-006 — Moss Green `#2E5E3E` preserved.
- [x] CHK-007 — Sage Green `#7A8F6B` preserved.
- [x] CHK-008 — Terracotta `#C46A3A` preserved.
- [x] CHK-009 — Warm Beige `#F1E7D3` preserved.
- [x] CHK-010 — Cream `#FAF7F2` preserved.
- [x] CHK-011 — Dark Olive `#2B2F23` preserved.
- [x] CHK-012 — Lora heading direction preserved.
- [x] CHK-013 — Inter body/UI direction preserved.
- [x] CHK-014 — 8px spacing rhythm formalized.
- [x] CHK-015 — Border system formalized.
- [x] CHK-016 — Radius 8/12/16/24 formalized.
- [x] CHK-017 — Soft shadow hierarchy formalized.
- [x] CHK-018 — Iconography direction formalized.
- [x] CHK-019 — Imagery direction formalized.
- [x] CHK-020 — Botanical motif remains decorative only.
- [x] CHK-021 — Public design specified.
- [x] CHK-022 — Admin design specified.
- [x] CHK-023 — Buttons specified.
- [x] CHK-024 — Forms specified.
- [x] CHK-025 — Tables/lists specified.
- [x] CHK-026 — Cards specified.
- [x] CHK-027 — Map UI specified.
- [x] CHK-028 — Empty/loading/error/success specified.
- [x] CHK-029 — Destructive UI specified.
- [x] CHK-030 — Soft Delete is not confused with Archive.
- [x] CHK-031 — Logically Removed account remains read-only.
- [x] CHK-032 — 32/32 components visually covered.
- [x] CHK-033 — 13/13 forms visually covered.
- [x] CHK-034 — 28/28 screens visually assessed.
- [x] CHK-035 — Homepage exploratory mockup audited.
- [x] CHK-036 — No unsupported marketplace elements adopted.
- [x] CHK-037 — No new feature.
- [x] CHK-038 — No new page.
- [x] CHK-039 — No CSS.
- [x] CHK-040 — No Blade/JavaScript implementation.
- [x] CHK-041 — Visual Design Specification passed formal human review.
- [x] CHK-042 — Source precedence explicitly normalized.
- [x] CHK-043 — Public Header does not gain unsupported CTA.
- [x] CHK-044 — Primary CTA style remains Moss Green + Cream where applicable.
- [x] CHK-045 — Destructive state uses canonical palette only.
- [x] CHK-046 — Error state does not rely on low-contrast Terracotta text.
- [x] CHK-047 — Success state remains readable and non-color-only.
- [x] CHK-048 — Warm Beige informational treatment remains readable.
- [x] CHK-049 — Sage border is contextual, not mandatory on every surface.
- [x] CHK-050 — Stronger canonical border is allowed where contrast requires.
- [x] CHK-051 — No seventh canonical color introduced.
- [x] CHK-052 — Homepage exploratory CTA/layout does not override Wireframe.
- [x] CHK-053 — Marketplace elements remain excluded.
- [x] CHK-054 — Nine VD Decisions are approved/frozen.
- [x] CHK-055 — 28/28 screen coverage retained.
- [x] CHK-056 — 32/32 component coverage retained.
- [x] CHK-057 — 13/13 form coverage retained.
- [x] CHK-058 — Visual Design Specification v1.0 is ready as high-fidelity source.

**Checklist result:** 58/58 PASS.

## 67. Final Validation

| No. | Validation | Result |
| ---: | --- | --- |
| 1 | Version | PASS — 1.0 |
| 2 | Status | PASS — FROZEN FOR MVP |
| 3 | Visual Direction | PASS — Warm Natural |
| 4 | Visual Direction Status | PASS — APPROVED AND FROZEN FOR MVP |
| 5 | Exact canonical palette | PASS — 6/6 retained |
| 6 | Additional canonical color | PASS — none |
| 7 | Typography | PASS — Lora + Inter |
| 8 | Spacing base | PASS — 8px |
| 9 | Border scale | PASS — 1/2/3px |
| 10 | Radius | PASS — 8/12/16/24px |
| 11 | Shadow | PASS — Low/Medium/High, soft natural |
| 12 | Visual Design Decisions | PASS — 9, approved/frozen |
| 13 | Visual Design Open Questions | PASS — 0 |
| 14 | Blocking Visual Design Questions | PASS — 0 |
| 15 | Visual components | PASS — 32/32 |
| 16 | Forms | PASS — 13/13 |
| 17 | Screens | PASS — 28/28 |
| 18 | Unsupported Header CTA | PASS — absent |
| 19 | Primary CTA style | PASS — Moss Green + Cream where authorized |
| 20 | Destructive/error palette | PASS — canonical palette only |
| 21 | Unsafe Terracotta small text | PASS — prohibited as sole cue |
| 22 | Focus distinction | PASS — visible canonical 2px/3px boundary |
| 23 | Wireframe | PASS — unchanged |
| 24 | UI/UX behavior | PASS — unchanged |
| 25 | Homepage mockup | PASS — exploratory only |
| 26 | Sumberagung/sample facts adopted | PASS — none |
| 27 | UMKM | PASS — directory + WhatsApp |
| 28 | Price/cart/checkout | PASS — absent |
| 29 | Peta Dusun Dusun selector | PASS — absent |
| 30 | Data/Peta | PASS — map-centric |
| 31 | Soft Delete versus Arsip | PASS — separate |
| 32 | Agenda lifecycle versus Soft Delete | PASS — separate |
| 33 | Removed account | PASS — retained read-only identity |
| 34 | All 11 Change Request categories | PASS — 0 |
| 35 | Figma | PASS — none created |
| 36 | New mockup | PASS — none created |
| 37 | CSS | PASS — none created |
| 38 | Blade/JavaScript | PASS — none created |
| 39 | Implementation code | PASS — none created |

**Final validation result:** 39/39 PASS.

**Document metrics:** 28/28 screens, 32/32 conceptual UI components, 13/13 forms, 9 approved/frozen Visual Design Decisions, 0 Visual Design Open Questions, 0 Blocking Visual Design Questions, 11 Change Request categories at 0, and 58/58 checklist items.

**Conclusion:** Visual Design Specification v1.0 and Warm Natural visual system have passed formal human review and are **FROZEN FOR MVP**. The specification is ready as the normative source for high-fidelity mockup production and consistent Warm Natural application across `UX-SCR-001–028`. The existing Homepage mockup remains exploratory and is not automatically final or frozen.
