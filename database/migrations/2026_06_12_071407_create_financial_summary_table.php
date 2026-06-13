<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_summary', function (Blueprint $table) {
            $table->id();
            $table->string('category');

            $table->bigInteger('amount_2022_01')->default(0);
            $table->bigInteger('amount_2022_02')->default(0);
            $table->bigInteger('amount_2022_03')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_summary');
    }
};