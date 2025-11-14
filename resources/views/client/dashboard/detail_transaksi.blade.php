@section('title', 'Detail Transaksi')
@include('client.template.head')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include("client.template.sidebar")
            <!-- Layout container -->
            <div class="layout-page">
                @include('client.template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="col-md-6 col-xxl-4 mb-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="mb-2">Detail Pembayaran #{{ $billing->merchant_ref }}</h6>
                                    @if ($billing->payment_name === 'QRIS' && !empty($billing->qr_url))
                                    <div class="cardMaster border p-6 rounded mb-4">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                                            <div class="card-information">

                                                <div class="text-center">
                                                    <img src="{{ $billing->qr_url }}" alt="QRIS Code" class="img-fluid w-100 rounded" style="max-width: 100%;">
                                                    <p class="mt-2 text-muted small">Scan/Download QRIS untuk melakukan pembayaran</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="cardMaster border p-6 rounded mb-4">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                                            <div class="card-information">
                                                <div class="d-flex align-items-center mb-2">
                                                    <h6 class="mb-0 me-2">{{ $billing->payment_name }}</h6>
                                                    <span class="badge bg-label-primary me-1">{{ $billing->status }}</span>
                                                </div>
                                                @if ($billing->payment_name !== 'QRIS' && !empty($billing->pay_code))
                                                <span class="card-number">No. VA: {{ $billing->pay_code }}</span>
                                                @endif

                                            </div>
                                            <!-- <div class="d-flex flex-column text-small">
                                                {{ \Carbon\Carbon::parse($billing->expired_time)->format('d/m/y H:i') }}
                                                WIB
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-basket-dollar ti-28px"></i></span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-nowrap">Rp {{ number_format($billing->total_amount, 0, ',', '.') }}</h6>
                                                    <small>Total Bayar</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-clock-dollar ti-28px"></i></span>
                                                </div>
                                                <div>
                                                    @if ($billing->status === 'PAID')
                                                    <h6 class="mb-0 text-nowrap">Tgl Bayar</h6>
                                                    <small>
                                                        {{ \Carbon\Carbon::parse($billing->billing_paid)->format('d/m/y H:i') }} WIB
                                                    </small>
                                                    @else
                                                    <h6 class="mb-0 text-nowrap">Exp Code</h6>
                                                    <small>
                                                        {{ \Carbon\Carbon::parse($billing->expired_time)->format('d/m/y H:i') }} WIB
                                                    </small>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                        @if($billing->status !== 'UNPAID')
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <ul class="p-0 m-0 mb-4 list-unstyled">
                                                    @forelse ($unpaidBillings as $billing)
                                                    @foreach ($billing->items as $item)
                                                    <li class="d-flex mb-3 border-bottom pb-2">
                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Tagihan {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</h6>
                                                                <small class="text-body d-block">{{ $billing->merchant_ref }}</small>
                                                            </div>
                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                <p class="mb-0">Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                    @empty
                                                    <li class="text-muted text-center">Tidak ada tagihan yang belum dibayar.</li>
                                                    @endforelse

                                                    @forelse ($unpaidBillings as $billing)
                                                    @foreach ($billing->items as $item)
                                                    @if ($item->denda > 0)
                                                    <li class="d-flex mb-3 border-bottom pb-2">
                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Denda</h6>
                                                                <small class="text-body d-block">{{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</small>
                                                            </div>
                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                <p class="mb-0 ">Rp {{ number_format($item->denda, 0, ',', '.') }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                    @empty
                                                    @endforelse


                                                    @forelse ($unpaidBillings as $billing)
                                                    @foreach ($billing->items as $item)
                                                    @if ($item->discount > 0)
                                                    <li class="d-flex mb-3 border-bottom pb-2">
                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Discount</h6>
                                                                <small class="text-body d-block">{{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</small>
                                                            </div>
                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                <p class="mb-0 text-success">Rp {{ number_format($item->discount, 0, ',', '.') }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                    @empty
                                                    @endforelse

                                                    @if($billing->point)
                                                    <li class="d-flex mb-2">
                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <h6 class="mb-0">Point</h6>
                                                                <small class="text-body d-block" id="bank-fee-label">
                                                                    Loyalti Point
                                                                </small>

                                                            </div>
                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                <p class="mb-0 text-success discount">{{ number_format($billing->point, 0, ',', '.') }}</p>

                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        @endif


                                        @if($billing->status !== 'PAID')
                                        <hr>
                                        <h6 class="mb-2">Cara Bayar:</h6>

                                        @php
                                        $instructions = is_string($billing->instructions)
                                        ? json_decode($billing->instructions, true)
                                        : $billing->instructions;
                                        @endphp

                                        @if(is_array($instructions))
                                        <div class="accordion mt-1" id="accordionExample">
                                            @foreach ($instructions as $index => $instruction)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $index }}">
                                                    <button type="button" class="accordion-button collapsed"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#accordion{{ $index }}"
                                                        aria-expanded="false"
                                                        aria-controls="accordion{{ $index }}">
                                                        {{ $instruction['title'] ?? 'Instruksi Pembayaran #' . ($index+1) }}
                                                    </button>
                                                </h2>

                                                <div id="accordion{{ $index }}"
                                                    class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                                    aria-labelledby="heading{{ $index }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        @if(isset($instruction['steps']) && is_array($instruction['steps']))
                                                        <ol class="mb-0">
                                                            @foreach ($instruction['steps'] as $step)
                                                            <li>{!! $step !!}</li>
                                                            @endforeach
                                                        </ol>
                                                        @else
                                                        <p>Tidak ada langkah instruksi.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @else
                                        <p>Tidak ada instruksi yang tersedia.</p>
                                        @endif
                                        @endif

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- / Content -->



                    <div class="content-backdrop fade"></div>

                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    @include('client.template.footer')

</body>

</html>