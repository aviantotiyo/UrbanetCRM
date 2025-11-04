<div class="container">
    <h4 class="mb-4">Edit Referral</h4>

    <form method="POST" action="{{ route('admin.team.referral.update', $prospect->id) }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $prospect->nama) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ old('nik', $prospect->nik) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $prospect->no_hp) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $prospect->alamat) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Kecamatan</label>
            <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $prospect->kecamatan) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Kabupaten</label>
            <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten', $prospect->kabupaten) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Provinsi</label>
            <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $prospect->provinsi) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Point</label>
            <input type="number" name="point" class="form-control" value="{{ old('point', $prospect->point) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ old('status', $prospect->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ old('status', $prospect->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ old('status', $prospect->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.team.referral.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>