<script>
document.addEventListener('DOMContentLoaded', function () {
    const tagihan = {{ $client->tagihan ?? 0 }};
    const inputPromoDay = document.getElementById('promo_day');
    const inputDate = document.getElementById('flatpickr-date');

    const masaPromoDiv = document.getElementById('masaPromoResult');
    const tagihanKedepanDiv = document.getElementById('tagihanKedepanResult');
    const totalTagihanDiv = document.getElementById('totalTagihanResult');

    function hitungPromo() {
        const promoDay = parseInt(inputPromoDay.value) || 0;
        const promoStartStr = inputDate.value;

        // Aktif hanya kalau promo_day ≠ 0 dan tanggal valid
        if (promoDay > 0 && promoStartStr) {
            const promoStart = new Date(promoStartStr);
            if (isNaN(promoStart)) {
                masaPromoDiv.innerText = '-';
                tagihanKedepanDiv.innerText = '-';
                totalTagihanDiv.innerText = 'Rp 0';
                return;
            }

            // Hitung tanggal akhir promo
            const masaPromo = new Date(promoStart);
            masaPromo.setDate(masaPromo.getDate() + promoDay);
            const masaPromoStr = masaPromo.toLocaleDateString('id-ID', {
                day: '2-digit', month: 'long', year: 'numeric'
            });
            masaPromoDiv.innerText = masaPromoStr;

            // Dapatkan jumlah hari pada bulan masa_promo
            const year = masaPromo.getFullYear();
            const month = masaPromo.getMonth();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Hitung tagihan_kedepan
            const hariMasaPromo = masaPromo.getDate();
            const tagihanKedepan = daysInMonth - hariMasaPromo;
            tagihanKedepanDiv.innerText = `${tagihanKedepan} hari`;

            // Hitung total tagihan prorata
            const totalTagihan = Math.ceil((tagihan / daysInMonth) * tagihanKedepan);
            const formattedTagihan = totalTagihan.toLocaleString('id-ID');
            totalTagihanDiv.innerText = `Rp ${formattedTagihan}`;
        } else {
            masaPromoDiv.innerText = '-';
            tagihanKedepanDiv.innerText = '-';
            totalTagihanDiv.innerText = 'Rp 0';
        }
    }

    inputPromoDay.addEventListener('input', hitungPromo);
    inputDate.addEventListener('change', hitungPromo);
});
</script>
