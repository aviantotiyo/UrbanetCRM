<div class="container">
    <h4 class="mb-4">Daftar Billing</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>NoPel</th>
                    <th>Client</th>
                    <th>Merchant Ref</th>
                    <th>Nama Item</th>
                    <th>Amount</th>
                    <th>Billing Cycle</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($billings as $billing)
                @foreach($billing->items as $item)
                <tr>
                    <td>{{ $billing->client->nopel ?? '-' }}</td>
                    <td>{{ $billing->client->nama ?? '-' }}</td>
                    <td>{{ $billing->merchant_ref }}</td>
                    <td>{{ $item->name ?? '-' }}</td>
                    <td>{{ number_format($item->amount ?? 0) }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</td>
                    <td>{{ $billing->status }}</td>
                </tr>
                @endforeach
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data billing</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>