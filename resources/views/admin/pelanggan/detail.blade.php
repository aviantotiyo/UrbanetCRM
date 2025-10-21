<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Detail Pelanggan — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h5 mb-0">Detail Pelanggan</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
                {{-- Contoh tombol edit/hapus (opsional)
      <a href="#" class="btn btn-sm btn-primary">Edit</a>
      <form method="POST" action="#">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-danger">Hapus</button>
      </form>
      --}}
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <div class="text-muted small">ID</div>
                            <div class="fw-semibold">{{ $client->id }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">No. Pelanggan (NoPel)</div>
                            <div class="fw-semibold">{{ $client->nopel }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Nama</div>
                            <div class="fw-semibold">{{ $client->nama }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Email</div>
                            <div class="fw-semibold">{{ $client->email ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">No HP</div>
                            <div class="fw-semibold">{{ $client->no_hp ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">NIK</div>
                            <div class="fw-semibold">{{ $client->nik ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Alamat</div>
                            <div class="fw-semibold">{{ $client->alamat ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Kecamatan / Kabupaten / Provinsi</div>
                            <div class="fw-semibold">
                                {{ $client->kecamatan ?: '—' }} /
                                {{ $client->kabupaten ?: '—' }} /
                                {{ $client->provinsi ?: '—' }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Lokasi Client</div>
                            <div class="fw-semibold">{{ $client->loc_client ?: '—' }}</div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <div class="text-muted small">Paket</div>
                            <div class="fw-semibold">{{ $client->paket ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Tagihan</div>
                            <div class="fw-semibold">{{ $client->tagihan ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">User PPPoE</div>
                            <div class="fw-semibold">{{ $client->user_pppoe }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Pass PPPoE</div>
                            <div class="fw-semibold">{{ $client->pass_pppoe }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Profile / Limit Radius</div>
                            <div class="fw-semibold">
                                {{ $client->name_profile ?: '—' }} / {{ $client->limit_radius ?: '—' }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">ODP ID / ODP Port ID</div>
                            <div class="fw-semibold">
                                {{ $client->odp?->kode_odp ?? '—' }} / {{ $client->odpPort?->port_numb ?? '—' }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Tag</div>
                            <div class="fw-semibold">{{ $client->tag ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Active User</div>
                            <div class="fw-semibold">
                                {{ $client->active_user ? \Carbon\Carbon::parse($client->active_user)->format('Y-m-d H:i') : '—' }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Status</div>
                            <span class="badge text-bg-secondary">{{ $client->status }}</span>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Catatan</div>
                            <div class="fw-semibold">{{ $client->note ?: '—' }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Foto Depan</div>
                            @if ($client->foto_depan)
                            <div class="fw-semibold mb-2">{{ $client->foto_depan }}</div>
                            {{-- Jika nanti berupa URL/asset, bisa tampilkan img: --}}
                            {{-- <img class="img-fluid rounded border" src="{{ asset($client->foto_depan) }}" alt="Foto Depan"> --}}
                            @else
                            <div class="fw-semibold">—</div>
                            @endif
                        </div>
                    </div>
                </div>

                <hr>
                <div class="small text-muted">
                    Dibuat: {{ $client->created_at?->format('Y-m-d H:i') ?? '—' }} ·
                    Diubah: {{ $client->updated_at?->format('Y-m-d H:i') ?? '—' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>