<script>
const PROVINSI  = @json($provinsiRaw ?? []);
const KABUPATEN = @json($kabupatenRaw ?? []);
const KECAMATAN = @json($kecamatanRaw ?? []);

function renderOptions($select, items, nameKey = 'name', idKey = 'id', placeholder = '-- pilih --') {
  $select.innerHTML = '';
  const def = document.createElement('option');
  def.value = '';
  def.textContent = placeholder;
  $select.appendChild(def);
  (items || []).forEach(item => {
    const opt = document.createElement('option');
    const txt = item?.[nameKey] ?? '';
    opt.value = txt;
    opt.textContent = txt;
    if (idKey && item?.[idKey]) opt.dataset.id = item[idKey];
    $select.appendChild(opt);
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const prov = document.getElementById('prov_odc');
  const kab  = document.getElementById('kota_odc');
  const kec  = document.getElementById('kec_odc');

  const oldProv = @json(old('prov', $odc->prov ?? ''));
  const oldKab  = @json(old('kota', $odc->kota ?? ''));
  const oldKec  = @json(old('kec', $odc->kec ?? ''));

  console.log('✅ Init Cascade ODC Loaded');
  console.log('Prov DB:', oldProv);
  console.log('Kab DB:', oldKab);
  console.log('Kec DB:', oldKec);

function onProvChange(selectKab = true) {
  let provId = prov.value;

  // Coba cocokan juga kalau value itu NAME (seperti di form edit)
  if (!PROVINSI.some(p => p.id == provId)) {
    const provByName = PROVINSI.find(p => p.name === prov.value);
    provId = provByName?.id ?? null;
  }

  const filteredKab = KABUPATEN.filter(k => k.province_id == provId);
  renderOptions(kab, filteredKab, 'name', 'id', '-- pilih kabupaten/kota --');

  if (selectKab && oldKab) {
    kab.value = oldKab;
    onKabChange(true);
  } else {
    renderOptions(kec, [], 'name', 'id', '-- pilih kecamatan --');
  }
}

function onKabChange(selectKec = false) {
  let kabId = kab.value;

  // Sama: handle jika value adalah name
  if (!KABUPATEN.some(k => k.id == kabId)) {
    const kabByName = KABUPATEN.find(k => k.name === kab.value);
    kabId = kabByName?.id ?? null;
  }

  const filteredKec = KECAMATAN.filter(k => k.regency_id == kabId);
  renderOptions(kec, filteredKec, 'name', 'id', '-- pilih kecamatan --');

  if (selectKec && oldKec) {
    kec.value = oldKec;
  }
}


  if (prov) prov.addEventListener('change', () => onProvChange(false));
  if (kab)  kab.addEventListener('change', () => onKabChange(false));

  // Auto-trigger saat edit: isi kabupaten & kecamatan
  if (oldProv) {
    prov.value = oldProv;
    onProvChange(true);
  }
});
</script>
