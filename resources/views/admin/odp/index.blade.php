<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Daftar ODP — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Daftar ODP</h1>
            <a href="{{ route('admin.odp.create') }}" class="btn btn-sm btn-primary">+ Tambah ODP</a>
        </div>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Kode ODP</th>
                                <th>Nama ODP</th>
                                <th>Lokasi</th>
                                <th>Port (Cap/Install)</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($odps as $i => $o)
                            <tr>
                                <td>{{ $odps->firstItem() + $i }}</td>
                                <td class="fw-semibold"><a href="{{ route('admin.odp.show', $o->id) }}">{{ $o->kode_odp }}</a></td>
                                <td>{{ $o->nama_odp ?? '—' }}</td>
                                <td class="small text-muted">
                                    {{ $o->desa ?? '—' }}, {{ $o->kec ?? '—' }}, {{ $o->kota ?? '—' }}, {{ $o->prov ?? '—' }}
                                </td>
                                <td>{{ $o->port_cap ?? '0' }}/{{ $o->port_install ?? '0' }}</td>
                                <td class="small text-muted">{{ $o->created_at?->format('Y-m-d H:i') ?? '—' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada data ODP.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    {{ $odps->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>