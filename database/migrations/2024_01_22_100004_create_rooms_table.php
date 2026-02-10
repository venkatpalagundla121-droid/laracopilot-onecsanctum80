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
            $table->foreignId('floor_id')->constrained()->onDelete('cascade');
            $table->string('room_number', 50);
            $table->string('room_type', 50);
            $table->integer('bed_capacity');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};