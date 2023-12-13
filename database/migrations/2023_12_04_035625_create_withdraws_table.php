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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id('withdraw_id');
            $table->integer('user_id')->nullable();
            $table->string('withdraw_type', 50)->nullable();
            $table->string('withdraw_method', 50)->nullable();
            $table->bigInteger('withdraw_account')->unsigned(); // Use bigInteger for an auto-incrementing column
            $table->decimal('withdraw_amount', 10, 2);
            $table->integer('withdraw_status')->default(0);
            $table->timestamps();
    
            // Define withdraw_account as the primary key
            // $table->primary('withdraw_account');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraws');
    }
};
