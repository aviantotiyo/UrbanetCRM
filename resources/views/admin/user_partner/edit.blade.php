<div class="container py-4">
    <h4>Edit Data Prospek</h4>

    <form action="{{ route('admin.list-prospek-mitra.user_partner.update', $client->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $client->nama) }}" required>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $client->no_hp) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="active" {{ $client->status == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ $client->status == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.list-prospek-mitra.user_partner.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>