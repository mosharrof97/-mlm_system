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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->integer('user_id');
            $table->string('transaction_type', 50)->nullable();
            $table->string('deposit_method', 50);
            $table->string('trxid', 100);
            $table->decimal('transaction_amount', 10,2);
            $table->integer('transaction_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations. 
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
