<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Edit ODC — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Edit ODC</h1>
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

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.odc.update', $odc->id) }}" novalidate>
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Server (POP)</label>
                            <select name="server_id" class="form-select @error('server_id') is-invalid @enderror">
                                <option value="">-- pilih server --</option>
                                @foreach($servers as $sv)
                                <option value="{{ $sv->id }}" {{ old('server_id', $odc->server_id) == $sv->id ? 'selected' : '' }}>
                                    {{ $sv->nama_pop }}{{ $sv->ip_public ? ' — '.$sv->ip_public : '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('server_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Kode ODC <span class="text-danger">*</span></label>
                            <input name="kode_odc" class="form-control @error('kode_odc') is-invalid @enderror"
                                value="{{ old('kode_odc', $odc->kode_odc) }}" required>
                            @error('kode_odc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Nama ODC</label>
                            <input name="nama_odc" class="form-control @error('nama_odc') is-invalid @enderror"
                                value="{{ old('nama_odc', $odc->nama_odc) }}">
                            @error('nama_odc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- ===== Lokasi ===== --}}
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <input name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                value="{{ old('alamat', $odc->alamat) }}" placeholder="Alamat lengkap ODC">
                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="prov_odc">Provinsi</label>
                            <select id="prov_odc" name="prov" class="form-select @error('prov') is-invalid @enderror">
                                <option value="">-- pilih provinsi --</option>
                                @foreach($provinsiRaw ?? [] as $pv)
                                @php $pvName = $pv['name'] ?? ''; @endphp
                                <option value="{{ $pvName }}" data-id="{{ $pv['id'] ?? '' }}"
                                    {{ old('prov', $odc->prov) === $pvName ? 'selected' : '' }}>
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
                                {{-- opsi diisi via JS berdasarkan prov --}}
                            </select>
                            @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="kec_odc">Kecamatan</label>
                            <select id="kec_odc" name="kec" class="form-select @error('kec') is-invalid @enderror">
                                <option value="">-- pilih kecamatan --</option>
                                {{-- opsi diisi via JS berdasarkan kab --}}
                            </select>
                            @error('kec')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Desa</label>
                            <input name="desa" class="form-control @error('desa') is-invalid @enderror"
                                value="{{ old('desa', $odc->desa) }}">
                            @error('desa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Lokasi (desc / lat,long)</label>
                            <input name="loc_odp" class="form-control @error('loc_odp') is-invalid @enderror"
                                value="{{ old('loc_odp', $odc->loc_odp) }}" placeholder="-6.xxx,106.xxx / titik">
                            @error('loc_odp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Lat</label>
                            <input name="lat" class="form-control @error('lat') is-invalid @enderror"
                                value="{{ old('lat', $odc->lat) }}" placeholder="-6.2">
                            @error('lat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-2">
                            <label class="form-label">Long</label>
                            <input name="long" class="form-control @error('long') is-invalid @enderror"
                                value="{{ old('long', $odc->long) }}" placeholder="106.8">
                            @error('long')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Port Capacity</label>
                            <input name="port_cap" class="form-control @error('port_cap') is-invalid @enderror"
                                value="{{ old('port_cap', $odc->port_cap) }}">
                            @error('port_cap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Port Installed</label>
                            <input name="port_install" class="form-control @error('port_install') is-invalid @enderror"
                                value="{{ old('port_install', $odc->port_install) }}">
                            @error('port_install')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Rasio</label>
                            <input name="rasio" class="form-control @error('rasio') is-invalid @enderror"
                                value="{{ old('rasio', $odc->rasio) }}" placeholder="mis: 1:4">
                            @error('rasio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Image (URL / path)</label>
                            <input name="image" class="form-control @error('image') is-invalid @enderror"
                                value="{{ old('image', $odc->image) }}">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Warna Core</label>
                            <input name="warna_core" class="form-control @error('warna_core') is-invalid @enderror"
                                value="{{ old('warna_core', $odc->warna_core) }}">
                            @error('warna_core')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Core Cable</label>
                            <input name="core_cable" class="form-control @error('core_cable') is-invalid @enderror"
                                value="{{ old('core_cable', $odc->core_cable) }}">
                            @error('core_cable')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Catatan</label>
                            <textarea name="note" rows="3" class="form-control @error('note') is-invalid @enderror"
                                placeholder="Catatan ODC...">{{ old('note', $odc->note) }}</textarea>
                            @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12 d-flex gap-2 pt-2">
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.odc.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>
    @include('template.js.kota-odc')
</body>

</html>