<div class="mb-3">
    <label class="form-label">Lokasi Gudang</label>
    <select name="warehouse_id" class="form-select" required>
        @foreach($warehouses as $wh)
        <option value="{{ $wh->id }}" {{ (old('warehouse_id', $stock->warehouse_id ?? '') == $wh->id) ? 'selected' : '' }}>
            {{ $wh->nama_gudang }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Item Barang</label>
    <select name="item_id" class="form-select" required>
        @foreach($items as $item)
        <option value="{{ $item->id }}" {{ (old('item_id', $stock->item_id ?? '') == $item->id) ? 'selected' : '' }}>
            {{ $item->nama_barang }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Kategori Barang</label>
    <select name="category_id" class="form-select" required>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ (old('category_id', $stock->category_id ?? '') == $cat->id) ? 'selected' : '' }}>
            {{ $cat->nama_kategori }}
        </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Stock Tersedia</label>
    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $stock->jumlah ?? 0) }}">
</div>

<div class="mb-3" class="form-label">
    <label>Kode Rak</label>
    <input type="text" name="kode_rak" class="form-control" value="{{ old('kode_rak', $stock->kode_rak ?? '') }}">
</div>