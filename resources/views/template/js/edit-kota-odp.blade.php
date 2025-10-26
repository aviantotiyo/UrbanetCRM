<script>
const KABUPATEN = @json($kabupatenRaw ?? []);
const KECAMATAN = @json($kecamatanRaw ?? []);

function renderOptions($select, items, nameKey = 'name', idKey = 'id') {
    $select.innerHTML = '';
    const placeholder = new Option('-- pilih --', '');
    $select.appendChild(placeholder);

    items.forEach(item => {
        const text = item?.[nameKey] ?? '';
        const opt = new Option(text, text); // value = name
        if (idKey && item?.[idKey]) {
            opt.dataset.id = item[idKey];
        }
        $select.appendChild(opt);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const $prov = document.getElementById('provinsi');
    const $kota = document.getElementById('kota');
    const $kec  = document.getElementById('kecamatan');

    // Ambil nilai existing dari $odp untuk pre-select
    const currentProv = @json(old('prov', $odp->prov));
    const currentKota = @json(old('kota', $odp->kota));
    const currentKec  = @json(old('kec', $odp->kec));

    function onProvChange(triggerKab = true) {
        const provName = $prov.value;
        const provMatch = Array.from($prov.options).find(opt => opt.value === provName);
        const provId = provMatch?.dataset.id ?? null;

        // Reset kecamatan
        renderOptions($kec, []);
        $kec.disabled = true;

        if (!provId) {
            renderOptions($kota, []);
            $kota.disabled = true;
            return;
        }

        const filteredKab = KABUPATEN.filter(k => String(k.province_id) === String(provId));
        renderOptions($kota, filteredKab, 'name', 'id');
        $kota.disabled = false;

        if (triggerKab && currentKota) {
            $kota.value = currentKota;
            onKabChange(true);
        }
    }

    function onKabChange(triggerKec = false) {
        const kabName = $kota.value;
        const kabMatch = KABUPATEN.find(k => k.name === kabName);
        const kabId = kabMatch?.id ?? null;

        if (!kabId) {
            renderOptions($kec, []);
            $kec.disabled = true;
            return;
        }

        const filteredKec = KECAMATAN.filter(k => String(k.regency_id) === String(kabId));
        renderOptions($kec, filteredKec, 'name', 'id');
        $kec.disabled = false;

        if (triggerKec && currentKec) {
            $kec.value = currentKec;
        }
    }

    // Event
    $prov.addEventListener('change', () => onProvChange(false));
    $kota.addEventListener('change', () => onKabChange(false));

    // Auto set saat load awal
    if (currentProv) {
        $prov.value = currentProv;
        onProvChange(true);
    }

    // Agar select ikut terkirim saat disabled
    document.querySelector('form').addEventListener('submit', () => {
        $kota.disabled = false;
        $kec.disabled = false;
    });
});
</script>
