 <script>
     (function() {
         const nikInput = document.getElementById('nik');
         if (!nikInput) return;

         // Format: "12341234..." -> "1234.1234.1234.1234"
         function formatNik(raw) {
             const chunks = raw.match(/\d{1,4}/g) || [];
             return chunks.join('.');
         }

         // Ambil hanya digit, batasi 16
         function onlyDigits16(str) {
             return (str.replace(/\D+/g, '')).slice(0, 16);
         }

         // Set tampilan + simpan raw di dataset
         function setFromRaw(raw) {
             nikInput.value = formatNik(raw);
             nikInput.dataset.raw = raw;
         }

         // Inisialisasi dari nilai lama (old()) jika ada
         setFromRaw(onlyDigits16(nikInput.value));

         // Re-mask saat mengetik / paste
         nikInput.addEventListener('input', function() {
             const raw = onlyDigits16(nikInput.value);
             setFromRaw(raw);
         });

         // Pastikan yang dikirim adalah raw digits
         const form = nikInput.closest('form');
         if (form) {
             form.addEventListener('submit', function() {
                 const raw = nikInput.dataset.raw || onlyDigits16(nikInput.value);
                 nikInput.value = raw; // ganti value jadi angka murni sebelum submit
             });
         }
     })();
 </script>