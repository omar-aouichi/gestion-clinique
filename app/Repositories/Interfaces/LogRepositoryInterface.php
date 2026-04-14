<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface LogRepositoryInterface
{
    public function getAll(): Collection;
    public function create(array $data);
}
