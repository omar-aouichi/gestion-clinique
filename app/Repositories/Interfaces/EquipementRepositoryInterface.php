<?php

namespace App\Repositories\Interfaces;

use App\Enums\EquipementState;
use Illuminate\Support\Collection;

interface EquipementRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id);
    public function updateQuantity(int $id, int $amount);
    public function updateState(int $id, EquipementState $state);
}
