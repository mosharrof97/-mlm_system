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
        Schema::create('refer_bonuses', function (Blueprint $table) {
            $table->id('bonus_id');
            $table->integer('user_id');
            $table->decimal('bonus_amount');
            $table->date('bonus_date');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refer_bonuses');
    }
};
