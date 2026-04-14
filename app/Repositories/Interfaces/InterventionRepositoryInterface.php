<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface InterventionRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id);
    public function findByDossierId(int $dossierId): Collection;
    public function create(array $data);
    public function update(int $id, array $data);
}
