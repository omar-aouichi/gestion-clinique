<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface AlerteRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id);
    public function create(array $data);
    public function markAsResolved(int $id);
}
