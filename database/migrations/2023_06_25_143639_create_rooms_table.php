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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_number', 10)->unique();
            $table->string('room_name', 20);
            $table->string('room_type', 10);
            $table->text('short_description');
            $table->text('description')->nullable();
            $table->integer('beds');
            $table->integer('occupancy');
            $table->decimal('price', 10, 2);
            $table->string('status', 10)->default('available');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
