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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->restrictOnDelete();
            $table->string('status', 20)->default('pending');
            $table->unsignedBigInteger('total_cents')->default(0);
            $table->timestamp('expires_at')->nullable();
            $table->string('payment_intent_id')->nullable()->unique();
            $table->string('idempotency_key')->unique();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'expires_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
