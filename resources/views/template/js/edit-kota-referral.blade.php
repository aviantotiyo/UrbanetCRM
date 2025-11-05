
<script>
    const kabupatenData = @json($kabupatenRaw);
    const kecamatanData = @json($kecamatanRaw);
    const selectedProvinsi   = @json(old('provinsi', $prospect->provinsi));
    const selectedKabupaten  = @json(old('kabupaten', $prospect->kabupaten));
    const selectedKecamatan  = @json(old('kecamatan', $prospect->kecamatan));
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const provinsiSelect = document.getElementById('provinsi_pel');
    const kabupatenSelect = document.getElementById('kabupaten_pel');
    const kecamatanSelect = document.getElementById('kecamatan_pel');

    const resetSelect = (el, label) => {
        el.innerHTML = `<option value="">-- pilih ${label} --</option>`;
    };

    const populateKabupaten = (provName) => {
        const provOption = [...provinsiSelect.options].find(opt => opt.value === provName);
        if (!provOption) return;

        const provId = provOption.dataset.id;
        // ✅ gunakan 'province_id' bukan 'provinsi_id'
        const filteredKab = kabupatenData.filter(k => k.province_id == provId);

        resetSelect(kabupatenSelect, 'kabupaten/kota');
        resetSelect(kecamatanSelect, 'kecamatan');

        filteredKab.forEach(kab => {
            const opt = document.createElement('option');
            opt.value = kab.name;
            opt.textContent = kab.name;
            opt.dataset.id = kab.id;
            kabupatenSelect.appendChild(opt);
        });

        if (selectedKabupaten) {
            kabupatenSelect.value = selectedKabupaten;
            kabupatenSelect.dispatchEvent(new Event('change'));
        }
    };

    const populateKecamatan = (kabName) => {
        const kab = kabupatenData.find(k => k.name === kabName);
        if (!kab) return;

        // ✅ gunakan 'regency_id' bukan 'kabupaten_id'
        const filteredKec = kecamatanData.filter(kec => kec.regency_id == kab.id);

        resetSelect(kecamatanSelect, 'kecamatan');

        filteredKec.forEach(kec => {
            const opt = document.createElement('option');
            opt.value = kec.name;
            opt.textContent = kec.name;
            kecamatanSelect.appendChild(opt);
        });

        if (selectedKecamatan) {
            kecamatanSelect.value = selectedKecamatan;
        }
    };

    // === INITIALIZATION ===
    window.setTimeout(() => {
        if (selectedProvinsi) {
            const foundProvOption = [...provinsiSelect.options].find(opt => opt.value === selectedProvinsi);
            if (foundProvOption) {
                provinsiSelect.value = selectedProvinsi;
                provinsiSelect.dispatchEvent(new Event('change')); // trigger kabupaten + kecamatan
            }
        }
    }, 200);

    // === EVENT ===
    provinsiSelect.addEventListener('change', function () {
        populateKabupaten(this.value);
    });

    kabupatenSelect.addEventListener('change', function () {
        populateKecamatan(this.value);
    });
});
</script>

