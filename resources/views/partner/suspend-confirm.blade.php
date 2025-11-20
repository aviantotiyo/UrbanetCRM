@section('title', 'Client Suspend')
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
                    <div class="container-xxl flex-grow-1 container-p-y ">
                        <div class="col-md-6 col-xxl-4 mb-6">

                            <div class="card h-100">
                                <div class="card-body">
                                    <p>
                                        Pelanggan <strong>{{ $client->nama }}</strong> NoPel: {{ $client->nopel ?? '-' }} saat ini dalam kondisi <strong>Masa Tenggang</strong> karena belum melakukan pembayaran.
                                    </p>
                                    <p>Pelanggan di wajibkan membayar tagihan bulan sebelumnya dan tagihan bulan berjalan.
                                    </p>

                                    <div class="mt-2">
                                        <a href="{{ route('partner.user_suspend.process', $client->id) }}" class="btn btn-primary w-100">Ya. Pelanggan Bersedia Membayar</a>
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
            @include('template.js.no-hp')

</body>

</html>