@section('title', 'Daftar Referral')
@include('client.template.head')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include("client.template.sidebar")
            <!-- Layout container -->
            <div class="layout-page">
                @include('client.template.navbar')

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
                                    <h5 class="mb-0 me-2">Daftar Referral</h5>
                                    @if($referrals->isNotEmpty())
                                    <div class="card-header-elements ms-auto">
                                        <a href="{{ route('client.referral.create') }}" class="btn btn-xs btn-primary waves-effect waves-light">
                                            <span class="tf-icon ti ti-plus ti-xs me-1"></span>Ajak Teman</a>

                                    </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    @if($referrals->isNotEmpty())
                                    <ul class="list-group">
                                        @foreach($referrals as $ref)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">
                                                        {{ $ref->nama }}
                                                    </h6>
                                                    <small class="text-body d-block">{{ $ref->no_hp }}</small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0"><span class="badge rounded-pill bg-label-primary">{{ ucfirst($ref->status) }}</span></p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <p>Dapatkan point senilai {{ number_format($point, 0, ',', '.') }} point dengan mengajak teman/tetangga bergabung menjadi pelanggan kami.</p>
                                    <p> Point akan langsung bisa di gunakan untuk tagihan bulanan.</p>
                                    <a href="{{ route('client.referral.create') }}" class="btn btn-primary w-100">Ajak Teman/Tetangga</a>
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