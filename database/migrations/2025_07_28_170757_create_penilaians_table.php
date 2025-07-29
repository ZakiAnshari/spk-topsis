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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            // Foreign keys
            $table->unsignedBigInteger('alternatif_id');
            $table->unsignedBigInteger('kriteria_id');
            $table->unsignedBigInteger('subkriteria_id');

            // Nilai penilaian
            $table->decimal('nilai', 8, 2)->nullable(); // nilai bisa desimal
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('alternatif_id')->references('id')->on('alternatifs');
            $table->foreign('kriteria_id')->references('id')->on('kriterias');
            $table->foreign('subkriteria_id')->references('id')->on('subkriterias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
