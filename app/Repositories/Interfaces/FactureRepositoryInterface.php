<?php
namespace App\Repositories\Interfaces;
use Illuminate\Support\Collection;
interface FactureRepositoryInterface {
    public function getAll(): Collection;
    public function findById(int $id);
    public function findByPatient(int $patientId): Collection;
    public function create(array $data);
    public function updateState(int $id, \App\Enums\FactureState $state);
}
