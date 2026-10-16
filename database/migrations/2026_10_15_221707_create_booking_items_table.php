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
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ticket_type_id')->constrained()->restrictOnDelete();
            $table->unsignedSmallInteger('quantity');
            $table->unsignedInteger('unit_price_cents');
            $table->timestamps();

            $table->unique(['booking_id', 'ticket_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_items');
    }
};
