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
    Schema::create('fournisseurs', function (Blueprint $table) {
        $table->id(); // Corresponds to id_fournisseur
        $table->string('nom_fournisseur');
        $table->string('prenom_fournisseur');
        $table->string('email_fournisseur')->unique();
        $table->string('telephone');
        $table->string('num_compte');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
