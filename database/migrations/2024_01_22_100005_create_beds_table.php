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
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->string('bed_number', 50);
            $table->string('bed_type', 50);
            $table->boolean('is_occupied')->default(false);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('beds');
    }
};