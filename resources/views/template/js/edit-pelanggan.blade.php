<script>
// === Paket ===
const PAKETS = @json($paketsForJs);
document.addEventListener('DOMContentLoaded', () => {
  const sel  = document.getElementById('paket');
  const tag  = document.getElementById('tagihan');
  const prof = document.getElementById('name_profile');
  const rad  = document.getElementById('limit_radius');

  function fillByName(nama) {
    const row = (PAKETS || []).find(p => p.nama_paket === nama);
    if (!row) { if(tag)tag.value=''; if(prof)prof.value=''; if(rad)rad.value=''; return; }
    if (tag)  tag.value  = row.harga ?? '';
    if (prof) prof.value = row.name_profile ?? '';
    if (rad)  rad.value  = row.limit_radius ?? '';
  }
  if (sel) {
    sel.addEventListener('change', () => fillByName(sel.value));
    // inisialisasi dari old()/model
    if (sel.value) fillByName(sel.value);
  }
});

// === Wilayah: filter kabupaten/kecamatan ===
const KAB = @json($kabupatenRaw ?? []);
const KEC = @json($kecamatanRaw ?? []);

function renderOptions($select, items, nameKey='name', idKey='id', placeholder='-- pilih --') {
  $select.innerHTML = '';
  const def = document.createElement('option');
  def.value = '';
  def.textContent = placeholder;
  $select.appendChild(def);
  (items||[]).forEach(item => {
    const opt = document.createElement('option');
    const txt = item?.[nameKey] ?? '';
    opt.value = txt;
    opt.textContent = txt;
    if (idKey && item?.[idKey]) opt.dataset.id = item[idKey];
    $select.appendChild(opt);
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const prov = document.getElementById('provinsi_pel');
  const kab  = document.getElementById('kabupaten_pel');
  const kec  = document.getElementById('kecamatan_pel');

  const oldKab = @json(old('kabupaten', $client->kabupaten));
  const oldKec = @json(old('kecamatan', $client->kecamatan));

  function onProvChange() {
    const provId = prov.selectedOptions[0]?.dataset.id || null;
    // reset kecamatan
    renderOptions(kec, [], 'name', 'id', '-- pilih kecamatan --');
    if (!provId) { renderOptions(kab, [], 'name','id', '-- pilih kabupaten/kota --'); return; }
    const listKab = KAB.filter(r => String(r.province_id) === String(provId));
    renderOptions(kab, listKab, 'name', 'id', '-- pilih kabupaten/kota --');
    if (oldKab) {
      const matchKab = Array.from(kab.options).find(o => o.value === oldKab);
      if (matchKab) { kab.value = oldKab; onKabChange(); }
    }
  }

  function onKabChange() {
    const regId = kab.selectedOptions[0]?.dataset.id || null;
    if (!regId) { renderOptions(kec, [], 'name','id', '-- pilih kecamatan --'); return; }
    const listKec = KEC.filter(r => String(r.regency_id) === String(regId));
    renderOptions(kec, listKec, 'name', 'id', '-- pilih kecamatan --');
    if (oldKec) {
      const matchKec = Array.from(kec.options).find(o => o.value === oldKec);
      if (matchKec) kec.value = oldKec;
    }
  }

  if (prov) {
    prov.addEventListener('change', onProvChange);
    // trigger awal agar kab/kec terisi sesuai old()/model
    onProvChange();
  }
  if (kab) kab.addEventListener('change', onKabChange);
});
</script>

{{-- (Opsional) Title case saat ketik untuk beberapa field --}}
<script>
(function () {
  document.querySelectorAll('[data-titlecase]').forEach(el => {
    const SMALL = new Set(['bin','binti','dan','di','ke','dari','yang','untuk','atau','al','as','ibn','abu']);
    const capCore=w=>{const l=w.toLowerCase();if(/^(?=[mdclxvi]+$)/i.test(l))return l.toUpperCase();if(/^[A-Z0-9]{2,}$/.test(w)&&w===w.toUpperCase())return w;return l.charAt(0).toUpperCase()+l.slice(1);}
    const capWord=w=>w.includes('-')?w.split('-').map(capWord).join('-'):w.includes("'")?w.split("'").map(capWord).join("'"):capCore(w);
    const live=s=>String(s??'').split(' ').map((w,i)=>{if(!w)return w;const b=w.toLowerCase();const edge=(i===0||i===s.length-1);return !edge&&SMALL.has(b)?b:capWord(w)}).join(' ');
    el.addEventListener('input',()=>{const s=el.selectionStart,e=el.selectionEnd,b=el.value,a=live(b);if(a!==b){el.value=a;el.setSelectionRange(s,e);}});
  });
})();
</script>