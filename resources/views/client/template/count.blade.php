<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radios = document.querySelectorAll('.payment-option');
        const finalTotalEl = document.getElementById('final-total');
        const bankFeeLabelEl = document.getElementById('bank-fee-label');
        const amountTotal = {{ $amountTotal }};

        function calculateFee(flat, percent) {
            const flatFee = parseFloat(flat);
            const percentFee = parseFloat(percent);
            const fee = flatFee + (amountTotal * (percentFee / 100));
            return Math.ceil(fee); // pembulatan ke atas agar integer
        }

        function updateDisplay(flat, percent) {
            const fee = calculateFee(flat, percent);
            const total = amountTotal + fee;

            finalTotalEl.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
            bankFeeLabelEl.textContent = 'admin bank Rp ' + new Intl.NumberFormat('id-ID').format(fee);
        }

        radios.forEach(radio => {
            radio.addEventListener('change', function () {
                const flat = this.dataset.flat;
                const percent = this.dataset.percent;
                updateDisplay(flat, percent);
            });

            if (radio.checked) {
                updateDisplay(radio.dataset.flat, radio.dataset.percent);
            }
        });
    });
</script>
