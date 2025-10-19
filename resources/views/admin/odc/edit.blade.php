<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Edit ODC — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
</body>

</html>