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
        Schema::create('occurrence', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->integer('inaturalist_taxa')->nullable();
            $table->string('specieslink_id')->nullable();
            $table->integer('type');
            $table->char('state_acronym', 2);
            $table->string('state_name', 255);
            $table->string('habitat', 255)->nullable();
            $table->string('literature_reference', 255)->nullable();
            $table->double('latitude', 10,8)->nullable();
            $table->double('longitude', 11,8)->nullable();
            $table->boolean('curation')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occurrence');
    }
};
