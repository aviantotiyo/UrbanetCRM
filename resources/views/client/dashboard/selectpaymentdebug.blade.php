<div class="container py-5">
    <h4>🔍 Debug Response Tripay</h4>

    <h6>Raw CURL Response</h6>
    <pre style="background:#f8f9fa; padding:1rem;">{{ $response }}</pre>

    <h6>Hasil json_decode() → $result</h6>
    <pre style="background:#f1f3f5; padding:1rem;">{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>

    <h6>Hasil filter aktif → $channels</h6>
    <pre style="background:#f8f9fa; padding:1rem;">{{ json_encode($channels, JSON_PRETTY_PRINT) }}</pre>
</div>