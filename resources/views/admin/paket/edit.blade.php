<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Edit Paket — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Edit Paket</h1>
            <a href="{{ route('admin.paket.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
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
                <form method="POST" action="{{ route('admin.paket.update', $paket->id) }}" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Paket <span class="text-danger">*</span></label>
                            <input name="nama_paket" class="form-control @error('nama_paket') is-invalid @enderror"
                                value="{{ old('nama_paket', $paket->nama_paket) }}" required>
                            @error('nama_paket')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Harga <span class="text-danger">*</span></label>
                            <input name="harga" class="form-control @error('harga') is-invalid @enderror"
                                value="{{ old('harga', $paket->harga) }}" required>
                            @error('harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Name Profile</label>
                            <input name="name_profile" class="form-control @error('name_profile') is-invalid @enderror"
                                value="{{ old('name_profile', $paket->name_profile) }}">
                            @error('name_profile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Limit Radius</label>
                            <input name="limit_radius" class="form-control @error('limit_radius') is-invalid @enderror"
                                value="{{ old('limit_radius', $paket->limit_radius) }}">
                            @error('limit_radius')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror"
                                placeholder="Catatan paket...">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12 d-flex gap-2 pt-2">
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.paket.index') }}" class="btn btn-outline-secondary">Batal</a>
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