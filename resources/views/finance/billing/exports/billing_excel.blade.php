<table>
    <thead>
        <tr>
            <th>Invoice</th>
            <th>NoPel</th>
            <th>Nama</th>
            <th>Item</th>
            <th>Tagihan</th>
            <th>Denda</th>
            <th>Diskon</th>
            <th>Payment Method</th>
            <th>Payment Name</th>
            <th>Total Amount</th>
            <th>Point</th>
            <th>Fee Merchant</th>
            <th>Fee Customer</th>
            <th>Amount Received</th>
            <th>Tax</th>
            <th>After Tax</th>
            <th>Status Client</th>
            <th>Status Billing</th>
            <th>Tgl Billing</th>
            <th>Billing Paid</th>
        </tr>
    </thead>
    <tbody>
        @foreach($billings as $billing)
        @foreach($billing->items as $item)
        <tr>
            <td>{{ $billing->merchant_ref }}</td>
            <td>{{ $billing->client->nopel ?? '-' }}</td>
            <td>{{ $billing->client->nama ?? '-' }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->amount }}</td>
            <td>{{ $item->denda }}</td>
            <td>{{ $item->discount }}</td>
            <td>{{ $billing->payment_method }}</td>
            <td>{{ $billing->payment_name }}</td>
            <td>{{ $billing->total_amount }}</td>
            <td>{{ $billing->point }}</td>
            <td>{{ $billing->fee_merchant }}</td>
            <td>{{ $billing->fee_customer }}</td>
            <td>{{ $billing->amount_received }}</td>
            <td>{{ $billing->tax }}</td>
            <td>{{ $billing->after_tax}}</td>
            <td>{{ $billing->client->status }}</td>
            <td>{{ $billing->status }}</td>
            <td>{{ \Carbon\Carbon::parse($item->billing_cycle)->format('Y-m') }}</td>
            <td>{{ ($billing->billing_paid) }}</td>
        </tr>
        @endforeach
        @endforeach
    </tbody>
</table>