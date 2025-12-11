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
                                    <span class="h5">Data Komisi Teknisi</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">

                                <form action="{{ route('admin.komisi_teknisi.export_excel') }}" method="GET">
                                    <button type="submit" class="btn btn-outline-success mb-3">
                                        <i class="ti ti-download me-1"></i> Download Excel
                                    </button>
                                </form>
                                <a href="{{ route('admin.komisi_teknisi.paidList') }}" class="btn btn-outline-primary mb-3">Daftar History</a>

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
                            <form method="GET" action="{{ route('admin.komisi_teknisi.index') }}" class="align-items-end mb-4">
                                <div class="card-body py-3">
                                    <div class="row g-2 align-items-end">
                                        <div class="col-md-4">
                                            <label for="teknisi" class="form-label">Nama Teknisi</label>
                                            <input type="text" name="user" value="{{ request('user') }}" class="form-control" placeholder="Cari Nama Teknisi">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="tanggal_awal" class="form-label">Tanggal Mulai</label>
                                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-primary w-100">Filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card mt-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Data Komisi Teknisi</h5>
                                <form action="{{ route('admin.komisi_teknisi.paid_multiple') }}" method="POST" id="form-paid-multiple" onsubmit="return confirm('Tandai fee teknisi yang dipilih sebagai sudah dibayar?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary">Tandai Sudah Dibayar</button>
                                </form>
                            </div>

                            <div class="table-responsive text-nowrap">
                                <form method="POST" action="{{ route('admin.komisi_teknisi.paid_multiple') }}" id="form-paid-multiple-inner">
                                    @csrf
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select-all"></th>
                                                <th>Nama Teknisi</th>
                                                <th>Instalasi</th>
                                                <th>Perbaikan</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Fee</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($teknisiRows as $row)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="selected_ids[]" value="{{ $row['row_id'] }}|{{ $row['pos'] }}">
                                                </td>
                                                <td>{{ $row['user']->name ?? '-' }}<br><small>{{ $row['user']->role ?? '-' }}</small></td>
                                                <td>{{ $row['ticketHC']->ticket_code ?? '-' }}</td>
                                                <td>{{ $row['ticket']->ticket_code ?? '-' }}</td>
                                                <td>
                                                    {{ $row['client']->nama ?? '-' }}<br><small>{{ $row['client']->nopel ?? '-' }}</small>
                                                </td>
                                                <td>
                                                    Rp {{ number_format($row['fee'] ?? 0, 0, ',', '.') }}<br>
                                                    <span class="badge bg-secondary">Belum Dibayar</span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($row['updated_at'])->format('d/m/Y H:i') }} WIB</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">Belum ada data teknisi atau fee.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </form>
                            </div>

                            <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                                {{ $pagination->links() }}
                            </div>
                        </div>

                        <script>
                            document.getElementById('select-all').addEventListener('change', function(e) {
                                const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
                                checkboxes.forEach(cb => cb.checked = e.target.checked);
                            });

                            // Form submit dari tombol di header ke form isi
                            document.getElementById('form-paid-multiple').addEventListener('submit', function(e) {
                                e.preventDefault();
                                document.getElementById('form-paid-multiple-inner').submit();
                            });
                        </script>


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
    <script>
        document.getElementById('select-all').addEventListener('change', function(e) {
            const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');

            checkboxes.forEach(cb => {
                cb.checked = e.target.checked;

                // Trigger 'change' untuk memastikan form aware
                cb.dispatchEvent(new Event('change'));
            });
        });
    </script>

    <script>
        // Submit form dari tombol luar
        document.getElementById('submit-multiple').addEventListener('click', function() {
            const selected = document.querySelectorAll('input[name="selected_ids[]"]:checked');
            if (selected.length === 0) {
                alert('Tidak ada data yang dipilih.');
                return;
            }

            if (confirm('Tandai semua data yang dipilih sebagai sudah dibayar?')) {
                document.getElementById('form-paid-multiple').submit();
            }
        });

        // Select all
        document.getElementById('select-all').addEventListener('change', function(e) {
            const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
            checkboxes.forEach(cb => cb.checked = e.target.checked);
        });
    </script>

</body>

</html>