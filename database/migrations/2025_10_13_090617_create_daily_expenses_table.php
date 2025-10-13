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
        Schema::create('daily_expenses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('expense_category_id')->constrained('expense_categories');
            $table->text('description')->nullable();
            $table->decimal('amount', 12, 2);
            $table->tinyInteger('payment_mode'); // 1 = Cash, 2 = Bank, 3 = UPI
            $table->foreignId('paid_by')->constrained('users');
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->string('receipt_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_expenses');
    }
};
