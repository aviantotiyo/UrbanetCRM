@section('title', 'Tambah Data Instalasi Pelanggan')
@include('template.head')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />

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
                        @if($peringatan)
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>Peringatan!</strong> {{ $peringatan }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="mb-1">
                                    <span class="h5">{{ $client->nopel }} <span class="badge bg-label-primary me-1 ms-2">{{ $client->status }}</span></span>
                                </div>
                                <p class="mb-0">{{ $client->nama }} </p>
                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.dashboard.ticket_hc.index') }}" class="btn btn-outline-primary">← Kembali</a>
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
                                <div class="col-12 col-md-6 mb-4">
                                    <form action="{{ route('admin.dashboard.ticket_hc.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="client_id" value="{{ $client->id }}">

                                        <div class="mb-3">
                                            <label>Nama Client</label>
                                            <input type="text" class="form-control" value="{{ $client->nama }}" disabled>
                                        </div>

                                        <div class="mb-3">
                                            <label for="users_id" class="form-label">Pilih Installer</label>
                                            <select name="users_id" class="form-select" required>
                                                <option value="">-- Pilih Installer --</option>
                                                @foreach($installers as $installer)
                                                <option value="{{ $installer->id }}">{{ $installer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="defaultSelect" class="form-label">Status</label>
                                            <select id="defaultSelect" class="form-select" name="status">
                                                <option>Pilih Status</option> process,pending,cancel,finish
                                                <option value="open" selected>Open</option>
                                                <option value="process">Proses</option>
                                                <option value="pending">Pending</option>
                                                <option value="cancel">Cancel</option>
                                                <option value="finish">Finish</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Merk Kabel Dropcore</label>
                                            <input type="text" class="form-control" name="merk_kabel">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Panjang Kabel Dropcore ke ODP</label>
                                            <input type="text" class="form-control" name="panjang_kabel">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Sambungan Kabel Dropcore ke ODP</label>
                                            <input type="text" class="form-control" name="sambungan_kabel">
                                        </div>

                                        <div class="mb-3">
                                            <label>Catatan</label>
                                            <textarea name="note" class="form-control" rows="4"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- </div> -->
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

    <!-- Vendors JS -->
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>


    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>


</body>

</html>