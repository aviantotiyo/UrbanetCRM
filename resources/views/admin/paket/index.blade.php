<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Data Paket — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Data Paket</h1>
            <a href="{{ route('admin.paket.create') }}" class="btn btn-sm btn-primary">+ Tambah Paket</a>
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
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Profile / Limit</th>
                                <th>Deskripsi</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pakets as $i => $p)
                            <tr>
                                <td>{{ $pakets->firstItem() + $i }}</td>
                                <td class="fw-semibold">{{ $p->nama_paket }}</td>
                                <td>{{ $p->harga }}</td>
                                <td>{{ $p->name_profile ?: '—' }} / {{ $p->limit_radius ?: '—' }}</td>
                                <td class="small text-muted">{{ $p->deskripsi ?: '—' }}</td>
                                <td class="small text-muted">{{ $p->created_at?->format('Y-m-d H:i') ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('admin.paket.edit', $p->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada paket.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">{{ $pakets->links() }}</div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>