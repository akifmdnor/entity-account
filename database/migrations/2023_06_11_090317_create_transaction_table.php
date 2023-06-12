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
        Schema::connection('mongodb')->create('transactions', function ($collection) {
            $collection->index('entity_id');
            $collection->index('transaction_total');
            $collection->index('transaction_comission');
            $collection->index('net_transaction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction');
    }
};
