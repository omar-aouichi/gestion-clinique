<?php

namespace App\Repositories\Interfaces;

use App\DTOs\CommandeDTO;
use App\Enums\CommandeState;
use Illuminate\Support\Collection;

interface CommandeRepositoryInterface
{
    public function getAll(): Collection;
    public function findById(int $id);
    public function create(CommandeDTO $commande);
    public function updateState(int $id, CommandeState $state);
}
