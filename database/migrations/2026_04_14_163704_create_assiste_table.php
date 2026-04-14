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
    Schema::create('assiste', function (Blueprint $table) {
        $table->foreignId('infirmier_id')->constrained('utilisateurs')->onDelete('cascade');
        $table->foreignId('intervention_id')->constrained('interventions')->onDelete('cascade');
        
        // This ensures the same nurse cannot be assigned to the exact same intervention twice
        $table->primary(['infirmier_id', 'intervention_id']); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assiste');
    }
};
