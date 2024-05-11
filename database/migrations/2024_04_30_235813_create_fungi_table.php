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
        Schema::create('fungi', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->integer('inaturalist_taxa')->nullable();
            $table->integer('bem');
            $table->string('kingdom', 255);
            $table->string('phylum', 255);
            $table->string('class', 255);
            $table->string('order', 255);
            $table->string('family', 255);
            $table->string('genus', 255);
            $table->string('specie', 255);
            $table->string('scientific_name', 255);
            $table->string('popular_name', 255)->nullable();
            $table->integer('threatened')->nullable();
            $table->string('description', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fungi');
    }
};
