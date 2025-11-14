@section('title', 'Edit Data Mitra Pembayaran')
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


                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="mb-1">
                                    <span class="h5">Mitra Pembayaran</span>
                                    <span class="badge bg-label-{{ $partner->status == 'active' ? 'primary' : 'secondary' }} me-1 ms-2">{{ ucfirst($partner->status) }}</span>
                                    <!-- <span class="badge bg-label-primary me-1 ms-2">Active</span>

                                    <span class="badge bg-secondary">Inactive</span> -->

                                </div>
                                <p class="mb-0">Registrasi: {{ \Carbon\Carbon::parse($partner->created_at)->format('d/m/Y H:i') }} WIB</p>
                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <a href="{{ route('admin.partner.index') }}" class="btn btn-outline-primary">← Kembali</a>
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
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('admin.partner.update', $partner->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')


                                    <div class="row">
                                        <!-- KIRI -->
                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="mb-3">
                                                <label for="nama_partner" class="form-label">Nama Mitra</label>
                                                <input type="text" class="form-control" name="nama_partner" value="{{ $partner->nama_partner }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="no_hp" class="form-label">Nomor HP</label>
                                                <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $partner->no_hp }}" required readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" name="alamat" rows="2">{{ $partner->alamat }}</textarea>
                                            </div>


                                        </div>

                                        <!-- KANAN -->

                                        <div class="col-12 col-md-6 mb-4">
                                            <div class="mb-3">
                                                <label class="form-label">Provinsi</label>
                                                <select id="provinsi_pel" name="provinsi" class="form-select" required>
                                                    <option value="">-- pilih provinsi --</option>
                                                    @foreach($provinsiRaw as $p)
                                                    <option value="{{ $p['name'] }}" {{ old('provinsi', $partner->provinsi) === $p['name'] ? 'selected' : '' }}>
                                                        {{ $p['name'] }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('provinsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kabupaten</label>
                                                <!-- <input type="text" class="form-control mt-2" readonly value="Selected Kabupaten: {{ old('kabupaten', $partner->kabupaten) }}"> -->

                                                <select id="kabupaten_pel" name="kabupaten" class="form-select" data-selected="{{ old('kabupaten', $partner->kabupaten) }}">
                                                    <option value="">-- pilih kabupaten --</option>
                                                </select>
                                                @error('kabupaten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kecamatan</label>
                                                <!-- <input type="text" class="form-control mt-2" readonly value="Selected Kecamatan: {{ old('kecamatan', $partner->kecamatan) }}"> -->

                                                <select id="kecamatan_pel" name="kecamatan" class="form-select" data-selected="{{ old('kecamatan', $partner->kecamatan) }}">
                                                    <option value="">-- pilih kecamatan --</option>
                                                </select>
                                                @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mb-4">
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" name="status" required>
                                                <option value="active" {{ $partner->status === 'active' ? 'selected' : '' }}>Aktif</option>
                                                <option value="inactive" {{ $partner->status === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                                            <input type="text" class="form-control" name="password">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                            </div>


                            </form>
                        </div>

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
    @include('template.js.select-city-partner')

    @include('template.js.title-case')
    @include('template.js.no-hp')

    @include('template.footer')


</body>

</html>