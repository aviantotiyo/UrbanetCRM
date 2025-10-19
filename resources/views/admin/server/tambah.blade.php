<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Tambah Server — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Tambah Server</h1>
            <a href="{{ route('admin.server.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
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
                <form method="POST" action="{{ route('admin.server.store') }}" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama POP <span class="text-danger">*</span></label>
                            <input name="nama_pop" class="form-control @error('nama_pop') is-invalid @enderror"
                                value="{{ old('nama_pop') }}" required>
                            @error('nama_pop')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Lokasi</label>
                            <input name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                                value="{{ old('lokasi') }}" placeholder="Alamat/Deskripsi lokasi">
                            @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">IP Public</label>
                            <input name="ip_public" class="form-control @error('ip_public') is-invalid @enderror"
                                value="{{ old('ip_public') }}" placeholder="x.x.x.x">
                            @error('ip_public')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">IP Static</label>
                            <input name="ip_static" class="form-control @error('ip_static') is-invalid @enderror"
                                value="{{ old('ip_static') }}" placeholder="x.x.x.x">
                            @error('ip_static')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">User <span class="text-danger">*</span></label>
                            <input name="user" class="form-control @error('user') is-invalid @enderror"
                                value="{{ old('user') }}" required>
                            @error('user')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input name="password" type="text"
                                class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12 d-flex gap-2 pt-2">
                            <button class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.server.index') }}" class="btn btn-outline-secondary">Batal</a>
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