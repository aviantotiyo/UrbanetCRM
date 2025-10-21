<script>
  // Port yang dikirim server: hanya "available" + (jika ada) port yang saat ini dipakai client
  const AVAILABLE_PORTS = @json($availablePorts);

  // Susun jadi map per ODP biar lookup cepat
  const PORT_MAP = AVAILABLE_PORTS.reduce((acc, p) => {
    const key = String(p.odp_id);
    (acc[key] ||= []).push(p);
    return acc;
  }, {});

  function makeOption(val, text, {selected=false, disabled=false} = {}) {
    const opt = document.createElement('option');
    opt.value = val;
    opt.textContent = text;
    if (selected) opt.selected = true;
    if (disabled) opt.disabled = true;
    return opt;
  }

  function renderPortOptions(odpId, selectedPortId = '') {
    const portSel = document.getElementById('select-port');
    if (!portSel) return;

    portSel.innerHTML = '';
    portSel.appendChild(makeOption('', '-- pilih port --', {selected: !selectedPortId}));

    if (!odpId) return;

    const list = PORT_MAP[String(odpId)] || [];

    if (list.length === 0) {
      portSel.appendChild(makeOption('', '— tidak ada port available —', {disabled: true}));
      return;
    }

    list.forEach(p => {
      portSel.appendChild(
        makeOption(p.id, p.port_numb, {selected: String(selectedPortId) === String(p.id)})
      );
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    const odpSel   = document.getElementById('select-odp');
    const oldOdp   = @json(old('odp_id', $client->odp_id));
    const oldPort  = @json(old('odp_port_id', $client->odp_port_id));

    // Inisialisasi awal (saat page load / setelah validation error)
    if (oldOdp) {
      renderPortOptions(oldOdp, oldPort || '');
    }

    // Saat ODP berubah -> isi ulang port
    if (odpSel) {
      odpSel.addEventListener('change', () => {
        renderPortOptions(odpSel.value, '');
      });
    }
  });
</script>
