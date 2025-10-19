<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Tambah Pelanggan — UrbanetCRM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1 class="h5 mb-0">Tambah Pelanggan</h1>
                            <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-sm btn-outline-secondary">← Kembali</a>
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

                        {{-- Info field otomatis --}}
                        <div class="alert alert-info small">
                            <div><strong>NoPel</strong> akan dibuat otomatis (format: ID12345678).</div>
                            <div><strong>User PPPoE</strong> otomatis sama dengan NoPel.</div>
                            <div><strong>Pass PPPoE</strong> otomatis 6 digit angka acak.</div>
                        </div>

                        <form method="POST" action="{{ route('admin.pelanggan.store') }}" novalidate>
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                                        value="{{ old('nama') }}" required>
                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">No HP</label>
                                    <input name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx">
                                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="email@domain.com">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">NIK</label>
                                    <input name="nik" type="text" class="form-control @error('nik') is-invalid @enderror"
                                        value="{{ old('nik') }}">
                                    @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label">Alamat</label>
                                    <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                        value="{{ old('alamat') }}">
                                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="provinsi_pel">Provinsi</label>
                                    <select id="provinsi_pel" name="provinsi" class="form-select @error('provinsi') is-invalid @enderror">
                                        <option value="">-- pilih provinsi --</option>
                                        @foreach(($provinsiRaw ?? []) as $p)
                                        <option value="{{ $p['name'] ?? '' }}" data-id="{{ $p['id'] ?? '' }}"
                                            {{ old('provinsi')===($p['name'] ?? '') ? 'selected' : '' }}>
                                            {{ $p['name'] ?? '' }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('provinsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="kabupaten_pel">Kabupaten/Kota</label>
                                    <select id="kabupaten_pel" name="kabupaten" class="form-select @error('kabupaten') is-invalid @enderror" disabled>
                                        <option value="">-- pilih kabupaten/kota --</option>
                                    </select>
                                    @error('kabupaten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="kecamatan_pel">Kecamatan</label>
                                    <select id="kecamatan_pel" name="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror" disabled>
                                        <option value="">-- pilih kecamatan --</option>
                                    </select>
                                    @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label">Lokasi Client (lat,long / deskripsi)</label>
                                    <input name="loc_client" type="text" class="form-control @error('loc_client') is-invalid @enderror"
                                        value="{{ old('loc_client') }}" placeholder="-6.xxxx,106.xxxx">
                                    @error('loc_client')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Paket</label>
                                    <input name="paket" type="text" class="form-control @error('paket') is-invalid @enderror"
                                        value="{{ old('paket') }}" placeholder="Home 20M / Biz 50M">
                                    @error('paket')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Tagihan</label>
                                    <input name="tagihan" type="text" class="form-control @error('tagihan') is-invalid @enderror"
                                        value="{{ old('tagihan') }}" placeholder="250000">
                                    @error('tagihan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Name Profile</label>
                                    <input name="name_profile" type="text" class="form-control @error('name_profile') is-invalid @enderror"
                                        value="{{ old('name_profile') }}" placeholder="home-20m / biz-50m">
                                    @error('name_profile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Limit Radius</label>
                                    <input name="limit_radius" type="text" class="form-control @error('limit_radius') is-invalid @enderror"
                                        value="{{ old('limit_radius') }}" placeholder="512k/512k">
                                    @error('limit_radius')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Active User (datetime)</label>
                                    <input name="active_user" type="datetime-local"
                                        class="form-control @error('active_user') is-invalid @enderror"
                                        value="{{ old('active_user') }}">
                                    @error('active_user')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">ODP ID</label>
                                    <input name="odp_id" type="text" class="form-control @error('odp_id') is-invalid @enderror"
                                        value="{{ old('odp_id') }}">
                                    @error('odp_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">ODP Port ID</label>
                                    <input name="odp_port_id" type="text" class="form-control @error('odp_port_id') is-invalid @enderror"
                                        value="{{ old('odp_port_id') }}">
                                    @error('odp_port_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        @php
                                        $statuses = ['booking','active','isolir','suspend','inactive'];
                                        $oldStatus = old('status','booking');
                                        @endphp
                                        @foreach ($statuses as $s)
                                        <option value="{{ $s }}" {{ $oldStatus===$s?'selected':'' }}>{{ $s }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Tag</label>
                                    <input name="tag" type="text" class="form-control @error('tag') is-invalid @enderror"
                                        value="{{ old('tag') }}" placeholder="VIP, Corporate, Residential">
                                    @error('tag')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Catatan</label>
                                    <textarea name="note" rows="3" class="form-control @error('note') is-invalid @enderror"
                                        placeholder="Catatan tambahan...">{{ old('note') }}</textarea>
                                    @error('note')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Foto Depan (path/URL)</label>
                                    <input name="foto_depan" type="text" class="form-control @error('foto_depan') is-invalid @enderror"
                                        value="{{ old('foto_depan') }}" placeholder="uploads/foto_depan.jpg">
                                    @error('foto_depan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12 d-flex gap-2 pt-2">
                                    <button class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center text-muted small mt-3 mb-0">v1 • add client</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @include('template.js.kota')


</body>

</html>