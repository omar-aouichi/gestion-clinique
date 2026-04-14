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
    Schema::create('commandes', function (Blueprint $table) {
        $table->id(); // Corresponds to id_commande
        $table->foreignId('fournisseur_id')->constrained('fournisseurs')->onDelete('cascade');
        $table->date('date_commande');
        $table->date('date_livraison')->nullable();
        $table->string('etat')->default('CREEE');
        $table->decimal('montant', 10, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
