<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('snap_token')->nullable()->after('method');
            $table->string('order_id')->nullable()->unique()->after('snap_token');
            $table->string('proof')->nullable()->change(); // pembayaran Midtrans gak perlu upload bukti manual
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['snap_token', 'order_id']);
            $table->string('proof')->nullable(false)->change();
        });
    }
};