ALUR BILLING KETIKA CLIENT MENDAPATKAN PROMO

-   Database
-   Logic

data_blling

-   net_income di kurangi pajak
-   denda (field database sudah)
    loyalti program (point) (field database sudah)

============
cara pakai role auth di routes:

Route::middleware(['auth', 'role:admin'])->group(function () {
// hanya bisa diakses oleh user dengan role 'admin'
});

atau

Route::middleware(['auth', 'role:admin,teknisi'])->group(function () {
// hanya admin dan teknisi yang bisa mengakses
});

---

cara pakai role auth di controller, single role:
public function \_\_construct()
{
$this->middleware(['auth', 'role:admin']);
}

atau multi role

public function \_\_construct()
{
$this->middleware(['auth', 'role:admin,teknisi']);
}

mebatasi beberapa metod:

public function \_\_construct()
{
$this->middleware(['auth', 'role:admin'])->only(['destroy', 'update']);
$this->middleware(['auth', 'role:teknisi'])->only(['create', 'store']);
}

---

untuk membatasi dari blade:
@auth
@if(auth()->user()->role === 'admin')
<a href="{{ route('paket.create') }}" class="btn btn-primary">Tambah Paket</a>
@endif
@endauth

untuk multi role:

@auth
@if(in_array(auth()->user()->role, ['admin', 'teknisi']))
<a href="{{ route('odp.create') }}" class="btn btn-success">Tambah ODP</a>
@endif
@endauth

=============
