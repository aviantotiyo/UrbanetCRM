<script>
document.addEventListener('DOMContentLoaded', function () {
    const amountElements   = document.querySelectorAll('p[data-type="amount"]');
    const dendaElements    = document.querySelectorAll('p[data-type="denda"]');
    const discountElements = document.querySelectorAll('p[data-type="discount"]');
    const pointValue       = parseInt(document.getElementById('clientPoint').value) || 0;

    let totalAmount = 0;
    let totalDenda = 0;
    let totalDiscount = 0;

    const parseRupiah = (str) => parseInt(str.replace(/[^\d]/g, '')) || 0;

    amountElements.forEach(el => totalAmount += parseRupiah(el.textContent));
    dendaElements.forEach(el => totalDenda += parseRupiah(el.textContent));
    discountElements.forEach(el => totalDiscount += parseRupiah(el.textContent));

    let totalTagihan = totalAmount + totalDenda - totalDiscount;
    let totalPayment = totalTagihan - pointValue;
    if (totalPayment < 0) totalPayment = 0;

    let sisaPoint = pointValue - (totalTagihan > pointValue ? pointValue : totalTagihan);
    if (sisaPoint < 0) sisaPoint = 0;

    const pointUsed = pointValue - sisaPoint;

    const formatRupiah = (angka) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    };

    // Update tampilan
    document.getElementById('totalPayment').textContent = formatRupiah(totalPayment);

    const sisaPointLabel = document.getElementById('sisaPointLabel');
    if (sisaPointLabel) {
        sisaPointLabel.textContent = sisaPoint > 0 ? 'Sisa point: ' + formatRupiah(sisaPoint) : '';
    }

    const pointUsedLabel = document.getElementById('pointUsedLabel');
    if (pointUsedLabel) {
        pointUsedLabel.textContent = formatRupiah(pointUsed);
    }

    // Set hidden form input values
    document.getElementById('inputTotalPayment').value = totalPayment;
    document.getElementById('inputPointUsedLabel').value = pointUsed;
    document.getElementById('inputSisaPointLabel').value = sisaPoint;
});


</script>
