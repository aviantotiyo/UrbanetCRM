<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateEnumRoleUsersTable extends Migration
{
    public function up(): void
    {
        // Sesuaikan daftar enum berikut sesuai enum yang sudah ada + yang baru
        DB::statement("
            ALTER TABLE users 
            MODIFY role ENUM(
                'Admin', 
                'Finance', 
                'NOC', 
                'CustomerCare',
                'Installer',
                'Sales',
                'Legal',
                'AdminCust'
            ) 
            NULL
        ");
    }

    public function down(): void
    {
        // Kembalikan ke enum awal (tanpa 3 yang baru), sesuaikan dengan enum awal kamu
        DB::statement("
            ALTER TABLE users 
            MODIFY role ENUM(
                'Admin', 
                'Finance', 
                'NOC', 
                'CustomerCare',
                'Installer',
            ) 
            NULL
        ");
    }
}
