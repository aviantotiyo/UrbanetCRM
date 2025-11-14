<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fb;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.06);
        }

        h2 {
            color: #4a90e2;
        }

        p {
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #e5e5e5;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #f0f4f8;
            color: #333;
        }

        .summary-table td {
            border: none;
            padding: 4px 0;
        }

        .summary-table tr td:first-child {
            width: 45%;
            color: #777;
        }

        .footer {
            margin-top: 32px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }

        .strong {
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .container {
                padding: 16px;
            }

            th,
            td {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Invoice Pembayaran</h2>

        <p>Halo <strong>{{ $client->nama }}</strong>,</p>
        <p>Terima kasih telah melakukan pembayaran tagihan <b>{{ $billing->merchant_ref }}</b>. Berikut ini adalah rincian transaksi yang telah dilakukan:</p>

        <table>
            <thead>
                <tr>
                    <th>Tagihan</th>
                    <th>Paket</th>
                    <th>Nilai</th>
                    <th>Denda</th>
                    <th>Diskon</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</td>
                    <td>{{ $item->name }}</td>
                    <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->discount, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="summary-table" style="margin-top: 24px;">
            <tr>
                <td>Biaya Admin</td>
                <td>: Rp {{ number_format($billing->fee_customer, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Point loyalti</td>
                <td>: Rp {{ number_format($billing->point, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Tagihan</td>
                <td>: <strong>Rp {{ number_format($billing->total_amount, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: <span class="strong">{{ $billing->status }}</span></td>
            </tr>
            <tr>
                <td>Tanggal Pembayaran</td>
                <td>: {{ \Carbon\Carbon::parse($billing->billing_paid)->format('d/m/Y H:i') }} WIB</td>
            </tr>
            <tr>
                <td>Metode Pembayaran</td>
                <td>: {{ $billing->payment_name }}</td>
            </tr>
        </table>

        <p class="footer">
            Invoice ini dikirim otomatis oleh sistem Urbanet. Mohon untuk tidak membalas email ini.<br>
            Jika Anda memiliki pertanyaan, silakan hubungi Customer Service kami.
        </p>

        <p style="text-align:center; color:#4a90e2;"><strong>Urbanet Billing System</strong></p>
    </div>
</body>

</html>