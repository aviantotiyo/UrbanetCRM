<div class="container">
    <h4>Daftar Referral Anda</h4>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('client.referral.create') }}" class="btn btn-primary mb-3">Tambah Referral</a>

    @if($referrals->isNotEmpty())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Provinsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($referrals as $ref)
            <tr>
                <td>{{ $ref->nama }}</td>
                <td>{{ $ref->no_hp }}</td>
                <td>{{ $ref->alamat }}</td>
                <td>{{ $ref->kecamatan }}</td>
                <td>{{ $ref->kabupaten }}</td>
                <td>{{ $ref->provinsi }}</td>
                <td>{{ ucfirst($ref->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info text-center">Belum ada data referral.</div>
    @endif

</div>