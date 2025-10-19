<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Tambah ODC — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Tambah ODC</h1>
            <a href="{{ route('admin.odc.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa input:</strong>
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.odc.store') }}" novalidate>
            @csrf

            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Server (POP)</label>
                            <select name="server_id" class="form-select @error('server_id') is-invalid @enderror">
                                <option value="">— pilih server —</option>
                                @foreach($servers as $s)
                                <option value="{{ $s->id }}" {{ old('server_id')===$s->id ? 'selected' : '' }}>
                                    {{ $s->nama_pop }} — {{ $s->ip_public }}
                                </option>
                                @endforeach
                            </select>
                            @error('server_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Kode ODC <span class="text-danger">*</span></label>
                            <input name="kode_odc" class="form-control @error('kode_odc') is-invalid @enderror"
                                value="{{ old('kode_odc') }}" required>
                            @error('kode_odc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Nama ODC</label>
                            <input name="nama_odc" class="form-control @error('nama_odc') is-invalid @enderror"
                                value="{{ old('nama_odc') }}">
                            @error('nama_odc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h6 class="mb-3">Lokasi</h6>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <input name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                value="{{ old('alamat') }}" placeholder="Alamat lengkap ODC">
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="prov_odc">Provinsi</label>
                            <select id="prov_odc" name="prov" class="form-select @error('prov') is-invalid @enderror">
                                <option value="">-- pilih provinsi --</option>
                                @foreach($provinsiRaw ?? [] as $pv)
                                @php $pvName = $pv['name'] ?? ''; @endphp
                                <option value="{{ $pvName }}" data-id="{{ $pv['id'] ?? '' }}"
                                    {{ old('prov')===$pvName ? 'selected' : '' }}>
                                    {{ $pvName }}
                                </option>
                                @endforeach
                            </select>
                            @error('prov')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="kota_odc">Kota/Kab</label>
                            <select id="kota_odc" name="kota" class="form-select @error('kota') is-invalid @enderror">
                                <option value="">-- pilih kabupaten/kota --</option>
                            </select>
                            @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="kec_odc">Kecamatan</label>
                            <select id="kec_odc" name="kec" class="form-select @error('kec') is-invalid @enderror">
                                <option value="">-- pilih kecamatan --</option>
                            </select>
                            @error('kec')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Desa</label>
                            <input name="desa" class="form-control @error('desa') is-invalid @enderror"
                                value="{{ old('desa') }}">
                            @error('desa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Lokasi (desc / lat,long)</label>
                            <input name="loc_odp" class="form-control @error('loc_odp') is-invalid @enderror"
                                value="{{ old('loc_odp') }}" placeholder="-6.xxx,106.xxx / titik landasan">
                            @error('loc_odp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Lat</label>
                            <input name="lat" class="form-control @error('lat') is-invalid @enderror"
                                value="{{ old('lat') }}" placeholder="-6.2">
                            @error('lat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Long</label>
                            <input name="long" class="form-control @error('long') is-invalid @enderror"
                                value="{{ old('long') }}" placeholder="106.8">
                            @error('long')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h6 class="mb-3">Spesifikasi</h6>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Port Capacity</label>
                            <input name="port_cap" class="form-control @error('port_cap') is-invalid @enderror"
                                value="{{ old('port_cap') }}">
                            @error('port_cap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Port Installed</label>
                            <input name="port_install" class="form-control @error('port_install') is-invalid @enderror"
                                value="{{ old('port_install') }}">
                            @error('port_install')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Rasio</label>
                            <input name="rasio" class="form-control @error('rasio') is-invalid @enderror"
                                value="{{ old('rasio') }}">
                            @error('rasio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Warna Core</label>
                            <input name="warna_core" class="form-control @error('warna_core') is-invalid @enderror"
                                value="{{ old('warna_core') }}">
                            @error('warna_core')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Core Cable</label>
                            <input name="core_cable" class="form-control @error('core_cable') is-invalid @enderror"
                                value="{{ old('core_cable') }}">
                            @error('core_cable')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-9">
                            <label class="form-label">Catatan</label>
                            <textarea name="note" rows="2" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                            @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Image (URL / path)</label>
                            <input name="image" class="form-control @error('image') is-invalid @enderror"
                                value="{{ old('image') }}">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.odc.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>

    <!-- jQuery & Select2 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>

    <script>
        // Data JSON dari controller
        const KABUPATEN = @json($kabupatenRaw ?? []);
        const KECAMATAN = @json($kecamatanRaw ?? []);

        function renderOptions($select, items, nameKey = 'name', idKey = 'id') {
            $select.empty().append(new Option('-- pilih --', ''));
            items.forEach(item => {
                const text = item?.[nameKey] ?? '';
                const opt = new Option(text, text, false, false); // value = name
                if (idKey && item?.[idKey]) opt.dataset.id = item[idKey];
                $select.append(opt);
            });
        }

        $(function() {
            const $prov = $('#prov_odc');
            const $kota = $('#kota_odc');
            const $kec = $('#kec_odc');

            // Select2 utk kota & kec
            $kota.select2({
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

            const oldProv = @json(old('prov'));
            const oldKota = @json(old('kota'));
            const oldKec = @json(old('kec'));

            // Prov change → filter kab
            $prov.on('change', function() {
                const provId = $('option:selected', this).data('id') || null;

                // reset kec
                $kec.val(null).trigger('change');
                $kec.prop('disabled', true).empty().append(new Option('-- pilih kecamatan --', ''));

                if (!provId) {
                    $kota.val(null).trigger('change');
                    $kota.prop('disabled', true).empty().append(new Option('-- pilih kabupaten/kota --', ''));
                    return;
                }

                const filteredKab = KABUPATEN.filter(k => String(k.province_id) === String(provId));
                renderOptions($kota, filteredKab, 'name', 'id');
                $kota.prop('disabled', false).trigger('change');
            });

            // Kab change → filter kec
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
            });

            // Restore (prov → kota → kec)
            if (oldProv) {
                const hasProv = $prov.find('option').filter((_, opt) => opt.value === oldProv).length > 0;
                if (hasProv) $prov.val(oldProv);
                $prov.trigger('change');

                if (oldKota) {
                    setTimeout(() => {
                        const hasKota = $kota.find('option').filter((_, opt) => opt.value === oldKota).length > 0;
                        if (hasKota) $kota.val(oldKota).trigger('change');

                        if (oldKec) {
                            setTimeout(() => {
                                const hasKec = $kec.find('option').filter((_, opt) => opt.value === oldKec).length > 0;
                                if (hasKec) $kec.val(oldKec).trigger('change');
                            }, 0);
                        }
                    }, 0);
                }
            } else {
                $kota.prop('disabled', true);
                $kec.prop('disabled', true);
            }

            // Pastikan tidak disabled saat submit
            $('form').on('submit', function() {
                if ($kota.prop('disabled')) $kota.prop('disabled', false);
                if ($kec.prop('disabled')) $kec.prop('disabled', false);
            });
        });
    </script>
</body>

</html>