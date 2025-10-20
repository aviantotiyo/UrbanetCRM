<script>
    (function() {
        const SELECTORS = ['input[name="nama"]', 'input[name="alamat"]']; // tambah selector lain di sini

        const SMALL = new Set(['bin', 'binti', 'dan', 'di', 'ke', 'dari', 'yang', 'untuk', 'atau', 'al', 'as', 'ibn', 'abu']);

        function capCore(w) {
            const lower = w.toLowerCase();
            if (/^(?=[mdclxvi]+$)/i.test(lower)) return lower.toUpperCase(); // roman numerals
            if (/^[A-Z0-9]{2,}$/.test(w) && w === w.toUpperCase()) return w; // akronim
            return lower.charAt(0).toUpperCase() + lower.slice(1);
        }

        function capWord(w) {
            if (w.includes('-')) return w.split('-').map(capWord).join('-');
            if (w.includes("'")) return w.split("'").map(capWord).join("'");
            return capCore(w);
        }

        function titleCaseLive(str) {
            const parts = String(str ?? '').split(' ');
            return parts.map((w, i) => {
                if (!w) return w;
                const base = w.toLowerCase();
                const isEdge = (i === 0 || i === parts.length - 1);
                if (!isEdge && SMALL.has(base)) return base;
                return capWord(w);
            }).join(' ');
        }

        function titleCaseFinal(str) {
            return titleCaseLive(String(str ?? '').trim().replace(/\s+/g, ' '));
        }

        function wire(el) {
            if (!el) return;
            el.addEventListener('input', () => {
                const s = el.selectionStart,
                    e = el.selectionEnd;
                const before = el.value,
                    after = titleCaseLive(before);
                if (after !== before) {
                    el.value = after;
                    el.setSelectionRange(s, e);
                }
            });
            const finalize = () => {
                const before = el.value,
                    after = titleCaseFinal(before);
                if (after !== before) el.value = after;
            };
            el.addEventListener('blur', finalize);
            const form = el.closest('form');
            if (form) form.addEventListener('submit', finalize);
        }

        SELECTORS.forEach(sel => document.querySelectorAll(sel).forEach(wire));
    })();
</script>