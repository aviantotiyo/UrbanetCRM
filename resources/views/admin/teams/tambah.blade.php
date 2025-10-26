<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota Tim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function generatePassword(length = 10) {
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%";
            return Array.from({
                length
            }, () => charset[Math.floor(Math.random() * charset.length)]).join('');
        }

        function setPassword() {
            const pass = generatePassword();
            document.getElementById('password').value = pass;
        }

        window.addEventListener('DOMContentLoaded', setPassword);
    </script>
</head>

<body class="container mt-5">
    <h3 class="mb-4">Tambah Anggota Tim</h3>

    <form method="POST" action="{{ route('admin.team.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (Otomatis)</label>
            <input type="text" name="password" id="password" class="form-control" readonly required>
            <button type="button" onclick="setPassword()" class="btn btn-sm btn-secondary mt-2">Generate Ulang</button>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Peran / Role</label>
            <select name="role" class="form-select" required>
                <option value="">-- Pilih Role --</option>
                <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Finance" {{ old('role') == 'Finance' ? 'selected' : '' }}>Finance</option>
                <option value="NOC" {{ old('role') == 'NOC' ? 'selected' : '' }}>NOC</option>
                <option value="CustomerCare" {{ old('role') == 'CustomerCare' ? 'selected' : '' }}>Customer Care</option>
                <option value="Installer" {{ old('role') == 'Installer' ? 'selected' : '' }}>Installer</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Status Aktif</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="active" value="1" {{ old('active', '1') == '1' ? 'checked' : '' }}>
                <label class="form-check-label">Aktif</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="active" value="0" {{ old('active') === '0' ? 'checked' : '' }}>
                <label class="form-check-label">Nonaktif</label>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>

</body>

</html>