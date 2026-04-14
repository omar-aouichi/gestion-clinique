<?php

namespace App\Repositories\Mock;

use App\DTOs\DossierMedicalDTO;
use App\Enums\DossierState;
use App\Repositories\Interfaces\DossierMedicalRepositoryInterface;
use Illuminate\Support\Collection;

class MockDossierMedicalRepository implements DossierMedicalRepositoryInterface
{
    private static ?Collection $dossiers = null;

    public function __construct()
    {
        if (self::$dossiers === null) {
            self::$dossiers = collect([
                new DossierMedicalDTO(
                    1, 1, DossierState::ACTIF,
                    [
                        ['type' => 'Consultation Générale', 'date' => '2026-03-10', 'medecin' => 'Dr. Alami'],
                        ['type' => 'Analyse Sanguine', 'date' => '2026-03-15', 'medecin' => 'Dr. Alami'],
                        ['type' => 'Radiographie Thorax', 'date' => '2026-04-01', 'medecin' => 'Dr. Benani'],
                    ],
                    true
                ),
                new DossierMedicalDTO(
                    2, 2, DossierState::ACTIF,
                    [
                        ['type' => 'Examen Ophtalmologique', 'date' => '2026-04-05', 'medecin' => 'Dr. Fassi'],
                    ],
                    false
                ),
                new DossierMedicalDTO(3, 3, DossierState::ARCHIVE, [], false),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$dossiers;
    }

    public function findById(int $id)
    {
        return self::$dossiers->first(fn($d) => $d->id === $id);
    }

    public function findByPatientId(int $patientId)
    {
        return self::$dossiers->first(fn($d) => $d->patient_id === $patientId);
    }

    public function create(array $data)
    {
        $id = (self::$dossiers->max('id') ?? 0) + 1;
        $dossier = new DossierMedicalDTO(
            $id,
            $data['patient_id'],
            $data['state'] ?? DossierState::ACTIF,
            $data['actes'] ?? [],
            $data['resultats_valides'] ?? false
        );
        self::$dossiers->push($dossier);
        return $dossier;
    }

    public function update(int $id, array $data)
    {
        $dossier = $this->findById($id);
        if ($dossier) {
            foreach ($data as $key => $value) {
                if (property_exists($dossier, $key)) {
                    $dossier->{$key} = $value;
                }
            }
        }
        return $dossier;
    }
}
