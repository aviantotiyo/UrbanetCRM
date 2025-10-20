<script>
    // Data mentah dari controller
    const KABUPATEN_PEL = @json($kabupatenRaw ?? []); // [{id, province_id, name, ...}]
    const KECAMATAN_PEL = @json($kecamatanRaw ?? []); // [{id, regency_id, name, ...}]

    // Helper render opsi (value = name, data-id = id)
    function fillOptions(selectEl, items, {
        nameKey = 'name',
        idKey = 'id',
        placeholder = '-- pilih --'
    } = {}) {
        // kosongkan
        selectEl.innerHTML = '';
        // placeholder
        const ph = document.createElement('option');
        ph.value = '';
        ph.textContent = placeholder;
        selectEl.appendChild(ph);

        // isi cepat pakai DocumentFragment
        const frag = document.createDocumentFragment();
        for (const item of items) {
            const text = item?.[nameKey] ?? '';
            const opt = document.createElement('option');
            opt.value = text; // simpan NAMA ke DB
            opt.textContent = text;
            if (idKey && item?.[idKey] != null) opt.setAttribute('data-id', String(item[idKey]));
            frag.appendChild(opt);
        }
        selectEl.appendChild(frag);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const prov = document.getElementById('provinsi_pel');
        const kab = document.getElementById('kabupaten_pel');
        const kec = document.getElementById('kecamatan_pel');

        // Old values (buat restore saat validasi gagal)
        const oldProv = @json(old('provinsi'));
        const oldKab = @json(old('kabupaten'));
        const oldKec = @json(old('kecamatan'));

        // --- Handler: Provinsi berubah -> filter Kabupaten ---
        prov.addEventListener('change', () => {
            const provId = prov.selectedOptions[0]?.getAttribute('data-id') || null;

            // reset kecamatan
            fillOptions(kec, [], {
                placeholder: '-- pilih kecamatan --'
            });
            kec.value = '';
            kec.disabled = true;

            if (!provId) {
                // kosongkan + disable kabupaten kalau provinsi belum dipilih
                fillOptions(kab, [], {
                    placeholder: '-- pilih kabupaten/kota --'
                });
                kab.value = '';
                kab.disabled = true;
                return;
            }

            // filter kabupaten by province_id
            const filteredKab = KABUPATEN_PEL.filter(k => String(k.province_id) === String(provId));
            fillOptions(kab, filteredKab, {
                nameKey: 'name',
                idKey: 'id',
                placeholder: '-- pilih kabupaten/kota --'
            });
            kab.disabled = false;

            // kalau sebelumnya ada oldKab & masih cocok di daftar baru, restore
            if (oldKab && filteredKab.some(k => k.name === oldKab)) {
                kab.value = oldKab;
                kab.dispatchEvent(new Event('change')); // populate kecamatan otomatis
            }
        });

        // --- Handler: Kabupaten berubah -> filter Kecamatan ---
        kab.addEventListener('change', () => {
            const regId = kab.selectedOptions[0]?.getAttribute('data-id') || null;

            if (!regId) {
                fillOptions(kec, [], {
                    placeholder: '-- pilih kecamatan --'
                });
                kec.value = '';
                kec.disabled = true;
                return;
            }

            const filteredKec = KECAMATAN_PEL.filter(kc => String(kc.regency_id) === String(regId));
            fillOptions(kec, filteredKec, {
                nameKey: 'name',
                idKey: 'id',
                placeholder: '-- pilih kecamatan --'
            });
            kec.disabled = false;

            if (oldKec && filteredKec.some(kc => kc.name === oldKec)) {
                kec.value = oldKec;
            }
        });

        // --- Inisialisasi (restore berurutan prov -> kab -> kec) ---
        if (oldProv) {
            // pilih provinsi lama bila ada
            const hasProv = Array.from(prov.options).some(o => o.value === oldProv);
            if (hasProv) prov.value = oldProv;
            // panggil handler untuk mem-populate kabupaten
            prov.dispatchEvent(new Event('change'));
        } else {
            // default: anak select disabled sampai provinsi dipilih
            kab.disabled = true;
            kec.disabled = true;
        }

        // Pastikan value terkirim walau disabled (jaga-jaga)
        const form = prov.closest('form');
        if (form) {
            form.addEventListener('submit', () => {
                if (kab.disabled) kab.disabled = false;
                if (kec.disabled) kec.disabled = false;
            });
        }
    });
</script>