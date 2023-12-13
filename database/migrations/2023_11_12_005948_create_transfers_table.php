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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id('transfer_id');
            $table->string('from_user')->nullable();
            $table->decimal('transfer_amount', 10,2)->none();
            $table->string('transfer_wallet', 50);
            $table->string('to_user')->nullable();
            $table->integer('transfer_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
