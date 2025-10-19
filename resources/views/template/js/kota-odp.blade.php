<script>
    // Data dari controller (JSON mentah)
    const KABUPATEN = @json($kabupatenRaw ?? []);
    const KECAMATAN = @json($kecamatanRaw ?? []);

    // Helper: render options (value = NAMA, data-id = ID)
    function renderOptions($select, items, nameKey = 'name', idKey = 'id') {
        $select.empty().append(new Option('-- pilih --', ''));
        items.forEach(item => {
            const text = item?.[nameKey] ?? '';
            const value = text; // yang disimpan ke DB adalah NAMA
            const opt = new Option(text, value, false, false);
            if (idKey && item?.[idKey]) {
                opt.dataset.id = item[idKey];
            }
            $select.append(opt);
        });
    }

    $(function() {
        const $prov = $('#provinsi');
        const $kota = $('#kota');
        const $kec = $('#kecamatan');

        // Init Select2 utk kota & kec
        $kota.select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: '-- pilih kota/kabupaten --',
            allowClear: true
        });
        $kec.select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: '-- pilih kecamatan --',
            allowClear: true
        });

        // Sinkronkan tampilan error Laravel ke Select2
        if ($kota.hasClass('is-invalid')) $kota.next('.select2').find('.select2-selection').addClass('is-invalid');
        if ($kec.hasClass('is-invalid')) $kec.next('.select2').find('.select2-selection').addClass('is-invalid');

        // Old values (untuk restore ketika validasi gagal)
        const oldProv = @json(old('prov'));
        const oldKota = @json(old('kota'));
        const oldKec = @json(old('kec'));

        // Provinsi berubah -> filter kabupaten
        $prov.on('change', function() {
            const provId = $('option:selected', this).data('id') || null;

            // reset kecamatan
            $kec.val(null).trigger('change');
            $kec.prop('disabled', true).empty().append(new Option('-- pilih kecamatan --', ''));

            if (!provId) {
                $kota.val(null).trigger('change');
                $kota.prop('disabled', true).empty().append(new Option('-- pilih kota/kabupaten --', ''));
                return;
            }

            // filter kabupaten by province_id
            const filteredKab = KABUPATEN.filter(k => String(k.province_id) === String(provId));
            renderOptions($kota, filteredKab, 'name', 'id');
            $kota.prop('disabled', false);

            // jangan pakai 'change.select2' — pakai 'change' supaya handler di bawah terpanggil
            $kota.trigger('change');
        });

        // Kota/Kab berubah -> filter kecamatan
        $kota.on('change', function() {
            const regId = $('option:selected', this).data('id') || null;

            if (!regId) {
                $kec.val(null).trigger('change');
                $kec.prop('disabled', true).empty().append(new Option('-- pilih kecamatan --', ''));
                return;
            }

            const filteredKec = KECAMATAN.filter(kc => String(kc.regency_id) === String(regId));
            renderOptions($kec, filteredKec, 'name', 'id');
            $kec.prop('disabled', false);
            // tidak auto-select apapun di sini; user pilih sendiri
        });

        // Restore berurutan: prov -> kota -> kec
        if (oldProv) {
            // pilih prov lama
            const hasProv = $prov.find('option').filter((_, opt) => opt.value === oldProv).length > 0;
            if (hasProv) {
                $prov.val(oldProv);
            }
            // trigger untuk populate kota
            $prov.trigger('change');

            if (oldKota) {
                // tunggu DOM kota terisi, lalu set nilainya & trigger agar kec terisi
                // (karena renderOptions dipanggil di handler prov change)
                setTimeout(() => {
                    const hasKota = $kota.find('option').filter((_, opt) => opt.value === oldKota).length > 0;
                    if (hasKota) {
                        $kota.val(oldKota).trigger('change');
                    }
                    if (oldKec) {
                        // setelah kecamatan di-populate oleh handler kota change, set kec lama
                        setTimeout(() => {
                            const hasKec = $kec.find('option').filter((_, opt) => opt.value === oldKec).length > 0;
                            if (hasKec) {
                                $kec.val(oldKec).trigger('change');
                            }
                        }, 0);
                    }
                }, 0);
            }
        } else {
            // default state
            $kota.prop('disabled', true);
            $kec.prop('disabled', true);
        }

        // Pastikan select tidak disabled saat submit (agar ikut terkirim)
        $('form').on('submit', function() {
            if ($kota.prop('disabled')) $kota.prop('disabled', false);
            if ($kec.prop('disabled')) $kec.prop('disabled', false);
        });
    });
</script>