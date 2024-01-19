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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('bank_id')->constrained()->onDelete('cascade');
            $table->string('address')->nullable();
            $table->double('lat', 10, 6)->nullable();
            $table->double('lng', 10, 6)->nullable();
            $table->string('phone')->nullable();
            $table->string('api_id')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
