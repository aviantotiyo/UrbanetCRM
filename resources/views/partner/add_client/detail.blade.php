@section('title', 'Daftar Pendaftaran Pelanggan')
@include('client.template.head')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include("partner.template.sidebar")
            <!-- Layout container -->
            <div class="layout-page">
                @include('partner.template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="col-md-6 col-xxl-4 mb-6">
                            @if (session('success'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                {!! session('success') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <div class="card h-100">
                                <div class="card-header header-elements">
                                    <h5 class="mb-0 me-2">Detail Pelanggan</h5>
                                </div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-4">NIK</dt>
                                        <dd class="col-sm-8">{{ $client->nik }}</dd>

                                        <dt class="col-sm-4">Nama</dt>
                                        <dd class="col-sm-8">{{ $client->nama }}</dd>

                                        <dt class="col-sm-4">No HP</dt>
                                        <dd class="col-sm-8">{{ $client->no_hp }}</dd>

                                        <dt class="col-sm-4">Email</dt>
                                        <dd class="col-sm-8">{{ $client->email }}</dd>

                                        <dt class="col-sm-4">Alamat</dt>
                                        <dd class="col-sm-8">{{ $client->alamat }}</dd>

                                        <dt class="col-sm-4">Kecamatan</dt>
                                        <dd class="col-sm-8">{{ $client->kecamatan }}</dd>

                                        <dt class="col-sm-4">Kabupaten</dt>
                                        <dd class="col-sm-8">{{ $client->kabupaten }}</dd>

                                        <dt class="col-sm-4">Provinsi</dt>
                                        <dd class="col-sm-8">{{ $client->provinsi }}</dd>

                                        <dt class="col-sm-4">Status</dt>
                                        <dd class="col-sm-8">{{ ucfirst($client->status) }}</dd>

                                        <dt class="col-sm-4">Fee</dt>
                                        <dd class="col-sm-8">Rp {{ number_format($client->fee, 0, ',', '.') }}</dd>

                                        <dt class="col-sm-4">Fee Paid</dt>
                                        <dd class="col-sm-8">{{ $client->fee_paid ? 'Sudah Dibayar' : 'Belum Dibayar' }}</dd>

                                        <dt class="col-sm-4">Tanggal Dibayar</dt>
                                        <dd class="col-sm-8">{{ $client->fee_date_paid ? \Carbon\Carbon::parse($client->fee_date_paid)->format('d M Y') : '-' }}</dd>
                                    </dl>

                                    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
    @include('client.template.footer')

</body>

</html>