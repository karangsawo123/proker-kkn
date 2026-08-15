@props([
    'latitude' => null,
    'longitude' => null,
    'required' => false,
    'mapId' => 'coordPickerMap',
    'latName' => 'latitude',
    'lngName' => 'longitude',
])

<div class="coordinate-picker-component">
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

    let initLat = parseFloat(latInput.value);
    let initLng = parseFloat(lngInput.value);

    const hasValidCoords = !isNaN(initLat) && !isNaN(initLng);
    const defaultCenter = hasValidCoords ? [initLat, initLng] : [-7.6298, 110.8603];
    const defaultZoom = hasValidCoords ? 15 : 13;

    if (typeof L !== 'undefined') {
        const pickerMap = L.map('{{ $mapId }}').setView(defaultCenter, defaultZoom);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright" rel="noopener">OpenStreetMap</a>',
            maxZoom: 19,
        }).addTo(pickerMap);

        let marker = null;

        function setMarker(lat, lng) {
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng], { draggable: true }).addTo(pickerMap);

                marker.on('dragend', function (e) {
                    const pos = e.target.getLatLng();
                    latInput.value = pos.lat.toFixed(6);
                    lngInput.value = pos.lng.toFixed(6);
                });
            }
            latInput.value = lat.toFixed(6);
            lngInput.value = lng.toFixed(6);
        }

        if (hasValidCoords) {
            setMarker(initLat, initLng);
        }

        pickerMap.on('click', function (e) {
            setMarker(e.latlng.lat, e.latlng.lng);
        });

        function updateFromInputs() {
            const lat = parseFloat(latInput.value);
            const lng = parseFloat(lngInput.value);
            if (!isNaN(lat) && !isNaN(lng) && lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
                setMarker(lat, lng);
                pickerMap.setView([lat, lng], Math.max(pickerMap.getZoom(), 14));
            }
        }

        latInput.addEventListener('input', updateFromInputs);
        lngInput.addEventListener('input', updateFromInputs);

        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                latInput.value = '';
                lngInput.value = '';
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
