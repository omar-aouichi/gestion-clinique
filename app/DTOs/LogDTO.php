<?php

namespace App\DTOs;

class LogDTO
{
    public function __construct(
        public int $id,
        public string $timestamp,
        public string $action,
        public int $user_id,
        public ?string $user_name = null
    ) {}
}
