<div class="container py-3">
    <h1 class="h4 mb-3">Pelanggan Terbaru (20)</h1>

    <div class="table-responsive">
        <table class="table table-sm table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>NoPel</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $i => $c)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td><a href="{{ route('admin.pelanggan.show', $c->id) }}"> {{ $c->nopel }}</a></td>
                    <td>{{ $c->nama }}</td>
                    <td>{{ $c->email }}</td>
                    <td>{{ $c->no_hp }}</td>
                    <td><span class="badge text-bg-secondary">{{ $c->status }}</span></td>
                    <td>{{ $c->created_at?->format('Y-m-d H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>