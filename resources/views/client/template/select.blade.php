<script>
document.querySelectorAll('input[name="method"]').forEach((radio) => {
    radio.addEventListener('change', function () {
        const flat = this.getAttribute('data-flat');
        const percent = this.getAttribute('data-percent');

        document.getElementById('flatFee').value = flat;
        document.getElementById('percentFee').value = percent;

        // Optionally: update label admin bank dan final total
        const amountTotal = {{ $amountTotal }};
        const fee = Math.ceil(parseInt(flat) + (amountTotal * (parseFloat(percent) / 100)));

        document.getElementById('bank-fee-label').innerText = 'admin bank Rp ' + fee.toLocaleString('id-ID');
        document.getElementById('final-total').innerText = 'Rp ' + (amountTotal + fee).toLocaleString('id-ID');
    });

    // trigger once untuk yang sudah checked
    if (radio.checked) {
        radio.dispatchEvent(new Event('change'));
    }
});
</script>
