<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Tambah ODP — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <!-- (Opsional) Theme Bootstrap 5 untuk Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Tambah ODP</h1>
            <a href="{{ route('admin.odp.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
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

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.odp.store') }}" novalidate>
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Kode ODP <span class="text-danger">*</span></label>
                            <input name="kode_odp" type="text" class="form-control @error('kode_odp') is-invalid @enderror"
                                value="{{ old('kode_odp') }}" required placeholder="ODP-XXX-001">
                            @error('kode_odp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Nama ODP</label>
                            <input name="nama_odp" type="text" class="form-control @error('nama_odp') is-invalid @enderror"
                                value="{{ old('nama_odp') }}">
                            @error('nama_odp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Server (POP)</label>
                            <select name="server_id" class="form-select @error('server_id') is-invalid @enderror">
                                <option value="">-- pilih server --</option>
                                @foreach ($servers ?? [] as $sv)
                                <option value="{{ $sv->id }}" {{ old('server_id')===$sv->id ? 'selected' : '' }}>
                                    {{ $sv->nama_pop }}{{ $sv->ip_public ? ' — '.$sv->ip_public : '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('server_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="form-text">Opsional. Menghubungkan ODP ini ke server/POP tertentu.</div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Lokasi (lat,long / deskripsi)</label>
                            <input name="loc_odp" type="text" class="form-control @error('loc_odp') is-invalid @enderror"
                                value="{{ old('loc_odp') }}" placeholder="-6.xxxx,106.xxxx">
                            @error('loc_odp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                value="{{ old('alamat') }}">
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="provinsi">Provinsi</label>
                            <select id="provinsi" name="prov" class="form-select @error('prov') is-invalid @enderror">
                                <option value="">-- pilih provinsi --</option>
                                @foreach(($provinsiRaw ?? []) as $p)
                                {{-- value = NAMA (disimpan ke DB), data-id untuk filter --}}
                                <option value="{{ $p['name'] ?? '' }}"
                                    data-id="{{ $p['id'] ?? '' }}"
                                    {{ old('prov') === ($p['name'] ?? '') ? 'selected' : '' }}>
                                    {{ $p['name'] ?? '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('prov')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="kota">Kota/Kab</label>
                            <select id="kota" name="kota" class="form-select @error('kota') is-invalid @enderror" disabled>
                                <option value="">-- pilih kota/kabupaten --</option>
                            </select>
                            @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="kecamatan">Kecamatan</label>
                            <select id="kecamatan" name="kec" class="form-select @error('kec') is-invalid @enderror" disabled>
                                <option value="">-- pilih kecamatan --</option>
                            </select>
                            @error('kec')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>



                        <div class="col-md-3">
                            <label class="form-label">Desa/Kel.</label>
                            <input name="desa" type="text" class="form-control @error('desa') is-invalid @enderror"
                                value="{{ old('desa') }}">
                            @error('desa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Port Capacity</label>
                            <input name="port_cap" type="text" class="form-control @error('port_cap') is-invalid @enderror"
                                value="{{ old('port_cap') }}" placeholder="8 / 16 / 24">
                            @error('port_cap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Port Installed</label>
                            <input name="port_install" type="text" class="form-control @error('port_install') is-invalid @enderror"
                                value="{{ old('port_install') }}" placeholder="0..N">
                            @error('port_install')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- vlan -->
                        <div class="col-md-3">
                            <label class="form-label">VLAN</label>
                            <input name="vlan" type="text" class="form-control @error('vlan') is-invalid @enderror"
                                value="{{ old('vlan') }}" placeholder="VLAN:10,20...">
                            @error('vlan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Warna Core</label>
                            <input name="warna_core" type="text" class="form-control @error('warna_core') is-invalid @enderror"
                                value="{{ old('warna_core') }}" placeholder="Blue/Orange/Green...">
                            @error('warna_core')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Core Cable</label>
                            <input name="core_cable" type="text" class="form-control @error('core_cable') is-invalid @enderror"
                                value="{{ old('core_cable') }}" placeholder="12C / 24C / 48C">
                            @error('core_cable')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Catatan</label>
                            <textarea name="note" rows="3" class="form-control @error('note') is-invalid @enderror"
                                placeholder="Catatan tambahan...">{{ old('note') }}</textarea>
                            @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12 d-flex gap-2 pt-2">
                            <button class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.odp.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery (wajib untuk Select2) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @include('template.js.kota-odp')

</body>

</html>