<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Detail ODC — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Detail ODC</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.odc.edit', $odc->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <a href="{{ route('admin.odc.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="text-muted small">ID</div>
                            <div class="fw-semibold">{{ $odc->id }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Kode ODC</div>
                            <div class="fw-semibold">{{ $odc->kode_odc }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Nama ODC</div>
                            <div class="fw-semibold">{{ $odc->nama_odc ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Server / POP</div>
                            <div class="fw-semibold">
                                @if($odc->server)
                                {{ $odc->server->nama_pop }}
                                @if($odc->server->ip_public)
                                <span class="text-muted">— {{ $odc->server->ip_public }}</span>
                                @endif
                                @else
                                —
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Rasio</div>
                            <div class="fw-semibold">{{ $odc->rasio ?: '—' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="text-muted small">Port Capacity / Installed</div>
                            <div class="fw-semibold">{{ $odc->port_cap ?: '—' }} / {{ $odc->port_install ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Warna Core</div>
                            <div class="fw-semibold">{{ $odc->warna_core ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Core Cable</div>
                            <div class="fw-semibold">{{ $odc->core_cable ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Gambar</div>
                            <div class="fw-semibold">
                                @if($odc->image)
                                <a href="{{ $odc->image }}" target="_blank" class="text-decoration-none">Lihat gambar</a>
                                @else
                                —
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <div class="text-muted small">Catatan</div>
                            <div class="fw-semibold">{{ $odc->note ?: '—' }}</div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="small text-muted">
                    Dibuat: {{ $odc->created_at?->format('Y-m-d H:i') ?? '—' }} ·
                    Diubah: {{ $odc->updated_at?->format('Y-m-d H:i') ?? '—' }}
                </div>
            </div>
        </div>

        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h2 class="h6 mb-0">Daftar Port</h2>
                    <a href="{{ route('admin.odc_port.create', $odc->id) }}" class="btn btn-sm btn-primary">+ Tambah Port</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Port</th>
                                <th>Status</th>
                                <th>ODP Tujuan</th>
                                <th>Aksi</th> {{-- kolom baru --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($odc->ports as $i => $p)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td class="fw-semibold">{{ $p->port_numb }}</td>
                                <td>{{ ucfirst($p->status) }}</td>
                                <td>
                                    @if($p->odp)
                                    <a href="{{ route('admin.odp.show', $p->odp->id) }}" class="text-decoration-none">
                                        <span class="fw-semibold">{{ $p->odp->kode_odp }}</span>
                                        @if($p->odp->nama_odp)
                                        <span class="text-muted"> — {{ $p->odp->nama_odp }}</span>
                                        @endif
                                    </a>
                                    @else
                                    <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.odc_port.edit', $p->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada port untuk ODC ini.</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>