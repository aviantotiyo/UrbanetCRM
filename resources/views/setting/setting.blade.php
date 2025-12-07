@section('title', 'Setting CRM')
@include('template.head')


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
                                    <span class="h5">Ubah Pengaturan</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <!-- <a href="{{ route('admin.team.index') }}" class="btn btn-outline-primary">← Kembali</a> -->
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

                        @if(session('success'))
                        <div class="alert alert-primary">{{ session('success') }}</div>
                        @endif
                        <!-- <div class="row g-6"> -->
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('admin.setting.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    @foreach([
                                    'denda' => 'Denda',
                                    'point' => 'Point',
                                    'tax' => 'Tax (%)',
                                    'fee_merchant_billing' => 'Fee Merchant Billing',
                                    'fee_merchant_sales' => 'Fee Merchant Sales',
                                    'fee_sales_internal' => 'Fee Sales Internal',
                                    'fee_engineer_sales' => 'Fee Engineer Sales',
                                    'fee_engineer' => 'Fee Engineer',
                                    'fee_engineer_2' => 'Fee Engineer Support'
                                    ] as $field => $label)
                                    <div class="mb-3 col-4">
                                        <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                                        <input type="number" name="{{ $field }}" id="{{ $field }}" class="form-control" value="{{ old($field, $setting->$field) }}">
                                    </div>
                                    @endforeach

                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
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
</body>

</html>