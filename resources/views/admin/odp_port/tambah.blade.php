<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Tambah Port ODP — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Tambah Port untuk ODP: <span class="text-primary">{{ $odp->kode_odp }}</span></h1>
            <a href="{{ route('admin.odp.show', $odp->id) }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
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
                <form method="POST" action="{{ route('admin.odp_port.store', $odp->id) }}" novalidate>
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nomor Port <span class="text-danger">*</span></label>
                            <input name="port_numb" type="text"
                                class="form-control @error('port_numb') is-invalid @enderror"
                                value="{{ old('port_numb') }}" required placeholder="1">
                            @error('port_numb')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="form-text">Unik per ODP. Contoh: 1, 2, 3, ...</div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Client (opsional)</label>
                            <select name="client_id" class="form-select @error('client_id') is-invalid @enderror">
                                <option value="">— Tanpa client —</option>
                                @foreach ($clients as $c)
                                <option value="{{ $c->id }}" {{ old('client_id')===$c->id ? 'selected' : '' }}>
                                    {{ $c->nopel }} — {{ $c->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('client_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            @php
                            $statuses = ['available','reserved','active','faulty','blocked'];
                            $oldStatus = old('status', 'available');
                            @endphp
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                @foreach ($statuses as $s)
                                <option value="{{ $s }}" {{ $oldStatus===$s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12 d-flex gap-2 pt-2">
                            <button class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.odp.show', $odp->id) }}" class="btn btn-outline-secondary">Batal</a>
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