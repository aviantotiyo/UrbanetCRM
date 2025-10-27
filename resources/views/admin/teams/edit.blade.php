@section('title', 'Edit Team dan Admin')
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
                                    <span class="h5">Edit Data Member</span>
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
                                <form action="{{ route('admin.team.update', $user->id) }}" method="POST">
                                    @csrf

                                    <div class="mb-3 col-4">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    </div>

                                    <div class="mb-3 col-4">
                                        <label for="role" class="form-label">Peran</label>
                                        <select name="role" id="role" class="form-select" required>
                                            @foreach (['Admin', 'Finance', 'NOC', 'CustomerCare', 'Installer'] as $role)
                                            <option value="{{ $role }}" @selected(old('role', $user->role) === $role)>
                                                {{ $role }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3 col-4">
                                        <label for="active" class="form-label">Status Aktif</label>
                                        <select name="active" id="active" class="form-select" required>
                                            <option value="1" @selected($user->active == 1)>Aktif</option>
                                            <option value="0" @selected($user->active == 0)>Nonaktif</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Batal</a>
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

        @include('template.js.title-case')
        @include('template.footer')
</body>

</html>