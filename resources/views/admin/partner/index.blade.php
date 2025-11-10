{{-- resources/views/admin/partner/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Mitra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h3>Daftar Mitra</h3>
        <a href="{{ route('admin.partner.create') }}" class="btn btn-success mb-3">+ Tambah Mitra</a>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($partners as $partner)
                <tr>
                    <td>{{ $partner->nama_partner }}</td>
                    <td>{{ $partner->no_hp }}</td>
                    <td>{{ $partner->alamat }}</td>
                    <td><span class="badge bg-{{ $partner->status == 'active' ? 'success' : 'secondary' }}">{{ ucfirst($partner->status) }}</span></td>
                    <td>
                        <a href="{{ route('admin.partner.edit', $partner->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>