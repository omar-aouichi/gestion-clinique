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
    Schema::create('demandes', function (Blueprint $table) {
        $table->id(); // Corresponds to id_demande
        $table->foreignId('employe_id')->constrained('utilisateurs')->onDelete('cascade');
        $table->string('type');
        $table->date('date');
        $table->string('statut')->default('EN_ATTENTE');
        $table->text('description')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
