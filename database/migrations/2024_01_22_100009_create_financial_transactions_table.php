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
            $table->string('category');
            $table->text('description');
            $table->decimal('amount', 10, 2);
            $table->date('transaction_date');
            $table->foreignId('hostel_id')->nullable()->constrained('hostels')->onDelete('cascade');
            $table->foreignId('student_id')->nullable()->constrained('students')->onDelete('set null');
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->enum('payment_method', ['Cash', 'Bank Transfer', 'UPI', 'Card', 'Cheque'])->nullable();
            $table->string('receipt_number')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('financial_transactions');
    }
};