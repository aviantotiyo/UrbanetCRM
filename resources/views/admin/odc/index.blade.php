<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Data ODC — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Data ODC</h1>
            <a href="{{ route('admin.odc.create') }}" class="btn btn-sm btn-primary">+ Tambah ODC</a>
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
                                <th>Kode ODC</th>
                                <th>Nama ODC</th>
                                <th>Server/POP</th>
                                <th>Port Cap / Install</th>
                                <th>Rasio</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($odcs as $i => $o)
                            <tr>
                                <td>{{ $odcs->firstItem() + $i }}</td>
                                <td class="fw-semibold"><a href="{{ route('admin.odc.show', $o->id) }}"> {{ $o->kode_odc }}</a></td>
                                <td>{{ $o->nama_odc ?: '—' }}</td>
                                <td>
                                    @if($o->server)
                                    {{ $o->server->nama_pop }}
                                    @if($o->server->ip_public)
                                    <span class="text-muted">— {{ $o->server->ip_public }}</span>
                                    @endif
                                    @else
                                    <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>{{ $o->port_cap ?: '—' }} / {{ $o->port_install ?: '—' }}</td>
                                <td>{{ $o->rasio ?: '—' }}</td>
                                <td class="small text-muted">{{ $o->created_at?->format('Y-m-d H:i') ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('admin.odc.edit', $o->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada data ODC.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    {{ $odcs->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>