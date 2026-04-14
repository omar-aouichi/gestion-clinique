<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface DemandeRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
}
