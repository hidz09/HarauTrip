<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('booking_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('payment_code');

            $table->decimal('amount', 12, 2);

            $table->enum('method', [
                'DANA',
                'QR CODE'
            ]);

            $table->string('proof')
                  ->nullable();

            $table->enum('status', [
                'Pending',
                'Lunas',
                'Ditolak'
            ])->default('Pending');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};