<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan CSR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <h2>Edit Pelanggan CSR</h2>

    <form action="{{ route('admin.pelanggan_csr.update', $item->id) }}" method="POST">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nopel</label>
                <input type="text" name="nopel" class="form-control" value="{{ old('nopel', $item->nopel) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $item->nama) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">User PPPoE</label>
                <input type="text" name="user_pppoe" class="form-control" value="{{ old('user_pppoe', $item->user_pppoe) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Password PPPoE</label>
                <input type="text" name="pass_pppoe" class="form-control" value="{{ old('pass_pppoe', $item->pass_pppoe) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Paket</label>
                <input type="text" name="paket" class="form-control" value="{{ old('paket', $item->paket) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Limit Radius</label>
                <input type="text" name="limit_radius" class="form-control" value="{{ old('limit_radius', $item->limit_radius) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">ODP</label>
                <select name="odp_id" class="form-control">
                    <option value="">-- Pilih --</option>
                    @foreach ($odps as $odp)
                    <option value="{{ $odp->id }}" {{ (old('odp_id', $item->odp_id) == $odp->id) ? 'selected' : '' }}>
                        {{ $odp->nama ?? $odp->id }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">ODP Port</label>
                <select name="odp_port_id" class="form-control">
                    <option value="">-- Pilih --</option>
                    @foreach ($odp_ports as $port)
                    <option value="{{ $port->id }}" {{ (old('odp_port_id', $item->odp_port_id) == $port->kode_odp) ? 'selected' : '' }}>
                        {{ $port->port_name ?? $port->id }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</body>

</html>