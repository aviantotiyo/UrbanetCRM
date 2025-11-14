<script>
    document.addEventListener("DOMContentLoaded", function() {
        const kabupatenRaw = @json($kabupatenRaw);
        const kecamatanRaw = @json($kecamatanRaw);
        const provinsiRaw = @json($provinsiRaw);

        const selectProvinsi = document.getElementById("provinsi_pel");
        const selectKabupaten = document.getElementById("kabupaten_pel");
        const selectKecamatan = document.getElementById("kecamatan_pel");

        const selectedKabupaten = selectKabupaten.dataset.selected;
        const selectedKecamatan = selectKecamatan.dataset.selected;

        // ------ MAP PROVINSI NAME → ID ------
        const mapProvNameToId = {};
        provinsiRaw.forEach(p => {
            mapProvNameToId[p.name] = p.id;
        });

        // ------ MAP KABUPATEN NAME → ID ------
        const mapKabNameToId = {};
        kabupatenRaw.forEach(k => {
            mapKabNameToId[k.name] = k.id;
        });


        // ------------------------------
        // LOAD KABUPATEN BERDASARKAN PROVINSI
        // ------------------------------
        function updateKabupaten(provName) {
            selectKabupaten.innerHTML = '<option value="">-- pilih kabupaten --</option>';
            selectKecamatan.innerHTML = '<option value="">-- pilih kecamatan --</option>';

            const provId = mapProvNameToId[provName];
            if (!provId) return;

            const filteredKab = kabupatenRaw.filter(item => item.province_id == provId);

            filteredKab.forEach(item => {
                const opt = document.createElement("option");
                opt.value = item.name;
                opt.textContent = item.name;

                if (item.name === selectedKabupaten) opt.selected = true;
                selectKabupaten.appendChild(opt);
            });

            // Auto-load kecamatan jika editing data
            if (selectedKabupaten) {
                updateKecamatan(selectedKabupaten);
            }
        }

        // ------------------------------
        // LOAD KECAMATAN BERDASARKAN KABUPATEN
        // ------------------------------
        function updateKecamatan(kabName) {
            selectKecamatan.innerHTML = '<option value="">-- pilih kecamatan --</option>';

            const kabId = mapKabNameToId[kabName];
            if (!kabId) return;

            const filteredKec = kecamatanRaw.filter(item => item.regency_id == kabId);

            filteredKec.forEach(item => {
                const opt = document.createElement("option");
                opt.value = item.name;
                opt.textContent = item.name;

                if (item.name === selectedKecamatan) opt.selected = true;
                selectKecamatan.appendChild(opt);
            });
        }

        // ------------------------------
        // TRIGGER AWAL (edit mode)
        // ------------------------------
        if (selectProvinsi.value) {
            updateKabupaten(selectProvinsi.value);
        }

        // Trigger ketika user ganti provinsi
        selectProvinsi.addEventListener("change", function() {
            updateKabupaten(this.value);
        });

        // Trigger ketika user ganti kabupaten
        selectKabupaten.addEventListener("change", function() {
            updateKecamatan(this.value);
        });
    });
</script>