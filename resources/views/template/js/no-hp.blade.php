 <script>
     (function() {
         const hp = document.getElementById('no_hp');
         if (!hp) return;

         function digits17(str) {
             return (str.replace(/\D+/g, '')).slice(0, 17);
         }

         function normalize(raw) {
             raw = digits17(raw);
             if (raw.length === 0) return '';
             // jika mulai dengan '0' → ganti jadi '62'
             if (raw[0] === '0') {
                 raw = '62' + raw.slice(1);
                 // setelah ganti, pastikan tetap max 14
                 raw = raw.slice(0, 17);
             }
             return raw;
         }

         // Init dari nilai lama (old())
         hp.value = normalize(hp.value);

         // Re-normalize saat ketik/paste
         hp.addEventListener('input', function() {
             const pos = hp.selectionStart; // optional: jaga caret sederhana
             const before = hp.value;
             const after = normalize(before);
             if (before !== after) {
                 hp.value = after;
                 // coba pertahankan posisi kursor mendekati akhir
                 hp.setSelectionRange(after.length, after.length);
             }
         });

         // Pastikan yang terkirim sudah normal
         const form = hp.closest('form');
         if (form) {
             form.addEventListener('submit', function() {
                 hp.value = normalize(hp.value);
             });
         }
     })();
 </script>