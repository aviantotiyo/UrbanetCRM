@section('title', 'Data Komisi Teknisi')
@include('template.head')

</head>

<body>
    <!-- Layout wrapper -->
    <div class=" layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('template.sidebar')
            <div class="menu-mobile-toggler d-xl-none rounded-1">
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                    <i class="ti tabler-menu icon-base"></i>
                    <i class="ti tabler-chevron-right icon-base"></i>
                </a>
            </div>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                @include('template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="mb-1">
                                    <span class="h5">Histori Data Komisi Teknisi</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">

                                <a href="{{ route('admin.komisi_teknisi.index') }}" class="btn btn-outline-primary">Kembali</a>

                            </div>
                        </div>
                        {{-- Alert sukses --}}
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


                        <div class="card">
                            <h5 class="card-header">Data Pelanggan</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Teknisi</th>
                                            <th>Instalasi</th>
                                            <th>Perbaikan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Fee</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse($data as $row)
                                        @php
                                        $teknisiList = [
                                        ['user' => $row->user, 'fee' => $row->fee, 'paid' => $row->fee_paid],
                                        ['user' => $row->user2, 'fee' => $row->fee_2, 'paid' => $row->fee_paid_2],
                                        ['user' => $row->user3, 'fee' => $row->fee_3, 'paid' => $row->fee_paid_3],
                                        ];
                                        @endphp

                                        @foreach($teknisiList as $teknisi)
                                        @if ($teknisi['user'])
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium">
                                                            <a href="#">
                                                                {{ $teknisi['user']->name ?? '-' }}
                                                            </a>
                                                        </p>
                                                        <small>{{ $teknisi['user']->role ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> <a href="{{ route('admin.dashboard.ticket_hc.edit', $row->ticketHC->id ?? 0) }}">
                                                    {{ $row->ticketHC->ticket_code ?? '-' }}
                                                </a>
                                            </td>
                                            <td><a href="{{ route('admin.dashboard.ticket.edit', $row->ticket->id ?? 0) }}">
                                                    {{ $row->ticket->ticket_code ?? '-' }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium">
                                                            <a href="{{ route('admin.pelanggan.show', $row->client->id ?? 0) }}">
                                                                {{ $row->client->nama ?? '-' }}
                                                            </a>
                                                        </p>
                                                        <small>{{ $row->client->nopel ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium">
                                                            Rp {{ number_format($teknisi['fee'] ?? 0, 0, ',', '.') }}
                                                        </p>
                                                        <small> @if ($teknisi['paid'] == 1)
                                                            <span class="badge bg-success">Sudah Dibayar</span>
                                                            @else
                                                            <span class="badge bg-primary">Belum Dibayar</span>
                                                            @endif</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>{{ $row->updated_at->format('d/m/Y H:i') }} WIB</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Belum ada data teknisi atau fee.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    {{-- Links pagination --}}
                                    {{ $data->withQueryString()->links() }}
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

    @include('template.footer')

</body>

</html>