<div class="container">
    <h4 class="mb-4">Daftar Kategori Gudang</h4>

    <a href="{{ route('admin.warehouse_category.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $kat)
            <tr>
                <td>{{ $kat->kode_kategori }}</td>
                <td>{{ $kat->nama_kategori }}</td>
                <td>{{ $kat->deskripsi }}</td>
                <td>
                    <a href="{{ route('warehouse_category.edit', $kat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>