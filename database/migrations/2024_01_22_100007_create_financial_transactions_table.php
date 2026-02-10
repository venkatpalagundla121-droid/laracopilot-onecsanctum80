<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expense']);
            $table->string('description');
            $table->decimal('amount', 10, 2);
            $table->string('category', 100);
            $table->date('transaction_date');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('financial_transactions');
    }
};