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
                                <div class="card-body">
                                    <h5 class="mb-3">Lengkapi Email Anda</h5>
                                    <p>Untuk melanjutkan pembayaran, lengkapi alamat email terlebih dahulu. Proses ini hanya satu kali saja.</p>

                                    <form method="POST" action="{{ route('client.add_email.store') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Alamat Email</label>
                                            <input type="email" class="form-control" id="email" name="email" required placeholder="nama@email.com">
                                            @error('email')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan & Lanjutkan</button>
                                    </form>
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