<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface CadreRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
