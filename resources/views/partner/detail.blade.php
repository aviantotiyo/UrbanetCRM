@section('title', 'Atur Pembayaran')
@include('client.template.head')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include("partner.template.sidebar")

            <!-- Layout container -->
            <div class="layout-page">
                @include('partner.template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="col-md-6 col-xxl-4 mb-6">

                            @if (session('success'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                {!! session('success') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            {{-- (Opsional) Alert error umum --}}
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {!! session('error') !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="mb-2">Detail Tagihan {{ $billing->merchant_ref }}</h6>
                                    <hr />
                                    <ul class="p-0 m-0 mb-4 list-unstyled">
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $client->nama }}</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ $client->nopel }} | {{ $client->paket }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0"><span class="badge rounded-pill bg-label-primary">{{ $billing->status }}</span></p>

                                                </div>
                                            </div>
                                        </li>
                                        @if ($billing->status == 'PAID')
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Tagihan Lunas</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ $billing->payment_name }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0">{{ ($billing->billing_paid)->format('d/m/Y H:i') }} WIB</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                    </ul>
                                    <hr />
                                    @foreach ($billings as $billing)
                                    <ul class="p-0 m-0 mb-4 list-unstyled">
                                        @foreach ($billingItems->where('merchant_ref_id', $billing->merchant_ref) as $item)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Tagihan {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ $billing->merchant_ref }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 amount">Rp {{ number_format($item->amount, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endforeach

                                        @if($item->denda)
                                        @foreach ($billingItems->where('merchant_ref_id', $billing->merchant_ref) as $item)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Denda</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 denda">Rp {{ number_format($item->denda, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif

                                        @if($item->discount)
                                        @foreach ($billingItems->where('merchant_ref_id', $billing->merchant_ref) as $item)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Discount</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 text-success discount">Rp {{ number_format($item->discount, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif

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
                                        <hr />
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">SubTotal</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        Pembayaran
                                                    </small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0" id="total">Rp </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Kode Unik</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        wajid di tambahkan
                                                    </small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0">Rp {{ $billing->kode_unik }}</p>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Total Bayar Dari Pelanggan</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        Fee Admin Rp {{ number_format( $fee_merchant_billing, 0, ',', '.') }}

                                                    </small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0" id="total_admin">Rp 0</p>
                                                </div>
                                            </div>
                                        </li>
                                        <hr />
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Total Transfer Mitra</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        Nilai harus sama
                                                    </small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0">Rp {{ number_format($billing->total_amount, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                    @endforeach

                                    @if ($billing->status != 'PAID')
                                    <h6 class="mb-2">Konfirmasi Transfer</h6>
                                    <ul>
                                        <li>
                                            Nilai yang harus ditransfer:
                                            <span id="amountWrapper" style="position: relative;">
                                                <a href="javascript:void(0);" onclick="copyToClipboard('amountText', 'tooltipAmount')" id="amountLink">
                                                    Rp {{ number_format($billing->total_amount, 0, ',', '.') }}
                                                </a>
                                                <span id="tooltipAmount" class="custom-tooltip">Disalin!</span>
                                            </span>
                                        </li>

                                        @php
                                        $targetBank = $allBanks->firstWhere('nama_bank', $billing->bank_name_manual);
                                        @endphp

                                        @if ($targetBank)
                                        <li>
                                            Transfer ke {{ $targetBank->nama_bank }} {{ $targetBank->nama_pic }} -
                                            <span id="noRekWrapper" style="position: relative;">
                                                <a href="javascript:void(0);" onclick="copyToClipboard('rekText', 'tooltipRek')" id="noRekLink">
                                                    {{ $targetBank->no_rek }}
                                                </a>
                                                <span id="tooltipRek" class="custom-tooltip">Disalin!</span>
                                            </span>
                                        </li>
                                        @endif

                                        <li>
                                            Maks waktu proses:
                                            {{ \Carbon\Carbon::parse($billing->exp_tx_bank)->format('d/m/Y H:i') }} WIB
                                        </li>
                                        <li>
                                            <strong>Wajib:</strong> Lakukan konfirmasi pembayaran setelah Anda transfer.
                                        </li>
                                    </ul>

                                    <!-- Hidden texts for copy -->
                                    <span id="amountText" class="d-none">{{ $billing->total_amount }}</span>
                                    <span id="rekText" class="d-none">{{ $targetBank->no_rek ?? '' }}</span>

                                    <hr />
                                    @endif




                                    @if (is_null($billing->bank_check) && $billing->status != 'PAID')
                                    <form action="{{ route('partner.transfer.confirm', ['merchant_ref' => $billing->merchant_ref]) }}" method="POST">
                                        @csrf
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-100">Saya sudah transfer</button>
                                        </div>
                                    </form>
                                    @else
                                    <div class="mt-4">
                                        <a href="{{ route('partner.dashboard') }}" class="btn btn-secondary w-100">
                                            Kembali ke Dashboard
                                        </a>
                                    </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <style>
                    .custom-tooltip {
                        visibility: hidden;
                        background-color: #333;
                        color: #fff;
                        text-align: center;
                        border-radius: 4px;
                        padding: 5px 8px;
                        position: absolute;
                        z-index: 1;
                        bottom: 125%;
                        left: 50%;
                        transform: translateX(-50%);
                        opacity: 0;
                        transition: opacity 0.3s;
                        font-size: 12px;
                    }

                    .custom-tooltip.show {
                        visibility: visible;
                        opacity: 1;
                    }
                </style>

                <script>
                    function copyToClipboard(textId, tooltipId) {
                        const text = document.getElementById(textId).innerText;
                        navigator.clipboard.writeText(text).then(() => {
                            const tooltip = document.getElementById(tooltipId);
                            tooltip.classList.add('show');
                            setTimeout(() => {
                                tooltip.classList.remove('show');
                            }, 1500);
                        });
                    }
                </script>


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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function parseRupiah(rpText) {
                return parseInt(rpText.replace(/[^\d]/g, '')) || 0;
            }

            let totalAmount = 0;
            let totalDenda = 0;
            let totalDiscount = 0;

            document.querySelectorAll('.amount').forEach(el => {
                totalAmount += parseRupiah(el.innerText);
            });

            document.querySelectorAll('.denda').forEach(el => {
                totalDenda += parseRupiah(el.innerText);
            });

            document.querySelectorAll('.discount').forEach(el => {
                totalDiscount += parseRupiah(el.innerText);
            });

            const point = parseRupiah(document.getElementById('client-point')?.innerText || '0');
            const totalFinal = (totalAmount + totalDenda) - totalDiscount - point;

            const formatRupiah = new Intl.NumberFormat('id-ID').format(totalFinal);

            document.getElementById('total').innerText = 'Rp ' + formatRupiah;
        });
    </script>

    @include('partner.template.count-admin')
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>


    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
</body>

</html>