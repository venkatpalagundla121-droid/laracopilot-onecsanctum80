<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
            $table->string('bed_number')->unique();
            $table->enum('bed_type', ['Standard', 'Premium', 'Deluxe'])->default('Standard');
            $table->enum('status', ['Available', 'Occupied', 'Under Maintenance'])->default('Available');
            $table->boolean('is_occupied')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beds');
    }
};