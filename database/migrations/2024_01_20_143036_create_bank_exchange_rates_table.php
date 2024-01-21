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
        Schema::create('bank_exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id')->constrained()->onDelete('cascade');
            $table->foreignId('bank_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'cash' or 'card'
            $table->double('bid', 10, 6)->nullable();
            $table->double('ask', 10, 6)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_exchange_rates');
    }
};
