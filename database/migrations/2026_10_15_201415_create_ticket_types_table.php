<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedInteger('price_cents');
            $table->char('currency', 3)->default('EGP');
            $table->unsignedInteger('quantity_total');
            $table->unsignedInteger('quantity_sold')->default(0);
            $table->unsignedInteger('quantity_held')->default(0);
            $table->unsignedTinyInteger('max_per_order')->default(10);
            $table->timestamp('sales_start_at')->nullable();
            $table->timestamp('sales_end_at')->nullable();
            $table->timestamps();

            $table->unique(['event_id', 'name']); // no two "VIP" types in one event
        });

        // quantity_total >= sold + held
        if (DB::getDriverName() === 'mysql') {
            DB::statement('ALTER TABLE ticket_types ADD CONSTRAINT chk_ticket_types_capacity
                CHECK (quantity_sold + quantity_held <= quantity_total)');
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_types');
    }
};