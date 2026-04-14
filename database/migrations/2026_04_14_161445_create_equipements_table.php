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
    Schema::create('equipements', function (Blueprint $table) {
        $table->id('id_equipement'); 
        $table->string('nom');
        $table->string('categorie');
        $table->integer('quantite');
        $table->decimal('prix', 8, 2);
        $table->date('date_expiration')->nullable();
        $table->string('etat')->default('VALIDE');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipements');
    }
};
