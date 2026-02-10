<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->text('address');
            $table->string('contact_number', 15);
            $table->integer('total_floors');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('hostels');
    }
};