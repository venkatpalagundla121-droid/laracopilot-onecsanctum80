<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('guardian_name');
            $table->string('guardian_phone');
            $table->string('guardian_email')->nullable();
            $table->foreignId('bed_id')->constrained('beds')->onDelete('cascade');
            $table->date('admission_date');
            $table->date('checkout_date')->nullable();
            $table->decimal('monthly_fee', 10, 2);
            $table->decimal('security_deposit', 10, 2)->nullable();
            $table->enum('payment_status', ['Paid', 'Pending', 'Overdue'])->default('Pending');
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};