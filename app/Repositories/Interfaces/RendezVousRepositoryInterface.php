<?php
namespace App\Repositories\Interfaces;
use Illuminate\Support\Collection;
interface RendezVousRepositoryInterface {
    public function getAll(): Collection;
    public function findById(int $id);
    public function findByPatient(int $patientId): Collection;
    public function create(array $data);
    public function updateState(int $id, \App\Enums\RendezVousState $state);
    public function checkConflict(string $date, string $heure, string $medecinId);
}
