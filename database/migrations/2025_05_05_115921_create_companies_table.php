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
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("Korhona nomi");
            $table->string('ceo')->comment("Korhona rahbari FIO si");
            $table->string('address')->comment("Korhona manzili");
            // $table->string('email')->unique()->comment("Korhona emaili");
            $table->string('website')->comment("Korhona websayti");
            $table->string('phone')->comment("Korhona telefon raqami");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
