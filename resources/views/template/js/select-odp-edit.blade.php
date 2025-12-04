 <script>
     document.addEventListener('DOMContentLoaded', function() {
         const allPorts = @json($odp_ports); // dari controller
         const odpSelect = document.getElementById('select-odp');
         const portSelect = document.getElementById('select-odp-port');
         const selectedPortId = portSelect.dataset.selected;

         function resetPortOptions() {
             portSelect.innerHTML = '<option value="">-- Pilih --</option>';
         }

         function populatePortOptions(odpId) {
             resetPortOptions();

             const filteredPorts = allPorts.filter(p =>
                 p.odp_id == odpId &&
                 (p.status === 'available' || p.id == selectedPortId) // tampilkan hanya yang available atau sedang digunakan oleh item ini
             );

             filteredPorts.forEach(p => {
                 const opt = document.createElement('option');
                 opt.value = p.id;
                 opt.textContent = `PORT ${p.port_numb || '-'}`;
                 if (p.id == selectedPortId) {
                     opt.selected = true;
                 }
                 portSelect.appendChild(opt);
             });
         }

         // Trigger awal (edit mode)
         const selectedOdpId = odpSelect.dataset.selected;
         if (selectedOdpId) {
             populatePortOptions(selectedOdpId);
         }

         // Event ganti ODP
         odpSelect.addEventListener('change', function() {
             populatePortOptions(this.value);
         });
     });
 </script>