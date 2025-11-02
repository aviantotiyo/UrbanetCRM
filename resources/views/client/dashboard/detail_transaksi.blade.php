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
                                                    <h6 class="mb-0 text-nowrap">Exp Code</h6>
                                                    <small>{{ \Carbon\Carbon::parse($billing->expired_time)->format('d/m/y H:i') }}
                                                        WIB</small>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{ $index }}" aria-expanded="false" aria-controls="accordion{{ $index }}">
                                                        {{ $instruction['title'] ?? 'Instruksi Pembayaran #' . ($index+1) }}
                                                    </button>
                                                </h2>

                                                <div id="accordion{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
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