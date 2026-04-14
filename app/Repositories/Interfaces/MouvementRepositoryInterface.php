<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface MouvementRepositoryInterface
{
    public function getAll(): Collection;
    public function create(array $data);
}
