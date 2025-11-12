<!DOCTYPE html>
<html>

<head>
    <title>Login Mitra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('client.template.recaptcha')
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h3 class="text-center mb-4">Login Mitra</h3>
        <form method="POST" action="{{ route('partner.login.process') }}" class="card p-4 mx-auto" style="max-width: 400px;">
            @csrf

            <div class="mb-3">
                <label for="no_hp">No HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
                @error('no_hp')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

    </div>
</body>

</html>