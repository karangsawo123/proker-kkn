# Pre-Production Readiness & Operational Decision Register

| Attribute | Value |
| :--- | :--- |
| **Project** | Portal Informasi Desa Bendung |
| **Document** | Pre-Production Readiness & Operational Decision Register |
| **Version** | 1.0 |
| **Status** | Active Operational Document |
| **Authority** | Non-frozen operational register; does not alter frozen specifications |
| **Gate Target** | PREPROD-01 — Production Decisions & Ownership |

---

## 1. Executive Summary

This document captures and tracks all **14 unresolved operational, administrative, and infrastructure decisions** required to transition **Portal Informasi Desa Bendung** from a **Local Qualified MVP** to **Live Production Deployment**.

All items in this register are human/stakeholder decisions and must **NOT** be assumed or silently finalized by automated tools.

---

## 2. Pre-Production Operational Decision Matrix

| No. | Decision Area | Status | Owner | Decision / Current Specification | Evidence & Technical Context | Blocking Production? |
| :---: | :--- | :---: | :--- | :--- | :--- | :---: |
| **1** | **Candidate cPanel Hosting / Package** | `OPEN` | Tim KKN / Perangkat Desa | Selection of shared hosting package supporting PHP 8.3+, MariaDB 10.4+, and custom document root (`public/`). | Evaluated in `TC-ENV-003`; requires real hosting server for staging deployment. | **YES** |
| **2** | **Production Domain & DNS** | `OPEN` | Perangkat Desa Bendung | Acquisition of official domain (e.g. `desabendung.id` or `desa-bendung.gunungkidulkab.go.id`). | Required for HTTPS SSL issuance and QR destination URL encoding. | **YES** |
| **3** | **Production Map Tile Provider** | `OPEN` | Tim KKN / Tim Teknis | Selection of production tile provider (OpenStreetMap standard, Mapbox, Stadia Maps, etc.) and SLA/usage agreement. | Evaluated in `TC-ENV-007`; development currently uses standard OSM CDN. | **YES** |
| **4** | **Hosting & Domain Account Ownership** | `OPEN` | Kepala Desa / Sekretaris Desa | Formal assignment of organizational email and legal entity as account owner of hosting and domain. | Prevents loss of domain/server ownership post-KKN period. | **YES** |
| **5** | **Billing Contact & Renewal Lifecycle** | `OPEN` | Bendahara Desa Bendung | Designation of annual billing contact and fund allocation for domain/hosting renewal. | Guarantees operational continuity and service renewal. | **YES** |
| **6** | **Server & Infrastructure Recovery Contact** | `OPEN` | Tim IT Desa / Administrator | Emergency contact and procedure for hosting downtime, credential loss, or server failure. | Operational safety prerequisite. | **YES** |
| **7** | **Official Super Admin Credential Holder** | `OPEN` | Lurah / Sekretaris Desa Bendung | Handover of primary `SUPER_ADMIN` account credentials to authorized village administrative staff. | Replaces development seed Super Admin account. | **YES** |
| **8** | **Admin Dusun Assignment (6 Dusun)** | `OPEN` | Kepala Dusun (6 Wilayah) | Designation and creation of 6 dedicated `ADMIN_DUSUN` accounts for the 6 village hamlets. | Server-forces 1 account per Dusun with unique non-recyclable usernames. | **YES** |
| **9** | **OPEN-002 Final WhatsApp Message Template** | `OPEN` | Perangkat Desa / UMKM & Layanan | Standardization of pre-filled WhatsApp click-to-chat greeting text. | `TC-EXT-001`; currently uses structured placeholder template. | **NO** (Has safe default) |
| **10** | **OPEN-010 Super Admin Recovery Runbook** | `OPEN` | Tim KKN & Tim Teknis Desa | Administrative protocol for resetting Super Admin password via direct database access runbook if locked out. | Offline disaster recovery protocol. | **YES** |
| **11** | **Official Launch Dataset** | `OPEN` | Perangkat Desa & Kader Dusun | Assembly and verification of real village profile, contact list, active UMKM directory, and facility coordinates. | Development uses synthetic test fixtures; real data inserted post-handover. | **YES** |
| **12** | **Backup Ownership & Automated Schedule** | `OPEN` | Administrator Sistem Desa | Schedule (e.g. weekly DB dump + media sync) and offsite storage location for backups. | Evaluated in `TC-ENV-006` runbook. | **YES** |
| **13** | **Handover Owner & Post-KKN Supervisor** | `OPEN` | DPL KKN / Lurah Desa Bendung | Formal signing of system handover document and operational maintenance appointment. | Formal project milestone closure. | **YES** |
| **14** | **Physical Board & Final QR Destination** | `OPEN` | Tim KKN & Karang Taruna | Printing of physical informational boards and QR codes pointing to the stabilized production domain. | QR destination URL requires final domain name from Item 2. | **YES** |

---

## 3. Pre-Production Decision Status Summary

| Total Decision Items | Open / Pending Human Decision | Configured / Resolved | Production Blockers |
| :---: | :---: | :---: | :---: |
| **14** | **14** | **0** | **13 Items Blocking Production** |

---

## 4. Next Recommended Gate

Transition to **PREPROD-01 — Production Decisions & Ownership** to formally resolve items 1–14 with village stakeholders before provisioning infrastructure or inserting production data.
