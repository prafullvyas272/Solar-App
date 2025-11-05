<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TransactionType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('daily_expenses', function (Blueprint $table) {
            $table->enum('transaction_type', ['income', 'expense'])
                ->after('amount')
                ->default('expense')
                ->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daily_expenses', function (Blueprint $table) {
            if (Schema::hasColumn('daily_expenses', 'transaction_type')) {
                $table->dropIndex(['transaction_type']);
                $table->dropColumn('transaction_type');
            }
        });
    }
};
