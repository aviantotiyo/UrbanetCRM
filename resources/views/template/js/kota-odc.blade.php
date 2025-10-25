<script>
    const KABUPATEN = @json($kabupatenRaw ?? []);
    const KECAMATAN = @json($kecamatanRaw ?? []);

    function renderOptions(selectEl, items, nameKey = 'name', idKey = 'id', placeholder = '-- pilih --') {
        selectEl.innerHTML = '';
        const placeholderOption = new Option(placeholder, '');
        selectEl.appendChild(placeholderOption);

        items.forEach(item => {
            const opt = new Option(item[nameKey], item[idKey]);
            selectEl.appendChild(opt);
        });
    }

    function filterKab(provId) {
        return KABUPATEN.filter(k => String(k.province_id) === String(provId));
    }

    function filterKec(kabId) {
        return KECAMATAN.filter(k => String(k.regency_id) === String(kabId));
    }

    function initWilayahCascade({
        provSel,
        kabSel,
        kecSel,
        oldProv = '',
        oldKab = '',
        oldKec = ''
    }) {
        const $prov = document.querySelector(provSel);
        const $kab = document.querySelector(kabSel);
        const $kec = document.querySelector(kecSel);

        $prov.addEventListener('change', function () {
            const provId = this.value;
            const filteredKab = filterKab(provId);

            renderOptions($kab, filteredKab, 'name', 'id', '-- pilih kabupaten/kota --');
            $kec.innerHTML = '<option value="">-- pilih kecamatan --</option>';
        });

        $kab.addEventListener('change', function () {
            const kabId = this.value;
            const filteredKec = filterKec(kabId);

            renderOptions($kec, filteredKec, 'name', 'id', '-- pilih kecamatan --');
        });

        // Restore old values (jika ada)
        if (oldProv) {
            $prov.value = oldProv;
            const filteredKab = filterKab(oldProv);
            renderOptions($kab, filteredKab, 'name', 'id', '-- pilih kabupaten/kota --');
            $kab.value = oldKab || '';

            if (oldKab) {
                const filteredKec = filterKec(oldKab);
                renderOptions($kec, filteredKec, 'name', 'id', '-- pilih kecamatan --');
                $kec.value = oldKec || '';
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        initWilayahCascade({
            provSel: '#prov_odc',
            kabSel: '#kota_odc',
            kecSel: '#kec_odc',
            oldProv: @json(old('prov')),
            oldKab: @json(old('kota')),
            oldKec: @json(old('kec')),
        });
    });
</script>
