 <script>
     // Data ODP Port yang sudah dipass dari server ke JS
     const odpPorts = @json($odp_ports);

     const selectOdp = document.getElementById('select-odp');
     const selectPort = document.getElementById('select-odp-port');

     selectOdp.addEventListener('change', function() {
         const selectedOdpId = this.value;

         // Hapus semua option sebelumnya
         selectPort.innerHTML = '<option value="">-- Pilih --</option>';

         // Filter data ODP Port berdasarkan ODP ID yang dipilih
         const filteredPorts = odpPorts.filter(port => port.odp_id === selectedOdpId);

         // Masukkan opsi baru ke selectPort
         filteredPorts.forEach(port => {
             const option = document.createElement('option');
             option.value = port.id;
             option.textContent = port.port_numb;
             selectPort.appendChild(option);
         });
     });

     // Jika sedang edit form dan sudah ada ODP terpilih → jalankan trigger awal
     window.addEventListener('DOMContentLoaded', () => {
         const existingOdpId = selectOdp.value;
         if (existingOdpId) {
             const event = new Event('change');
             selectOdp.dispatchEvent(event);

             // Jika ingin auto-select port lama juga:
             const selectedPortId = "{{ old('odp_port_id', $item->odp_port_id ?? '') }}";
             if (selectedPortId) {
                 selectPort.value = selectedPortId;
             }
         }
     });
 </script>