<?php

namespace App\Repositories\Mock;

use App\DTOs\PatientDTO;
use App\Enums\PatientState;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use Illuminate\Support\Collection;

class MockPatientRepository implements PatientRepositoryInterface
{
    private static ?Collection $patients = null;

    public function __construct()
    {
        if (self::$patients === null) {
            self::$patients = collect([
                new PatientDTO(1, 'G123456', 'Aouichi', 'Omar', 'omar@example.com', '0612345678', PatientState::ACTIF, false, 'MRN-001', 0),
                new PatientDTO(2, 'F987654', 'Benzema', 'Karim', 'karim@example.com', '0600000000', PatientState::ACTIF, false, 'MRN-002', 1),
                new PatientDTO(3, 'X000000', 'Sous X', 'Inconnu', 'hopital@emerg.ch', '0000000000', PatientState::ACTIF, true, 'MRN-003', 0),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$patients;
    }

    public function findById(int $id)
    {
        return self::$patients->first(fn($p) => $p->id === $id);
    }

    public function findByCIN(string $cin)
    {
        return self::$patients->first(fn($p) => $p->cin === $cin);
    }

    public function create(array $data)
    {
        $id = self::$patients->max('id') + 1;
        $patient = new PatientDTO(
            $id,
            $data['cin'],
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['telephone'],
            $data['state'] ?? PatientState::ACTIF,
            $data['sousX'] ?? false,
            $data['medical_record_number'] ?? null,
            $data['absences_non_justifiees'] ?? 0
        );
        self::$patients->push($patient);
        return $patient;
    }

    public function updateState(int $id, PatientState $state)
    {
        $p = $this->findById($id);
        if ($p) {
            $p->state = $state;
            return true;
        }
        return false;
    }

    public function update(int $id, array $data)
    {
        $p = $this->findById($id);
        if ($p) {
            foreach ($data as $key => $value) {
                if (property_exists($p, $key)) $p->{$key} = $value;
            }
            return $p;
        }
        return false;
    }


}
