@section('title', 'Edit/Process Data Instalasi Pelanggan')
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
                                    <span class="h5">Data Instalasi Pelanggan Baru <span class="badge bg-label-primary me-1 ms-2">{{ $ticket->status }}</span></span>
                                </div>
                                <p class="mb-0">ID: {{ $ticket->ticket_code }} | {{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y H:i') }} WIB</p>
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
                        <div class="row gy-4">
                            {{-- Form Update Tiket --}}
                            <div class="col-12 col-md-6">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <form action="{{ route('admin.dashboard.ticket_hc.update', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="client_id" value="{{ $client->id }}">

                                            <div class="mb-3">
                                                <label class="form-label">Nama Client</label>
                                                <input type="text" class="form-control" value="{{ $client->nama }}" disabled>
                                            </div>

                                            <div class="mb-3">
                                                <label for="users_id" class="form-label">Pilih Installer</label>
                                                <select name="users_id" class="form-select" required>
                                                    <option value="">-- Pilih Installer --</option>
                                                    @foreach($installers as $installer)
                                                    <option value="{{ $installer->id }}" {{ ($ticket->teamSite && $ticket->teamSite->users_id == $installer->id) ? 'selected' : '' }}>
                                                        {{ $installer->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Status</label>
                                                <select class="form-select" name="status">
                                                    <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                                    <option value="process" {{ $ticket->status == 'process' ? 'selected' : '' }}>Proses</option>
                                                    <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="cancel" {{ $ticket->status == 'cancel' ? 'selected' : '' }}>Cancel</option>
                                                    <option value="finish" {{ $ticket->status == 'finish' ? 'selected' : '' }}>Finish</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Merk Kabel Dropcore</label>
                                                <input type="text" class="form-control" name="merk_kabel" value="{{ $ticket->merk_kabel }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Panjang Kabel Dropcore ke ODP</label>
                                                <input type="text" class="form-control" name="panjang_kabel" value="{{ $ticket->panjang_kabel }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Sambungan Kabel Dropcore ke ODP</label>
                                                <input type="text" class="form-control" name="sambungan_kabel" value="{{ $ticket->sambungan_kabel }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Catatan</label>
                                                <textarea name="note" class="form-control" rows="4">{{ $ticket->note }}</textarea>
                                            </div>

                                            <div class="">
                                                <button type="submit" class="btn btn-primary">Update Instalasi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Informasi Client --}}
                            <div class="col-12 col-md-6">
                                <div class="card shadow-sm h-100">
                                    <div class="card-header">
                                        <h5 class="mb-0">Data Pelanggan</h5>
                                    </div>
                                    <div class="card-body">
                                        @php $server = $client->odp->server ?? null; @endphp

                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="text-muted small">No. Pelanggan (NoPel)</div>
                                                <div class="fw-semibold">{{ $client->nopel }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-muted small">Nama</div>
                                                <div class="fw-semibold">{{ $client->nama }}</div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="text-muted small">Email</div>
                                                <div class="fw-semibold">{{ $client->email ?: '—' }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-muted small">No HP</div>
                                                <div class="fw-semibold">{{ $client->no_hp ?: '—' }}</div>
                                            </div>

                                            <div class="col-12">
                                                <div class="text-muted small">NIK</div>
                                                <div class="fw-semibold">{{ $client->nik ?: '—' }}</div>
                                            </div>

                                            <div class="col-12">
                                                <div class="text-muted small">Alamat</div>
                                                <div class="fw-semibold">{{ $client->alamat ?: '—' }}</div>
                                            </div>

                                            <div class="col-12">
                                                <div class="text-muted small">Kecamatan / Kabupaten / Provinsi</div>
                                                <div class="fw-semibold">
                                                    {{ $client->kecamatan ?: '—' }} /
                                                    {{ $client->kabupaten ?: '—' }} /
                                                    {{ $client->provinsi ?: '—' }}
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="text-muted small">Lokasi Client</div>
                                                <div class="fw-semibold">
                                                    <a href="{{ $client->loc_client ?: '#' }}" target="_blank">Maps</a>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="text-muted small">Status</div>
                                                <span class="badge {{ $client->status === 'active' ? 'text-bg-primary' : 'text-bg-secondary' }}">
                                                    {{ $client->status }}
                                                </span>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="text-muted small">Active User</div>
                                                <div class="fw-semibold">
                                                    {{ $client->active_user ? \Carbon\Carbon::parse($client->active_user)->format('Y-m-d H:i') : '—' }}
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="text-muted small">Server</div>
                                                <div class="fw-semibold">{{ $server->nama_pop ?? '-' }} - {{ $server->ip_public ?? '-' }}</div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="text-muted small">Lokasi Server</div>
                                                <div class="fw-semibold">{{ $server->lokasi ?? '-' }}</div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="text-muted small">User PPPoE</div>
                                                <div class="fw-semibold">{{ $client->user_pppoe }}</div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="text-muted small">Pass PPPoE</div>
                                                <div class="fw-semibold">{{ $client->pass_pppoe }}</div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="text-muted small">Profile / Limit Radius</div>
                                                <div class="fw-semibold">
                                                    {{ $client->name_profile ?: '—' }} / {{ $client->limit_radius ?: '—' }}
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="text-muted small">ODP ID / Port</div>
                                                <div class="fw-semibold">
                                                    <a href="/admin/dashboard/odp/{{ $client->odp?->id ?? '' }}">
                                                        {{ $client->odp?->kode_odp ?? '—' }}
                                                    </a> / {{ $client->odpPort?->port_numb ?? '—' }}
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="text-muted small">Catatan</div>
                                                <div class="fw-semibold">{{ $client->note ?: '—' }}</div>
                                            </div>

                                            <div class="col-12">
                                                <div class="text-muted small">Tag</div>
                                                <div class="fw-semibold">{{ $client->tag ?: '—' }}</div>
                                            </div>

                                            <div class="col-12">
                                                <div class="text-muted small">Foto Depan</div>
                                                <div class="fw-semibold">{{ $client->foto_depan ?: '—' }}</div>
                                            </div>
                                        </div>
                                    </div>
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