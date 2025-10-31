@section('title', 'Tambah Laporan Gangguan')
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
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="mb-1">
                                    <span class="h5">Tambah Laporan Gangguan</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.dashboard.ticket.index') }}" class="btn btn-outline-primary">← Kembali</a>
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
                                <form action="{{ route('admin.dashboard.ticket.store') }}" method="POST">
                                    @csrf
                                    <div class="row gx-3 gy-4">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label for="select2Basic" class="form-label">Client</label>
                                                <select id="select2Basic" name="client_id" class="select2 form-control form-control-lg" data-allow-clear="true" style="width: 100%">
                                                    <option value="">-- Pilih Client --</option>
                                                    @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->nopel }} - {{ $client->nama }} {{ $client->no_hp }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="users_id" class="form-label">Pilih Installer</label>
                                                <select name="users_id" class="form-control" required>
                                                    <option value="">-- Pilih Installer --</option>
                                                    @foreach($installers as $installer)
                                                    <option value="{{ $installer->id }}">{{ $installer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Type Task</label>
                                                <select name="type_task" class="form-select" required>
                                                    <option value="Gangguan">Gangguan</option>
                                                    <option value="Customers Support">Customers Support</option>
                                                    <option value="Support NOC">Support NOC</option>
                                                    <option value="Maintenance">Maintenance</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Detail Task</label>
                                                <textarea name="detail_task" class="form-control"></textarea>
                                            </div>

                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="open">Open</option>
                                                    <option value="cancel">Cancel</option>
                                                    <option value="process">Process</option>
                                                    <option value="finish">Finish</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="flatpickr-date" class="form-label">Status Finish</label>
                                                <input type="text" class="form-control" name="status_finish" placeholder="YYYY-MM-DD" id="flatpickr-date" />
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Solving</label>
                                                <select name="solving" class="form-select">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="Ganti Router">Ganti Router</option>
                                                    <option value="Ganti Adaptor">Ganti Adaptor</option>
                                                    <option value="Kabel Putus">Kabel Putus</option>
                                                    <option value="Setting NOC">Setting NOC</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label class="form-label">Note</label>
                                                <textarea name="note" class="form-control"></textarea>
                                            </div>
                                            <!-- <div class="mb-3">
                                                <label>Ticket Guarantee</label>
                                                <select name="ticket_guarantee" class="form-control">
                                                    <option value="0">Tidak</option>
                                                </select>
                                            </div> -->
                                        </div>

                                        <div class="col-12  mt-4">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
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