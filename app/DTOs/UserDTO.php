<?php

namespace App\DTOs;

use App\Enums\UserRole;

class UserDTO
{
    public function __construct(
        public int $id,
        public string $login,
        public string $password,
        public string $nom,
        public string $prenom,
        public string $dateNaissance,
        public string $contact,
        public UserRole $role
    ) {}
}
