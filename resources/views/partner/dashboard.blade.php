@section('title', 'Dashboard Pelanggan')
@include('client.template.head')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include("client.template.sidebar")
            <!-- Layout container -->
            <div class="layout-page">
                @include('partner.template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y ">
                        <div class="col-md-6 col-xxl-4 mb-6">
                            @if (session('success'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                {!! session('success') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            {{-- (Opsional) Alert error umum --}}
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {!! session('error') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="bg-label-primary rounded text-center mb-4 pt-4">
                                        <img
                                            class="img-fluid"
                                            src="../../assets/img/illustrations/girl-with-laptop.png"
                                            alt="Card girl image"
                                            width="140" />
                                    </div>
                                    <h5 class="mb-2">Halo. {{ $partner->nama_partner }}</h5>

                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-address-book ti-28px"></i></span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-nowrap">
                                                        <h6 class="mb-0 text-nowrap">{{ Str::title($partner->status) }}</h6>
                                                    </h6>
                                                    <small>Status Mitra</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-album ti-28px"></i></span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-nowrap">{{ $partner->created_at->format('d/m/Y') }}
                                                    </h6>
                                                    <small>Terdaftar</small>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="small">
                                            Selamat bekerja dan terimakasih masih setia menjadi mitra pembayaran kami. Gunakan nomor telp yang di daftarkan oleh pelanggan.
                                        </p>
                                        <hr>
                                    </div>
                                    @if ($errors->any())
                                    <div class="alert alert-primary mt-2">
                                        @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                        @endforeach
                                    </div>
                                    @endif

                                    @if (session('info'))
                                    <div class="alert alert-primary mt-2">
                                        {{ session('info') }}
                                    </div>
                                    @endif

                                    <form action="{{ route('partner.dashboard.searchBilling') }}" method="POST" class="mb-4">
                                        @csrf
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="ti ti-search"></i></span>
                                            <input type="text" name="no_hp" class="form-control" placeholder="Cari No HP..." required>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary w-100">Cari Tagihan</button>
                                        </div>
                                    </form>

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