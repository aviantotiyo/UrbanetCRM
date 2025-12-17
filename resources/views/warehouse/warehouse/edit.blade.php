<div class="container">
    <h4 class="mb-4">Edit Gudang</h4>

    <form action="{{ route('admin.dashboard_warehouse.update', $gudang->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="kode_gudang" class="form-label">Kode Gudang</label>
            <input type="text" name="kode_gudang" class="form-control" value="{{ old('kode_gudang', $gudang->kode_gudang) }}" required>
            @error('kode_gudang') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="nama_gudang" class="form-label">Nama Gudang</label>
            <input type="text" name="nama_gudang" class="form-control" value="{{ old('nama_gudang', $gudang->nama_gudang) }}" required>
            @error('nama_gudang') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi (Opsional)</label>
            <textarea name="lokasi" class="form-control">{{ old('lokasi', $gudang->lokasi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Gudang</label>
            <select name="jenis" class="form-select" required>
                <option value="internal" {{ old('jenis', $gudang->jenis) == 'internal' ? 'selected' : '' }}>Internal</option>
                <option value="personal" {{ old('jenis', $gudang->jenis) == 'personal' ? 'selected' : '' }}>Personal</option>
            </select>
            @error('jenis') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('admin.dashboard_warehouse.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>