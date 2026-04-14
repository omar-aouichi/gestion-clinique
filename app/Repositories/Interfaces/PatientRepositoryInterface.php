<?php
namespace App\Repositories\Interfaces;
use Illuminate\Support\Collection;
interface PatientRepositoryInterface {
    public function getAll(): Collection;
    public function findById(int $id);
    public function findByCIN(string $cin);
    public function create(array $data);
    public function updateState(int $id, \App\Enums\PatientState $state);
    public function update(int $id, array $data);
}
