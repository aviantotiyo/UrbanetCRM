<script>
function calculatePoint() {
    const selected = document.querySelector('input[name="method"]:checked');
    const flat = parseFloat(selected.dataset.flat || 0);
    const percent = parseFloat(selected.dataset.percent || 0);

    flatFeeInput.value = flat;
    percentFeeInput.value = percent;

    const adminFeeEstimate = Math.ceil(flat + ((totalTagihan - pointAvailable) * percent / 100));
    const minimumTotal = 10000;

    const maxPoint = totalTagihan - (minimumTotal - adminFeeEstimate);
    const pointUsed = Math.min(pointAvailable, Math.max(0, maxPoint));

    pointUsedInput.value = Math.floor(pointUsed);


    const pointDisplay = document.getElementById('pointDisplay');
    if (pointDisplay) {
        pointDisplay.textContent = formatRupiah(pointUsed);
    }
}

</script>