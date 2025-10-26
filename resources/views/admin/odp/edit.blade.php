@section('title', 'Edit Data ODP')
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
                                    <span class="h5">Edit Data ODP</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <a href="{{ route('admin.odp.index') }}" class="btn btn-outline-primary">← Kembali</a>
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
                        <form method="POST" action="{{ route('admin.odp.update', $odp->id) }}" novalidate>
                            @csrf
                            <div class="card shadow-sm mb-3">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label">Kode ODP <span class="text-danger">*</span></label>
                                            <input name="kode_odp" type="text" class="form-control @error('kode_odp') is-invalid @enderror"
                                                value="{{ old('kode_odp', $odp->kode_odp) }}" required placeholder="ODP-XXX-001">
                                            @error('kode_odp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Nama ODP</label>
                                            <input name="nama_odp" type="text" class="form-control @error('nama_odp') is-invalid @enderror"
                                                value="{{ old('nama_odp', $odp->nama_odp) }}">
                                            @error('nama_odp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Server (POP)</label>
                                            <select name="server_id" class="form-select @error('server_id') is-invalid @enderror">
                                                <option value="">-- pilih server --</option>
                                                @foreach ($servers ?? [] as $sv)
                                                <option value="{{ $sv->id }}" {{ old('server_id', $odp->server_id) == $sv->id ? 'selected' : '' }}>
                                                    {{ $sv->nama_pop }}{{ $sv->ip_public ? ' — '.$sv->ip_public : '' }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('server_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            <div class="form-text">Opsional. Menghubungkan ODP ini ke server/POP tertentu.</div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Lokasi (Gmap)</label>
                                            <input name="loc_odp" type="text" class="form-control @error('loc_odp') is-invalid @enderror"
                                                value="{{ old('loc_odp', $odp->loc_odp) }}" placeholder="">
                                            @error('loc_odp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            <div class="form-text">Contoh: https://maps.app.goo.gl/YZKJaJuhwX</div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Alamat</label>
                                            <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                value="{{ old('alamat', $odp->alamat) }}">
                                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <!-- PROVINSI -->
                                        <div class="col-md-3">
                                            <label class="form-label" for="provinsi">Provinsi</label>
                                            <select id="provinsi" name="prov" class="form-select @error('prov') is-invalid @enderror">
                                                <option value="">-- pilih provinsi --</option>
                                                @foreach($provinsiRaw ?? [] as $p)
                                                <option value="{{ $p['name'] }}" data-id="{{ $p['id'] }}"
                                                    {{ old('prov', $odp->prov) == $p['name'] ? 'selected' : '' }}>
                                                    {{ $p['name'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('prov')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <!-- KOTA/KAB -->
                                        <div class="col-md-3">
                                            <label class="form-label" for="kota">Kota/Kab</label>
                                            <select id="kota" name="kota" class="form-select @error('kota') is-invalid @enderror" disabled>
                                                <option value="">-- pilih kota/kabupaten --</option>
                                            </select>
                                            @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <!-- KECAMATAN -->
                                        <div class="col-md-3">
                                            <label class="form-label" for="kecamatan">Kecamatan</label>
                                            <select id="kecamatan" name="kec" class="form-select @error('kec') is-invalid @enderror" disabled>
                                                <option value="">-- pilih kecamatan --</option>
                                            </select>
                                            @error('kec')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Desa/Kel.</label>
                                            <input name="desa" type="text" class="form-control @error('desa') is-invalid @enderror"
                                                value="{{ old('desa', $odp->desa) }}">
                                            @error('desa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Port Capacity</label>
                                            <input name="port_cap" type="text" class="form-control @error('port_cap') is-invalid @enderror"
                                                value="{{ old('port_cap', $odp->port_cap) }}" placeholder="8 / 16 / 24">
                                            @error('port_cap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Port Installed</label>
                                            <input name="port_install" type="text" class="form-control @error('port_install') is-invalid @enderror"
                                                value="{{ old('port_install', $odp->port_install) }}" placeholder="0..N">
                                            @error('port_install')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <!-- vlan -->
                                        <div class="col-md-3">
                                            <label class="form-label">VLAN</label>
                                            <input name="vlan" type="text" class="form-control @error('vlan') is-invalid @enderror"
                                                value="{{ old('vlan', $odp->vlan) }}" placeholder="VLAN:10,20...">
                                            @error('vlan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Warna Core</label>
                                            <input name="warna_core" type="text" class="form-control @error('warna_core') is-invalid @enderror"
                                                value="{{ old('warna_core', $odp->warna_core) }}" placeholder="Blue/Orange/Green...">
                                            @error('warna_core')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">Core Cable</label>
                                            <input name="core_cable" type="text" class="form-control @error('core_cable') is-invalid @enderror"
                                                value="{{ old('core_cable', $odp->core_cable) }}" placeholder="12C / 24C / 48C">
                                            @error('core_cable')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Catatan</label>
                                            <textarea name="note" rows="3" class="form-control @error('note') is-invalid @enderror"
                                                placeholder="Catatan tambahan...">{{ old('note', $odp->note) }}</textarea>
                                            @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12 d-flex gap-2 pt-2">
                                            <button class="btn btn-primary">Update</button>
                                            <a href="{{ route('admin.odp.index') }}" class="btn btn-outline-secondary">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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



        @include('template.js.edit-kota-odp')
        @include('template.footer')
        <script src="{{ asset('assets/js/kota-odp.js') }}"></script>
</body>

</html>