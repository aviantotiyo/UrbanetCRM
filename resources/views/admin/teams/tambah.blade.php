@section('title', 'Tambah Team dan Admin')
@include('template.head')


</head>

<body>
    <!-- Layout wrapper -->
    <div class=" layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('template.sidebar')
            <div class="menu-mobile-toggler d-xl-none rounded-1">
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                    <i class="ti tabler-menu icon-base"></i>
                    <i class="ti tabler-chevron-right icon-base"></i>
                </a>
            </div>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                @include('template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="mb-1">
                                    <span class="h5">Tambah Member Baru</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.team.index') }}" class="btn btn-outline-primary">← Kembali</a>
                            </div>
                        </div>

                        {{-- Alert error --}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Periksa input:</strong>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- <div class="row g-6"> -->
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.team.store') }}">
                                    @csrf

                                    <div class="mb-3 col-4">
                                        <label for="name" class="form-label">Nama</label>
                                        <input id="title" type="text" name="name" class="form-control" required value="{{ old('name') }}">
                                    </div>

                                    <div class="mb-3 col-4">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                                    </div>

                                    <div class="mb-3 col-4">
                                        <label for="password" class="form-label">Password (Otomatis)</label>
                                        <input type="text" name="password" id="password" class="form-control" readonly required>
                                        <button type="button" onclick="setPassword()" class="btn btn-sm btn-secondary mt-2">Generate Ulang</button>
                                    </div>

                                    <div class="mb-3 col-4">
                                        <label for="role" class="form-label">Peran / Role</label>
                                        <select name="role" class="form-select" required>
                                            <option value="">-- Pilih Role --</option>
                                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="Finance" {{ old('role') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                            <option value="NOC" {{ old('role') == 'NOC' ? 'selected' : '' }}>NOC</option>
                                            <option value="CustomerCare" {{ old('role') == 'CustomerCare' ? 'selected' : '' }}>Customer Care</option>
                                            <option value="Installer" {{ old('role') == 'Installer' ? 'selected' : '' }}>Installer</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label d-block">Status Aktif</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="active" value="1" {{ old('active', '1') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label">Aktif</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="active" value="0" {{ old('active') === '0' ? 'checked' : '' }}>
                                            <label class="form-check-label">Nonaktif</label>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- </div> -->

                        <!-- Disini -->


                        <!-- / Content -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>

            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
        </div>
        <!-- / Layout wrapper -->
        <script>
            function generatePassword(length = 10) {
                const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%";
                return Array.from({
                    length
                }, () => charset[Math.floor(Math.random() * charset.length)]).join('');
            }

            function setPassword() {
                const pass = generatePassword();
                document.getElementById('password').value = pass;
            }

            window.addEventListener('DOMContentLoaded', setPassword);
        </script>
        @include('template.js.title-case')
        @include('template.footer')
</body>

</html>