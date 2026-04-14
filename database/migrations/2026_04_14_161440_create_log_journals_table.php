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
    Schema::create('log_journals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('idUtilisateur')->constrained('utilisateurs')->onDelete('cascade');
        $table->string('action');
        $table->timestamp('timestamp')->useCurrent();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_journals');
    }
};
