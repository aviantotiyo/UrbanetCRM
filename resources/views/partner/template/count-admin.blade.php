<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ambil nilai subtotal (total)
    const totalElement = document.getElementById('total');
    const totalText = totalElement.textContent.replace(/[^\d]/g, '');
    const subtotal = parseInt(totalText) || 0;

    // Ambil kode unik dari Blade
    const kodeUnik = parseInt({{ $billing->kode_unik ?? 0 }}) || 0;

    // Ambil fee admin dari Blade
    const feeAdmin = parseInt({{ $fee_merchant_billing ?? 0 }}) || 0;

    // Hitung total admin
    const totalAdmin = subtotal + kodeUnik + feeAdmin;

    // Format angka ke format Rupiah
    const formatted = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(totalAdmin);

    // Tampilkan hasil di elemen #total_admin
    const totalAdminEl = document.getElementById('total_admin');
    if (totalAdminEl) {
        totalAdminEl.textContent = formatted;
    }
});
</script>
