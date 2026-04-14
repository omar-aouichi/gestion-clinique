<?php

namespace App\Repositories\Mock;

use App\DTOs\UserDTO;
use App\Enums\UserRole;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;

class MockUserRepository implements UserRepositoryInterface
{
    private static ?Collection $users = null;

    public function __construct()
    {
        if (self::$users === null) {
            self::$users = collect([
                new UserDTO(1, 'admin', 'password', 'Technique', 'Admin', '1980-01-01', 'admin@hopital.com', UserRole::ADMIN_TECHNIQUE),
                new UserDTO(2, 'drhouse', 'password', 'House', 'Gregory', '1970-05-15', 'house@hopital.com', UserRole::MEDECIN),
                new UserDTO(3, 'sec_sophie', 'password', 'Bernard', 'Sophie', '1990-10-20', 'sophie@hopital.com', UserRole::SECRETAIRE),
            ]);
        }
    }

    public function getAll(): Collection
    {
        return self::$users;
    }

    public function findById(int $id)
    {
        return self::$users->first(fn($u) => $u->id === $id);
    }

    public function findByLogin(string $login)
    {
        return self::$users->first(fn($u) => $u->login === $login);
    }

    public function create(array $data)
    {
        $id = self::$users->max('id') + 1;
        $user = new UserDTO(
            $id,
            $data['login'],
            $data['password'] ?? 'password',
            $data['nom'],
            $data['prenom'],
            $data['dateNaissance'] ?? '1990-01-01',
            $data['contact'],
            $data['role']
        );
        self::$users->push($user);
        return $user;
    }

    public function update(int $id, array $data)
    {
        $user = $this->findById($id);
        if ($user) {
            foreach ($data as $key => $value) {
                if (property_exists($user, $key)) {
                    $user->{$key} = $value;
                }
            }
            return $user;
        }
        return null;
    }

    public function delete(int $id)
    {
        self::$users = self::$users->reject(fn($u) => $u->id === $id);
    }
}
