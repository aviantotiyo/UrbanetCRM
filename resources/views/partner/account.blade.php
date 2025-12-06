@section('title', 'Pengaturan Akun')
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
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="mb-2">Pengaturan Akun</h5>
                                    <hr />
                                    <dl class="row mb-0 gx-2">
                                        <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Nama Mitra</dt>
                                        <dd class="col-sm-9">{{ $partner->nama_partner }}</dd>
                                        <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Nomor HP</dt>
                                        <dd class="col-sm-9">{{ $partner->no_hp }}</dd>
                                        <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Alamat</dt>
                                        <dd class="col-sm-9">{{ $partner->alamat }}<br />{{ $partner->provinsi }}/{{ $partner->kabupaten }}/{{ $partner->kecamatan }}</dd>
                                        <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Bank</dt>
                                        <dd class="col-sm-9">{{ $partner->bank_name }}</dd>
                                        <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Rekening Bank</dt>
                                        <dd class="col-sm-9">{{ $partner->bank_account }}</dd>
                                        <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Pemilik Bank</dt>
                                        <dd class="col-sm-9">{{ $partner->bank_pic }}</dd>
                                        <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Status Akun</dt>
                                        <dd class="col-sm-9"><strong class="{{ $partner->status === 'active' ? 'text-success' : 'text-danger' }}">
                                                {{ ucfirst($partner->status) }}
                                            </strong></dd>
                                    </dl>
                                    <hr />

                                    @if($partner->status === 'active')
                                    <form action="{{ route('partner.deactivate') }}" method="POST" onsubmit="return confirm('Yakin ingin menonaktifkan akun?')">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary mt-3">
                                            Non Aktifkan Akun
                                        </button>
                                    </form>
                                    @else
                                    <div class="alert alert-warning mt-3">Akun ini sudah tidak aktif.</div>
                                    @endif



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