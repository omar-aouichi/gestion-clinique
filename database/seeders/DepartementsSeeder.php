<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departement;
use App\Models\Utilisateur;

class DepartementsSeeder extends Seeder
{
    public function run(): void
    {
        $deps = [
            ['nom' => 'Urgences',     'batiment' => 'Bloc A'],
            ['nom' => 'Cardiologie',  'batiment' => 'Bloc B'],
            ['nom' => 'Radiologie',   'batiment' => 'Bloc C'],
            ['nom' => 'Pédiatrie',    'batiment' => 'Bloc A'],
            ['nom' => 'Chirurgie',    'batiment' => 'Bloc B'],
            ['nom' => 'Administration','batiment' => 'Bloc Central'],
        ];

        $medecin = Utilisateur::where('role', 'medecin')->first();
        $rh      = Utilisateur::where('role', 'rh')->first();

        foreach ($deps as $index => $data) {
            $dep = Departement::create($data);
            
            // Assign some responsibles for testing
            if ($index === 0 && $medecin) {
                $dep->update(['responsable_id' => $medecin->id]);
            }
            if ($index === 5 && $rh) {
                $dep->update(['responsable_id' => $rh->id]);
            }
        }

        $this->command->info('✅ ' . count($deps) . ' départements créés.');
    }
}
