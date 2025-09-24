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
        Schema::create('stock_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->foreignId('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->string('supplier_name');
            $table->text('purchase_invoice_no')->nullable();
            $table->date('invoice_date');
            $table->string('brand');
            $table->string('model');
            $table->string('capacity');
            $table->decimal('purchase_price', 10, 2);
            $table->integer('gst');
            $table->decimal('quantity', 10, 2);
            $table->text('supplier_invoice_copy_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_purchases');
    }
};
