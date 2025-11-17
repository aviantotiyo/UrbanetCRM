<div class="container py-4">
    <h4>Edit Prospek Sales</h4>

    <form method="POST" action="{{ route('admin.sales.update', $sales->id) }}">
        @csrf
        @method('PUT')

        {{-- Paket --}}
        <div class="mb-3">
            <label for="paket_id" class="form-label">Paket</label>
            <select name="paket_id" id="paket_id" class="form-select @error('paket_id') is-invalid @enderror" disabled>
                @foreach($paketList as $paket)
                <option value="{{ $paket->id }}" {{ $sales->paket_id == $paket->id ? 'selected' : '' }}>
                    {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}
                </option>
                @endforeach
            </select>
            @error('paket_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nama --}}
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                value="{{ old('nama', $sales->nama) }}" readonly>
            @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- No HP --}}
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                value="{{ old('no_hp', $sales->no_hp) }}" readonly>
            @error('no_hp')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input name="status" id="status" class="form-control @error('status') is-invalid @enderror"
                value="{{ old('status', $sales->status) }}" readonly>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('admin.sales.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>