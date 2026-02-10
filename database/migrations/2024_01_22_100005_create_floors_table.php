<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('floors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hostel_id')->constrained('hostels')->onDelete('cascade');
            $table->integer('floor_number');
            $table->string('floor_name');
            $table->integer('total_rooms');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('floors');
    }
};