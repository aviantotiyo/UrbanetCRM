ALUR BILLING KETIKA CLIENT MENDAPATKAN PROMO

-   Database
-   Logic

data_blling

-   net_income di kurangi pajak (V)
-   denda (field database sudah)
    loyalti program (point) (field database sudah) (V)

referral system

-   sales internal
-   client referral (V)

Ticket Support

-   instlasi baru (V)
-   Gangguan input admin, dan user (V)

Finance report

-   income dashboard, list paid, taxt, before tax
-   Fee sales
-   Fee engineer

user setting

-   atur password, foto dan lain lain

Billing User

-   kondisi bila nilai point lebih besar auto payment (V)
-   lapor gangguan client

-   prospect pelanggan (V) aktifkan point proses permintaan

User Regist Dashboard admin (view, edit, process)

CSR list

ODP dan ODP belum di handling dari edit/update user Teknisi (beresiko odp port di ganti tampa melalui sistem) (V)

Referral
bagian referral client perlu di tambahkan select paket.
NIK, no hp belum ada pengecekan di semua data pelanggan DataClient, DataClientsRegist,DataClientreferral

==========================================================

jalankan minio: C:\>minio.exe server D:\minio-data --address ":9000" --console-address ":9001"

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
