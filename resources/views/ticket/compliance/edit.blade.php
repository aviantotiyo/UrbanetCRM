<h3>Edit Ticket</h3>

<form action="{{ route('admin.dashboard.ticket.update', $ticket->id) }}" method="POST">
    @csrf
    @method('PUT') {{-- Gunakan method PUT agar tidak memicu store() --}}
    {{-- Untuk keperluan edit, biasanya kita pakai PUT/PATCH, tapi karena route edit ini belum diimplementasikan fully, kita tetap pakai POST dulu --}}

    {{-- Hidden ID jika diperlukan --}}
    <input type="hidden" name="id" value="{{ $ticket->id }}">

    <div class="mb-3">
        <label>Kode Tiket</label>
        <input type="text" class="form-control" value="{{ $ticket->ticket_code }}" disabled>
    </div>

    <div class="mb-3">
        <label>Client</label>
        <select name="client_id" class="form-control" required>
            @foreach($clients as $client)
            <option value="{{ $client->id }}" {{ $ticket->client_id == $client->id ? 'selected' : '' }}>
                {{ $client->nama }} - {{ $client->nopel }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="users_id" class="form-label">Pilih Installer</label>
        <select name="users_id" class="form-control" required>
            <option value="">-- Pilih Installer --</option>
            @foreach($installers as $installer)
            <option value="{{ $installer->id }}"
                {{ isset($teamSite) && $teamSite->users_id === $installer->id ? 'selected' : '' }}>
                {{ $installer->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Type Task</label>
        <select name="type_task" class="form-control" required>
            @foreach(['Gangguan', 'Customers Support', 'Support NOC', 'Maintenance'] as $type)
            <option value="{{ $type }}" {{ $ticket->type_task == $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Detail Task</label>
        <textarea name="detail_task" class="form-control">{{ $ticket->detail_task }}</textarea>
    </div>

    <div class="mb-3">
        <label>Note</label>
        <textarea name="note" class="form-control">{{ $ticket->note }}</textarea>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            @foreach(['open', 'cancel', 'process', 'finish'] as $status)
            <option value="{{ $status }}" {{ $ticket->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Status Finish</label>
        <input type="datetime-local" name="status_finish" class="form-control"
            value="{{ $ticket->status_finish ? $ticket->status_finish->format('Y-m-d\TH:i') : '' }}">
    </div>

    <div class="mb-3">
        <label>Solving</label>
        <select name="solving" class="form-control">
            @foreach(['Ganti Router', 'Ganti Adaptor', 'Kabel Putus', 'setting NOC'] as $solve)
            <option value="{{ $solve }}" {{ $ticket->solving == $solve ? 'selected' : '' }}>{{ $solve }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Ticket Guarantee</label>
        <select name="ticket_guarantee" class="form-control">
            <option value="0" {{ $ticket->ticket_guarantee == 0 ? 'selected' : '' }}>0</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>