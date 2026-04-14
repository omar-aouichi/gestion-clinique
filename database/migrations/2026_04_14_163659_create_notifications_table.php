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
    Schema::create('notifications', function (Blueprint $table) {
        $table->id(); // Corresponds to id_notif
        $table->foreignId('demande_id')->nullable()->constrained('demandes')->onDelete('cascade');
        $table->foreignId('destinataire_id')->constrained('utilisateurs')->onDelete('cascade');
        $table->text('message');
        $table->dateTime('date_envoi');
        $table->string('destinataire')->nullable(); // e.g., 'Responsable RH' or 'Directeur General'
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
