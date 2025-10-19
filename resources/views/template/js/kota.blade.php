<script>
    // Data mentah dari controller
    const KABUPATEN_PEL = @json($kabupatenRaw ?? []);
    const KECAMATAN_PEL = @json($kecamatanRaw ?? []);

    function renderOptions($select, items, nameKey = 'name', idKey = 'id') {
        $select.empty().append(new Option('-- pilih --', ''));
        items.forEach(item => {
            const text = item?.[nameKey] ?? '';
            const value = text; // yang disimpan ke DB adalah NAMA
            const opt = new Option(text, value, false, false);
            if (idKey && item?.[idKey]) opt.dataset.id = item[idKey];
            $select.append(opt);
        });
    }

    $(function() {
        const $prov = $('#provinsi_pel');
        const $kab = $('#kabupaten_pel');
        const $kec = $('#kecamatan_pel');

        // Init Select2 untuk kab/kec
        $kab.select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: '-- pilih kabupaten/kota --',
            allowClear: true
        });
        $kec.select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: '-- pilih kecamatan --',
            allowClear: true
        });

        if ($kab.hasClass('is-invalid')) $kab.next('.select2').find('.select2-selection').addClass('is-invalid');
        if ($kec.hasClass('is-invalid')) $kec.next('.select2').find('.select2-selection').addClass('is-invalid');

        const oldProv = @json(old('provinsi'));
        const oldKab = @json(old('kabupaten'));
        const oldKec = @json(old('kecamatan'));

        // Provinsi -> filter kabupaten
        $prov.on('change', function() {
            const provId = $('option:selected', this).data('id') || null;

            // reset kecamatan
            $kec.val(null).trigger('change');
            $kec.prop('disabled', true).empty().append(new Option('-- pilih kecamatan --', ''));

            if (!provId) {
                $kab.val(null).trigger('change');
                $kab.prop('disabled', true).empty().append(new Option('-- pilih kabupaten/kota --', ''));
                return;
            }

            const filteredKab = KABUPATEN_PEL.filter(k => String(k.province_id) === String(provId));
            renderOptions($kab, filteredKab, 'name', 'id');
            $kab.prop('disabled', false);
            $kab.trigger('change'); // panggil handler kabupaten -> kecamatan
        });

        // Kabupaten -> filter kecamatan
        $kab.on('change', function() {
            const regId = $('option:selected', this).data('id') || null;

            if (!regId) {
                $kec.val(null).trigger('change');
                $kec.prop('disabled', true).empty().append(new Option('-- pilih kecamatan --', ''));
                return;
            }

            const filteredKec = KECAMATAN_PEL.filter(kc => String(kc.regency_id) === String(regId));
            renderOptions($kec, filteredKec, 'name', 'id');
            $kec.prop('disabled', false);
            // user pilih manual kecamatan; tidak auto-select
        });

        // Restore old values berurutan
        if (oldProv) {
            const hasProv = $prov.find('option').filter((_, opt) => opt.value === oldProv).length > 0;
            if (hasProv) $prov.val(oldProv);
            $prov.trigger('change');

            if (oldKab) {
                setTimeout(() => {
                    const hasKab = $kab.find('option').filter((_, opt) => opt.value === oldKab).length > 0;
                    if (hasKab) $kab.val(oldKab).trigger('change');

                    if (oldKec) {
                        setTimeout(() => {
                            const hasKec = $kec.find('option').filter((_, opt) => opt.value === oldKec).length > 0;
                            if (hasKec) $kec.val(oldKec).trigger('change');
                        }, 0);
                    }
                }, 0);
            }
        } else {
            $kab.prop('disabled', true);
            $kec.prop('disabled', true);
        }

        // pastikan tidak disabled saat submit agar terkirim ke server
        $('form').on('submit', function() {
            if ($kab.prop('disabled')) $kab.prop('disabled', false);
            if ($kec.prop('disabled')) $kec.prop('disabled', false);
        });
    });
</script>