<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface DossierMedicalRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id);
    public function findByPatientId(int $patientId);
    public function create(array $data);
    public function update(int $id, array $data);
}
