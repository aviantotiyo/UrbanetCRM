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


                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="mb-1">
                                    <span class="h5">Laporan Gangguan {{ $ticket->ticket_code }} </span>
                                    @if ($ticket->ticket_guarantee == 0)
                                    <span class="badge bg-label-success me-1 ms-2">Laporan Baru</span>
                                    @elseif ($ticket->ticket_guarantee == 1)
                                    <span class="badge bg-warning">Gangguan Berulang</span>
                                    @endif
                                </div>
                                <p class="mb-0">{{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y H:i') }} WIB</p>
                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
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
                                <form action="{{ route('admin.dashboard.ticket.update', $ticket->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $ticket->id }}">

                                    <div class="row">
                                        <!-- KIRI -->
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="mb-3">
                                                <label>Kode Tiket</label>
                                                <input type="text" class="form-control" value="{{ $ticket->ticket_code }}" disabled>
                                            </div>

                                            <div class="mb-3">
                                                <label>Client</label>
                                                <select class="form-control" disabled>
                                                    @foreach($clients as $client)
                                                    <option value="{{ $client->id }}" {{ $ticket->client_id == $client->id ? 'selected' : '' }}>
                                                        {{ $client->nama }} - {{ $client->nopel }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="client_id" value="{{ $ticket->client_id }}">
                                            </div>



                                            <div class="mb-3">
                                                <label>Type Task</label>
                                                <select name="type_task" class="form-select" required>
                                                    @foreach(['Gangguan', 'Customers Support', 'Support NOC', 'Maintenance'] as $type)
                                                    <option value="{{ $type }}" {{ $ticket->type_task == $type ? 'selected' : '' }}>
                                                        {{ $type }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label>Detail Task</label>
                                                <textarea name="detail_task" class="form-control">{{ $ticket->detail_task }}</textarea>
                                            </div>


                                        </div>

                                        <!-- KANAN -->
                                        @auth
                                        @if(in_array(auth()->user()->role, ['Admin', 'NOC', 'Installer']))
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="mb-3">
                                                <label for="users_id" class="form-label">Installer</label>
                                                <select name="users_id" class="form-select" required>
                                                    <option value="">-- Pilih Installer --</option>
                                                    @foreach($installers as $installer)
                                                    <option value="{{ $installer->id }}"
                                                        {{ isset($teamSite) && $teamSite->users_id === $installer->id ? 'selected' : '' }}>
                                                        {{ $installer->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label>Status</label>
                                                <select name="status" class="form-select" required>
                                                    @foreach(['open', 'cancel', 'process', 'finish'] as $status)
                                                    <option value="{{ $status }}" {{ $ticket->status == $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label>Solving</label>
                                                <select name="solving" class="form-select">
                                                    @foreach(['Ganti Router', 'Ganti Adaptor', 'Kabel Putus', 'Setting NOC', 'Lainnya'] as $solve)
                                                    <option value="{{ $solve }}" {{ $ticket->solving == $solve ? 'selected' : '' }}>
                                                        {{ $solve }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label>Note</label>
                                                <textarea name="note" class="form-control">{{ $ticket->note }}</textarea>
                                            </div>
                                        </div>
                                        @endif
                                        @endauth
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>

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

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>


    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>

</body>

</html>