<script>
  // kirim data paket ke JS (harus assign ke variabel!)
  const PAKETS = @json($paketsForJs);

  document.addEventListener('DOMContentLoaded', () => {
    const sel  = document.getElementById('paket');
    const tag  = document.getElementById('tagihan');
    const prof = document.getElementById('name_profile');
    const rad  = document.getElementById('limit_radius');

    function fillByName(nama) {
      const row = Array.isArray(PAKETS) ? PAKETS.find(p => p.nama_paket === nama) : null;
      if (!row) {
        if (tag)  tag.value  = '';
        if (prof) prof.value = '';
        if (rad)  rad.value  = '';
        return;
      }
      if (tag)  tag.value  = row.harga ?? '';
      if (prof) prof.value = row.name_profile ?? '';
      if (rad)  rad.value  = row.limit_radius ?? '';
    }

    if (!sel) return;

    // isi otomatis jika sudah ada nilai (mis. old('paket'))
    if (sel.value) fillByName(sel.value);

    // isi saat user mengganti paket
    sel.addEventListener('change', () => fillByName(sel.value));
  });
</script>
