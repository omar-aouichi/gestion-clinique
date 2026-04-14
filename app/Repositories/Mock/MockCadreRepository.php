<?php

namespace App\Repositories\Mock;

use App\DTOs\CadreDTO;
use App\Enums\CadreState;
use App\Repositories\Interfaces\CadreRepositoryInterface;
use Illuminate\Support\Collection;

class MockCadreRepository implements CadreRepositoryInterface
{
    private static ?Collection $cadres = null;

    public function __construct()
    {
        if (self::$cadres === null) {
            self::$cadres = collect([
                new CadreDTO(1, 'Ahmed Alami', ['SIGN', 'VALIDATE'], CadreState::AUTHENTIFIE),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$cadres;
    }

    public function findById(int $id)
    {
        return self::$cadres->first(fn($c) => $c->id === $id);
    }

    public function create(array $data)
    {
        $id = self::$cadres->max('id') + 1;
        $cadre = new CadreDTO(
            $id,
            $data['nom'],
            $data['droits'] ?? [],
            $data['state'] ?? CadreState::AUTHENTIFIE
        );
        self::$cadres->push($cadre);
        return $cadre;
    }

    public function update(int $id, array $data)
    {
        $cadre = $this->findById($id);
        if ($cadre) {
            foreach ($data as $key => $value) {
                if (property_exists($cadre, $key)) $cadre->{$key} = $value;
            }
        }
        return $cadre;
    }

    public function delete(int $id)
    {
        self::$cadres = self::$cadres->reject(fn($c) => $c->id === $id);
    }
}
