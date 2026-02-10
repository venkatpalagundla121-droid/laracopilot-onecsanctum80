<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('floor_id')->constrained('floors')->onDelete('cascade');
            $table->string('room_number');
            $table->enum('room_type', ['Single', 'Double', 'Triple', 'Quad', 'Dormitory']);
            $table->integer('bed_capacity');
            $table->decimal('rent_per_bed', 10, 2)->nullable();
            $table->text('amenities')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};