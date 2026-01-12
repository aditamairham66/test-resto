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
        Schema::create('master_category', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 191)->nullable();
        });

        Schema::create('master_ingridient', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 191)->nullable();
        });

        Schema::create('receipt', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('master_category_id')->index('category')->nullable();
            $table->string('name', 191)->nullable();
        });

        Schema::create('receipt_ingridient', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('receipt_id')->index('receipt')->nullable();
            $table->foreignId('master_ingridient_id')->index('ingridient')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt');
    }
};
