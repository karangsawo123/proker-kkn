/**
 * map.js — Leaflet map initialization for Portal Informasi Desa Bendung.
 *
 * Contract:
 *   window.MAP_CONFIG  — injected by Blade via Js::from()
 *   window.MAP_MARKERS — injected by Blade via Js::from()
 *
 * Both values are produced server-side; all strings are safe-encoded via
 * Illuminate\Support\Js::from() before reaching this file.
 *
 * Popup content is built with DOM APIs (textContent / createElement) to
 * prevent XSS from admin-entered strings (name, address, category, etc.).
 */

import L from 'leaflet';

// Fix Leaflet default icon paths when bundled with Vite
import iconRetinaUrl from 'leaflet/dist/images/marker-icon-2x.png';
import iconUrl from 'leaflet/dist/images/marker-icon.png';
import shadowUrl from 'leaflet/dist/images/marker-shadow.png';

delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
    iconRetinaUrl,
    iconUrl,
    shadowUrl,
});

// ─── Marker icon factory ──────────────────────────────────────────────────────

// ─── Marker icon factory (High-contrast thematic badges) ──────────────────────

const ICON_CONFIGS = {
    UMKM: {
        color: '#156635',
        title: 'UMKM',
        svg: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>`,
    },
    PELAYANAN: {
        color: '#c46a3a',
        title: 'Pelayanan Publik',
        svg: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="21" x2="21" y2="21"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="5 6 12 3 19 6"/><line x1="4" y1="10" x2="4" y2="21"/><line x1="20" y1="10" x2="20" y2="21"/><line x1="8" y1="14" x2="8" y2="17"/><line x1="12" y1="14" x2="12" y2="17"/><line x1="16" y1="14" x2="16" y2="17"/></svg>`,
    },
    DEFAULT: {
        color: '#A16207',
        title: 'Fasilitas & Titik',
        svg: `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>`,
    },
};

function makeIcon(markerType) {
    const cfg = ICON_CONFIGS[markerType] ?? ICON_CONFIGS.DEFAULT;
    const svgHtml = `
        <div style="position:relative;width:38px;height:48px;display:flex;flex-direction:column;align-items:center;cursor:pointer;filter:drop-shadow(0 4px 8px rgba(0,0,0,0.38));transition:transform 0.2s cubic-bezier(0.175,0.885,0.32,1.275);">
            <div style="width:36px;height:36px;border-radius:50%;background:${cfg.color};border:2.5px solid #ffffff;display:flex;align-items:center;justify-content:center;box-shadow:inset 0 1px 2px rgba(255,255,255,0.35);">
                ${cfg.svg}
            </div>
            <div style="width:0;height:0;border-left:7px solid transparent;border-right:7px solid transparent;border-top:10px solid ${cfg.color};margin-top:-2px;"></div>
        </div>`;
    return L.divIcon({
        html: svgHtml,
        className: 'portal-custom-badge-icon',
        iconSize: [38, 48],
        iconAnchor: [19, 46],
        popupAnchor: [0, -46],
        tooltipAnchor: [0, -48],
    });
}

// ─── Popup builder (DOM-based, XSS-safe) ─────────────────────────────────────

