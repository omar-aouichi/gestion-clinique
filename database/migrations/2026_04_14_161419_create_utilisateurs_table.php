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
    Schema::create('utilisateurs', function (Blueprint $table) {
        $table->id();
        $table->string('login')->unique();
        $table->string('mdp');
        $table->string('nom');
        $table->string('prenom');
        $table->date('dateNaissance');
        $table->string('contact');
        $table->string('role'); 
        $table->string('statut')->default('ACTIF'); 
        $table->boolean('sousX')->default(false);
        
        $table->foreignId('departement_id')->nullable()->constrained('departements')->nullOnDelete();
        $table->integer('absences_non_justifiees')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
