@props([
    'latitude' => null,
    'longitude' => null,
    'required' => false,
    'mapId' => 'coordPickerMap',
    'latName' => 'latitude',
    'lngName' => 'longitude',
])

<div class="coordinate-picker-component">
    {{-- Smart Input Box --}}
    <div class="smart-coord-box" style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px; padding: 12px; margin-bottom: 12px;">
        <label for="{{ $mapId }}SmartInput" class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #1e293b; display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
            <span>✨ Tempel Link Shareloc / Derajat Google Maps</span>
            <span style="font-weight: normal; font-size: 0.75rem; color: #64748b;">(Smart Input)</span>
        </label>
        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <input
                type="text"
                id="{{ $mapId }}SmartInput"
                class="form-input"
                style="flex: 1; min-width: 220px; font-size: 0.85rem; background: #ffffff;"
                placeholder='Contoh: 7°23&apos;56.0"S 112°26&apos;32.5"E atau -7.3988, 112.4423 atau link Maps...'
            >
            <button type="button" class="btn btn-sm btn-primary" id="{{ $mapId }}ApplySmartBtn" style="white-space: nowrap; padding: 6px 14px; font-size: 0.825rem; font-weight: 600;">
                📍 Terapkan
            </button>
            <button type="button" class="btn btn-sm btn-outline-primary" id="{{ $mapId }}GpsBtn" style="white-space: nowrap; padding: 6px 14px; font-size: 0.825rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                🛰️ Lokasi GPS Saya
            </button>
        </div>
        <div id="{{ $mapId }}SmartFeedback" style="font-size: 0.78rem; margin-top: 6px; min-height: 18px; color: #64748b; transition: all 0.2s ease;"></div>
    </div>

    <div class="form-row coordinate-inputs">
        <div class="form-group">
            <label for="{{ $latName }}" class="form-label">
                Latitude @if($required) <span class="required-mark">*</span> @else <span class="optional-tag">(Opsional)</span> @endif
            </label>
            <input
                type="number"
                step="0.000001"
                min="-90"
                max="90"
                name="{{ $latName }}"
                id="{{ $latName }}"
                class="form-input @error($latName) is-invalid @enderror"
                value="{{ old($latName, $latitude) }}"
                placeholder="-7.123456"
                @if($required) required @endif
            >
            @error($latName)
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="{{ $lngName }}" class="form-label">
                Longitude @if($required) <span class="required-mark">*</span> @else <span class="optional-tag">(Opsional)</span> @endif
            </label>
            <input
                type="number"
                step="0.000001"
                min="-180"
                max="180"
                name="{{ $lngName }}"
                id="{{ $lngName }}"
                class="form-input @error($lngName) is-invalid @enderror"
                value="{{ old($lngName, $longitude) }}"
                placeholder="110.123456"
                @if($required) required @endif
            >
            @error($lngName)
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="map-helper-bar">
        <span class="map-instruction">💡 Klik pada peta atau seret pin untuk menentukan titik lokasi koordinat.</span>
        @if(!$required)
            <button type="button" class="btn btn-sm btn-outline-secondary" id="{{ $mapId }}ClearBtn">
                Hapus Titik Koordinat
            </button>
        @endif
    </div>

    <div id="{{ $mapId }}" class="coord-picker-map" style="height: 320px; width: 100%; border-radius: 8px; border: 1px solid #dcd3c4; margin-top: 8px;"></div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const mapElement = document.getElementById('{{ $mapId }}');
    if (!mapElement) return;

    const latInput = document.getElementById('{{ $latName }}');
    const lngInput = document.getElementById('{{ $lngName }}');
    const clearBtn = document.getElementById('{{ $mapId }}ClearBtn');
    const smartInput = document.getElementById('{{ $mapId }}SmartInput');
    const applySmartBtn = document.getElementById('{{ $mapId }}ApplySmartBtn');
    const gpsBtn = document.getElementById('{{ $mapId }}GpsBtn');
    const feedback = document.getElementById('{{ $mapId }}SmartFeedback');

    let initLat = parseFloat(latInput.value);
    let initLng = parseFloat(lngInput.value);

    const hasValidCoords = !isNaN(initLat) && !isNaN(initLng);
    const defaultCenter = hasValidCoords ? [initLat, initLng] : [-7.8341, 110.7185];
    const defaultZoom = hasValidCoords ? 16 : 14;

    if (typeof L !== 'undefined') {
        const pickerMap = L.map('{{ $mapId }}').setView(defaultCenter, defaultZoom);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright" rel="noopener">OpenStreetMap</a>',
            maxZoom: 19,
        }).addTo(pickerMap);

        let marker = null;

        function setMarker(lat, lng, zoomLevel) {
            lat = parseFloat(lat);
            lng = parseFloat(lng);
            if (isNaN(lat) || isNaN(lng)) return;

            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng], { draggable: true }).addTo(pickerMap);

                marker.on('dragend', function (e) {
                    const pos = e.target.getLatLng();
                    latInput.value = pos.lat.toFixed(6);
                    lngInput.value = pos.lng.toFixed(6);
                    if (feedback) feedback.innerHTML = `<span style="color: #059669;">📍 Pin digeser ke: ${pos.lat.toFixed(6)}, ${pos.lng.toFixed(6)}</span>`;
                });
            }
            latInput.value = lat.toFixed(6);
            lngInput.value = lng.toFixed(6);
            pickerMap.setView([lat, lng], zoomLevel || Math.max(pickerMap.getZoom(), 15));
        }

        if (hasValidCoords) {
            setMarker(initLat, initLng);
        }

        pickerMap.on('click', function (e) {
            setMarker(e.latlng.lat, e.latlng.lng);
            if (feedback) feedback.innerHTML = `<span style="color: #059669;">📍 Titik dipilih di peta: ${e.latlng.lat.toFixed(6)}, ${e.latlng.lng.toFixed(6)}</span>`;
        });

        function updateFromInputs() {
            const lat = parseFloat(latInput.value);
            const lng = parseFloat(lngInput.value);
            if (!isNaN(lat) && !isNaN(lng) && lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
                setMarker(lat, lng);
            }
        }

        latInput.addEventListener('input', updateFromInputs);
        lngInput.addEventListener('input', updateFromInputs);

        // ═══════════════════════════════════════════════════════════════════
        // SMART PARSER (DMS, Maps URL, Comma-Separated Decimal)
        // ═══════════════════════════════════════════════════════════════════
        function parseSmartLocation(raw) {
            if (!raw || typeof raw !== 'string') return null;
            let text = raw.trim();

            // 1. DMS Format: e.g. 7°23'56.0"S 112°26'32.5"E or 7°23'56"S, 112°26'32"E
            const dmsRegex = /(\d+(?:\.\d+)?)\s*°\s*(\d+(?:\.\d+)?)\s*['\u2032]?\s*(\d+(?:\.\d+)?)\s*["\u2033]?\s*([NSEWnsew])/g;
            const dmsMatches = [...text.matchAll(dmsRegex)];
            if (dmsMatches.length >= 2) {
                let lat = null, lng = null;
                for (const m of dmsMatches) {
                    const deg = parseFloat(m[1]);
                    const min = parseFloat(m[2]) || 0;
                    const sec = parseFloat(m[3]) || 0;
                    const dir = m[4].toUpperCase();
                    let dec = deg + (min / 60) + (sec / 3600);
                    if (dir === 'S' || dir === 'W') dec = -dec;
                    if (dir === 'N' || dir === 'S') lat = dec;
                    if (dir === 'E' || dir === 'W') lng = dec;
                }
                if (lat !== null && lng !== null) {
                    return { lat, lng, type: 'DMS (Derajat)' };
                }
            }

            // 2. Google Maps URL or query string patterns
            // Matches @-7.123,110.123 or ?q=-7.123,110.123 or destination=-7.123,110.123 or ll=-7.123,110.123
            const urlMatch = text.match(/(?:@|[?&](?:q|destination|ll)=|\/dir\/\/)(-?\d{1,2}\.\d+)[,\s]+(-?\d{1,3}\.\d+)/i);
            if (urlMatch) {
                return { lat: parseFloat(urlMatch[1]), lng: parseFloat(urlMatch[2]), type: 'Google Maps Link' };
            }

            // 3. Simple Decimal coordinates: -7.123456, 110.123456 or -7.123456 110.123456
            const decMatch = text.match(/(-?\d{1,2}\.\d+)[,\s]+(-?\d{1,3}\.\d+)/);
            if (decMatch) {
                return { lat: parseFloat(decMatch[1]), lng: parseFloat(decMatch[2]), type: 'Koordinat Desimal' };
            }

            return null;
        }

        function executeSmartParse() {
            if (!smartInput) return;
            const val = smartInput.value.trim();
            if (!val) {
                if (feedback) feedback.innerHTML = '<span style="color: #64748b;">Silakan tempel teks koordinat atau link Maps terlebih dahulu.</span>';
                return;
            }

            const parsed = parseSmartLocation(val);
            if (parsed) {
                setMarker(parsed.lat, parsed.lng, 17);
                if (feedback) {
                    feedback.innerHTML = `<span style="color: #059669; font-weight: 600;">✅ Berhasil mengenali format ${parsed.type}: Lat ${parsed.lat.toFixed(6)}, Lng ${parsed.lng.toFixed(6)}</span>`;
                }
                smartInput.style.borderColor = '#10b981';
            } else {
                if (feedback) {
                    feedback.innerHTML = `<span style="color: #dc2626; font-weight: 500;">⚠️ Format tidak dikenali. Contoh yang didukung: <code>7°23'56.0"S 112°26'32.5"E</code> atau <code>-7.3988, 112.4423</code> atau link Maps.</span>`;
                }
                smartInput.style.borderColor = '#ef4444';
            }
        }

        if (applySmartBtn) {
            applySmartBtn.addEventListener('click', executeSmartParse);
        }

        if (smartInput) {
            smartInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    executeSmartParse();
                }
            });

            // Auto parse on paste with tiny delay
            smartInput.addEventListener('paste', () => {
                setTimeout(executeSmartParse, 50);
            });
        }

        // ═══════════════════════════════════════════════════════════════════
        // GPS GEOLOCATION BUTTON (FOR MOBILE/FIELD SURVEY)
        // ═══════════════════════════════════════════════════════════════════
        if (gpsBtn) {
            gpsBtn.addEventListener('click', () => {
                if (!navigator.geolocation) {
                    if (feedback) feedback.innerHTML = '<span style="color: #dc2626;">Perangkat Anda tidak mendukung fitur GPS Browser.</span>';
                    return;
                }

                gpsBtn.disabled = true;
                gpsBtn.innerHTML = '⏳ Mendeteksi GPS...';
                if (feedback) feedback.innerHTML = '<span style="color: #2563eb;">Sedang mencari sinyal GPS akurat... Pastikan izin lokasi diizinkan di HP.</span>';

                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        const acc = Math.round(position.coords.accuracy || 0);

                        setMarker(lat, lng, 18);
                        gpsBtn.disabled = false;
                        gpsBtn.innerHTML = '🛰️ Lokasi GPS Saya';
                        if (feedback) {
                            feedback.innerHTML = `<span style="color: #059669; font-weight: 600;">✅ Lokasi GPS HP berhasil didapatkan! (Akurasi: ±${acc} meter)</span>`;
                        }
                    },
                    (error) => {
                        gpsBtn.disabled = false;
                        gpsBtn.innerHTML = '🛰️ Lokasi GPS Saya';
                        let msg = 'Gagal mendeteksi lokasi GPS.';
                        if (error.code === error.PERMISSION_DENIED) {
                            msg = 'Akses lokasi GPS ditolak oleh browser/HP. Silakan izinkan lokasi di pengaturan browser.';
                        } else if (error.code === error.POSITION_UNAVAILABLE) {
                            msg = 'Sinyal GPS tidak tersedia.';
                        }
                        if (feedback) feedback.innerHTML = `<span style="color: #dc2626;">⚠️ ${msg}</span>`;
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            });
        }

        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                latInput.value = '';
                lngInput.value = '';
                if (smartInput) smartInput.value = '';
                if (feedback) feedback.innerHTML = '';
                if (marker) {
                    pickerMap.removeLayer(marker);
                    marker = null;
                }
            });
        }

        // Force map resize fix
        setTimeout(() => {
            pickerMap.invalidateSize();
        }, 200);
    }
});
</script>
@endpush

