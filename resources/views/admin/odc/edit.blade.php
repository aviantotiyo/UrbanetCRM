@section('title', 'Edit Data ODC')
@include('template.head')

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
                                    <span class="h5">Edit Data ODC</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <a href="{{ route('admin.odc.index') }}" class="btn btn-outline-primary">← Kembali</a>
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


                        <form method="POST" action="{{ route('admin.odc.update', $odc->id) }}" novalidate>
                            @csrf

                            <div class="card shadow-sm mb-3">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Server (POP)</label>
                                            <select name="server_id" class="form-select @error('server_id') is-invalid @enderror">
                                                <option value="">-- pilih server --</option>
                                                @foreach($servers as $sv)
                                                <option value="{{ $sv->id }}" {{ old('server_id', $odc->server_id) == $sv->id ? 'selected' : '' }}>
                                                    {{ $sv->nama_pop }}{{ $sv->ip_public ? ' — '.$sv->ip_public : '' }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('server_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Kode ODC <span class="text-danger">*</span></label>
                                            <input name="kode_odc" class="form-control @error('kode_odc') is-invalid @enderror"
                                                value="{{ old('kode_odc', $odc->kode_odc) }}" required>
                                            @error('kode_odc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Nama ODC</label>
                                            <input name="nama_odc" class="form-control @error('nama_odc') is-invalid @enderror"
                                                value="{{ old('nama_odc', $odc->nama_odc) }}">
                                            @error('nama_odc')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card shadow-sm mb-3">
                                <div class="card-body">
                                    <h6 class="mb-3">Lokasi</h6>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Alamat</label>
                                            <input name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                                value="{{ old('alamat', $odc->alamat) }}" placeholder="Alamat lengkap ODC">
                                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <!-- PROVINSI -->
                                        <div class="col-md-4">
                                            <label class="form-label" for="prov_odc">Provinsi</label>
                                            <select id="prov_odc" name="prov" class="form-select @error('prov') is-invalid @enderror">
                                                <option value="">-- pilih provinsi --</option>
                                                @foreach($provinsiRaw ?? [] as $p)
                                                <option value="{{ $p['name'] }}" data-id="{{ $p['id'] }}"
                                                    {{ old('prov', $odc->prov ?? '') == $p['name'] ? 'selected' : '' }}>
                                                    {{ $p['name'] }}
                                                </option>
                                                @endforeach
                                            </select>

                                            @error('prov')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <!-- KABUPATEN -->
                                        <div class="col-md-4">
                                            <label class="form-label" for="kota_odc">Kota/Kab</label>
                                            <select id="kota_odc" name="kota" class="form-select @error('kota') is-invalid @enderror">
                                                <option value="">-- pilih kabupaten/kota --</option>
                                            </select>

                                            @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <!-- KECAMATAN -->
                                        <div class="col-md-4">
                                            <label class="form-label" for="kec_odc">Kecamatan</label>
                                            <select id="kec_odc" name="kec" class="form-select @error('kec') is-invalid @enderror">
                                                <option value="">-- pilih kecamatan --</option>
                                            </select>
                                            @error('kec')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>




                                        <div class="col-md-4">
                                            <label class="form-label">Desa</label>
                                            <input name="desa" class="form-control @error('desa') is-invalid @enderror"
                                                value="{{ old('desa', $odc->desa) }}">
                                            @error('desa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label">Link Gmap</label>
                                            <input name="loc_odp" class="form-control @error('loc_odp') is-invalid @enderror"
                                                value="{{ old('loc_odp', $odc->loc_odp) }}" placeholder="">
                                            @error('loc_odp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            <div id="defaultFormControlHelp" class="form-text">
                                                Contoh: https://maps.app.goo.gl/YZKJaJuhwXUFCJs27
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Latitude</label>
                                            <input name="lat" class="form-control @error('lat') is-invalid @enderror"
                                                value="{{ old('lat', $odc->lat) }}" placeholder="-6.2">
                                            @error('lat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-2">
                                            <label class="form-label">Longitude</label>
                                            <input name="long" class="form-control @error('long') is-invalid @enderror"
                                                value="{{ old('long', $odc->long) }}" placeholder="106.8">
                                            @error('long')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm mb-3">
                                <div class="card-body">
                                    <h6 class="mb-3">Spesifikasi</h6>
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label">Port Capacity</label>
                                            <input name="port_cap" class="form-control @error('port_cap') is-invalid @enderror"
                                                value="{{ old('port_cap', $odc->port_cap) }}">
                                            @error('port_cap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Port Installed</label>
                                            <input name="port_install" class="form-control @error('port_install') is-invalid @enderror"
                                                value="{{ old('port_install', $odc->port_install) }}">
                                            @error('port_install')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Rasio</label>
                                            <input name="rasio" class="form-control @error('rasio') is-invalid @enderror"
                                                value="{{ old('rasio', $odc->rasio) }}" placeholder="mis: 1:4">
                                            @error('rasio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Image (URL / path)</label>
                                            <input name="image" class="form-control @error('image') is-invalid @enderror"
                                                value="{{ old('image', $odc->image) }}">
                                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Warna Core</label>
                                            <input name="warna_core" class="form-control @error('warna_core') is-invalid @enderror"
                                                value="{{ old('warna_core', $odc->warna_core) }}">
                                            @error('warna_core')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Core Cable</label>
                                            <input name="core_cable" class="form-control @error('core_cable') is-invalid @enderror"
                                                value="{{ old('core_cable', $odc->core_cable) }}">
                                            @error('core_cable')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Catatan</label>
                                            <textarea name="note" rows="3" class="form-control @error('note') is-invalid @enderror"
                                                placeholder="Catatan ODC...">{{ old('note', $odc->note) }}</textarea>
                                            @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12 d-flex gap-2 pt-2">
                                            <button class="btn btn-primary">Update</button>
                                            <a href="{{ route('admin.odc.index') }}" class="btn btn-outline-secondary">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="d-flex gap-2">
                                <button class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.odc.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div> -->
                        </form>

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


        @include('template.js.kota-odc')
        @include('template.footer')
</body>

</html>