<div class="card mt-4">
    <div class="card-header">
        <h5>Debug Response dari Tripay</h5>
    </div>
    <div class="card-body">
        <h6>Total Dibayar: Rp {{ number_format($finalTotal, 0, ',', '.') }}</h6>
        <h6>Fee Admin: Rp {{ number_format($fee, 0, ',', '.') }}</h6>
        <hr>
        <strong>Payload Request:</strong>
        <pre>{{ json_encode($data, JSON_PRETTY_PRINT) }}</pre>

        <hr>
        <strong>Respon dari Tripay:</strong>
        <pre>{{ json_encode($response, JSON_PRETTY_PRINT) }}</pre>
    </div>
</div>