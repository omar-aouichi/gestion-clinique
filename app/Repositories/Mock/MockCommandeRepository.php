<?php

namespace App\Repositories\Mock;

use App\DTOs\CommandeDTO;
use App\Enums\CommandeState;
use App\Repositories\Interfaces\CommandeRepositoryInterface;
use Illuminate\Support\Collection;

class MockCommandeRepository implements CommandeRepositoryInterface
{
    private static ?Collection $commandes = null;

    public function __construct()
    {
        if (self::$commandes === null) {
            self::$commandes = collect([
                new CommandeDTO(1, '2024-04-10', null, CommandeState::CREE, 1500.50, 'PharmaCorp'),
                new CommandeDTO(2, '2024-04-05', '2024-04-08', CommandeState::LIVRE, 3200.00, 'MedSupplies'),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$commandes ?? collect();
    }

    public function findById(int $id)
    {
        return self::$commandes->first(fn($c) => $c->id_commande === $id);
    }

    public function create(CommandeDTO $commande)
    {
        self::$commandes->push($commande);
        return $commande;
    }

    public function updateState(int $id, CommandeState $state)
    {
        $commande = $this->findById($id);
        if ($commande) {
            $commande->etat = $state;
            return true;
        }
        return false;
    }
}
