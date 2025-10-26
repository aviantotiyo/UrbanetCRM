@section('title', 'Tambah Port ODC')
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
                                    <span class="h5">Tambah Port ODC {{ $odc->kode_odc }}</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <a href="{{ route('admin.odc.show', $odc->id) }}" class="btn btn-outline-secondary">← Kembali</a>
                            </div>
                        </div>
                        {{-- Alert sukses --}}
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


                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-header">Detail ODC Terpasang</h5>
                                <form method="POST" action="{{ route('admin.odc_port.store', $odc->id) }}" novalidate>
                                    @csrf

                                    {{-- Hidden odc_id agar ikut terkirim (meski controller ambil dari URL juga) --}}
                                    <input type="hidden" name="odc_id" value="{{ $odc->id }}">

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">ODP (tujuan)</label>
                                            <select name="odp_id" class="form-select @error('odp_id') is-invalid @enderror" required>
                                                <option value="">-- pilih ODP --</option>
                                                @foreach($odps as $o)
                                                <option value="{{ $o->id }}" {{ old('odp_id')===$o->id ? 'selected' : '' }}>
                                                    {{ $o->kode_odp }}{{ $o->nama_odp ? ' — '.$o->nama_odp : '' }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('odp_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Nomor/Label Port <span class="text-danger">*</span></label>
                                            <input name="port_numb" class="form-control @error('port_numb') is-invalid @enderror"
                                                value="{{ old('port_numb') }}" placeholder="mis: 01 / A1 / 1.1" required>
                                            <div class="form-text">Boleh huruf/angka, underscore (_), minus (-), titik (.)</div>
                                            @error('port_numb')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                                @foreach(($statuses ?? ['available','reserved','active','faulty','blocked']) as $st)
                                                <option value="{{ $st }}" {{ old('status','available')===$st ? 'selected' : '' }}>
                                                    {{ ucfirst($st) }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12 d-flex gap-2 pt-2">
                                            <button class="btn btn-primary">Simpan</button>
                                            <a href="{{ route('admin.odc.show', $odc->id) }}" class="btn btn-outline-secondary">Batal</a>
                                        </div>
                                    </div>

                                </form>
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

    @include('template.footer')

</body>

</html>