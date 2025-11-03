<script>
    const methodInputs = document.querySelectorAll('.payment-option');
    const flatFeeInput = document.getElementById('flatFee');
    const percentFeeInput = document.getElementById('percentFee');
    const pointUsedInput = document.getElementById('pointUsed');
    const pointDisplay = document.getElementById('pointDisplay');

    const totalTagihan = {{ $unpaidBillings->sum(function($bill) {
        return $bill->items->sum(function($item) {
            return $item->amount + $item->denda - $item->discount;
        });
    }) }};
    const pointAvailable = {{ $client->point }};

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(angka);
    }

    function calculatePoint() {
    const selected = document.querySelector('input[name="method"]:checked');
    const flat = parseFloat(selected.dataset.flat || 0);
    const percent = parseFloat(selected.dataset.percent || 0);

    flatFeeInput.value = flat;
    percentFeeInput.value = percent;

    const minimumFinal = 10000;

    // Uji dari point terbesar ke 0
    let bestPointUsed = 0;
    for (let p = pointAvailable; p >= 0; p--) {
        const sisaTagihan = totalTagihan - p;
        const adminFee = Math.ceil(flat + (sisaTagihan * percent / 100));
        const finalTotal = sisaTagihan + adminFee;

        if (finalTotal >= minimumFinal) {
            bestPointUsed = p;
            break;
        }
    }

    pointUsedInput.value = Math.floor(bestPointUsed);

    const pointDisplay = document.getElementById('pointDisplay');
    if (pointDisplay) {
        pointDisplay.textContent = formatRupiah(bestPointUsed);
    }

    const totalDisplay = document.getElementById('totalDisplay');
    if (totalDisplay) {
        const sisa = totalTagihan - bestPointUsed;
        const adminFee = Math.ceil(flat + (sisa * percent / 100));
        const finalTotal = sisa + adminFee;
        totalDisplay.textContent = formatRupiah(finalTotal);
    }

    console.log('Flat fee:', flat, 'Percent:', percent);
    console.log('Total tagihan:', totalTagihan);
    console.log('Point digunakan:', bestPointUsed);
}


    methodInputs.forEach(el => el.addEventListener('change', calculatePoint));
    window.addEventListener('DOMContentLoaded', calculatePoint);
</script>
