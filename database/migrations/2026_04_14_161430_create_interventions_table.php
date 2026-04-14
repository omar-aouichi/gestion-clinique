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
    Schema::create('interventions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('dossier_id')->constrained('dossier_medicals')->onDelete('cascade');
        $table->foreignId('medecin_id')->constrained('utilisateurs')->onDelete('cascade');
        $table->dateTime('date');
        $table->string('type');
        $table->text('compte_rendu')->nullable();
        $table->string('statut')->default('PLANIFIEE'); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