function buildPopup(marker) {
    const wrap = document.createElement('div');
    wrap.style.cssText = 'min-width:180px;max-width:240px;font-family:inherit;';

    // Optional image
    if (marker.photo_url) {
        const img = document.createElement('img');
        img.src = marker.photo_url;
        img.alt = '';
        img.style.cssText = 'width:100%;border-radius:8px;margin-bottom:8px;display:block;object-fit:cover;height:100px;';
        wrap.appendChild(img);
    }

    // Name
    const name = document.createElement('strong');
    name.textContent = marker.name;
    name.style.cssText = 'display:block;font-size:0.9rem;color:#2b2f23;margin-bottom:4px;';
    wrap.appendChild(name);

    // Category
    const cat = document.createElement('span');
    cat.textContent = marker.category;
    cat.style.cssText = 'display:inline-block;font-size:0.75rem;background:#f1e7d3;border-radius:4px;padding:2px 8px;margin-bottom:6px;color:#2b2f23;';
    wrap.appendChild(cat);

    // Address (optional)
    if (marker.address) {
        const addr = document.createElement('p');
        addr.textContent = marker.address;
        addr.style.cssText = 'font-size:0.8rem;color:#7a8f6b;margin:0 0 8px;';
        wrap.appendChild(addr);
    }

    // Action row
    const actions = document.createElement('div');
    actions.style.cssText = 'display:flex;gap:6px;flex-wrap:wrap;margin-top:6px;';

    // Detail / context link
    if (marker.detail_url) {
        const detailLink = document.createElement('a');
        detailLink.href = marker.detail_url;
        detailLink.textContent = 'Lihat Detail';
        detailLink.style.cssText = 'font-size:0.8rem;font-weight:600;color:#2e5e3e;text-decoration:underline;';
        actions.appendChild(detailLink);
    }

    // Directions (conditional on valid coordinates)
    if (marker.lat != null && marker.lng != null) {
        const mapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${encodeURIComponent(marker.lat)},${encodeURIComponent(marker.lng)}`;
        const dirLink = document.createElement('a');
        dirLink.href = mapsUrl;
        dirLink.target = '_blank';
        dirLink.rel = 'noopener noreferrer';
        dirLink.textContent = 'Petunjuk Arah';
        dirLink.style.cssText = 'font-size:0.8rem;font-weight:600;color:#2e5e3e;text-decoration:underline;';
        actions.appendChild(dirLink);
    }

    if (actions.children.length > 0) {
        wrap.appendChild(actions);
    }

    return wrap;
}

// ─── Core init ────────────────────────────────────────────────────────────────

export function initMap(elementId) {
    const config = window.MAP_CONFIG ?? {};
    const allMarkers = window.MAP_MARKERS ?? [];

    const el = document.getElementById(elementId);
    if (!el) return;

    // Center defaults to Jawa Tengah if not provided
    const center = config.center ?? [-7.6298, 110.8603];
    const zoom = config.zoom ?? 13;

    const map = L.map(elementId, {
        center,
        zoom,
        zoomControl: true,
    });

    // OSM tile — development only (DEV05-DEC-002)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright" rel="noopener">OpenStreetMap</a>',
        maxZoom: 19,
    }).addTo(map);

    // Fallback message on tile error
    map.on('tileerror', () => {
        const notice = el.querySelector('.map-tile-error');
        if (!notice) {
            const div = document.createElement('div');
            div.className = 'map-tile-error';
            div.style.cssText = 'position:absolute;bottom:8px;left:50%;transform:translateX(-50%);background:rgba(250,247,242,0.9);border-radius:8px;padding:4px 12px;font-size:0.8rem;color:#7a8f6b;z-index:500;pointer-events:none;';
            div.textContent = 'Peta sementara tidak tersedia.';
            el.style.position = 'relative';
            el.appendChild(div);
        }
    });

    // ─── Filters ───────────────────────────────────────────────────────────────
    const filterDusunEl = document.getElementById(`${elementId}-filter-dusun`);
    const filterCatEl = document.getElementById(`${elementId}-filter-cat`);

    let activeMarkers = [];

    function renderMarkers() {
        // Remove existing markers
        activeMarkers.forEach(m => m.remove());
        activeMarkers = [];

        const selectedDusun = filterDusunEl ? filterDusunEl.value : 'semua';
        const selectedCat = filterCatEl ? filterCatEl.value : 'semua';

        allMarkers.forEach(marker => {
            if (selectedDusun !== 'semua' && String(marker.dusun_id) !== String(selectedDusun)) return;
            if (selectedCat !== 'semua' && marker.category !== selectedCat) return;
            if (marker.lat == null || marker.lng == null) return;

            const lMarker = L.marker([marker.lat, marker.lng], {
                icon: makeIcon(marker.marker_type),
                title: marker.name,
            });

            // Permanent label displaying location name above the pin without requiring a click
            lMarker.bindTooltip(marker.name, {
                permanent: true,
                direction: 'top',
                offset: [0, -38],
                className: 'portal-map-label',
            });

            // Rich interactive popup on click
            lMarker.bindPopup(() => buildPopup(marker), {
                maxWidth: 260,
                className: 'portal-popup',
            });

            lMarker.addTo(map);
            activeMarkers.push(lMarker);
        });
    }

    if (filterDusunEl) filterDusunEl.addEventListener('change', renderMarkers);
    if (filterCatEl) filterCatEl.addEventListener('change', renderMarkers);

    renderMarkers();
}

// Auto-init any element with data-map attribute
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-map]').forEach(el => {
        initMap(el.id);
    });
});
