<div class="container">
    <h4 class="mb-4">Tambah Gudang Baru</h4>

    <form action="{{ route('admin.dashboard_warehouse.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="kode_gudang" class="form-label">Kode Gudang</label>
            <input type="text" name="kode_gudang" class="form-control" value="{{ old('kode_gudang') }}" required>
            @error('kode_gudang') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="nama_gudang" class="form-label">Nama Gudang</label>
            <input type="text" name="nama_gudang" class="form-control" value="{{ old('nama_gudang') }}" required>
            @error('nama_gudang') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi (Opsional)</label>
            <textarea name="lokasi" class="form-control">{{ old('lokasi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Gudang</label>
            <select name="jenis" class="form-select" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="internal" {{ old('jenis') == 'internal' ? 'selected' : '' }}>Internal</option>
                <option value="personal" {{ old('jenis') == 'personal' ? 'selected' : '' }}>Personal</option>
            </select>
            @error('jenis') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.dashboard_warehouse.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>