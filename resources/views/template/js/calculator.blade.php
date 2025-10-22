<script>
document.addEventListener('DOMContentLoaded', function () {
    const tagihan = {{ $client->tagihan ?? 0 }}; // tagihan dari server
    const inputPromoDay = document.getElementById('promo_day');
    const inputDate = document.getElementById('flatpickr-date');
    const resultDiv = document.getElementById('prorataResult');
    const selisihDiv = document.getElementById('selisihResult'); // tempat tampilkan selisih

    function hitungProrata() {
        const promoDay = parseInt(inputPromoDay.value) || 0;
        const promoStartStr = inputDate.value;

        if (promoDay === 0 && promoStartStr) {
            const promoStart = new Date(promoStartStr);
            if (isNaN(promoStart)) {
                resultDiv.innerText = 'Rp 0';
                selisihDiv.innerText = '-';
                return;
            }

            const year = promoStart.getFullYear();
            const month = promoStart.getMonth();
            const dayToday = promoStart.getDate();

            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const selisih = daysInMonth - dayToday;

            const prorata = Math.ceil((tagihan / daysInMonth) * selisih);

            // Format ke Rupiah
            const formatted = prorata.toLocaleString('id-ID');
            resultDiv.innerText = `Rp ${formatted}`;
            selisihDiv.innerText = `${selisih} hari`;
        } else {
            resultDiv.innerText = 'Rp 0';
            selisihDiv.innerText = '-';
        }
    }

    inputPromoDay.addEventListener('input', hitungProrata);
    inputDate.addEventListener('change', hitungProrata);
});
</script>
