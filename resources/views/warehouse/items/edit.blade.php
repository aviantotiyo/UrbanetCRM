<div class="container">
    <h4 class="mb-4">Edit Barang</h4>

    <form action="{{ route('admin.warehouse_items.update', $item->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Kode Barang</label>
            <input type="text" class="form-control" value="{{ $item->kode_barang }}" readonly>
        </div>

        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang', $item->nama_barang) }}" required>
            @error('nama_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="category_id" class="form-select" required>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>
                    {{ $cat->nama_kategori }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Unit</label>
            <select name="unit_type" class="form-select" required>
                @foreach(['unit', 'roll', 'meter', 'lainnya'] as $unit)
                <option value="{{ $unit }}" {{ old('unit_type', $item->unit_type) == $unit ? 'selected' : '' }}>{{ ucfirst($unit) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Spesifikasi</label>
            <textarea name="spesifikasi" class="form-control">{{ old('spesifikasi', $item->spesifikasi) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Barcode</label>
            <input type="text" name="barcode" class="form-control" value="{{ old('barcode', $item->barcode) }}">
        </div>

        <div class="mb-3">
            <label>Harga Satuan</label>
            <input type="number" name="harga_satuan" class="form-control" value="{{ old('harga_satuan', $item->harga_satuan) }}">
        </div>

        <div class="mb-3">
            <label>URL Gambar</label>
            <input type="text" name="img" class="form-control" value="{{ old('img', $item->img) }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('admin.warehouse_items.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>