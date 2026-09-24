<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE payments MODIFY status ENUM('Pending','Diterima','Lunas','Ditolak') DEFAULT 'Pending'");

        DB::table('payments')->where('status', 'Diterima')->update(['status' => 'Lunas']);

        DB::statement("ALTER TABLE payments MODIFY status ENUM('Pending','Lunas','Ditolak') DEFAULT 'Pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE payments MODIFY status ENUM('Pending','Diterima','Lunas','Ditolak') DEFAULT 'Pending'");

        DB::table('payments')->where('status', 'Lunas')->update(['status' => 'Diterima']);

        DB::statement("ALTER TABLE payments MODIFY status ENUM('Pending','Diterima','Ditolak') DEFAULT 'Pending'");
    }
};