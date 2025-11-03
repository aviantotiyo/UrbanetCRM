<script>
document.addEventListener('DOMContentLoaded', function () {
    const amountElements   = document.querySelectorAll('p[data-type="amount"]');
    const dendaElements    = document.querySelectorAll('p[data-type="denda"]');
    const discountElements = document.querySelectorAll('p[data-type="discount"]');
    const pointValue       = parseInt(document.getElementById('clientPoint').value) || 0;

    let totalAmount = 0;
    let totalDenda = 0;
    let totalDiscount = 0;

    // Helper untuk parsing angka dari format Rp
    const parseRupiah = (str) => parseInt(str.replace(/[^\d]/g, '')) || 0;

    amountElements.forEach(el => totalAmount += parseRupiah(el.textContent));
    dendaElements.forEach(el => totalDenda += parseRupiah(el.textContent));
    discountElements.forEach(el => totalDiscount += parseRupiah(el.textContent));

    // Rumus: total = (amount + denda - discount - point)
    let totalTagihan = totalAmount + totalDenda - totalDiscount;
    let totalPayment = totalTagihan - pointValue;

    // Jika hasil negatif, artinya tidak perlu bayar, nol saja
    if (totalPayment < 0) totalPayment = 0;

    // Sisa point
    let sisaPoint = pointValue - (totalTagihan > pointValue ? pointValue : totalTagihan);
    if (sisaPoint < 0) sisaPoint = 0;

    const formatRupiah = (angka) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    };

    // Tampilkan total pembayaran
    document.getElementById('totalPayment').textContent = formatRupiah(totalPayment);

    // Tampilkan sisa point
    const sisaPointLabel = document.getElementById('sisaPointLabel');
    if (sisaPointLabel) {
        sisaPointLabel.textContent = sisaPoint > 0 ? 'Sisa point: ' + formatRupiah(sisaPoint) : '';
    }

    const pointDisplay = document.getElementById('pointDisplay');
    if (pointDisplay) {
        pointDisplay.textContent = formatRupiah(sisaPoint);
    }

    // Tampilkan point yang dipakai
    const pointUsed = pointValue - sisaPoint;
    const pointUsedLabel = document.getElementById('pointUsedLabel');
    if (pointUsedLabel) {
        pointUsedLabel.textContent = formatRupiah(pointUsed);
    }

    // Hidden input untuk form
    const form = document.querySelector('form');
    if (form) {
        let hiddenInput = document.getElementById('pointUsed');
        if (!hiddenInput) {
            hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'point_used';
            hiddenInput.id = 'pointUsed';
            form.appendChild(hiddenInput);
        }
        hiddenInput.value = pointUsed;
    }
});

</script>
