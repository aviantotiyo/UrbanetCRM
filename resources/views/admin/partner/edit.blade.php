<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Edit Mitra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-5">
        <h2 class="mb-4">Edit Mitra</h2>

        <form action="{{ route('admin.partner.update', $partner->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_partner" class="form-label">Nama Mitra</label>
                <input type="text" class="form-control" name="nama_partner" value="{{ $partner->nama_partner }}" required>
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" name="no_hp" value="{{ $partner->no_hp }}" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" rows="2">{{ $partner->alamat }}</textarea>
            </div>

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label class="form-label">Provinsi</label>
                    <input type="text" class="form-control" name="provinsi" value="{{ $partner->provinsi }}">
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label">Kabupaten</label>
                    <input type="text" class="form-control" name="kabupaten" value="{{ $partner->kabupaten }}">
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label">Kecamatan</label>
                    <input type="text" class="form-control" name="kecamatan" value="{{ $partner->kecamatan }}">
                </div>
            </div>

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

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.partner.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>