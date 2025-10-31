<div class="container">
    <h4>Tambah Ticket Home Connection</h4>
    <form action="{{ route('admin.dashboard.ticket_hc.store') }}" method="POST">
        @csrf
        <input type="hidden" name="client_id" value="{{ $client->id }}">

        <div class="mb-3">
            <label>Nama Client</label>
            <input type="text" class="form-control" value="{{ $client->nama }}" disabled>
        </div>

        <div class="mb-3">
            <label for="users_id" class="form-label">Pilih Installer</label>
            <select name="users_id" class="form-control" required>
                <option value="">-- Pilih Installer --</option>
                @foreach($installers as $installer)
                <option value="{{ $installer->id }}">{{ $installer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="defaultSelect" class="form-label">Status</label>
            <select id="defaultSelect" class="form-select" name="status">
                <option>Pilih Status</option> process,pending,cancel,finish
                <option value="open">Open</option>
                <option value="process">Proses</option>
                <option value="pending">Pending</option>
                <option value="cancel">Cancel</option>
                <option value="finish">Finish</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Merk Kabel Dropcore</label>
            <input type="text" class="form-control" name="merk_kabel">
        </div>

        <div class="mb-3">
            <label>Panjang Kabel Dropcore ke ODP</label>
            <input type="text" class="form-control" name="panjang_kabel">
        </div>

        <div class="mb-3">
            <label>Sambungan Kabel Dropcore ke ODP</label>
            <input type="text" class="form-control" name="sambungan_kabel">
        </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="note" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>