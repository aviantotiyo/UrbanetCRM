@section('title', 'Data Komisi Partner')
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
                                    <span class="h5">Data Komisi Mitra</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <a href="{{ route('admin.komisi_mitra.index') }}" class="btn btn-outline-primary mb-3">Kembali</a>

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
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Data Komisi Sales</h5>

                            </div>

                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Mitra</th>
                                            <th>Pelanggan</th>
                                            <th>Alamat</th>
                                            <th>Paket</th>
                                            <th>Komisi</th>
                                            <th>Paid</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse($data as $item)
                                        <tr>
                                            <td>
                                                <p class="mb-0 small fw-medium">
                                                    <a href="{{ route('admin.partner.edit', $item->partner->id) }}">
                                                        {{ $item->partner->nama_partner ?? '-' }}
                                                    </a>
                                                </p>
                                                <small>{{ \Carbon\Carbon::parse($item->partner->updated_at)->format('d/m/Y H:i') }} WIB</small>
                                            </td>

                                            <td>
                                                <p class="mb-0 small fw-medium">
                                                    <a href="{{ route('admin.pelanggan.show', $item->client_prospect_id) }}">{{ $item->nama ?? '-' }}
                                                    </a>
                                                </p>
                                                <small>{{ $item->no_hp ?? '-' }}</small>
                                            </td>
                                            <td>
                                                <p class="mb-0 small fw-medium">{{ $item->alamat ?? '-' }}</p>
                                                <small>{{ $item->provinsi }}/{{ $item->Kabupaten }}/{{ $item->kecamatan }}</small>
                                            </td>

                                            <td>
                                                <p class="mb-0 small fw-medium">{{ $item->paket->nama_paket ?? '-' }}</p>
                                                <small>Rp {{ number_format($item->paket->harga, 0, ',', '.') }}</small>
                                            </td>
                                            <td>
                                                <p class="mb-0 small fw-medium">{{ ucfirst($item->status) }}</p>
                                                <small>Fee: Rp {{ number_format($item->fee, 0, ',', '.') }}</small>
                                            </td>
                                            <td>
                                                <p class="mb-0 small fw-medium">
                                                    @if($item->fee_paid)
                                                    <span class="badge bg-primary">Lunas</span>
                                                    @else
                                                    <span class="badge bg-secondary">Belum</span>
                                                    @endif
                                                </p>
                                                <small>{{ \Carbon\Carbon::parse($item->fee_date_paid)->format('d/m/Y H:i') }} WIB</small>



                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Belum ada data.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- ❗️ Penutup card -->



                        <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                            {{ $data->links() }}
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