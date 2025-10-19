<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Data Server — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Data Server</h1>
            <a href="{{ route('admin.server.create') }}" class="btn btn-sm btn-primary">+ Tambah Server</a>
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
                                <th>Nama POP</th>
                                <th>Lokasi</th>
                                <th>IP Public</th>
                                <th>IP Static</th>
                                <th>User</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($servers as $i => $s)
                            <tr>
                                <td>{{ $servers->firstItem() + $i }}</td>
                                <td class="fw-semibold">{{ $s->nama_pop }}</td>
                                <td class="small text-muted">{{ $s->lokasi ?: '—' }}</td>
                                <td>{{ $s->ip_public ?: '—' }}</td>
                                <td>{{ $s->ip_static ?: '—' }}</td>
                                <td>{{ $s->user }}</td>
                                <td class="small text-muted">{{ $s->created_at?->format('Y-m-d H:i') ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('admin.server.edit', $s->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada server.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $servers->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>