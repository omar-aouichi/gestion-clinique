<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'login'         => 'admin',
                'mdp'           => Hash::make('admin123'),
                'nom'           => 'Système',
                'prenom'        => 'Admin',
                'dateNaissance' => '1980-01-01',
                'contact'       => '0600000001',
                'role'          => 'admin',
                'absences_non_justifiees' => 0,
            ],
            [
                'login'         => 'secretaire1',
                'mdp'           => Hash::make('password'),
                'nom'           => 'Benchikh',
                'prenom'        => 'Fatima',
                'dateNaissance' => '1990-05-15',
                'contact'       => '0600000002',
                'role'          => 'secretaire',
                'absences_non_justifiees' => 0,
            ],
            [
                'login'         => 'docteur1',
                'mdp'           => Hash::make('password'),
                'nom'           => 'Alami',
                'prenom'        => 'Karim',
                'dateNaissance' => '1978-03-20',
                'contact'       => '0600000003',
                'role'          => 'medecin',
                'absences_non_justifiees' => 0,
            ],
            [
                'login'         => 'infirmier1',
                'mdp'           => Hash::make('password'),
                'nom'           => 'Idrissi',
                'prenom'        => 'Sanae',
                'dateNaissance' => '1995-07-10',
                'contact'       => '0600000004',
                'role'          => 'infirmier',
                'absences_non_justifiees' => 0,
            ],
            [
                'login'         => 'rh1',
                'mdp'           => Hash::make('password'),
                'nom'           => 'Ouali',
                'prenom'        => 'Mourad',
                'dateNaissance' => '1985-11-03',
                'contact'       => '0600000005',
                'role'          => 'rh',
                'absences_non_justifiees' => 0,
            ],
            [
                'login'         => 'stock1',
                'mdp'           => Hash::make('password'),
                'nom'           => 'Berrada',
                'prenom'        => 'Hassan',
                'dateNaissance' => '1988-09-25',
                'contact'       => '0600000006',
                'role'          => 'gerant_stock',
                'absences_non_justifiees' => 0,
            ],
            [
                'login'         => 'cadre1',
                'mdp'           => Hash::make('password'),
                'nom'           => 'Lahlou',
                'prenom'        => 'Rachid',
                'dateNaissance' => '1975-02-14',
                'contact'       => '0600000007',
                'role'          => 'cadre_administratif',
                'absences_non_justifiees' => 0,
            ],
            [
                'login'         => 'dg',
                'mdp'           => Hash::make('password'),
                'nom'           => 'Marrakchi',
                'prenom'        => 'Youssef',
                'dateNaissance' => '1970-08-05',
                'contact'       => '0600000008',
                'role'          => 'dg',
                'absences_non_justifiees' => 0,
            ],
            [
                'login'         => 'patient1',
                'mdp'           => Hash::make('password'),
                'nom'           => 'Aouichi',
                'prenom'        => 'Omar',
                'dateNaissance' => '1998-04-22',
                'contact'       => '0612345678',
                'role'          => 'patient',
                'absences_non_justifiees' => 0,
            ],
        ];

        foreach ($users as $data) {
            Utilisateur::updateOrCreate(['login' => $data['login']], $data);
        }

        $this->command->info('✅ ' . count($users) . ' utilisateurs créés/mis à jour.');
    }
}
