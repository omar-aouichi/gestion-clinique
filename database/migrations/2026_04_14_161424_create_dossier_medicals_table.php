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
    Schema::create('dossier_medicals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('patient_id')->constrained('utilisateurs')->onDelete('cascade');
        $table->string('statut')->default('ACTIF');
        $table->json('actes')->nullable();
        $table->boolean('resultats_valides')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossier_medicals');
    }
};
