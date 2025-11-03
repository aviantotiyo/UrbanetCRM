<div class="container">
    <h4>Pembayaran dengan Poin</h4>

    <div class="alert alert-success">
        Anda memiliki cukup poin untuk membayar seluruh tagihan Anda.
    </div>


    <p><strong>Debug Info:</strong></p>
    <ul>
        <li>Poin Client: <strong>{{ $client->point }}</strong></li>
        <li>Total Tagihan (amount): <strong>{{ $totalAmount }}</strong></li>
        <li>Kondisi:
            @if ($client->point >= $totalAmount)
            ✅ Point mencukupi
            @else
            ❌ Point tidak mencukupi
            @endif
        </li>
    </ul>

    <p>Silakan lanjutkan ke proses konfirmasi pembayaran menggunakan poin Anda.</p>

    <a href="{{ route('client.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>