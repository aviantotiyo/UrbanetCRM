<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Edit Port ODC — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Edit Port — ODC {{ $port->odc?->kode_odc ?? '—' }}</h1>
            <a href="{{ route('admin.odc.show', $port->odc_id) }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
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
                    <div>ODC:
                        <span class="fw-semibold">{{ $port->odc?->kode_odc ?? '—' }}</span>
                        @if($port->odc?->nama_odc) — {{ $port->odc->nama_odc }} @endif
                    </div>
                    <div>Port saat ini: <span class="fw-semibold">{{ $port->port_numb }}</span></div>
                </div>

                <form method="POST" action="{{ route('admin.odc_port.update', $port->id) }}" novalidate>
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">ODP (tujuan)</label>
                            <select name="odp_id" class="form-select @error('odp_id') is-invalid @enderror" required>
                                <option value="">-- pilih ODP --</option>
                                @foreach($odps as $o)
                                <option value="{{ $o->id }}"
                                    {{ old('odp_id', $port->odp_id) === $o->id ? 'selected' : '' }}>
                                    {{ $o->kode_odp }}{{ $o->nama_odp ? ' — '.$o->nama_odp : '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('odp_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                <option value="{{ $st }}" {{ old('status', $port->status)===$st ? 'selected' : '' }}>
                                    {{ ucfirst($st) }}
                                </option>
                                @endforeach
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12 d-flex gap-2 pt-2">
                            <button class="btn btn-primary">Simpan Perubahan</button>
                            <a href="{{ route('admin.odc.show', $port->odc_id) }}" class="btn btn-outline-secondary">Batal</a>
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