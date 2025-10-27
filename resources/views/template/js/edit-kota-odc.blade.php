<script>
    // === Load JSON dari Blade ke JS ===
    const jsonKabupaten = @json($kabupatenRaw ?? []);
    const jsonKecamatan = @json($kecamatanRaw ?? []);
    const defaultKota = @json(old('kota', $odc->kota ?? ''));
    const defaultKec = @json(old('kec', $odc->kec ?? ''));

    document.addEventListener('DOMContentLoaded', function () {
        const selectProv = document.getElementById('prov_odc');
        const selectKota = document.getElementById('kota_odc');
        const selectKec = document.getElementById('kec_odc');

        // Populate kabupaten/kota saat provinsi dipilih
        selectProv.addEventListener('change', function () {
            const provId = selectProv.selectedOptions[0]?.dataset.id;
            const filteredKab = jsonKabupaten.filter(kab => kab.provinsi_id == provId);

            selectKota.innerHTML = '<option value="">-- pilih kabupaten/kota --</option>';
            filteredKab.forEach(kab => {
                const opt = document.createElement('option');
                opt.value = kab.name;
                opt.textContent = kab.name;
                opt.dataset.id = kab.id;
                selectKota.appendChild(opt);
            });

            // Reset kecamatan
            selectKec.innerHTML = '<option value="">-- pilih kecamatan --</option>';
        });

        // Populate kecamatan saat kabupaten dipilih
        selectKota.addEventListener('change', function () {
            const kabId = selectKota.selectedOptions[0]?.dataset.id;
            const filteredKec = jsonKecamatan.filter(kec => kec.kabupaten_id == kabId);

            selectKec.innerHTML = '<option value="">-- pilih kecamatan --</option>';
            filteredKec.forEach(kec => {
                const opt = document.createElement('option');
                opt.value = kec.name;
                opt.textContent = kec.name;
                selectKec.appendChild(opt);
            });
        });

        // Auto-populate saat halaman edit (default preselect)
        const triggerPreselect = () => {
            const selectedProv = selectProv.selectedOptions[0];
            if (selectedProv) {
                const provId = selectedProv.dataset.id;

                // Load kabupaten
                const filteredKab = jsonKabupaten.filter(kab => kab.provinsi_id == provId);
                selectKota.innerHTML = '<option value="">-- pilih kabupaten/kota --</option>';
                filteredKab.forEach(kab => {
                    const opt = document.createElement('option');
                    opt.value = kab.name;
                    opt.textContent = kab.name;
                    opt.dataset.id = kab.id;
                    if (kab.name === defaultKota) {
                        opt.selected = true;
                    }
                    selectKota.appendChild(opt);
                });

                // Load kecamatan
                const selectedKab = filteredKab.find(kab => kab.name === defaultKota);
                if (selectedKab) {
                    const filteredKec = jsonKecamatan.filter(kec => kec.kabupaten_id == selectedKab.id);
                    selectKec.innerHTML = '<option value="">-- pilih kecamatan --</option>';
                    filteredKec.forEach(kec => {
                        const opt = document.createElement('option');
                        opt.value = kec.name;
                        opt.textContent = kec.name;
                        if (kec.name === defaultKec) {
                            opt.selected = true;
                        }
                        selectKec.appendChild(opt);
                    });
                }
            }
        };

        triggerPreselect();
    });
</script>
