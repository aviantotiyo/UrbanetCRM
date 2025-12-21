<div class="container">
    <h4 class="mb-4">Tambah Kategori</h4>

    <form action="{{ route('admin.warehouse_category.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Kode Kategori</label>
            <input type="text" name="kode_kategori" class="form-control @error('kode_kategori') is-invalid @enderror" value="{{ old('kode_kategori') }}" required>
            @error('kode_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}" required>
            @error('nama_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.warehouse_category.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>