<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UrbanetCRM — Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-7 col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-3 text-center">UrbanetCRM — Admin</h1>

                        {{-- Alert umum (termasuk pesan throttle dari exception handler) --}}
                        <!-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                <li class="js-error-item">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif -->

                        <form method="POST" action="{{ route('admin.login.post') }}" novalidate>
                            @csrf

                            {{-- Honeypot sederhana: kalau diisi bot → ditolak di controller --}}
                            <input type="text" name="website" class="d-none" tabindex="-1" autocomplete="off">

                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label" for="password">Password</label>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="form-control"
                                    required
                                    autocomplete="current-password">
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="remember"
                                        name="remember"
                                        value="1"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                            </div>

                            <button id="btnLogin" class="btn btn-primary w-100" type="submit">Sign in</button>
                            <div id="throttleHint" class="form-text text-danger mt-2 d-none"></div>
                        </form>

                        <!-- <p class="text-center text-muted small mt-3 mb-0">
                            v1 • session-based auth
                        </p> -->
                    </div>
                </div>
                <p class="text-center mt-3">
                    <a class="small text-decoration-none" href="/">← back</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Disable tombol saat submit (hindari double submit)
        // (function() {
        //     const form = document.querySelector('form');
        //     const btn = document.getElementById('btnLogin');
        //     form.addEventListener('submit', () => {
        //         btn.disabled = true;
        //         // re-enable otomatis jika server mengembalikan halaman lagi (validasi gagal)
        //         setTimeout(() => {
        //             btn.disabled = false;
        //         }, 3000);
        //     });
        // })();

        // Jika pesan error mengandung "Coba lagi dalam {detik} detik", tampilkan hint countdown
        (function() {
            const items = document.querySelectorAll('.js-error-item');
            if (!items.length) return;
            const hint = document.getElementById('throttleHint');
            for (const li of items) {
                const m = li.textContent.match(/Coba lagi dalam\s+(\d+)\s+detik/i);
                if (m) {
                    let remain = parseInt(m[1], 10);
                    hint.classList.remove('d-none');
                    hint.textContent = `Silakan coba lagi dalam ${remain} detik.`;
                    const t = setInterval(() => {
                        remain -= 1;
                        if (remain <= 0) {
                            clearInterval(t);
                            hint.textContent = 'Silakan coba sekarang.';
                            return;
                        }
                        hint.textContent = `Silakan coba lagi dalam ${remain} detik.`;
                    }, 1000);
                    break;
                }
            }
        })();
    </script>
</body>

</html>