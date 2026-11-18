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
            $table->id();
            $table->foreignId('programme_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('phone', 30);
            $table->string('email');
            $table->date('preferred_date');
            $table->string('preferred_time');
            $table->enum('preference', ['online', 'offline']);
            $table->text('message')->nullable();
            $table->string('status')->default('pending'); // pending, approved, cancelled
            $table->timestamps();
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
