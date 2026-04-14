<?php

namespace App\Repositories\Mock;

use App\DTOs\EmployeDTO;
use App\Enums\EmployeState;
use App\Repositories\Interfaces\EmployeRepositoryInterface;
use Illuminate\Support\Collection;

class MockEmployeRepository implements EmployeRepositoryInterface
{
    private static ?Collection $employees = null;

    public function __construct()
    {
        if (self::$employees === null) {
            self::$employees = collect([
                new EmployeDTO(1, 'Aouichi Omar', 1, EmployeState::ACTIF, 'Médecine Interne'),
                new EmployeDTO(2, 'Benzema Karim', 1, EmployeState::ACTIF, 'Médecine Interne'),
                new EmployeDTO(3, 'Sophie Bernard', 2, EmployeState::EN_CONGE, 'Administration'),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$employees;
    }

    public function findById(int $id)
    {
        return self::$employees->first(fn($e) => $e->id === $id);
    }

    public function create(array $data)
    {
        $id = self::$employees->max('id') + 1;
        $employee = new EmployeDTO(
            $id,
            $data['nom'],
            $data['departement_id'],
            $data['state'] ?? EmployeState::ACTIF,
            $data['departement_nom'] ?? 'Unassigned'
        );
        self::$employees->push($employee);
        return $employee;
    }

    public function update(int $id, array $data)
    {
        $employee = $this->findById($id);
        if ($employee) {
            foreach ($data as $key => $value) {
                if (property_exists($employee, $key)) $employee->{$key} = $value;
            }
        }
        return $employee;
    }

    public function delete(int $id)
    {
        self::$employees = self::$employees->reject(fn($e) => $e->id === $id);
    }
}
