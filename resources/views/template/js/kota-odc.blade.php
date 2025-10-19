<!-- JS (reusable) -->
<script>
    const KABUPATEN = @json($kabupatenRaw ?? []);
    const KECAMATAN = @json($kecamatanRaw ?? []);

    function renderOptions($select, items, nameKey = 'name', idKey = 'id', placeholder = '-- pilih --') {
        $select.empty().append(new Option(placeholder, ''));
        items.forEach(item => {
            const text = item?.[nameKey] ?? '';
            const opt = new Option(text, text, false, false); // value = name
            if (idKey && item?.[idKey]) opt.dataset.id = item[idKey];
            $select.append(opt);
        });
    }

    function initWilayahCascade({
        provSel,
        kabSel,
        kecSel,
        oldProv = '',
        oldKab = '',
        oldKec = ''
    }) {
        const $prov = $(provSel),
            $kab = $(kabSel),
            $kec = $(kecSel);

        // Optional: Select2 untuk kab & kec
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

        function filterKab(provId) {
            return KABUPATEN.filter(k => String(k.province_id) === String(provId));
        }

        function filterKec(regId) {
            return KECAMATAN.filter(kc => String(kc.regency_id) === String(regId));
        }

        $prov.on('change', function() {
            const provId = $('option:selected', this).data('id') || null;
            // reset kec
            $kec.val(null).trigger('change');
            $kec.prop('disabled', true).empty().append(new Option('-- pilih kecamatan --', ''));
            if (!provId) {
                $kab.val(null).trigger('change');
                $kab.prop('disabled', true).empty().append(new Option('-- pilih kabupaten/kota --', ''));
                return;
            }
            renderOptions($kab, filterKab(provId), 'name', 'id', '-- pilih kabupaten/kota --');
            $kab.prop('disabled', false).trigger('change');
        });

        $kab.on('change', function() {
            const regId = $('option:selected', this).data('id') || null;
            if (!regId) {
                $kec.val(null).trigger('change');
                $kec.prop('disabled', true).empty().append(new Option('-- pilih kecamatan --', ''));
                return;
            }
            renderOptions($kec, filterKec(regId), 'name', 'id', '-- pilih kecamatan --');
            $kec.prop('disabled', false);
        });

        // Restore old values (prov -> kab -> kec)
        if (oldProv) {
            const hasProv = $prov.find('option').filter((_, o) => o.value === oldProv).length > 0;
            if (hasProv) $prov.val(oldProv);
            $prov.trigger('change');
            if (oldKab) {
                setTimeout(() => {
                    const hasKab = $kab.find('option').filter((_, o) => o.value === oldKab).length > 0;
                    if (hasKab) $kab.val(oldKab).trigger('change');
                    if (oldKec) {
                        setTimeout(() => {
                            const hasKec = $kec.find('option').filter((_, o) => o.value === oldKec).length > 0;
                            if (hasKec) $kec.val(oldKec).trigger('change');
                        }, 0);
                    }
                }, 0);
            }
        } else {
            $kab.prop('disabled', true);
            $kec.prop('disabled', true);
        }

        // pastikan tidak disabled saat submit
        $('form').on('submit', function() {
            if ($kab.prop('disabled')) $kab.prop('disabled', false);
            if ($kec.prop('disabled')) $kec.prop('disabled', false);
        });
    }

    // PANGGIL sesuai form ODC:
    $(function() {
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