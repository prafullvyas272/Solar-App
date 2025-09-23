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
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')
                ->constrained('quotations')
                ->onDelete('cascade')
                ->nullable();
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade')
                ->nullable();
            $table->string('item_name')->nullable();
            $table->string('hsn')->nullable();
            $table->decimal('quantity', 10, 2);
            $table->decimal('rate', 10, 2);
            $table->decimal('tax', 10, 2)->nullable()->default(12.0);  //Default tax
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};
