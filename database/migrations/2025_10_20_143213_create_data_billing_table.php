<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_billing', function (Blueprint $table) {
            // Primary key UUID
            $table->uuid('id')->primary();

            // Relasi ke data_clients (UUID)
            $table->foreignUuid('client_id')
                ->constrained('data_clients')   // references('id')->on('data_clients')
                ->cascadeOnDelete();

            // Field utama
            $table->string('reference');                     // referensi internal/eksternal
            $table->string('merchant_ref')->nullable()->unique(); // bisa null, harus unik jika ada
            $table->string('payment_method');                // ex: VA, QRIS, CC, dsb
            $table->string('payment_name');                  // ex: BCA VA, Mandiri VA, QRIS, dsb

            // Nominal
            $table->integer('amount');                       // tagihan utama
            $table->integer('fee_merchant');                 // biaya ke merchant
            $table->integer('fee_customer');                 // biaya ke customer
            $table->integer('amount_received');              // amount - fee_merchant - fee_customer (atau sesuai flow)

            // Kode bayar / QR
            $table->string('pay_code')->nullable();          // ex: VA number / paycode
            $table->string('qr_url')->nullable();            // ex: URL QRIS

            // Status & waktu
            $table->string('status');                        // ex: PENDING, PAID, EXPIRED, FAILED
            $table->dateTime('expired_time');                // kapan berakhir
            $table->string('sku');                           // SKU produk/layanan
            $table->string('name');                          // nama item/produk/penagihan
            $table->text('instructions');                    // instruksi pembayaran

            // Siklus & cap waktu billing
            $table->dateTime('billing_cycle');               // (ejaan sesuai permintaan) periode tagihan
            $table->dateTime('billing_create');              // waktu dibuat
            $table->dateTime('billing_paid')->nullable();                // waktu bayar

            // (Opsional) timestamps Laravel
            $table->timestamps();

            // (Opsional) index tambahan jika perlu query cepat:
            // $table->index(['client_id', 'status']);
            // $table->index('reference');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_billing');
    }
};
