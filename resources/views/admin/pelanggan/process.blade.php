<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Proses Pelanggan — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">

                {{-- Flash success/error --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="h5 mb-3">Proses Pelanggan</h1>

                        {{-- Data statis pelanggan --}}
                        <div class="mb-3">
                            <div class="text-muted small">No. Pelanggan</div>
                            <div class="fw-semibold">{{ $client->nopel }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Nama</div>
                            <div class="fw-semibold">{{ $client->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">No HP</div>
                            <div class="fw-semibold">{{ $client->no_hp ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Email</div>
                            <div class="fw-semibold">{{ $client->email ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">NIK</div>
                            <div class="fw-semibold">{{ $client->nik ?: '—' }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-muted small">Alamat</div>
                            <div class="fw-semibold">{{ $client->alamat ?: '—' }}</div>
                        </div>

                        <hr>

                        {{-- Form proses pemasangan --}}
                        <form method="POST" action="{{ route('admin.pelanggan.process.store', $client->id) }}" novalidate>
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Pilih ODP <span class="text-danger">*</span></label>
                                    <select id="select-odp" name="odp_id" class="form-select @error('odp_id') is-invalid @enderror" required>
                                        <option value="">-- pilih ODP --</option>
                                        @foreach($odps as $o)
                                        <option value="{{ $o->id }}"
                                            {{ old('odp_id', $client->odp_id) === $o->id ? 'selected' : '' }}>
                                            {{ $o->kode_odp }}{{ $o->nama_odp ? ' — '.$o->nama_odp : '' }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('odp_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Pilih Port <span class="text-danger">*</span></label>
                                    <select id="select-port" name="odp_port_id" class="form-select @error('odp_port_id') is-invalid @enderror" required>
                                        <option value="">-- pilih port --</option>
                                        {{-- opsi akan diisi via JS berdasarkan ODP --}}
                                    </select>
                                    @error('odp_port_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    <div class="form-text">Hanya port dengan status <b>available</b> yang ditampilkan.</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Promo / Day</label>
                                    <input type="number" min="0" name="promo_day" class="form-control" placeholder="Contoh: 5">
                                    <div class="form-text">Masukkan jumlah hari promo. 0 = tanpa promo.</div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-4">
                                <button class="btn btn-primary">Simpan</button>
                                <a class="btn btn-outline-secondary" href="{{ route('admin.pelanggan.show', $client->id) }}">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center small text-muted mt-3 mb-0">UrbanetCRM</p>
            </div>
        </div>
    </div>

    @include('template.js.process-pelanggan')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>