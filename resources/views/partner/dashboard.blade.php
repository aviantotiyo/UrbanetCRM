<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Mitra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h3>Selamat datang, {{ $partner->nama_partner }}</h3>
        <p>No HP: {{ $partner->no_hp }}</p>

        <form action="{{ route('partner.logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>

</html>