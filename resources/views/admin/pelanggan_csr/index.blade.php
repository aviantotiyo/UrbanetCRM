<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Pelanggan CSR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <h2>Daftar Pelanggan CSR</h2>
    <a href="{{ route('admin.pelanggan_csr.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nopel</th>
                <th>Nama</th>
                <th>User PPPoE</th>
                <th>Paket</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td>{{ $d->nopel }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->user_pppoe }}</td>
                <td>{{ $d->paket }}</td>
                <td>
                    <a href="{{ route('admin.pelanggan_csr.edit', $d->id) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>