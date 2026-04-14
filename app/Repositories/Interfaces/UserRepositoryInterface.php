<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id);
    public function findByLogin(string $login);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
