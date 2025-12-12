ALUR BILLING KETIKA CLIENT MENDAPATKAN PROMO

-   Database
-   Logic

data_blling

-   net_income di kurangi pajak (V)
-   denda (field database sudah) (v)
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

User Regist Dashboard admin (view, edit, process) (done all)

CSR list

-   tambah data crs sudah bisa (v-done)
-   antisipasi odp port sudah di pakai. ketika client masih berada di kondisi bukan 'active' (v-done)
-   history log siapa yang melakukan pengisian data. (v-done)
-   inactive dan isolir belum (logic sudah ada v-done)
-   kondisi ketika user isolir kembali ke active (v-done)
-   ketika user menggunakan port odp A1 kemudian di pindah ke A2 masih belum ada logic yang melakuakn handling (v-done)
-   Konek ke radius

ODP dan ODP belum di handling dari edit/update user Teknisi (beresiko odp port di ganti tampa melalui sistem) (V)

Referral
bagian referral client perlu di tambahkan select paket. (done - v)
NIK, no hp belum ada pengecekan di semua data pelanggan DataClient, DataClientsRegist,DataClientreferral (done -v)

selectpayment ada error. JS nya tidak menghitung angka akhirnya (V-done)

backend:
CSR list tidak di pungut ke billing. di buatkan odp port list (v-done)
CSR PPPoE belum konek ke radius

sales app

-   add data (done)
-   lihat status fee

agent app (partner)

-   info rekening bank belum di siapkan, masih hardcode (v - done)
-   login page belum disiapkan (v-done)
-   kondisi ketika user point melebihi tagihan (v -done)
-   hitung pajak dan penerimaan bersih (v - done)
-   dashboard mitra di backend admin belum di benahi UX nya (V- done)
-   Mitra melakukan inactive account dan update profile belum ada (V-done)
-   belum ada fitur add client dan hitungan fee
-   data bank partner, nama, no rek dll
-   tagihan ketika suspend harus ada mekanisme baru (done)

user app

-   tagihan ketika suspend harus ada mekanisme baru (done -v)

    /// OTOMASI

-   billing setiap bulan, generate invoice tagihan bulanan rutin (v-done)
-   exp konfrimasi dari agent transaksi manual (v -done)
-   cek transaksi PAID via mutasi bank manual (v-done, sudah sampai Wa message)
-   billing tagihan tiap bulan ( v- done)
-   pesan pengingat tagihan (v-done)
-   pesan isolir jaringan (v-done)
-   inactive user (v-done)
-   handling pesan ketika DataBillingItem lebih dari 1 data (sudah di gabung)

Table Mutasi Bank Manual

-   table database mutasi (v - done)
-   update cron mutasi (v - done)
-   pencocokan bank mutasi dengan billing. (v - done)

Tiket dan gangguan

-   hitungan fee instalasi (v -done)
-   hitungan fee gangguan (v -done)
-   hitungan ketika perlu ada beberapa teknisi (v -done)

========================================================
tanggal 5-30 Isolir
tanggal 1-30 Suspend
tanggal 1 inactive di awal bulan berikutnya
========================================================
==> Pengecekan radius dengan kondisi status user saat payment.
========================================================

# masih adakesalahan form di edit dari form online registrasi

==========================================================

perintah queue:
php artisan queue:work --queue=default,emails
==========================================================
perintah jalankan schedule

php artisan schedule:run
php artisan billing:reset-expired

bila perlu force:
php artisan billing:bulanan --force

bikin di app/Commands/
panggil di routes/console.php

untuk production pasang cron:

'\* \* \* \* \* cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
'
===========================================================
Cara menjalakna radius di server WSL
sudo freeradius -X

untuk detail nya

radtest testing 1234 localhost 0 testing123
hasilnya:

# Sent Access-Request Id 79 from 0.0.0.0:35636 to 127.0.0.1:1812 length 77 User-Name = "testing" User-Password = "1234" NAS-IP-Address = 127.0.1.1 NAS-Port = 0 Cleartext-Password = "1234" Received Access-Accept Id 79 from 127.0.0.1:1812 to 127.0.0.1:35636 length 38 Message-Authenticator = 0x99d9e0aa224af355dc4b5a13a826621c

kalau error, kill lalu jalakan ulang
sudo killall freeradius
sudo freeradius -X

# akses lokal http://localhost/UrbanetCRM/public/tes-radius

Radius LIb sederhana
App\Libraries\RadiusClient\RadiusClient.php
App\Services\RadiusAuthService.php
==================================================

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
