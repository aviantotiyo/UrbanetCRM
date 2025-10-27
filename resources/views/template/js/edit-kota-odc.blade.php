<script>
const jsonKabupaten = @json($kabupatenRaw ?? []);
const jsonKecamatan = @json($kecamatanRaw ?? []);
const defaultProv = @json(old('prov', $odc->prov ?? ''));
const defaultKota = @json(old('kota', $odc->kota ?? ''));
const defaultKec  = @json(old('kec', $odc->kec ?? ''));

document.addEventListener('DOMContentLoaded', function () {
    const selectProv = document.getElementById('prov_odc');
    const selectKota = document.getElementById('kota_odc');
    const selectKec  = document.getElementById('kec_odc');

    function findProvIdByName(name) {
        const option = Array.from(selectProv.options).find(opt => opt.value === name);
        return option?.dataset.id ?? null;
    }

    function renderOptions($select, items, selectedValue = null, placeholder = '-- pilih --') {
        $select.innerHTML = '';
        const def = document.createElement('option');
        def.value = '';
        def.textContent = placeholder;
        $select.appendChild(def);
        items.forEach(item => {
            const opt = document.createElement('option');
            opt.value = item.name;
            opt.textContent = item.name;
            opt.dataset.id = item.id;
            if (selectedValue && item.name === selectedValue) {
                opt.selected = true;
            }
            $select.appendChild(opt);
        });
    }

    function loadKabupaten(provId, selected = null) {
        const filtered = jsonKabupaten.filter(k => k.province_id == provId);
        renderOptions(selectKota, filtered, selected, '-- pilih kabupaten/kota --');
    }

    function loadKecamatan(kabId, selected = null) {
        const filtered = jsonKecamatan.filter(k => k.regency_id == kabId);
        renderOptions(selectKec, filtered, selected, '-- pilih kecamatan --');
    }

    selectProv.addEventListener('change', () => {
        const provId = findProvIdByName(selectProv.value);
        loadKabupaten(provId);
        selectKec.innerHTML = '<option value="">-- pilih kecamatan --</option>';
    });

    selectKota.addEventListener('change', () => {
        const kabId = selectKota.options[selectKota.selectedIndex]?.dataset.id;
        loadKecamatan(kabId);
    });

    // AUTO-TRIGGER saat edit
    if (defaultProv) {
        const provId = findProvIdByName(defaultProv);
        if (provId) {
            loadKabupaten(provId, defaultKota);

            const kabObj = jsonKabupaten.find(k => k.name === defaultKota && k.province_id == provId);
            if (kabObj) {
                loadKecamatan(kabObj.id, defaultKec);
            }
        }
    }
});
</script>
