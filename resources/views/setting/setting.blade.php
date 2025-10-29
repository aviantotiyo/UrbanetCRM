<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Pengaturan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h4>Form Pengaturan</h4>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.setting.update') }}" method="POST">
            @csrf
            @method('PUT')

            @foreach([
            'denda' => 'Denda',
            'point' => 'Point',
            'tax' => 'Tax (%)',
            'fee_merchant_billing' => 'Fee Merchant Billing',
            'fee_merchant_sales' => 'Fee Merchant Sales',
            'fee_sales_internal' => 'Fee Sales Internal',
            'fee_engineer_sales' => 'Fee Engineer Sales',
            'fee_engineer' => 'Fee Engineer'
            ] as $field => $label)
            <div class="mb-3">
                <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                <input type="number" name="{{ $field }}" id="{{ $field }}" class="form-control" value="{{ old($field, $setting->$field) }}">
            </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>

</html>