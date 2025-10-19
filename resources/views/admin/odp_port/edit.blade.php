<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Edit Port ODP — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">
                Edit Port — ODP {{ $port->odp?->kode_odp ?? '—' }}
            </h1>
            <a href="{{ route('admin.odp.show', $port->odp_id) }}" class="btn btn-sm btn-outline-secondary">
                ← Kembali
            </a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

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
                <div class="mb-3 small">
                    <div>ODP:
                        <span class="fw-semibold">{{ $port->odp?->kode_odp ?? '—' }}</span>
                        @if($port->odp?->nama_odp) — {{ $port->odp->nama_odp }} @endif
                    </div>
                    <div>Port saat ini: <span class="fw-semibold">{{ $port->port_numb }}</span></div>
                </div>

                <form method="POST" action="{{ route('admin.odp_port.update', $port->id) }}" novalidate>
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Client (opsional)</label>
                            <select name="client_id" class="form-select @error('client_id') is-invalid @enderror">
                                <option value="">— tidak terhubung —</option>
                                @foreach($clients as $c)
                                <option value="{{ $c->id }}" {{ old('client_id', $port->client_id) === $c->id ? 'selected' : '' }}>
                                    {{ $c->nama }} — {{ $c->nopel }}
                                </option>
                                @endforeach
                            </select>
                            @error('client_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Nomor/Label Port <span class="text-danger">*</span></label>
                            <input name="port_numb" class="form-control @error('port_numb') is-invalid @enderror"
                                value="{{ old('port_numb', $port->port_numb) }}" required>
                            <div class="form-text">Boleh huruf/angka, underscore (_), minus (-), titik (.)</div>
                            @error('port_numb')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                @foreach(($statuses ?? ['available','reserved','active','faulty','blocked']) as $st)
                                <option value="{{ $st }}" {{ old('status', $port->status) === $st ? 'selected' : '' }}>
                                    {{ ucfirst($st) }}
                                </option>
                                @endforeach
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12 d-flex gap-2 pt-2">
                            <button class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('admin.odp.show', $port->odp_id) }}" class="btn btn-outline-secondary">Batal</a>
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