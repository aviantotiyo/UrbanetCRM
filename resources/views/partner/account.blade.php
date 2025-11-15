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
                                    <p>Nama Mitra: <strong>{{ $partner->nama_partner }}</strong></p>
                                    <p>Nomor HP: <strong>{{ $partner->no_hp }}</strong></p>
                                    <p>Alamat: <strong>{{ $partner->alamat }}<br />{{ $partner->provinsi }}/{{ $partner->kabupaten }}/{{ $partner->kecamatan }}</strong></p>
                                    <p>Status Akun:
                                        <strong class="{{ $partner->status === 'active' ? 'text-success' : 'text-danger' }}">
                                            {{ ucfirst($partner->status) }}
                                        </strong>
                                    </p>

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