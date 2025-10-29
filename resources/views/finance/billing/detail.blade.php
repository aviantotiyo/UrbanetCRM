<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Tagihan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4">Detail Tagihan</h2>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Informasi Umum</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Nama Pelanggan:</strong> {{ $billing->client->nama ?? '-' }}</li>
                    <li class="list-group-item"><strong>Merchant Ref:</strong> {{ $billing->merchant_ref }}</li>
                    <li class="list-group-item"><strong>Status:</strong> {{ $billing->status }}</li>
                    <li class="list-group-item"><strong>Tanggal Dibuat:</strong> {{ $billing->billing_create?->format('d-m-Y H:i') }}</li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Item Tagihan</h5>
                @forelse ($billing->items as $item)
                <div class="border p-3 mb-3">
                    <p><strong>Nama Item:</strong> {{ $item->name }}</p>
                    <p><strong>Jumlah (Rp):</strong> {{ number_format($item->amount, 0, ',', '.') }}</p>
                    <p><strong>Periode:</strong> {{ $item->billing_cycle->format('m/Y') }}</p>
                </div>
                @empty
                <p class="text-muted">Tidak ada item tagihan.</p>
                @endforelse
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.billing.index') }}" class="btn btn-secondary">← Kembali ke Daftar</a>
        </div>
    </div>
</body>

</html>