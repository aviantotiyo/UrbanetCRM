<script>
    const selectedProvinsi   = @json(old('provinsi', $item->provinsi));
    const selectedKabupaten  = @json(old('kabupaten', $item->kabupaten));
    const selectedKecamatan  = @json(old('kecamatan', $item->kecamatan));

    const kabupatenData = @json($kabupatenRaw);
    const kecamatanData = @json($kecamatanRaw);
</script>


<script>
document.addEventListener('DOMContentLoaded', () => {
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

    // === Event listeners ===
    provinsiSelect.addEventListener('change', function() {
        populateKabupaten(this.value);
    });

    kabupatenSelect.addEventListener('change', function() {
        populateKecamatan(this.value);
    });

    // === Trigger awal ===
    setTimeout(() => {
        if (selectedProvinsi) {
            provinsiSelect.value = selectedProvinsi;
            provinsiSelect.dispatchEvent(new Event('change'));
        }
    }, 100);
});
</script>
