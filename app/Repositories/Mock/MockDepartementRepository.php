<?php

namespace App\Repositories\Mock;

use App\DTOs\DepartementDTO;
use App\Repositories\Interfaces\DepartementRepositoryInterface;
use Illuminate\Support\Collection;

class MockDepartementRepository implements DepartementRepositoryInterface
{
    private static ?Collection $departements = null;

    public function __construct()
    {
        if (self::$departements === null) {
            self::$departements = collect([
                new DepartementDTO(1, 'Médecine Interne'),
                new DepartementDTO(2, 'Administration'),
                new DepartementDTO(3, 'Ressources Humaines'),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$departements;
    }

    public function findById(int $id)
    {
        return self::$departements->first(fn($d) => $d->id === $id);
    }

    public function create(array $data)
    {
        $id = self::$departements->max('id') + 1;
        $departement = new DepartementDTO($id, $data['nom_departement']);
        self::$departements->push($departement);
        return $departement;
    }

    public function delete(int $id)
    {
        self::$departements = self::$departements->reject(fn($d) => $d->id === $id);
    }
}
