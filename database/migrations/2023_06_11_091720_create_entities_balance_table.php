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
        Schema::create('entities_balance', function (Blueprint $table) {
            $table->id();
            $table->foreign('entity_id')->references('id')->on('transactions');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->bigInteger('balance')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entities_balance');
    }
};
