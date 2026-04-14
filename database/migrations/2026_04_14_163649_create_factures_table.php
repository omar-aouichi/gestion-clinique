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
    Schema::create('factures', function (Blueprint $table) {
        $table->id(); // Corresponds to id_facture
        $table->foreignId('patient_id')->constrained('utilisateurs')->onDelete('cascade');
        $table->foreignId('secretaire_id')->nullable()->constrained('utilisateurs')->onDelete('set null');
        $table->decimal('montant', 10, 2);
        $table->date('date_emission');
        $table->boolean('etat_paiement')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
