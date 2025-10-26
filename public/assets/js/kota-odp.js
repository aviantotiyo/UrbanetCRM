// Ambil data global dari window
const KABUPATEN = window._data_kabupaten || [];
const KECAMATAN = window._data_kecamatan || [];

const oldProv = window._old_prov || '';
const oldKota = window._old_kota || '';
const oldKec  = window._old_kec || '';

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

        if (triggerKab && oldKota) {
            $kota.value = oldKota;
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

        if (triggerKec && oldKec) {
            $kec.value = oldKec;
        }
    }

    $prov.addEventListener('change', () => onProvChange(false));
    $kota.addEventListener('change', () => onKabChange(false));

    // Restore auto
    if (oldProv) {
        $prov.value = oldProv;
        onProvChange(true);
    }

    document.querySelector('form').addEventListener('submit', () => {
        $kota.disabled = false;
        $kec.disabled = false;
    });
});
