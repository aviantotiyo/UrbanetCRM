<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Detail ODP — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Detail ODP</h1>
            <a href="{{ route('admin.odp.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <div class="text-muted small">ID</div>
                            <div class="fw-semibold">{{ $odp->id }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Kode ODP</div>
                            <div class="fw-semibold">{{ $odp->kode_odp }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Nama ODP</div>
                            <div class="fw-semibold">{{ $odp->nama_odp ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Alamat</div>
                            <div class="fw-semibold">{{ $odp->alamat ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Provinsi / Kota / Kec / Desa</div>
                            <div class="fw-semibold">
                                {{ $odp->prov ?: '—' }} /
                                {{ $odp->kota ?: '—' }} /
                                {{ $odp->kec ?: '—' }} /
                                {{ $odp->desa ?: '—' }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Lokasi (lat,long / deskripsi)</div>
                            <div class="fw-semibold">{{ $odp->loc_odp ?: '—' }}</div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <div class="text-muted small">Server / POP</div>
                            <div class="fw-semibold">
                                @if($odp->server)
                                {{ $odp->server->nama_pop }}
                                @if($odp->server->ip_public)
                                <span class="text-muted">— {{ $odp->server->ip_public }}</span>
                                @endif
                                @else
                                —
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small">Port Capacity</div>
                            <div class="fw-semibold">{{ $odp->port_cap ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Port Installed</div>
                            <div class="fw-semibold">{{ $odp->port_install ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">VLAN</div>
                            <div class="fw-semibold">{{ $odp->vlan ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Warna Core</div>
                            <div class="fw-semibold">{{ $odp->warna_core ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Core Cable</div>
                            <div class="fw-semibold">{{ $odp->core_cable ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Catatan</div>
                            <div class="fw-semibold">{{ $odp->note ?: '—' }}</div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="small text-muted">
                    Dibuat: {{ $odp->created_at?->format('Y-m-d H:i') ?? '—' }} ·
                    Diubah: {{ $odp->updated_at?->format('Y-m-d H:i') ?? '—' }}
                </div>
            </div>
        </div>

        {{-- ===== Daftar Port pada ODP ini ===== --}}
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="h6 mb-0">Port ODP</h2>
                    <a href="{{ route('admin.odp_port.create', $odp->id) }}" class="btn btn-sm btn-primary">
                        + Tambah Port
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Port</th>
                                <th>Status</th>
                                <th>Client</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ports as $i => $p)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td class="fw-semibold">{{ $p->port_numb }}</td>
                                <td>
                                    @php
                                    $badge = match($p->status) {
                                    'active' => 'success',
                                    'reserved' => 'info',
                                    'faulty' => 'warning',
                                    'blocked' => 'secondary',
                                    default => 'light',
                                    };
                                    @endphp
                                    <span class="badge text-bg-{{ $badge }}">{{ $p->status }}</span>
                                </td>
                                <td>
                                    @if($p->client)
                                    {{-- Kalau kamu punya route detail client: admin.pelanggan.show --}}
                                    <a href="{{ route('admin.pelanggan.show', $p->client->id) }}">
                                        {{ $p->client->nopel }} — {{ $p->client->nama }}
                                    </a>
                                    @else
                                    <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="small text-muted">{{ $p->created_at?->format('Y-m-d H:i') ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('admin.odp_port.edit', $p->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada port pada ODP ini.</td>
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